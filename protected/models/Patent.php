<?php

/**
 * This is the model class for table "tbl_patent".
 *
 * The followings are the available columns in table 'tbl_patent':
 * @property integer $id
 * @property string $name
 * @property string $app_date
 * @property string $app_number
 * @property string $auth_number
 * @property string $auth_date
 * @property integer $is_intl
 * @property integer $is_domestic
 * @property string $abstract
 *
 * The followings are the available model relations:
 * @property People[]peoples
 * @property People searchPeople
 */
class Patent extends CActiveRecord
{


    const PROJECT_FUND=0;
    const PROJECT_REIM=1;
    const PROJECT_ACHIEVEMENT=2;

    public $searchPeople;

	public $achievementProjectIds = array();

	public function tableName()
	{
		return 'tbl_patent';
	}
    public function getAuthors() {
        $out=CHtml::listData($this->peoples,'id','name');
        return implode('<br/>', $out);
    }
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, app_date, app_number, is_intl, is_domestic, abstract', 'required'),
			array('app_date, auth_date','date','format'=>array('yyyy-mm-dd','yyyy.mm.dd','yyyy-m-d','yyyy.m.d')),
            array('is_intl, is_domestic', 'numerical', 'integerOnly'=>true),
			array('name, app_number, auth_number', 'length', 'max'=>255),
			array('auth_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, app_date, app_number, auth_number, auth_date, is_intl, is_domestic, abstract', 'safe', 'on'=>'search'),
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
				'tbl_patent_people(patent_id, people_id)',
				'alias'=>'peoples_',
				'order'=>'peoples_peoples_.seq',
			),
			'achievement_projects' => array(
				self::MANY_MANY, 
				'Project', 
				'tbl_patent_project_achievement(patent_id, project_id)',
				'alias'=>'achievement_',
				'order'=>'achievement_projects_achievement_.seq',
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
			'name' => '专利名称',
			'app_date' => '申请时间',
			'app_number' => '申请号',
			'auth_number' => '授权号',
			'auth_date' => '授权时间',
			'is_intl' => '国际',
			'is_domestic' => '国内',
			'abstract' => '简介',
            'peoples' => '发明人',
            'achievement_projects' => '成果项目',
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
        $criteria->with = array('peoples');
        //$criteria->order = 't.id';
        $criteria->together = true;
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('app_date',$this->app_date,true);
		$criteria->compare('app_number',$this->app_number,true);
		$criteria->compare('auth_number',$this->auth_number,true);
		$criteria->compare('auth_date',$this->auth_date,true);
		$criteria->compare('is_intl',$this->is_intl);
		$criteria->compare('is_domestic',$this->is_domestic);
		$criteria->compare('abstract',$this->abstract,true);
        //$criteria->compare('peoples.name',$this->searchPeople->name,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'t.id ASC',
            ),
		));
	}

    /**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Patent the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getAchievementProjects($glue=', ',$attr='name'){
        return self::getProjects(self::PROJECT_ACHIEVEMENT,$glue,$attr);   
    }

    public function getProjects($type,$glue=', ',$attr='name'){
        $projectsArr = array();
        switch ($type) {

            case self::PROJECT_ACHIEVEMENT:
                $projectRecords=$this->achievement_projects;
                break;
            default:
                $projectRecords=$this->achievement_projects;
                break;
        }
        foreach ($projectRecords as $project){
            array_push($projectsArr,$project->$attr);
        }
        return implode($glue, $projectsArr);
    }

    private function populatePatentProject($type) {
        switch ($type) {
            case self::PROJECT_ACHIEVEMENT:
            	$projects=$this->achievementProjectIds;
            default:
                $projects=$this->achievementProjectIds;
                break;
        }
        for($i=0;$i<count($projects);$i++) {
            if($projects[$i]!=null && $projects[$i]!=0){
                switch ($type) {
                    case self::PROJECT_ACHIEVEMENT:
                        $patentProject = new PatentProjectAchievement;
                        break;
                    default:
                        $patentProject = new PatentProjectAchievement;
                        break;
                }
                $patentProject->seq=$i+1;
                $patentProject->patent_id=$this->id;
                $patentProject->project_id=$projects[$i];
                if($patentProject->save()) {
                    yii::trace("projects[i]:".$projects[$i]." saved","Patent.populatePatentProject()");
                } else {
                    return false;
                }

            }
        }
        return true;
    }

    private function populatePatentProjectAll() {
    	return 
    		self::populatePatentProject(self::PROJECT_ACHIEVEMENT);
    }

    private function deletePatentProject($type) {
        $criteria = new CDbCriteria;
        $criteria->condition = 'patent_id=:patent_id';
        $criteria->params = array(':patent_id'=>$this->id);
        

         switch ($type) {
            case self::PROJECT_ACHIEVEMENT:
            	PatentProjectAchievement::model()->deleteAll($criteria);
            default:
                PatentProjectAchievement::model()->deleteAll($criteria);
                break;
        }
        return true;
    }

    private function deletePatentProjectAll() {
    	self::deletePatentProject(self::PROJECT_ACHIEVEMENT);
    	return true;
    }


	public function getPeoples($glue=', ',$attr='name') {
		$peopleArr = array();
		foreach ($this->peoples as $people) {
			array_push($peopleArr,$people->$attr);
		}
		return implode($glue,$peopleArr);
    }

    protected function beforeSave(){
    	if($this->app_date=='') {
    		$this->app_date=null;
    	}
    	if($this->auth_date=='') {
    		$this->auth_date=null;
    	}
	    if($this->scenario=='update') {
	    	if(self::deletePatentProjectAll()) {
	    		return parent::beforeSave();
	    	} else {
	    		return false;
	    	}
	    }
	    return parent::beforeSave();
	}

	protected function afterSave() {
		return 
			self::populatePatentProjectAll() &&
			parent::afterSave(); 
	}

    protected function afterDelete() {
        return 
        	self::deletePatentProjectAll() &&
        	parent::afterDelete();
    }

}
