<?php
Yii::import('application.vendor.*');
require_once('PHPExcel/PHPExcel.php');

class SoftwareController extends Controller
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
				'expression'=>'isset($user->is_software) && $user->is_software',
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

	private function setModelRelation($model) {
		if(isset($_POST['Software']['peoples']))
			$model->peopleIds=$_POST['Software']['peoples'];
		if(isset($_POST['Software']['fund_projects']))
			$model->fundProjectIds=$_POST['Software']['fund_projects'];
		if(isset($_POST['Software']['reim_projects']))
			$model->reimProjectIds=$_POST['Software']['reim_projects'];
		if(isset($_POST['Software']['achievement_projects']))
			$model->achievementProjectIds=$_POST['Software']['achievement_projects'];

	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Software;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Software']))
		{
			$model->attributes=$_POST['Software'];
			self::setModelRelation($model);
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

		if(isset($_POST['Software']))
		{
			$model->attributes=$_POST['Software'];
			self::setModelRelation($model);
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
		$dataProvider=new CActiveDataProvider('Software');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Software('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Software']))
			$model->attributes=$_GET['Software'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Software the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Software::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Software $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='software-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    protected function saveXlsToDb($xlsPath) {
        $softwares = self::xlsToArray($xlsPath);
        return self::saveXlsArrayToDb($softwares);
    }


    public function xlsToArray($path)
    {
        Yii::trace("start of loading","actionTestXls()");
        $objPHPExcel = PHPExcel_IOFactory::load($path);
        Yii::trace("end of loading","actionTestXls()");
        Yii::trace("start of reading","actionTestXls()");
        $dataArray = $objPHPExcel->getActiveSheet()->toArray();
        Yii::trace("end of reading","actionTestXls()");
        array_shift($dataArray);
        return $dataArray;
    }

    public function saveXlsArrayToDb($softwares)
    {
        $connection=Yii::app()->db;
        foreach($softwares as $k => $s) {
            $software = new Software;
            if(empty($s[0])) {
            	continue; //@TODO: more verbose validating.
            }
            $software->name=$s[0];
            $software->reg_date=$s[1];
            $software->reg_number=$s[2];
            $software->department=$s[8];
            for($i=3;$i<8;$i++){
            	if(!empty($s[$i])) {
            		$people=People::model()->findByAttributes(array('name'=>$s[$i]));
            		array_push($software->peopleIds, $people->id);
            	}
            }
            //@TODO: $software->jbf_number=$s[9];
            //@TODO: $software->maintainer..;
            $software->description=$s[11];

            for($i=12;$i<22;$i=$i+2){
            	if(!empty($s[$i])) {
            		$project=Project::model()->findByAttributes(array('name'=>$s[$i],'number'=>$s[$i+1]));
            		array_push($software->fundProjectIds, $project->id);
            	}
            }
            for($i=22;$i<32;$i=$i+2){
            	if(!empty($s[$i])) {
            		$project=Project::model()->findByAttributes(array('name'=>$s[$i],'number'=>$s[$i+1]));
            		array_push($software->reimProjectIds, $project->id);
            	}
            }
            for($i=32;$i<42;$i=$i+2){
            	if(!empty($s[$i])) {
            		$project=Project::model()->findByAttributes(array('name'=>$s[$i],'number'=>$s[$i+1]));
            		array_push($software->achievementProjectIds, $project->id);
            	}
            }
            var_dump($software->peopleIds);
            var_dump($software->fundProjectIds);
            var_dump($software->reimProjectIds);
            var_dump($software->achievementProjectIds);
            //Yii::app()->end();
            if($software->save()) {
            	;
            } else {
                var_dump( $software->getErrors());
                return false;
            }
        }
        return true;
    }

    public function actionUpload() {
        set_time_limit(50);
        if(isset($_FILES['spreedSheet']) && !empty($_FILES['spreedSheet'])) {
            $path = $_FILES['spreedSheet']['tmp_name'];
            echo $_FILES['spreedSheet']['name']."<hr />";
            echo $_FILES['spreedSheet']['type']."<hr />";
            echo $_FILES['spreedSheet']['tmp_name']."<hr />";
            //var_dump(self::xlsToArray($path));
            if(self::saveXlsToDb($path)){
                echo 'function actionUpload() succeeded.<hr />';
                $this->redirect(array('index'));
            }
        }

        $this->render('upload');
    }
}
