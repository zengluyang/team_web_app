<?php
Yii::import('application.vendor.*');
require_once('password_compat/password_compat.php');
require_once('PHPExcel/PHPExcel.php');
class ProjectController extends Controller
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
				'actions'=>array('create','update','admin'),
				'expression'=>'isset($user->is_project) && $user->is_project',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('upload','admin','delete','create','update','import','export','pwd','reset'),
				'expression'=>'isset($user->is_admin) && $user->is_admin',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
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

	private function setModelPeoples($model) {
		if(isset($_POST['Project']['execute_peoples']))
			$model->executePeoples=$_POST['Project']['execute_peoples'];
		if(isset($_POST['Project']['liability_peoples']))
			$model->liabilityPeoples=$_POST['Project']['liability_peoples'];
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Project;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Project']))
		{
			$model->attributes=$_POST['Project'];
			self::setModelPeoples($model);
			if($model->save()) {
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

		if(isset($_POST['Project']))
		{
			$model->attributes=$_POST['Project'];
			self::setModelPeoples($model);
			$model->scenario='update';
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$criteria = new CDbCriteria;
		$criteria->addCondition('is_school!=1');
		$dataProvider=new CActiveDataProvider('Project',
            array('sort'=>array(
                'defaultOrder'=>array(
                	'is_intl'=>true,
                	'is_NSF'=>true,
                	'is_973'=>true,
                	'is_863'=>true,
                	'is_is_NKTRD'=>true,
                	'is_major'=>true,
                	'is_provincial'=>true,
                	'is_city'=>true,
                	'is_enterprise'=>true,
                    'start_date' => true,
                ),

            ),
            'pagination'=>false,
            'criteria'=>$criteria
        ));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Project('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Project'])) {
			$model->attributes=$_GET['Project'];
			if($_GET['Project']['is_intl']=='0') {
				$model->is_intl="";
			}
			if($_GET['Project']['is_national']=='0') {
				$model->is_national="";
			}
			if($_GET['Project']['is_provincial']=='0') {
				$model->is_provincial="";
			}
			if($_GET['Project']['is_school']=='0') {
				$model->is_school="";
			}
			if($_GET['Project']['is_city']=='0') {
				$model->is_city="";
			}
			if($_GET['Project']['is_enterprise']=='0') {
				$model->is_enterprise="";
			}
			if($_GET['Project']['is_NSF']=='0') {
				$model->is_NSF="";
			}
			if($_GET['Project']['is_973']=='0') {
				$model->is_973="";
			}
			if($_GET['Project']['is_863']=='0') {
				$model->is_863="";
			}
			if($_GET['Project']['is_NKTRD']=='0') {
				$model->is_NKTRD="";
			}
			if($_GET['Project']['is_DFME']=='0') {
				$model->is_DFME="";
			}
			if($_GET['Project']['is_major']=='0') {
				$model->is_major="";
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
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Project the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Project::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Project $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='project-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
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
        Project::model()->deleteAll();
    }




    protected function saveXlsToDb($xlsPath) {
        $projects = self::xlsToArray($xlsPath);
        return self::saveXlsArrayToDb($projects);
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



    public function saveXlsArrayToDb($projects)
    {
        $connection=Yii::app()->db;
        //var_dump($projects);
        foreach($projects as $k => $p) {
            //var_dump($k);
            //var_dump($p);
            if($k<2) continue;
            if(($project=Project::model()->findByAttributes(array('name'=>$p[0],'number'=>$p[1])))==null) {
            	$project = new Project;
            }
            $project->name=$p[0];
            $project->number=$p[1];
            $project->fund_number=$p[2];
            $project->is_intl=self::convertYesNoToInt($p[3]);
            $project->is_national=self::convertYesNoToInt($p[4]);
            $project->is_provincial=self::convertYesNoToInt($p[5]);
            $project->is_city=self::convertYesNoToInt($p[6]);
            $project->is_school=self::convertYesNoToInt($p[7]);
            $project->is_enterprise=self::convertYesNoToInt($p[8]);
            $project->is_NSF=self::convertYesNoToInt($p[9]);
            $project->is_973=self::convertYesNoToInt($p[10]);
            $project->is_863=self::convertYesNoToInt($p[11]);
            $project->is_NKTRD=self::convertYesNoToInt($p[12]);
            $project->is_DFME=self::convertYesNoToInt($p[13]);
            $project->is_major=self::convertYesNoToInt($p[14]);
            $project->start_date=($p[16]);
            $project->deadline_date=($p[17]);
            $project->conclude_date=empty($p[18]) ? $project->deadline_date : $p[18];
            $project->pass_fund=$p[19];
            $peoplesId=array();
            for($i=0;$i<20;$i=$i+1){
				$peopleName=$p[20+$i];
				if($peopleName=="") {
					continue;
				}
				$people = People::model()->findByAttributes(array('name'=>$peopleName));
                if($people!=null) {
                    $peoplesId[]=$people->id;
                }else {
                    $people = new People;
                    $people->name = $peopleName;
                    if(!$people->save()){
                    	print_r($people->getErrors());
                    	return false;
                    }
                    $peoplesId[] = $people->id;
                }

            }
            $project->executePeoples = $peoplesId;
            $peoplesId=array();
            for($i=0;$i<20;$i=$i+1){
				$peopleName=$p[20+$i];
				$people = People::model()->findByAttributes(array('name'=>$peopleName));
                if($people!=null) {
                    $peoplesId[]=$people->id;

                }else {
                    $people = new People;
                    $people->name = $peopleName;
                    if($people->save())
                    $peoplesId[] = $people->id;
                }

            }
            $project->liabilityPeoples = $peoplesId;
            $project->save();
        }
        return true;
    }

    private function exportProjectsToXlsByPeople($papers,$fileName='export'){

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("导出的科研项目");
        $objPHPExcel->setActiveSheetIndex(0);

        $i=1;
        $activeSheet = $objPHPExcel->getActiveSheet();
        $activeSheet->setTitle('papers');
        $activeSheet->SetCellValue('A'.$i,'编号');
        $activeSheet->SetCellValue('B'.$i,'名称');
        $activeSheet->SetCellValue('C'.$i,'经费本编号');
        $activeSheet->SetCellValue('D'.$i,'级别');
        $activeSheet->SetCellValue('E'.$i,'开始时间');
        $activeSheet->SetCellValue('F'.$i,'截至时间');
        $activeSheet->SetCellValue('G'.$i,'结题时间');
        $activeSheet->SetCellValue('H'.$i,'申报时间');
        $activeSheet->SetCellValue('I'.$i,'通过时间');
        $activeSheet->SetCellValue('J'.$i,'申报经费');
        $activeSheet->SetCellValue('K'.$i,'立项经费');
        $activeSheet->SetCellValue('L'.$i,'实际执行人员');
        $activeSheet->SetCellValue('M'.$i,'责任书人员');
        $i++;
        $j=1;
        header("content-type:text/html; charset=utf-8");
        foreach($papers as $p) {
            $activeSheet->SetCellValue('A'.$i,$i-1);
            $activeSheet->SetCellValue('B'.$i,$p->name);
            $activeSheet->SetCellValue('C'.$i,$p->fund_number);
            $activeSheet->SetCellValue('D'.$i,$p->getLevelString());
            $activeSheet->SetCellValue('E'.$i,$p->start_date);
            $activeSheet->SetCellValue('F'.$i,$p->deadline_date);
            $activeSheet->SetCellValue('G'.$i,$p->conclude_date);
            $activeSheet->SetCellValue('H'.$i,$p->app_date);
            $activeSheet->SetCellValue('I'.$i,$p->pass_date);
            $activeSheet->SetCellValue('J'.$i,$p->app_fund);
            $activeSheet->SetCellValue('K'.$i,$p->pass_fund);
            $activeSheet->SetCellValue('L'.$i,Project::model()->findByPk($p->id)->getExecutePeoples(', '));
            $activeSheet->SetCellValue('M'.$i,Project::model()->findByPk($p->id)->getLiabilityPeoples(', '));
            $i++;
            // echo $j++.' '.$p->id.' '.$p->name.' ';
            // print_r(Project::model()->findByPk($p->id)->getExecutePeoples());
            // echo " ";
            // print_r(Project::model()->findByPk($p->id)->getLiabilityPeoples());
            // echo "<hr />";

        }
        //Yii::app()->end();
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

}
