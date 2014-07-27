<?php

/**
 * This is the model class for table "tbl_course".
 *
 * The followings are the available columns in table 'tbl_course':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $semester
 * @property string $duration
 * @property string $textbook
 *
 * The followings are the available model relations:
 * @property People[] $tblPeoples
 */
class Course extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_course';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, semester, duration', 'length', 'max'=>255),
			array('description, textbook', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, description, semester, duration, textbook', 'safe', 'on'=>'search'),
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
			'tblPeoples' => array(self::MANY_MANY, 'People', 'tbl_course_people(course_id, people_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => '课程名称',
			'description' => '课程简介',
			'semester' => '开课学期',
			'duration' => '学时',
			'textbook' => '教材及参考资料',
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('semester',$this->semester,true);
		$criteria->compare('duration',$this->duration,true);
		$criteria->compare('textbook',$this->textbook,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Course the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
