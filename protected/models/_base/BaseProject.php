<?php

/**
 * This is the model base class for the table "tbl_project".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Project".
 *
 * Columns in table "tbl_project" available as properties of the model,
 * and there are no model relations.
 *
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
 */
abstract class BaseProject extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'tbl_project';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Project|Projects', $n);
	}

	public static function representingColumn() {
		return 'name';
	}

	public function rules() {
		return array(
			array('is_intl, is_national, is_provincial, is_city, is_school, is_enterprise, is_NSF, is_973, is_863, is_NKTRD, is_DFME, is_major', 'numerical', 'integerOnly'=>true),
			array('name, number, fund_number', 'length', 'max'=>255),
			array('app_fund, pass_fund', 'length', 'max'=>15),
			array('start_date, deadline_date, conclude_date, app_date, pass_date', 'safe'),
			array('name, number, fund_number, is_intl, is_national, is_provincial, is_city, is_school, is_enterprise, is_NSF, is_973, is_863, is_NKTRD, is_DFME, is_major, start_date, deadline_date, conclude_date, app_date, pass_date, app_fund, pass_fund', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, name, number, fund_number, is_intl, is_national, is_provincial, is_city, is_school, is_enterprise, is_NSF, is_973, is_863, is_NKTRD, is_DFME, is_major, start_date, deadline_date, conclude_date, app_date, pass_date, app_fund, pass_fund', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'name' => Yii::t('app', 'Name'),
			'number' => Yii::t('app', 'Number'),
			'fund_number' => Yii::t('app', 'Fund Number'),
			'is_intl' => Yii::t('app', 'Is Intl'),
			'is_national' => Yii::t('app', 'Is National'),
			'is_provincial' => Yii::t('app', 'Is Provincial'),
			'is_city' => Yii::t('app', 'Is City'),
			'is_school' => Yii::t('app', 'Is School'),
			'is_enterprise' => Yii::t('app', 'Is Enterprise'),
			'is_NSF' => Yii::t('app', 'Is Nsf'),
			'is_973' => Yii::t('app', 'Is 973'),
			'is_863' => Yii::t('app', 'Is 863'),
			'is_NKTRD' => Yii::t('app', 'Is Nktrd'),
			'is_DFME' => Yii::t('app', 'Is Dfme'),
			'is_major' => Yii::t('app', 'Is Major'),
			'start_date' => Yii::t('app', 'Start Date'),
			'deadline_date' => Yii::t('app', 'Deadline Date'),
			'conclude_date' => Yii::t('app', 'Conclude Date'),
			'app_date' => Yii::t('app', 'App Date'),
			'pass_date' => Yii::t('app', 'Pass Date'),
			'app_fund' => Yii::t('app', 'App Fund'),
			'pass_fund' => Yii::t('app', 'Pass Fund'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('number', $this->number, true);
		$criteria->compare('fund_number', $this->fund_number, true);
		$criteria->compare('is_intl', $this->is_intl);
		$criteria->compare('is_national', $this->is_national);
		$criteria->compare('is_provincial', $this->is_provincial);
		$criteria->compare('is_city', $this->is_city);
		$criteria->compare('is_school', $this->is_school);
		$criteria->compare('is_enterprise', $this->is_enterprise);
		$criteria->compare('is_NSF', $this->is_NSF);
		$criteria->compare('is_973', $this->is_973);
		$criteria->compare('is_863', $this->is_863);
		$criteria->compare('is_NKTRD', $this->is_NKTRD);
		$criteria->compare('is_DFME', $this->is_DFME);
		$criteria->compare('is_major', $this->is_major);
		$criteria->compare('start_date', $this->start_date, true);
		$criteria->compare('deadline_date', $this->deadline_date, true);
		$criteria->compare('conclude_date', $this->conclude_date, true);
		$criteria->compare('app_date', $this->app_date, true);
		$criteria->compare('pass_date', $this->pass_date, true);
		$criteria->compare('app_fund', $this->app_fund, true);
		$criteria->compare('pass_fund', $this->pass_fund, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}