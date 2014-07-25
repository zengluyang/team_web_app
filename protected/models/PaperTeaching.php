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
			'maintainer' => array(self::BELONGS_TO, 'People', 'maintainer_id'),
			'tblPeoples' => array(self::MANY_MANY, 'People', 'tbl_paper_teaching_people(paper_teaching_id, people_id)'),
			'tblProjects' => array(self::MANY_MANY, 'Project', 'tbl_paper_teaching_project_reim(paper_teaching_id, project_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'info' => 'Info',
			'status' => 'Status',
			'pass_date' => 'Pass Date',
			'pub_date' => 'Pub Date',
			'index_date' => 'Index Date',
			'sci_number' => 'Sci Number',
			'ei_number' => 'Ei Number',
			'istp_number' => 'Istp Number',
			'is_first_grade' => 'Is First Grade',
			'is_core' => 'Is Core',
			'other_pub' => 'Other Pub',
			'is_journal' => 'Is Journal',
			'is_conference' => 'Is Conference',
			'is_intl' => 'Is Intl',
			'is_domestic' => 'Is Domestic',
			'filename' => 'Filename',
			'is_high_level' => 'Is High Level',
			'maintainer_id' => 'Maintainer',
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
}
