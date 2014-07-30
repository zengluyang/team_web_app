<?php
Yii::import('application.vendor.*');
require_once('PHPExcel/PHPExcel.php');
//require_once('PHPExcel/Writer/Excel2007.php');
class PaperController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */

    public $layout='//layouts/column2';


	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','download', 'admin'),
				'expression'=>'isset($user->is_paper) && $user->is_paper'
			),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('create','testExcelExport','testExcelExportByTable','query','testSearchByPeople','reset','upload','admin','delete','import','testXls','TestCsv','TestPhpExcelCsv','exportAll'),
                'expression'=>'isset($user->is_admin) && $user->is_admin',
            ),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

    public function actionUpload() {
        set_time_limit(50);
        if(isset($_FILES['spreedSheet']) && !empty($_FILES['spreedSheet'])) {
            $path = $_FILES['spreedSheet']['tmp_name'];
            echo $_FILES['spreedSheet']['name']."<hr />";
            echo $_FILES['spreedSheet']['type']."<hr />";
            echo $_FILES['spreedSheet']['tmp_name']."<hr />";
            if(self::saveXlsToDb($path)){
                echo 'function actionUpload() succeeded.<hr />';
                $this->redirect(array('index'));
            }
        }


        $this->render('upload');
    }

    public function actionReset() {
        Paper::model()->deleteAll();
    }

    protected function saveXlsToDb($xlsPath) {
        $papers = self::xlsToArray($xlsPath);
        return self::saveXlsArrayToDb($papers);
    }

    public function xlsToArray($path)
    {
        Yii::trace("start of loading","actionTestXls()");
        //$reader = PHPExcel_IOFactory::createReader('Excel5');
        //$reader->setReadDataOnly(true);
        $objPHPExcel = PHPExcel_IOFactory::load($path);
        Yii::trace("end of loading","actionTestXls()");
        Yii::trace("start of reading","actionTestXls()");
        $dataArray = $objPHPExcel->getActiveSheet()->toArray(null,true,true);
        Yii::trace("end of reading","actionTestXls()");
        array_shift($dataArray);
        //var_dump($dataArray);
        return $dataArray;
    }

    private function convertYesNoToInt($yesno) {
        if($yesno=='是') {
            return 1;
        }else if($yesno=='否'){
            return 0;
        }
        return 0;
    }

    private function converIntToYesNo($int) {
        if($int==1)
            return '是';
        else
            return '';
    }

    public function saveXlsArrayToDb($papers)
    {
        $connection=Yii::app()->db;
        foreach($papers as $k => $p) {
            //var_dump($k);
            //var_dump($p);
            if(($paper=Paper::model()->findByAttributes(array('info'=>$p[0])))==null){ 
                $paper = new Paper;
            }
            $paper->info=$p[0];
            if(isset($p[11]) && self::convertYesNoToInt($p[1])) {
                $paper->status = Paper::STATUS_PASSED;
            } else if(isset($p[12]) && self::convertYesNoToInt($p[12])) {
                $paper->status = Paper::STATUS_PUBLISHED;
            } else if(isset($p[13]) && self::convertYesNoToInt($p[13])) {
                $paper->status = Paper::STATUS_INDEXED;
            } else {
                $paper->status = null;
            }
            $paper->pass_date = $p[14];
            $paper->pub_date = $p[15];
            $paper->index_date = $p[16];
            if($paper->pass_date!=null)
                $paper->status = Paper::STATUS_PASSED;
            if($paper->pub_date!=null)
                $paper->status = Paper::STATUS_PUBLISHED;
            if($paper->index_date!=null)
                $paper->status = Paper::STATUS_INDEXED;
            $paper->sci_number = $p[17];
            $paper->ei_number = $p[18];
            $paper->istp_number = $p[19];
            $paper->is_first_grade = self::convertYesNoToInt($p[20]);
            $paper->is_core = self::convertYesNoToInt($p[21]);
            $paper->other_pub = self::convertYesNoToInt($p[22]);
            $paper->is_journal = self::convertYesNoToInt($p[23]);
            $paper->is_core = self::convertYesNoToInt($p[24]);
            $paper->is_intl = self::convertYesNoToInt($p[25]);
            $paper->is_domestic = self::convertYesNoToInt($p[26]);
            $paper->file_name = $p[27];
            $paper->is_high_level = self::convertYesNoToInt($p[58]);
            if($paper->save()) {
                $peoplesId=array();
                for($i=0;$i<5;$i=$i+2){
                    $peopleName=$p[1+$i];

                    $people = People::model()->findByAttributes(array('name'=>$peopleName));
                    if($people!=null) {
                        $peoplesId[]=$people->id;

                    }else {
                        $people = new People;
                        $people->name = $peopleName;
                        if($people->save()){
                            $peoplesId[] = $people->id;
                        }
                    }
                }
                if(!self::populatePeople($paper,$peoplesId))
                    return false;

            } else {
                var_dump( $paper->getErrors());
                //var_dump($paper->info);
                return false;
            }
        }
        return true;
    }

    private function populatePeople($paper, $peoples)
    {
        for($i=0;$i<count($peoples);$i++) {
            if($peoples[$i]!=null && $peoples[$i]!=0) {
                //@TODO : can be optimized.
                if(($paperPeople=PaperPeople::model()->findByPk(array('paper_id'=>$paper->id,'people_id'=>$peoples[$i])))!=null){
                    $paperPeople->delete();
                } 
                $paperPeople = new PaperPeople;
                $paperPeople->seq = $i+1;
                $paperPeople->paper_id=$paper->id;
                $paperPeople->people_id=$peoples[$i];
                //echo $paperPeople->paper_id." ".$paperPeople->people_id."<br>";
                if($paperPeople->save()) {
                    yii::trace("peoples[i]:".$peoples[$i]." saved","paperController.actionCreate()");
                } else {
                    return false;
                }
            }
        }
        return true;
    }


	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Paper;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Paper'])) {
			$model->attributes=$_POST['Paper'];
            self::setModelProjects($model);
			if ($model->save()) {
                $peoples = $_POST['Paper']['peoples'];
                self::populatePeople($model, $peoples);
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Paper'])) {
			$model->attributes=$_POST['Paper'];
            self::setModelProjects($model);
            $model->scenario='update';
			if ($model->save()) {
                $criteria = new CDbCriteria;
                $criteria->condition = 'paper_id=:paper_id';
                $criteria->params = array(':paper_id'=>$model->id);
                PaperPeople::model()->deleteAll($criteria);
                $peoples = $_POST['Paper']['peoples'];
                self::populatePeople($model, $peoples);
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

    public function actionDownload() {
        $model=$this->loadModel($_GET['id']);
        //header('Pragma: public');
        //header('Expires: 0');
        //header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Content-Transfer-Encoding: binary');
        header('Content-length: '.$model->file_size);
        header('Content-Type: '.$model->file_type);
        //header('Content-Disposition: attachment; filename='.$model->file_name);
        echo $model->file_content;
    }

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if (Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax'])) {
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
			}
		} else {
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		}
	}

	/**
	 * Lists all models.
	 */

	public function actionIndex()
	{
        $criteria = new CDbCriteria;
        //$criteria->condition = "is_high_level=1";
		$dataProvider=new CActiveDataProvider(
            'Paper',
            array('sort'=>array(
                'defaultOrder'=>array(
                    'index_date' => true
                ),

            ),
                'criteria' => $criteria,
            )
        );
        //$dataProvider->pagination=false;
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}


    public function actionAdminTODO() {
        $model = new Paper('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Paper'])) {
            $model->attributes=$_GET['Paper'];
            if($_GET['Paper']['is_first_grade']=='0') {
                $model->is_first_grade="";
            }
            if($_GET['Paper']['is_core']=='0') {
                $model->is_core="";
            }
            if($_GET['Paper']['is_journal']=='0') {
                $model->is_journal="";
            }
            if($_GET['Paper']['is_conference']=='0') {
                $model->is_conference="";
            }
            if($_GET['Paper']['is_domestic']=='0') {
                $model->is_domestic="";
            }
            if($_GET['Paper']['is_high_level']=='0') {
                $model->is_high_level="";
            }
            if($_GET['Paper']['is_intl']=='0') {
                $model->is_intl="";
            }

            $peopleNameArr=array();
            if(!empty($_GET['People']['execute_id'])){
                $people=People::model()->findByPk($_GET['People']['execute_id']);
                $model->searchExecutePeople=$people->id;
                $peopleNameArr[]=$people->name;

            }
            if(!empty($_GET['People']['liability_id'])){
                $people=People::model()->findByPk($_GET['People']['liability_id']);
                $model->searchExecutePeople=$people->id;
                $peopleNameArr[]=$people->name;
            }
            
        }
        if( isset($_GET['export']) && $_GET['export']) {
            $dataProvider=$model->search();
            $dataProvider->pagination=false;
            self::exportProjectsToXlsByPeople($dataProvider->getData(),'参与者包括'.implode('， ',$peopleNameArr).'的项目');
        } else {
            $this->render('admin',array(
                'model'=>$model,
            ));
        }

    }
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
        $isByMaintainer = false;
        $isByPeople = false;
        $isByDate = false;
        $isByProject = false;
        $fileName = array();
        $criteria = new CDbCriteria();
        $criteria->with = array('peoples','fund_projects','reim_projects');
        $criteria->together = true;
        $criteria->group = 't.id';
        $params = array();
        // do not manually cat sql string, use methods like CDbCriteria::addCondition()!
        // or there will be sql injection vulnerability!
        // http://www.yiiframework.com/forum/index.php/topic/13119-sql-injection-question/
        if(isset($_GET['People']['id']) && $_GET['People']['id']) {
            $isByPeople = true;
            $people = People::model()->find('id=:id',array(':id'=>$_GET['People']['id']));
            $peopleName = isset($people) ? $people->name : "";
            array_push($fileName,$peopleName."发表");
            $criteria->addCondition('peoples_.id=:people_id');
            $params[':people_id']=$_GET['People']['id'];
        };
        if(isset($_GET['Paper']['maintainer_id']) && $_GET['Paper']['maintainer_id']){
            $isByMaintainer = true;
            $isByPeople = true;
            $people = People::model()->find('id=:id',array(':id'=>$_GET['Paper']['maintainer_id']));
            $peopleName = isset($people) ? $people->name : "";
            array_push($fileName,$peopleName."维护");
            $criteria->addCondition('t.maintainer_id=:maintainer_id');
            $params[':maintainer_id']=$_GET['Paper']['maintainer_id'];
        }
        if(isset($_GET['Project']['fund_id']) && $_GET['Project']['fund_id']){
            $isByProject = true;
            $project=Project::model()->find('id=:id',array(':id'=>$_GET['Project']['fund_id']));
            array_push($fileName,'支柱项目为'.$project->name);
            $criteria->addCondition('fund_.id=:fund_id');
            $params[':fund_id']=$_GET['Project']['fund_id'];
        }
        if(isset($_GET['Project']['reim_id']) && $_GET['Project']['reim_id']){
            $isByProject = true;
            $project=Project::model()->find('id=:id',array(':id'=>$_GET['Project']['reim_id']));
            array_push($fileName,'报账项目为'.$project->name);
            $criteria->addCondition('reim_.id=:reim_id');
            $params[':reim_id']=$_GET['Project']['reim_id'];
        }
        if(isset($_GET['start_date']) && $_GET['start_date']){
            $isByDate = true;
            array_push($fileName,'在'.$_GET['start_date'].'之后');
            $criteria->addCondition('t.index_date > :start_date');
            $params[':start_date']=$_GET['start_date'];
        }
        if(isset($_GET['end_date']) && $_GET['end_date'] ){
            $isByDate = true;
            array_push($fileName,'在'.$_GET['end_date'].'之前');
            $criteria->addCondition('t.index_date < :end_date');
            $params[':end_date']=$_GET['end_date'];
        }
        if(isset($_GET['Paper']['is_first_grade']) && $_GET['Paper']['is_first_grade'] ){
            array_push($fileName,'级别为'.Paper::LEVEL_FIRST_GRADE);
            $criteria->addCondition('t.is_first_grade = :is_first_grade');
            $params[':is_first_grade']=$_GET['Paper']['is_first_grade'];
        }
        if(isset($_GET['Paper']['is_core']) && $_GET['Paper']['is_core'] ){
            array_push($fileName,'级别为'.Paper::LEVEL_CORE);
            $criteria->addCondition('t.is_core = :is_core');
            $params[':is_core']=$_GET['Paper']['is_core'];
        }
        if(isset($_GET['Paper']['other_pub']) && $_GET['Paper']['other_pub'] ){
            array_push($fileName,'级别为'.Paper::LEVEL_OTHER_PUB);
            $criteria->addCondition('t.other_pub != 0');
        }
        if(isset($_GET['Paper']['is_journal']) && $_GET['Paper']['is_journal'] ){
            array_push($fileName,'级别为'.Paper::LEVEL_JOURNAL);
            $criteria->addCondition('t.is_journal = :is_journal');
            $params[':is_journal']=$_GET['Paper']['is_journal'];
        }
        if(isset($_GET['Paper']['is_conference']) && $_GET['Paper']['is_conference'] ){
            array_push($fileName,'级别为'.Paper::LEVEL_CONFERENCE);
            $criteria->addCondition('t.is_conference = :is_conference');
            $params[':is_conference']=$_GET['Paper']['is_conference'];
        }
        if(isset($_GET['Paper']['is_intl']) && $_GET['Paper']['is_intl'] ){
            array_push($fileName,'级别为'.Paper::LEVEL_INTL);
            $criteria->addCondition('t.is_intl = :is_intl');
            $params[':is_intl']=$_GET['Paper']['is_intl'];
        }
        if(isset($_GET['Paper']['is_domestic']) && $_GET['Paper']['is_domestic'] ){
            array_push($fileName,'级别为'.Paper::LEVEL_DOMESTIC);
            $criteria->addCondition('t.is_domestic = :is_domestic');
            $params[':is_domestic']=$_GET['Paper']['is_domestic'];
        }
        //var_dump($params);
        $criteria->params = $params;

        $fileNameString = empty($fileName)?'全部论文':implode(', ',$fileName).'的论文';
        $isExport = false;
        if(isset($_GET['export']) && $_GET['export']) {
            $isExport = true;
        }
        $model = Paper::model();
        //var_dump(implode(' AND ',$condition));
        $dataProvider=new CActiveDataProvider(
            'Paper',
            array(
                'sort'=>array(
                    'defaultOrder'=>array(
                    'index_date' => true
                    ),
                ),
                'criteria' => /*array(
                    'with'=>array(
                        'peoples'=>array(
                            'condition'=>implode(' AND ',$condition),
                        ),
                        //'together'=>true,

                    ),
                    'together'=>true,
                    'group'=>'t.id'
                    //work around
                    //http://www.yiiframework.com/forum/index.php/topic/45984-cactivedataprovider-does-not-fetch-all-records/page__view__findpost__p__216651
                ),*/$criteria,

                'pagination' => false,//array(
                    //'pageSize' => Yii::app()->params['pageSize'],
                //)
            )
        );
        //var_dump($dataProvider);
        //var_dump($dataProvider->countCriteria);
        if($isExport){
            if($isByMaintainer) {
                self::exportPapersToXlsByMaintainer($dataProvider->getData(),$fileNameString);
            } else if($isByPeople) {
                self::exportPapersToXlsByPeople($dataProvider->getData(),$fileNameString);
            } else {
                self::exportPapersToXlsByPeople($dataProvider->getData(),$fileNameString);
            }
        } else {
            $dataProvider->pagination = new CPagination(10);
            $this->render('admin',array(
                'model'=>$model,
                'dataProvider'=>$dataProvider
            ));
        }
	}


    public function actionExportAll() {
        $dataProvider = new CActiveDataProvider('Paper',array('pagination' => false));
        self::exportPapersToXlsByDefault($dataProvider->getData(),'全部论文');
    }

    private function exportPapersToXlsByPeople($papers,$fileName='export'){

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("导出的论文");
        $objPHPExcel->setActiveSheetIndex(0);

        $i=1;
        $activeSheet = $objPHPExcel->getActiveSheet();
        $activeSheet->setTitle('papers');
        $activeSheet->SetCellValue('A'.$i,'序号');
        $activeSheet->SetCellValue('B'.$i,'论文信息');
        $activeSheet->SetCellValue('C'.$i,'作者');
        $activeSheet->SetCellValue('D'.$i,'状态');
        $activeSheet->SetCellValue('E'.$i,'时间');
        $activeSheet->SetCellValue('F'.$i,'检索');
        $activeSheet->SetCellValue('G'.$i,'发表级别');
        $activeSheet->SetCellValue('H'.$i,'报账项目');
        $activeSheet->SetCellValue('I'.$i,'文件名');
        $i++;
        foreach($papers as $p) {
            $activeSheet->SetCellValue('A'.$i,$i-1);
            $activeSheet->SetCellValue('B'.$i,$p->info);
            $activeSheet->SetCellValue('C'.$i,!empty($p->peoples)? $p->peoples[0]->name:'');
            $activeSheet->SetCellValue('D'.$i,$p->getStatusString());
            $activeSheet->SetCellValue('E'.$i,$p->getDateString());
            $activeSheet->SetCellValue('F'.$i,$p->getIndexString());
            $activeSheet->SetCellValue('G'.$i,$p->getLevelString());
            $activeSheet->SetCellValue('H'.$i,''); //@TODO when Project MVC is done! $p->getReimbursementProjectString()
            $activeSheet->SetCellValue('I'.$i,$p->file_name);
            $i++;

        }
        //http://stackoverflow.com/questions/19155488/array-to-excel-2007-using-phpexcel
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
        header("Content-Type:application/force-download");
        header("Content-Type:application/vnd.ms-excel");
        header("Content-Type:application/octet-stream");
        header("Content-Type:application/download");;
        //$fileName = iconv('utf-8', "gb2312", $fileName);
        header('Content-Disposition:attachment;filename="'.$fileName.'.xlsx"');
        header("Content-Transfer-Encoding:binary");
        $objWriter->save('php://output');

    }


    private function exportPapersToXlsByDefault($papers,$fileName='export'){
        $formatPath=dirname(__FILE__)."/../xls_format/paper_import_format.xlsx";
        $objPHPExcel = PHPExcel_IOFactory::load($formatPath);
        $objPHPExcel->getDefaultStyle()->getNumberFormat()->setFormatCode('PHPExcel_Style_NumberFormat::FORMAT_TEXT');
        $objPHPExcel->getProperties()->setTitle("导出的论文");
        $objPHPExcel->setActiveSheetIndex(0);
        $row=2;
        $activeSheet = $objPHPExcel->getActiveSheet();
        $activeSheet->setTitle('papers');
        foreach($papers as $p){
            $col=0;
            $activeSheet->setCellValueByColumnAndRow($col++,$row,$p->info);
            foreach($p->peoples as $people) {
                if($col>10){
                    throw new CHttpException(503,'Exceeding peoples output formant limit!');
                }
                $activeSheet->setCellValueByColumnAndRow($col++,$row,$people->name);
                $col++;//no output for english name.
            }
            $col=11;
            $activeSheet->setCellValueByColumnAndRow($col++,$row,$p->status==Paper::STATUS_PASSED?'是':'');
            $activeSheet->setCellValueByColumnAndRow($col++,$row,$p->status==Paper::STATUS_PUBLISHED?'是':'');
            $activeSheet->setCellValueByColumnAndRow($col++,$row,$p->status==Paper::STATUS_INDEXED?'是':'');
            $activeSheet->setCellValueByColumnAndRow($col++,$row,$p->pass_date);
            $activeSheet->setCellValueByColumnAndRow($col++,$row,$p->pub_date);
            $activeSheet->setCellValueByColumnAndRow($col++,$row,$p->index_date);
            $activeSheet->setCellValueExplicitByColumnAndRow($col++,$row,$p->sci_number, PHPExcel_Cell_DataType::TYPE_STRING);
            $activeSheet->setCellValueExplicitByColumnAndRow($col++,$row,$p->ei_number, PHPExcel_Cell_DataType::TYPE_STRING);
            $activeSheet->setCellValueExplicitByColumnAndRow($col++,$row,$p->istp_number, PHPExcel_Cell_DataType::TYPE_STRING);
            $activeSheet->setCellValueByColumnAndRow($col++,$row,self::converIntToYesNo($p->is_first_grade));
            $activeSheet->setCellValueByColumnAndRow($col++,$row,self::converIntToYesNo($p->is_core));
            $activeSheet->setCellValueByColumnAndRow($col++,$row,$p->other_pub);
            $activeSheet->setCellValueByColumnAndRow($col++,$row,self::converIntToYesNo($p->is_journal));
            $activeSheet->setCellValueByColumnAndRow($col++,$row,self::converIntToYesNo($p->is_conference));
            $activeSheet->setCellValueByColumnAndRow($col++,$row,self::converIntToYesNo($p->is_intl));
            $activeSheet->setCellValueByColumnAndRow($col++,$row,self::converIntToYesNo($p->is_domestic));
            $activeSheet->setCellValueByColumnAndRow($col++,$row,$p->file_name);
            foreach ($p->fund_projects as $pp) {
                if($col>37) {
                    throw new CHttpException(503,'Exceeding fund_projects output formant limit!');
                }
                $activeSheet->setCellValueByColumnAndRow($col++,$row,$pp->name);
                $activeSheet->setCellValueExplicitByColumnAndRow($col++,$row,$pp->number, PHPExcel_Cell_DataType::TYPE_STRING);
            }
            $col=38;
            foreach ($p->reim_projects as $pp) {
                if($col>47) {
                    throw new CHttpException(503,'Exceeding reim_projects output formant limit: '.$col);
                }
                $activeSheet->setCellValueByColumnAndRow($col++,$row,$pp->name);
                $activeSheet->setCellValueExplicitByColumnAndRow($col++,$row,$pp->number, PHPExcel_Cell_DataType::TYPE_STRING);
            }
            $col=48;
            foreach ($p->achievement_projects as $pp) {
                if($col>57) {
                    throw new CHttpException(503,'Exceeding achievement_projects output formant limit!');
                }
                $activeSheet->setCellValueByColumnAndRow($col++,$row,$pp->name);
                $activeSheet->setCellValueExplicitByColumnAndRow($col++,$row,$pp->number, PHPExcel_Cell_DataType::TYPE_STRING);
            }
            $activeSheet->setCellValueByColumnAndRow($col++,$row,self::converIntToYesNo($p->is_high_level));
            $activeSheet->setCellValueByColumnAndRow($col++,$row,isset($p->maintainer)?$p->maintainer->name:'');
            $row++;

        }
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
        header("Content-Type:application/force-download");
        header("Content-Type:application/vnd.ms-excel");
        header("Content-Type:application/octet-stream");
        header("Content-Type:application/download");;
        //$fileName = iconv('utf-8', "gb2312", $fileName);
        header('Content-Disposition:attachment;filename="'.$fileName.'.xlsx"');
        header("Content-Transfer-Encoding:binary");
        $objWriter->save('php://output');
    }
    private function exportPapersToXlsByMaintainer($papers,$fileName='export'){

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("导出的论文");
        $objPHPExcel->setActiveSheetIndex(0);

        $i=1;
        $activeSheet = $objPHPExcel->getActiveSheet();
        $activeSheet->setTitle(substr($fileName,0,28));
        $activeSheet->SetCellValue('A'.$i,'序号');
        $activeSheet->SetCellValue('B'.$i,'论文信息');
        $activeSheet->SetCellValue('C'.$i,'状态');
        $activeSheet->SetCellValue('D'.$i,'时间');
        $activeSheet->SetCellValue('E'.$i,'检索');
        $i++;
        foreach($papers as $p) {
            $activeSheet->SetCellValue('A'.$i,$i-1);
            $activeSheet->SetCellValue('B'.$i,$p->info);
            $activeSheet->SetCellValue('C'.$i,$p->getStatusString());
            $activeSheet->SetCellValue('D'.$i,$p->status==Paper::STATUS_PASSED ? $p->pass_date : $p->index_date);
            $activeSheet->SetCellValue('E'.$i,$p->getIndexString());
            $i++;

        }
        //http://stackoverflow.com/questions/19155488/array-to-excel-2007-using-phpexcel
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
        header("Content-Type:application/force-download");
        header("Content-Type:application/vnd.ms-excel");
        header("Content-Type:application/octet-stream");
        header("Content-Type:application/download");;
        $fileName = iconv('utf-8', "gb2312", $fileName);
        header('Content-Disposition:attachment;filename="'.$fileName.'.xlsx"');
        header("Content-Transfer-Encoding:binary");
        $objWriter->save('php://output');

    }

    public function actionTestSearchByPeople() {
        header('Content-Type: text/html; charset=utf-8');
        echo 'function actionTestSearchByPeople()';
        $people = People::model()->with(array(
            'papers'=>array(
                'condition'=>"",
                'order'=>'papers.index_date DESC'
            ),
        ))->findByPk('48');
        //http://www.yiiframework.com/doc/guide/1.1/en/database.arr#dynamic-relational-query-options
        //tables in relations should be disambiguated like papers.index_date
        //Relational Query Options:
        //  select
        //  condition
        //  order

        Yii::trace('actionTestSearchByPeople() big sql ended');
        if(isset($people->papers))
            var_dump($people->papers);
        echo '!!!'.'<hr />';
        $paper = Paper::model()->with(array(
            'peoples'=>array(
                'condition'=>'peoples.id=48',
            )
        ));

        var_dump($paper->findAll(array(
                'order'=>'index_date DESC'
            )
        ));

    }

    private function setModelProjects($model) {
        if(isset($_POST['Paper']['fund_projects']))
            $model->fundProjects=$_POST['Paper']['fund_projects'];
        if(isset($_POST['Paper']['reim_projects']))
            $model->reimProjects=$_POST['Paper']['reim_projects'];
        if(isset($_POST['Paper']['achievement_projects']))
            $model->achievementProjects=$_POST['Paper']['achievement_projects'];
    }


    /**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Paper the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Paper::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Paper $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='paper-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    

}