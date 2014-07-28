<?php

/**
 * This is the model class for table "tbl_paper_teaching".
 *
 * The followings are the available columns in table 'tbl_paper_teaching':
 * @property integer $id
 * @property string $info
 * @property integer $status
 * @property string $pass_date
 * @property string $pub_date
 * @property string $index_date
 * @property string $sci_number
 * @property string $ei_number
 * @property string $istp_number
 * @property integer $is_first_grade
 * @property integer $is_core
 * @property string $other_pub
 * @property integer $is_journal
 * @property integer $is_conference
 * @property integer $is_intl
 * @property integer $is_domestic
 * @property string $filename
 * @property integer $is_high_level
 * @property integer $maintainer_id
 *
 * The followings are the available model relations:
 * @property People $maintainer
 * @property People[] $tblPeoples
 * @property Project[] $tblProjects
 */
class PaperTeaching extends CActiveRecord
{    
	const STATUS_PASSED = 0;    //录用待发
    const STATUS_PUBLISHED = 1; //已发表
    const STATUS_INDEXED = 2;   //已检索

    const LABEL_PASSED = '录用待发';
    const LABEL_PUBLISHED = '已发表';
    const LABEL_INDEXED = '已检索';

    const LEVEL_DOMESTIC = '国内';
    const LEVEL_INTL = '国际';
    const LEVEL_CORE = '核心';
    const LEVEL_JOURNAL = '期刊';
    const LEVEL_CONFERENCE = '会议';
    const LEVEL_FIRST_GRADE = '一级';
    const LEVEL_HIGH_LEVEL = '高水平';
    const LEVEL_OTHER_PUB = '其它刊物';

    const PROJECT_FUND=0;
    const PROJECT_REIM=1;
    const PROJECT_ACHIEVEMENT=2;

	public $peopleIds = array();

