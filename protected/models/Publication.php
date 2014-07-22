<?php

/**
 * This is the model class for table "tbl_publication".
 *
 * The followings are the available columns in table 'tbl_publication':
 * @property integer $id
 * @property string $info
 * @property string $press
 * @property string $pub_date
 * @property integer $is_textbook
 * @property integer $is_pub
 * @property string $isbn_number
 * @property string $description
 *
 * The followings are the available model relations:
 * @property People[] $tblPeoples
 */
class Publication extends CActiveRecord
{
	public $peoplesId=array();
	public $searchPeople=array();
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_publication';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('is_textbook, is_pub', 'numerical', 'integerOnly'=>true),
			array('info, press, isbn_number, description', 'length', 'max'=>255),
			array('pub_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, info, press, pub_date, is_textbook, is_pub, isbn_number, description', 'safe', 'on'=>'search'),
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
				'tbl_publication_people(publication_id, people_id)',
				'alias'=>'peoples_',
				'order'=>'peoples_peoples_.seq',
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
			'info' => '著作信息',
			'press' => '出版社',
			'pub_date' => '出版时间',
			'is_textbook' => '教材',
			'is_pub' => '专著',
			'isbn_number' => 'ISBN书号',
			'description' => '简介',
			'peoples'=>'编写人',
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
		$criteria->compare('press',$this->press,true);
		$criteria->compare('pub_date',$this->pub_date,true);
		$criteria->compare('is_textbook',$this->is_textbook);
		$criteria->compare('is_pub',$this->is_pub);
		$criteria->compare('isbn_number',$this->isbn_number,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Publication the static model class
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

    public function getPeoplesJsArray($attr='id') {
    	$peoples=array();
    	foreach ($this->peoples as $people) {
    		array_push($peoples,'"'.$people->$attr.'"');
    	}
    	return implode(', ', $peoples);
    }

    private function populatePublicationPeople(){
    	$peoples=$this->peoplesId;
    	for($i=0;$i<count($peoples);$i++){
    		if($peoples[$i]!=null && $peoples[$i]!=0) {
    			$publicationPeople = new PublicationPeople;
    			$publicationPeople->seq=$i+1;
    			$publicationPeople->publication_id=$this->id;
    			$publicationPeople->people_id=$peoples[$i];
    			yii::trace("peoples[i]:".$peoples[$i]." saving","Publication.populatePublicationPeople()");
    			if($publicationPeople->save()){
    				yii::trace("peoples[i]:".$peoples[$i]." saved","Publication.populatePublicationPeople()");
    			} else {
    				return false;
    			}
    		}
    	}
    	return true;
    }

    private function deletePublicationPeople(){
    	$criteria = new CDbCriteria;
    	$criteria->condition = 'publication_id=:publication_id';
    	$criteria->params = array(':publication_id'=>$this->id);
    	return PublicationPeople::model()->deleteAll($criteria);
    }

    protected function beforeSave(){
    	Yii::trace("beforeSave()","Publication");
    	if($this->pub_date=='') {
    		$this->pub_date=null;
    	}
	    if($this->scenario=='update') {
	    	if(self::deletePublicationPeople()) {
	    		return parent::beforeSave();
	    	} else {
	    		return false;
	    	}
	    }
	    return parent::beforeSave();
	}

	protected function afterSave() {
		Yii::trace("afterSave()","Publication");
		return self::populatePublicationPeople() && parent::afterSave(); 
	}
}
