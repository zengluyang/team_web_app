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
                'actions'=>array('testExcelExport','testExcelExportByTable','query','testSearchByPeople','reset','upload','admin','delete','import','testXls','TestCsv','TestPhpExcelCsv'),
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
        $reader = PHPExcel_IOFactory::createReader('Excel5');
        $reader->setReadDataOnly(true);
        $objPHPExcel = $reader->load($path);
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

    public function saveXlsArrayToDb($papers)
    {
        $connection=Yii::app()->db;
        //var_dump($papers);
        foreach($papers as $k => $p) {
            //var_dump($k);
            //var_dump($p);
            if($k<1) continue;
            $paper = new paper;
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
            $paper->is_high_level = self::convertYesNoToInt($p[38]);
            if($paper->save()) {
                $peoplesId=array();
                for($i=0;$i<5;$i=$i+2){
                    $peopleName=$p[1+$i];
                    $peopleName=mysql_real_escape_string($peopleName);
                    $sql='select id from tbl_people where name="'.$peopleName.'";';
                    //


                    $testPeoples = People::model()->find('name="'.$peopleName.'"');
                    //var_dump($testPeoples);
                    $command=$connection->createCommand($sql);
                    $row=$command->queryRow();
                    if($row) {
                        //dump($row);
                        $peoplesId[]=$row['id'];

                    }else {
                        //dump($row);
                        $people = new People;
                        $people->name = $peopleName;
                        if($people->save())
                            //dump($people->id);
                        $peoplesId[] = $people->id;
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
        $criteria->with = array('peoples');
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
            $criteria->addCondition('peoples.id=:people_id');
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
        if(isset($_GET['project_id']) && $_GET['project_id']){
            $isByProject = true;
            //@TODO finish this when Project controller is done.
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




    private function exportPapersToXlsByPeople($papers,$fileName='export'){

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("导出的论文");
        $objPHPExcel->setActiveSheetIndex(0);

        $i=1;
        $activeSheet = $objPHPExcel->getActiveSheet();
        $activeSheet->setTitle(substr($fileName,0,28));
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