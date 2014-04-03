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
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_project';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('is_intl, is_national, is_provincial, is_city, is_school, is_enterprise, is_NSF, is_973, is_863, is_NKTRD, is_DFME, is_major', 'numerical', 'integerOnly'=>true),
			array('name, number, fund_number', 'length', 'max'=>255),
			array('app_fund, pass_fund', 'length', 'max'=>15),
			array('start_date, deadline_date, conclude_date, app_date, pass_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, number, fund_number, is_intl, is_national, is_provincial, is_city, is_school, is_enterprise, is_NSF, is_973, is_863, is_NKTRD, is_DFME, is_major, start_date, deadline_date, conclude_date, app_date, pass_date, app_fund, pass_fund', 'safe', 'on'=>'search'),
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
			'liability_people' => array(self::MANY_MANY, 'People', 'tbl_project_people_liability(project_id, people_id)','order'=>'seq'),
            'execute_people' => array(self::MANY_MANY, 'People', 'tbl_project_people_execute(project_id, people_id)','order'=>'seq'),
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
			'is_DFME' => '教育部博士点专项基金',
			'is_major' => '重大专项',
			'start_date' => '开始时间',
			'deadline_date' => '截至时间',
			'conclude_date' => '结题时间',
			'app_date' => '申报时间',
			'pass_date' => '立项时间',
			'app_fund' => '申报经费',
			'pass_fund' => '立项经费',
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
}