	public $fundProjectIds = array();
	public $reimProjectIds = array();
	public $achievementProjectIds = array();
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_paper_teaching';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('info', 'required'),
			array('status, is_first_grade, is_core, is_journal, is_conference, is_intl, is_domestic, is_high_level, maintainer_id', 'numerical', 'integerOnly'=>true),
			array('info, sci_number, ei_number, istp_number, other_pub, filename', 'length', 'max'=>255),
			array('pass_date, pub_date, index_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, info, status, pass_date, pub_date, index_date, sci_number, ei_number, istp_number, is_first_grade, is_core, other_pub, is_journal, is_conference, is_intl, is_domestic, filename, is_high_level, maintainer_id', 'safe', 'on'=>'search'),
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
			'maintainer' => array(
				self::BELONGS_TO, 
				'People', 
				'maintainer_id'
			),
			'peoples' => array(
				self::MANY_MANY, 
				'People', 
				'tbl_paper_teaching_people(paper_teaching_id, people_id)',
				'alias'=>'peoples_',
				'order'=>'peoples_peoples_.seq',
			),
			'fund_projects' => array(
				self::MANY_MANY, 
				'Project', 
				'tbl_paper_teaching_project_fund(paper_teaching_id, project_id)',
				'alias'=>'fund_',
				'order'=>'fund_projects_fund_.seq',
			),
			'reim_projects' => array(
				self::MANY_MANY, 
				'Project', 
				'tbl_paper_teaching_project_reim(paper_teaching_id, project_id)',
				'alias'=>'reim_',
				'order'=>'reim_projects_reim_.seq',
			),
			'achievement_projects' => array(
				self::MANY_MANY, 
				'Project', 
				'tbl_paper_teaching_project_achievement(paper_teaching_id, project_id)',
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
			'info' => '论文信息',
			'status' => '状态',
			'pass_date' => '录用时间',
			'pub_date' => '发表时间',
			'index_date' => '发表和检索时间',
			'sci_number' => 'SCI检索号',
			'ei_number' => 'EI检索号',
			'istp_number' => 'ISTP检索号',
			'is_first_grade' => '一级',
			'is_core' => '核心',
			'other_pub' => '其他',
			'is_journal' => '期刊',
			'is_conference' => '会议',
			'is_intl' => '国际',
			'is_domestic' => '国内',
			'filename' => '论文文件',
			'is_high_level' => '高水平',
			'maintainer' => '维护人员',
            'reim_projects' => '报账项目',
            'fund_projects' => '资助项目',
            'achivement_projects' => '成果项目',
            'level'=>'级别',
            'peoples'=>'作者',
		);
	}

	public function getPeoples($glue=', ',$attr='name') {
		$peopleArr = array();
		foreach ($this->peoples as $people) {
			array_push($peopleArr,$people->$attr);
		}
		return implode($glue,$peopleArr);
    }

    public function getDateString() {
        if(!empty($this->index_date)){
            return $this->index_date;
        } else if(!empty($this->pub_date)){
            return $this->pub_date;
        } else if(!empty($this->pass_date)){
            return $this->pass_date;
        } else {
            return "";
        }
    }

    public function getStatusString() {
        if($this->status == self::STATUS_INDEXED) {
            return self::LABEL_INDEXED;
        } else if($this->status == self::STATUS_PUBLISHED) {
            return self::LABEL_PUBLISHED;
        } else if($this->status == self::STATUS_PASSED) {
            return self::LABEL_PASSED;
        } else {
            return "";
        }

    }

    public function getIndexString($glue=', '){
        $indexes = array();
        if(!empty($this->sci_number)){
            array_push($indexes,'SCI: '.$this->sci_number);
        }
        if(!empty($this->ei_number)){
            array_push($indexes,'EI: '.$this->ei_number);
        }
        if(!empty($this->istp_number)){
            array_push($indexes,'ISTP: '.$this->istp_number);
        }
        return implode($glue, $indexes);
    }



    public function getLevelString($glue=', '){
        $levels = array();
        if($this->is_domestic){
            array_push($levels,self::LEVEL_DOMESTIC);
        }
        if($this->is_intl){
            array_push($levels,self::LEVEL_INTL);
        }
        if($this->is_core){
            array_push($levels,self::LEVEL_CORE);
        }
        if($this->is_journal){
            array_push($levels,self::LEVEL_JOURNAL);
        }
        if($this->is_conference){
            array_push($levels,self::LEVEL_CONFERENCE);
        }
        if($this->is_first_grade){
            array_push($levels,self::LEVEL_FIRST_GRADE);
        }
        if($this->is_high_level){
            array_push($levels,self::LEVEL_HIGH_LEVEL);
        }
        if(!empty($this->other_pub)){
            array_push($levels,$this->other_pub);
        }
        return implode($glue,$levels);
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
		$criteria->compare('info',$this->info,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('pass_date',$this->pass_date,true);
		$criteria->compare('pub_date',$this->pub_date,true);
		$criteria->compare('index_date',$this->index_date,true);
		$criteria->compare('sci_number',$this->sci_number,true);
		$criteria->compare('ei_number',$this->ei_number,true);
		$criteria->compare('istp_number',$this->istp_number,true);
		$criteria->compare('is_first_grade',$this->is_first_grade);
		$criteria->compare('is_core',$this->is_core);
		$criteria->compare('other_pub',$this->other_pub,true);
		$criteria->compare('is_journal',$this->is_journal);
		$criteria->compare('is_conference',$this->is_conference);
		$criteria->compare('is_intl',$this->is_intl);
		$criteria->compare('is_domestic',$this->is_domestic);
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('is_high_level',$this->is_high_level);
		$criteria->compare('maintainer_id',$this->maintainer_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getProjects($type,$glue=', ',$attr='name'){
        $projectsArr = array();
        switch ($type) {
            case self::PROJECT_FUND:
                $projectRecords=$this->fund_projects;
                break;
            case self::PROJECT_REIM:
                $projectRecords=$this->reim_projects;
                break;
            case self::PROJECT_ACHIEVEMENT:
                $projectRecords=$this->achievement_projects;
                break;
            default:
                $projectRecords=$this->fund_projects;
                break;
        }
        foreach ($projectRecords as $project){
            array_push($projectsArr,$project->$attr);
        }
        return implode($glue, $projectsArr);
    }

    public function getFundProjects($glue=', ',$attr='name'){
        return self::getProjects(self::PROJECT_FUND,$glue,$attr);   
    }

    public function getReimProjects($glue=', ',$attr='name'){
        return self::getProjects(self::PROJECT_REIM,$glue,$attr);   
    }

    public function getAchievementProjects($glue=', ',$attr='name'){
        return self::getProjects(self::PROJECT_ACHIEVEMENT,$glue,$attr);   
    }


    private function populatePaperTeachingPeople() {
        $peoples=$this->peopleIds;
        for($i=0;$i<count($peoples);$i++) {
            if($peoples[$i]!=null && $peoples[$i]!=0){
                $paperTeachingPeople = new PaperTeachingPeople;
                $paperTeachingPeople->seq=$i+1;
                $paperTeachingPeople->paper_teaching_id=$this->id;
                $paperTeachingPeople->people_id=$peoples[$i];
                if($paperTeachingPeople->save()) {
                    yii::trace("peoples[i]:".$peoples[$i]." saved","PaperTeachingTeaching.populatePaperPeoples()");
                } else {
                    return false;
                }

            }
        }
        return true;
    }

    private function deletePaperTeachingPeople() {
        $criteria = new CDbCriteria;
        $criteria->condition = 'paper_teaching_id=:paper_teaching_id';
        $criteria->params = array(':paper_teaching_id'=>$this->id);
        PaperTeachingPeople::model()->deleteAll($criteria);
        return true;
    }

    private function populatePaperTeachingProject($type) {
        switch ($type) {
            case self::PROJECT_FUND:
                $projects=$this->fundProjectIds;
                break;
            case self::PROJECT_REIM:
                $projects=$this->reimProjectIds;
                break;
            case self::PROJECT_ACHIEVEMENT:
            	$projects=$this->achievementProjectIds;
            default:
                $projects=$this->fundProjectIds;
                break;
        }
        for($i=0;$i<count($projects);$i++) {
            if($projects[$i]!=null && $projects[$i]!=0){
                switch ($type) {
                    case self::PROJECT_FUND:
                        $paperTeachingProject = new PaperTeachingProjectFund;
                        break;
                    case self::PROJECT_REIM:
                        $paperTeachingProject = new PaperTeachingProjectReim;
                        break;
                    case self::PROJECT_ACHIEVEMENT:
                        $paperTeachingProject = new PaperTeachingProjectAchievement;
                        break;
                    default:
                        $paperTeachingProject = new PaperTeachingProjectFund;
                        break;
                }
                $paperTeachingProject->seq=$i+1;
                $paperTeachingProject->paper_teaching_id=$this->id;
                $paperTeachingProject->project_id=$projects[$i];
                if($paperTeachingProject->save()) {
                    yii::trace("projects[i]:".$projects[$i]." saved","PaperTeaching.populatePaperTeachingProject()");
                } else {
                    return false;
                }

            }
        }
        return true;
    }

    private function populatePaperTeachingProjectAll() {
    	return 
    		self::populatePaperTeachingProject(self::PROJECT_FUND) &&
    		self::populatePaperTeachingProject(self::PROJECT_REIM) &&
    		self::populatePaperTeachingProject(self::PROJECT_ACHIEVEMENT);
    }

    private function deletePaperTeachingProject($type) {
        $criteria = new CDbCriteria;
        $criteria->condition = 'paper_teaching_id=:paper_teaching_id';
        $criteria->params = array(':paper_teaching_id'=>$this->id);
        

         switch ($type) {
            case self::PROJECT_FUND:
                PaperTeachingProjectFund::model()->deleteAll($criteria);
                break;
            
            case self::PROJECT_REIM:
                PaperTeachingProjectReim::model()->deleteAll($criteria);
                break;
            case self::PROJECT_ACHIEVEMENT:
            	PaperTeachingProjectAchievement::model()->deleteAll($criteria);
            default:
                PaperTeachingProjectFund::model()->deleteAll($criteria);
                break;
        }
        return true;
    }

    private function deletePaperTeachingProjectAll() {
    	self::deletePaperTeachingProject(self::PROJECT_FUND);
    	self::deletePaperTeachingProject(self::PROJECT_REIM);
    	self::deletePaperTeachingProject(self::PROJECT_ACHIEVEMENT);
    	return true;
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PaperTeaching the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    protected function beforeSave(){
        if($this->pass_date=='') {
            $this->pass_date=null;
        }
        if($this->pub_date=='') {
            $this->pub_date=null;
        }
        if($this->index_date=='') {
            $this->index_date=null;
        }
        if($this->scenario=='update') {
            if(self::deletePaperTeachingProjectAll() && self::deletePaperTeachingPeople()) {
                return parent::beforeSave();
            } else {
                return false;
            }
        }
        return parent::beforeSave();
    }

    protected function afterSave() {
        return 
            self::populatePaperTeachingProjectAll() && 
            self::populatePaperTeachingPeople() &&
            parent::afterSave(); 
    }

    protected function afterDelete() {
        return 
        self::deletePaperTeachingProjectAll() && 
        self::deletePaperTeachingPeople() &&
        parent::afterDelete();
    }

}
