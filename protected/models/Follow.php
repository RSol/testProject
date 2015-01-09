<?php

/**
 * This is the model class for table "tbl_follow".
 *
 * The followings are the available columns in table 'tbl_follow':
 * @property integer $id
 * @property string $name
 * @property string $city
 * @property integer $zip
 * @property string $state
 * @property string $country
 */
class Follow extends CActiveRecord
{
	public $email;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_follow';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('zip', 'numerical', 'integerOnly'=>true),
			array('name, city, state, country', 'length', 'max'=>255),
			array('name, city', 'length', 'min'=>2),
			array('country', 'required'),
			array('state', 'required', 'on' => 'usa_country'),
			array('name', 'namevalidate'),
			array('zip', 'zipvalidate'),
			array('state', 'safe'),
		);
	}
	
	public function namevalidate($attribute,$params)
    {
		$str = str_word_count($this->name);
		if ($str != 'null' && $str < 2) {
			$this->addError('name','Name must contain 2 words or more');	
		}
    }
	
	public function zipvalidate($attribute,$params)
    {
		if ($this->country == 'USA' && strlen($this->zip) != 5 && strlen($this->zip) > 0) {
			$this->addError('zip','Length of zip for USA should be 5');		
		}
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'city' => 'City',
			'zip' => 'Zip',
			'state' => 'State',
			'country' => 'Country',
		);
	}
	
	public function afterSave(){
		$h=array();
		foreach ($this->email as $mail) {
			array_push($h, ['follow_id' => $this->id, 'email' => $mail]);
		}
		$builder=Yii::app()->db->schema->commandBuilder;
		$command=$builder->createMultipleInsertCommand('tbl_email', $h);
		$command->execute();
        return parent::afterSave();
    }
	
	public function getEmail($id) {
		$model = Email::model()->findAll('follow_id = :follow', [':follow'=>$id]);
		foreach ($model as $item) {
			$a = $a.$item->email.'<br>';
		}
		return $a;
		
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
		$criteria->compare('city',$this->city,true);
		$criteria->compare('zip',$this->zip);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('country',$this->country,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Follow the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
