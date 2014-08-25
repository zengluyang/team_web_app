<?php
Yii::import('application.vendor.*');
require_once('password_compat/password_compat.php');
require_once('PHPExcel/PHPExcel.php');
class PublicationController extends Controller
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
			'postOnly + delete', // we only allow deletion via POST request
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
			array('allow', 
				'actions'=>array('create','update','admin'),
				'expression'=>'isset($user->is_publication) && $user->is_publication',
			),
			array('allow', 
				'actions'=>array('admin','delete','create','update','upload'),
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
		if(isset($_POST['Publication']['peoples']))
			$model->peoplesId=$_POST['Publication']['peoples'];
		if(isset($_POST['Publication']['fund_projects']))
			$model->fundProjectIds=$_POST['Publication']['fund_projects'];
		if(isset($_POST['Publication']['reim_projects']))
			$model->reimProjectIds=$_POST['Publication']['reim_projects'];
		if(isset($_POST['Publication']['achievement_projects']))
			$model->achievementProjectIds=$_POST['Publication']['achievement_projects'];
	}


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Publication;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Publication']))
		{
			$model->attributes=$_POST['Publication'];
			self::setModelPeoples($model);
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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

		if(isset($_POST['Publication']))
		{
			$model->attributes=$_POST['Publication'];
			self::setModelPeoples($model);
			// var_dump($model->achievementProjectIds);
			// Yii::app()->end();
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
		$dataProvider=new CActiveDataProvider('Publication');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Publication('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Publication']))
			$model->attributes=$_GET['Publication'];
			if(isset($_GET['Publication']['is_textbook']) && $_GET['Publication']['is_textbook']=='0'){
				$model->is_textbook="";
			}
			if(isset($_GET['Publication']['is_pub']) && $_GET['Publication']['is_pub']=='0'){
				$model->is_pub="";
			}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Publication the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Publication::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Publication $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='publication-form')
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
    }protected function saveXlsToDb($xlsPath) {
        $projects = self::xlsToArray($xlsPath);
        return self::saveXlsArrayToDb($projects);
    }

    public function xlsToArray($path)
    {
        Yii::trace("start of loading","actionTestXls()");
        $objPHPExcel = PHPExcel_IOFactory::load($path);
        Yii::trace("end of loading","actionTestXls()");
        Yii::trace("start of reading","actionTestXls()");
        $dataArray = $objPHPExcel->getActiveSheet()->toArray(null,true,true);
        Yii::trace("end of reading","actionTestXls()");
        //array_shift($dataArray);
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
        // var_dump($projects);
        // Yii::app()->end();
        foreach($projects as $k => $p) {
            //var_dump($k);
            //var_dump($p);
            if($k<1) continue;
            if(empty($p[0])) continue;
            if(($project=Publication::model()->findByAttributes(array('info'=>$p[0])))==null) {
            	$project = new Publication;
            }
            $project->scenario='update';
            $project->info=$p[0];
            $project->press=$p[1];
            $project->pub_date=$p[2];
            $project->is_textbook=self::convertYesNoToInt($p[9]);
            $project->is_pub=self::convertYesNoToInt($p[10]);
            $project->isbn_number=$p[12];
            $project->description=$p[13];
            $peoplesId=array();
            for($i=0;$i<6;$i=$i+1){
				$peopleName=$p[3+$i];
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
            $project->peoplesId = $peoplesId;
            $project->save();
        }
        return true;
    }
}
