<?php

/**
 * This is the model class for table "tbl_project_teaching".
 *
 * The followings are the available columns in table 'tbl_project_teaching':
 * @property integer $id
 * @property string $name
 * @property string $number
 * @property integer $is_intl
 * @property integer $is_provincial
 * @property integer $is_city
 * @property integer $is_school
 * @property integer $is_quality
 * @property integer $is_reform
 * @property integer $is_lab
 * @property integer $is_new_lab
 * @property string $start_date
 * @property string $deadline_date
 * @property string $conclude_date
 * @property string $fund
 * @property integer $should_display
 * @property integer $director_1
 * @property integer $director_2
 * @property integer $maintainer_id
 *
 * The followings are the available model relations:
 * @property People[] $tblPeoples
 */
class ProjectTeaching extends CActiveRecord
{

	public $peopleIds = array();
	public $searchPeoples = array();


	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_project_teaching';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('is_intl, is_provincial, is_city, is_school, is_quality, is_reform, is_lab, is_new_lab, should_display, maintainer_id, director_1, director_2','numerical', 'integerOnly'=>true),
			array('name, number', 'length', 'max'=>255),
			array('fund', 'length', 'max'=>15),
			array('start_date, deadline_date, conclude_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, number, is_intl, is_provincial, is_city, is_school, is_quality, is_reform, is_lab, is_new_lab, start_date, deadline_date, conclude_date, fund, should_display, maintainer_id', 'safe', 'on'=>'search'),
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
				'tbl_project_teaching_people(project_teaching_id, people_id)',
				'alias'=>'peoples_',
				'order'=>'peoples_peoples_.seq',
			),
			'maintainer' => array(
                self::BELONGS_TO, 
                'People',
                'maintainer_id'
            ),
			'director1' => array(
                self::BELONGS_TO, 
                'People',
                'director_1'
            ),
			'director2' => array(
                self::BELONGS_TO, 
                'People',
                'director_2'
            ),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => '项目名称',
			'number' => '项目编号',
			'fund_number' => '经本费编号',
			'is_intl' => '国家级',
			'is_provincial' => '省部级',
			'is_city' => '市级',
			'is_school' => '校级',
			'is_quality' => '质量工程',
			'is_reform' => '教学改革',
			'is_lab' => '实验室建设',
			'is_new_lab' => '新实验建设',
			'start_date' => '开始时间',
			'deadline_date' => '截至时间',
			'conclude_date' => '结题时间',
			'fund' => '经费',
			'should_display' => '对外显示',
			'maintainer' => '维护人',
			'level'=>'级别',
			'type'=>'类别',
			'peoples'=>'人员',
			'director1'=>'负责人1',
			'director2'=>'负责人2',
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
		$criteria->compare('number',$this->number,true);
		$criteria->compare('is_intl',$this->is_intl);
		$criteria->compare('is_provincial',$this->is_provincial);
		$criteria->compare('is_city',$this->is_city);
		$criteria->compare('is_school',$this->is_school);
		$criteria->compare('is_quality',$this->is_quality);
		$criteria->compare('is_reform',$this->is_reform);
		$criteria->compare('is_lab',$this->is_lab);
		$criteria->compare('is_new_lab',$this->is_new_lab);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('deadline_date',$this->deadline_date,true);
		$criteria->compare('conclude_date',$this->conclude_date,true);
		$criteria->compare('fund',$this->fund,true);
		$criteria->compare('should_display',$this->should_display);
		$criteria->compare('maintainer_id',$this->maintainer_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
                'attributes'=>array(
                    'level'=>array(
                        'asc'=>'is_intl, is_provincial, is_city, is_school',
                        'desc'=>'is_school, is_city, is_provincial, is_intl',
                    ),
                    'type'=>array(
                    	'asc'=>'is_reform, is_lab, is_new_lab',
                    	'desc'=>'is_new_lab, is_lab, is_reform',
                    ),
                    '*',
                ),
            ),
		));
	}

	
	public function getTypeString($glue=', '){
        $levels = array();
        $attrs = self::attributeLabels();
        
        if($this->is_quality){
            array_push($levels,$attrs['is_quality']);
        }

        if($this->is_reform){
            array_push($levels,$attrs['is_reform']);
        }

        if($this->is_lab){
            array_push($levels,$attrs['is_lab']);
        }
        if($this->is_new_lab){
            array_push($levels,$attrs['is_new_lab']);
        }

        return implode($glue,$levels);
    }

	
	public function getLevelString($glue=', '){
        $levels = array();
        $attrs = self::attributeLabels();

        if($this->is_intl){
            array_push($levels,$attrs['is_intl']);
        }

        if($this->is_provincial){
            array_push($levels,$attrs['is_provincial']);
        }
        if($this->is_city){
            array_push($levels,$attrs['is_city']);
        }
        if($this->is_school){
            array_push($levels,$attrs['is_school']);
        }

        return implode($glue,$levels);
    }


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProjectTeaching the static model class
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

    public function getPeoplesJsForSelect2Init() {
    	//[{id:"MA", text: "Massachusetts"},{id: "CA", text: "California"}]
    	$nameValuePairArr = array();
		foreach ($this->peoples as $people) {
			$nameValuePair = '{id:"'.$people->id.'", text: "'.$people->name.'"}';
			array_push($nameValuePairArr,$nameValuePair);
		}
		return '['.implode(',', $nameValuePairArr).']';
    }

    private function populateProjectTeachingPeople(){
    	$peoples=$this->peopleIds;
    	for($i=0;$i<count($peoples);$i++){
    		if($peoples[$i]!=null && $peoples[$i]!=0) {
    			$projectTeachingPeople = new ProjectTeachingPeople;
    			$projectTeachingPeople->seq=$i+1;
    			$projectTeachingPeople->project_teaching_id=$this->id;
    			$projectTeachingPeople->people_id=$peoples[$i];
    			yii::trace("peoples[i]:".$peoples[$i]." saving","ProjectTeaching.populateProjectTeachingPeople()");
    			if($projectTeachingPeople->save()){
    				yii::trace("peoples[i]:".$peoples[$i]." saved","ProjectTeaching.populateProjectTeachingPeople()");
    			} else {
    				return false;
    			}
    		}
    	}
    	return true;
    }

    private function deleteProjectTeachingPeople(){
    	$criteria = new CDbCriteria;
    	$criteria->condition = 'project_teaching_id=:project_teaching_id';
    	$criteria->params = array(':project_teaching_id'=>$this->id);
    	ProjectTeachingPeople::model()->deleteAll($criteria);
    	return true;
    }


    protected function beforeSave(){
    	if($this->start_date=='') {
    		$this->start_date=null;
    	}
    	if($this->deadline_date=='') {
    		$this->deadline_date=null;
    	}
    	if($this->conclude_date=='') {
    		$this->conclude_date=null;
    	}
	    if($this->scenario=='update') {
	    	if(self::deleteProjectTeachingPeople()) {
	    		return parent::beforeSave();
	    	} else {
	    		return false;
	    	}
	    }
	    return parent::beforeSave();
	}

	protected function afterSave() {
		return self::populateProjectTeachingPeople() && parent::afterSave(); 
	}

	protected function afterDelete(){
		return 
			self::deleteProjectTeachingPeople() &&
			parent::afterDelete();
	}

}
