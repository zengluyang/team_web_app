<?php
Yii::import('application.vendor.*');
require_once('PHPExcel/PHPExcel.php');

class PatentController extends Controller
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'admin'),
				'expression'=>'isset($user->is_patent) && $user->is_patent',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('upload','admin','delete','import','testXls','TestCsv','TestPhpExcelCsv'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

    public function actionUpload() {

        if(isset($_FILES['spreedSheet']) && !empty($_FILES['spreedSheet'])) {
            $path = $_FILES['spreedSheet']['tmp_name'];
            echo $_FILES['spreedSheet']['name']."<hr />";
            echo $_FILES['spreedSheet']['type']."<hr />";
            echo $_FILES['spreedSheet']['tmp_name']."<hr />";
            if(self::saveXlsToDb($path)){
                $this->redirect(array('index'));
            }
        }
        $this->render('upload');
    }



	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = $this->loadModel($id);
        $this->render('view',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Patent;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Patent']))
		{
			$model->attributes=$_POST['Patent'];
            if($model->save()) {
                yii::trace("model->id:".$model->id,"PatentController.actionCreate()");
                $peoples = $_POST['Patent']['peoples'];
                self::populatePeople($model, $peoples);
				$this->redirect(array('view','id'=>$model->id));
            }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

    /**
     * @param $patent
     * @param array $peoples, the peoples in tht patent_people to populate.
     * @return boolean, indicates if succeeds.
     */
    private function populatePeople($patent, $peoples)
    {
        for($i=0;$i<count($peoples);$i++) {
            if($peoples[$i]!=null &&$peoples[$i]!=0) {
                $patentPeople = new PatentPeople;
                $patentPeople->seq = $i+1;
                $patentPeople->patent_id=$patent->id;
                $patentPeople->people_id=$peoples[$i];
                //echo $patentPeople->patent_id." ".$patentPeople->people_id."<br>";
                if($patentPeople->save()) {
                    yii::trace("peoples[i]:".$peoples[$i]." saved","PatentController.populatePeople()");
                } else {
                    yii::trace("error in","PatentController.populatePeople()");
                    return false;
                }
            }
        }
        return true;
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

		if(isset($_POST['Patent']))
		{
			$model->attributes=$_POST['Patent'];
			if($model->save()) {
                $criteria=new CDbCriteria;
                $criteria->condition='patent_id=:patent_id';
                $criteria->params=array(':patent_id'=>$model->id);
                PatentPeople::model()->deleteAll($criteria);
                $peoples = $_POST['Patent']['peoples'];
                self::populatePeople($model, $peoples);
                $this->redirect(array('view','id'=>$model->id));
            }
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
        $dataProvider = new CActiveDataProvider(
            'Patent',
            array('sort'=> array(
                'defaultOrder'=>array(
                    'app_date'=>true
                ),
            )
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
		$model=new Patent('search');
        $people=new People('search');
		$model->unsetAttributes();  // clear any default values
        $people->unsetAttributes();
		if(isset($_GET['Patent']))
			$model->attributes=$_GET['Patent'];
        if(isset($_GET['People']))
           $people->attributes=$_GET['People'];
        $model->searchPeople = $people;
		$this->render('admin',array(
			'model'=>$model,
		));
	}

    public function actionImport()
    {
        $patentXlsPath = Yii::app()->getBasePath().'/vendor/PHPExcel/patent.xls';
        $patents = self::xlsToArray($patentXlsPath);
        if(self::saveXlsArrayToDb($patents));
            $this->redirect(array('index'));
    }

    protected function saveXlsToDb($patentXlsPath) {
        $patents = self::xlsToArray($patentXlsPath);
        return self::saveXlsArrayToDb($patents);
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
        return $dataArray;
    }

    public function saveXlsArrayToDb($patents)
    {
        $connection=Yii::app()->db;
        foreach($patents as $p) {
            //var_dump($p) ;
            $patent = new Patent;
            $patent->name=$p[0];
            $patent->app_date=trim($p[1]);
            $patent->app_number=$p[2];
            $patent->auth_number=$p[3];
            $patent->auth_date=trim($p[4]);
            $patent->is_intl=self::convertYesNoToInt($p[5]);
            $patent->is_domestic=self::convertYesNoToInt($p[6]);
            $patent->abstract=$p[12];
            if($patent->save()) {
                $peoplesId=array();
                for($i=0;$i<5;$i++){
                    $peopleName=$p[7+$i];
                    $peopleName=mysql_real_escape_string($peopleName);
                    $sql='select id from tbl_people where name="'.$peopleName.'";';
                    $command=$connection->createCommand($sql);
                    $row=$command->queryRow();
                    if($row) {
                        //var_dump($row);
                        $peoplesId[]=$row['id'];

                    }else {
                        //var_dump($row);
                        $people = new People;
                        $people->name = $peopleName;
                        if($people->save())
                            //var_dump($people->id);
                            $peoplesId[] = $people->id;
                    }
                }
                if(!self::populatePeople($patent,$peoplesId)) {
                    yii::trace("error in","PatentController.populatePeople()");
                    return false;

                }
            } else {
                //var_dump( $patent->getErrors());
                yii::trace("error in","PatentController.saveXlsArrayToDb()");
                return false;
            }
        }
        return true;
    }

    private function convertYesNoToInt($yesno) {
        if($yesno=='是') {
            return 1;
        }else if($yesno=='否'){
            return 0;
        }
        return 0;
    }

    public function actionTestPhpExcelCsv(){
        Yii::trace("start of reading","actionTestPhpExcelCsv()");
        $patentCsvPath = Yii::app()->getBasePath().'/vendor/PHPExcel/patent.csv';
        $reader = PHPExcel_IOFactory::createReader('CSV');
        $reader->setReadDataOnly(true)->setInputEncoding('GBK');
        $objPHPExcel = $reader->load($patentCsvPath);
        $dataArray=$objPHPExcel->getActiveSheet()->toArray();
        var_dump($dataArray);

        Yii::trace("end of reading","actionTestPhpExcelCsv()");
    }

    /**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Patent the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Patent::model()/*->with('peoples')*/->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
//        $criteria=new CDbCriteria;
//        $criteria->condition='patent_id=:patent_id';
//        $criteria->select = 'people_id';
//        $criteria->params=array(':patent_id'=>$id);
//        $patentPeople = PatentPeople::model()->findAll($criteria);
//		$peoples = array();
//        foreach($patentPeople as $pp) {
//            $peoples[] = $pp->people_id;
//            Yii::trace("people_id".$pp->people_id,"PatentController::loadModel($id)");
//        }
//        $model->peoples=$peoples;
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Patent $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='patent-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
