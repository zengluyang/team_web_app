<?php

/**
 * This is the model class for table "tbl_project".
 *
 * The followings are the available columns in table 'tbl_project':
 * @property integer $id
 * @property string $name
 * @property string $number
 * @property string $fund_number
 * @property integer $is_intl
 * @property integer $is_national
 * @property integer $is_provincial
 * @property integer $is_city
 * @property integer $is_school
 * @property integer $is_enterprise
 * @property integer $is_NSF
 * @property integer $is_973
 * @property integer $is_863
 * @property integer $is_NKTRD
 * @property integer $is_DFME
 * @property integer $is_major
 * @property string $start_date
 * @property string $deadline_date
 * @property string $conclude_date
 * @property string $app_date
 * @property string $pass_date
 * @property string $app_fund
 * @property string $pass_fund
 *
 * The followings are the available model relations:
 * @property People[] $tblPeoples
 */
class Project extends CActiveRecord
{
	

	const EXECUTE=0;
    const LIABILITY=1;



    /**
     *@var array() of people id
    */
	public $executePeoples=array();
    public $liabilityPeoples=array(); //must be different from the relation name!


    public $searchExecutePeople=null;
    public $searchLiabilityPeople=null;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_project';
	}

	public function getLevelList(){
		return array();
	}

	public function getTypeString(){
		return array();
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('name','required'),
			array('is_intl, is_national, is_provincial, is_city, is_school, is_enterprise, is_NSF, is_973, is_863, is_NKTRD, is_DFME, is_major', 'numerical', 'integerOnly'=>true),
			array('name, number, fund_number', 'length', 'max'=>255),
			array('app_fund, pass_fund', 'length', 'max'=>15),
			array('start_date, deadline_date, conclude_date, app_date, pass_date', 'safe'),
			array('id, name, number, fund_number, is_intl, is_national, is_provincial, is_city, is_school, is_enterprise, is_NSF, is_973, is_863, is_NKTRD, is_DFME, is_major, start_date, deadline_date, conclude_date, app_date, pass_date, app_fund, pass_fund, ', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		/*
			must add an alias to disambiguate col names in the order clause,
			can't disambiguate without alias:
			<WRONG_CODE>
				...
				'execute_peoples' => array(
	            	self::MANY_MANY, 
	            	'People', 
	            	'tbl_project_people_execute(project_id, people_id)',
	            	'order'=>'execute_peoples.seq',
	            ),
	            ...
            </WRONG_CODE>

            seems a bug in the Yii framework, alias seemd to be concated with 
            relationName in the SQL JOIN(instead of replacing it):
            eg:
            	if not specifying alias, the above WRONG code would render SQL like:
            		 LEFT OUTER JOIN `tbl_project_people_execute` `execute_peoples_execute_peoples` 
            		 ON (`t`.`id`=`execute_peoples_execute_peoples`.`project_id`)
            	which makes it not possible to disambiguate col names in order clause

		*/
		return array(
			'liability_peoples' => array(
				self::MANY_MANY, 
				'People', 
				'tbl_project_people_liability(project_id, people_id)',
				'order'=>'liability_peoples_liability_.seq',
				'alias'=>'liability_'
			),
            'execute_peoples' => array(
            	self::MANY_MANY, 
            	'People', 
            	'tbl_project_people_execute(project_id, people_id)',
            	'order'=>'execute_peoples_execute_.seq',
            	'alias'=>'execute_'
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
			'number' => '编号',
			'fund_number' => '经费本编号',
			'is_intl' => '国际',
			'is_national' => '国家级',
			'is_provincial' => '省部级',
			'is_city' => '市级',
			'is_school' => '校级',
			'is_enterprise' => '横向',
			'is_NSF' => '国家自然基金',
			'is_973' => '973',
			'is_863' => '863',
			'is_NKTRD' => '科技支撑计划',
			'is_DFME' => '教育部高校博士点基金',
			'is_major' => '重大专项',
			'start_date' => '开始时间',
			'deadline_date' => '截至时间',
			'conclude_date' => '结题时间',
			'app_date' => '申报时间',
			'pass_date' => '立项时间',
			'app_fund' => '申报经费',
			'pass_fund' => '立项经费',
			'execute_peoples' => '实际执行人员',
			'liability_peoples' => '项目书人员',
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

		$criteria=new CDbCriteria;
		$criteria->with=array(
			'execute_peoples',
			'liability_peoples'
		);
		$criteria->together=true;
		$criteria->group = 't.id';//IMPORTANT!!
		$criteria->compare('execute_.id',$this->searchExecutePeople,true);
		$criteria->compare('liability_.id',$this->searchLiabilityPeople,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('number',$this->number,true);
		$criteria->compare('fund_number',$this->fund_number,true);
		$criteria->compare('is_intl',$this->is_intl);
		$criteria->compare('is_national',$this->is_national);
		$criteria->compare('is_provincial',$this->is_provincial);
		$criteria->compare('is_city',$this->is_city);
		$criteria->compare('is_school',$this->is_school);
		$criteria->compare('is_enterprise',$this->is_enterprise);
		$criteria->compare('is_NSF',$this->is_NSF);
		$criteria->compare('is_973',$this->is_973);
		$criteria->compare('is_863',$this->is_863);
		$criteria->compare('is_NKTRD',$this->is_NKTRD);
		$criteria->compare('is_DFME',$this->is_DFME);
		$criteria->compare('is_major',$this->is_major);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('deadline_date',$this->deadline_date,true);
		$criteria->compare('conclude_date',$this->conclude_date,true);
		$criteria->compare('app_date',$this->app_date,true);
		$criteria->compare('pass_date',$this->pass_date,true);
		$criteria->compare('app_fund',$this->app_fund,true);
		$criteria->compare('pass_fund',$this->pass_fund,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	
	public function getLevelString($glue=', '){
        $levels = array();
        $attrs = self::attributeLabels();
        if($this->is_intl){
            array_push($levels,$attrs['is_intl']);
        }
        if($this->is_national){
            array_push($levels,$attrs['is_national']);
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
        if($this->is_enterprise){
            array_push($levels,$attrs['is_enterprise']);
        }
        if($this->is_NSF){
            array_push($levels,$attrs['is_NSF']);
        }
        if($this->is_973){
            array_push($levels,$attrs['is_973']);
        }
        if($this->is_863){
            array_push($levels,$attrs['is_863']);
        }
        if($this->is_NKTRD){
            array_push($levels,$attrs['is_NKTRD']);
        }
        if($this->is_DFME){
            array_push($levels,$attrs['is_DFME']);
        }
        if($this->is_major){
            array_push($levels,$attrs['is_major']);
        }


        return implode($glue,$levels);

    }


    public function getPeoples($type,$glue=', ',$attr='name') {
    	$peoplesArr = array();
    	switch ($type) {
    		case self::EXECUTE:
    			$peopleRecords=$this->execute_peoples;
    			break;
    		case self::LIABILITY:
    			$peopleRecords=$this->liability_peoples;
    			break;
    		default:
    			$peopleRecords=$this->execute_peoples;
    			break;
    	}
    	foreach ($peopleRecords as $people) {
    		array_push($peoplesArr,$people->$attr);
    	}
    	return implode($glue,$peoplesArr);
    }

    public function getExecutePeoples($glue=', ',$attr='name') {
    	return self::getPeoples(self::EXECUTE,$glue,$attr);
    }

    public function getLiabilityPeoples($glue=', ',$attr='name') {
    	return self::getPeoples(self::LIABILITY,$glue,$attr);
    }

    public function getExecutePeoplesJsArray($attr='id') {
    	$executePeoples = array();
    	foreach ($this->execute_peoples as $executePeople) {
    		array_push($executePeoples,'"'.$executePeople->$attr.'"');
    	}
    	return implode(', ', $executePeoples);
    }


    public function getLiabilityPeoplesJsArray($attr='id') {
    	$executePeoples = array();
    	foreach ($this->liability_peoples as $executePeople) {
    		array_push($executePeoples,'"'.$executePeople->$attr.'"');
    	}
    	return implode(', ', $executePeoples);
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Project the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	
	protected function beforeSave()
	{
		if ($this->pass_date=='')
            $this->pass_date=null;
        if ($this->app_date=='')
            $this->app_date=null;
        if ($this->conclude_date=='')
            $this->conclude_date=null;
        if($this->scenario=='update') {
			if(self::deleteProjectPeople(self::EXECUTE) && self::deleteProjectPeople(self::LIABILITY)){
				return parent::beforeSave();
			} else {
				return false;
			}
		}
		return parent::beforeSave();
	}

	protected function afterSave() {
		
	        if(self::populateProjectPeople(self::EXECUTE) && self::populateProjectPeople(self::LIABILITY)) {

	        }  
	        else {
	            return false;
	        }
	    
	    return parent::afterSave();
    }

    private function deleteProjectPeople($type) {
     	$criteria = new CDbCriteria;
        $criteria->condition = 'project_id=:project_id';
        $criteria->params = array(':project_id'=>$this->id);
        

         switch ($type) {
            case self::EXECUTE:
                ProjectPeopleExecute::model()->deleteAll($criteria);
                break;
            
            case self::LIABILITY:
                ProjectPeopleLiability::model()->deleteAll($criteria);
                break;
            default:
                return ProjectPeopleExecute::model()->deleteAll($criteria);
                break;
        }
        return true;
    }
    private function populateProjectPeople($type)
    {
        switch ($type) {
            case self::EXECUTE:
                $peoples=$this->executePeoples;
                break;
            
            case self::LIABILITY:
                $peoples=$this->liabilityPeoples;
                break;
            default:
                $peoples=$this->executePeoples;
                break;
        }
        for($i=0;$i<count($peoples);$i++) {
            if($peoples[$i]!=null && $peoples[$i]!=0) {
                switch ($type) {
                    case self::EXECUTE:
                        $projectPeople = new ProjectPeopleExecute;
                        break;
                    case self::LIABILITY:
                        $projectPeople = new ProjectPeopleLiability;
                        break;
                    default:
                        $projectPeople = new ProjectPeopleExecute;
                        break;
                }
                
                $projectPeople->seq = $i+1;
                $projectPeople->project_id=$this->id;
                $projectPeople->people_id=$peoples[$i];
                //echo $projectPeople->project_id." ".$projectPeople->people_id."<br>";
                if($projectPeople->save()) {
                    yii::trace("peoples[i]:".$peoples[$i]." saved","Project.populateProjectPeople()");
                } else {
                    return false;
                }
            }
        }
        return true;
    }

    protected function afterDelete() {
    	if(self::deleteProjectPeople(self::EXECUTE) && self::deleteProjectPeople(self::LIABILITY)){
			return parent::afterDelete();
		} else {
			return false;
		}
    }
}
