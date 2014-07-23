<?php

/**
 * This is the model class for table "tbl_software".
 *
 * The followings are the available columns in table 'tbl_software':
 * @property integer $id
 * @property string $name
 * @property string $reg_date
 * @property string $reg_number
 * @property string $department
 * @property string $description
 *
 * The followings are the available model relations:
 * @property People[] $tblPeoples
 */
class Software extends CActiveRecord
{

	public $peopleIds = array();
	public $searchPeoples = array();

	public $reimProjectIds = array();
	public $searchReimProjects = array();

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_software';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, reg_number, department, description', 'length', 'max'=>255),
			array('reg_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, reg_date, reg_number, department, description', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'peoples' => array(
				self::MANY_MANY, 
				'People', 
				'tbl_software_people(software_id, people_id)',
				'alias'=>'peoples_',
				'order'=>'peoples_peoples_.seq',
			),
			'reim_projects'=> array(
				self::MANY_MANY,
				'Project',
				'tbl_software_project_reim(software_id,project_id)',
				'alias'=>'reim_',
				'order'=>'reim_projects_reim_.seq', 
			)
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => '著作权名称',
			'reg_date' => '登记时间',
			'reg_number' => '登记号',
			'department' => '权属单位',
			'description' => '简介',
			'peoples'=>'申请人',
			'reim_projects'=>'报账项目',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('reg_date',$this->reg_date,true);
		$criteria->compare('reg_number',$this->reg_number,true);
		$criteria->compare('department',$this->department,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Software the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getPeoples($glue=', ',$attr='name') {
		$peopleArr = array();
		foreach ($this->peoples as $people) {
			array_push($peopleArr,$people->$attr);
		}
		return implode($glue,$peopleArr);
    }

    public function getReimProjects($glue=', ', $attr='name') {
    	$projetsArr = array();
    	foreach($this->reim_projects as $projet) {
    		array_push($projetsArr, $projet->$attr);
    	}
    	return implode($glue, $projetsArr);
    }

    private function populateSoftwareProject(){
    	$projects=$this->reimProjectIds;
    	for($i=0;$i<count($projects);$i++){
    		if($projects[$i]!=null && $projects[$i]!=0){
    			$softwareProjectReim = new SoftwareProjectReim;
    			$softwareProjectReim->seq=$i+1;
    			$softwareProjectReim->software_id=$this->id;
    			$softwareProjectReim->projetc_id=$projects[$i];
    			if($softwareProjectReim->save()){
    				yii::trace("projects[i]:".$projects[$i]." saved","Software.populateSoftwareProjects()");
    			} else {
    				return false;
    			}
    		}
    	}
    	return true;
    }

    private function deleteSoftwareProject() {
    	$criteria = new CDbCriteria;
    	$criteria->condition = 'software_id=:software_id';
    	$criteria->params = array(':software_id'=>$this->id);
    	SoftwareProjectReim::model()->deleteAll($criteria);
    	return true;
    }


    private function populateSoftwarePeople() {
    	$peoples=$this->peopleIds;
    	for($i=0;$i<count($peoples);$i++){
    		if($peoples[$i]!=null && $peoples[$i]!=0) {
    			$softwarePeople = new SoftwarePeople;
    			$softwarePeople->seq = $i+1;
    			$softwarePeople->software_id = $this->id;
    			$softwarePeople->people_id=$peoples[$i];
    			if($softwarePeople->save()){
    				yii::trace("peoples[i]:".$peoples[$i]." saved","Software.populatePeopleProjects()");
    			} else {
    				return false;
    			}
    		}
    	}
    	return true;
    }
    
    private function deleteSoftwarePeople(){
    	$criteria = new CDbCriteria;
    	$criteria->condition = 'software_id=:software_id';
    	$criteria->params = array(':software_id'=>$this->id);
    	SoftwarePeople::model()->deleteAll($criteria);
    	return true;    	
    }


    protected function beforeSave() {
    	if($this->reg_date==''){
    		$this->reg_date=null;
    	}
	    if($this->scenario=='update') {
	    	if(
	    		self::deleteSoftwareProject() && 
	    		self::deleteSoftwarePeople()
	    	) {
	    		;
	    	} else {
	    		return false;
	    	}
	    }    	
    	return parent::beforeSave();
    }

    protected function afterSave() {
    	return
    		self::populateSoftwareProject() &&
    		self::populateSoftwarePeople() &&
    		parent::afterSave();
    }
    
    protected function afterDelete(){
    	return 
    		self::deleteSoftwareProject() &&
    		self::deleteSoftwarePeople() &&
    		parent::afterSave();
    }

}
