<?php

/**
 * This is the model class for table "relation".
 *
 * The followings are the available columns in table 'relation':
 * @property integer $id
 * @property integer $kod_p
 * @property integer $kod_r
 * @property integer $quantity
 *
 * The followings are the available model relations:
 * @property Resource $kodR
 * @property Product $kodP
 */
class Relation extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'relation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kod_p, kod_r, quantity', 'required'),
			array('kod_p, kod_r, quantity', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kod_p, kod_r, quantity', 'safe', 'on'=>'search'),
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
			'resource' => array(self::BELONGS_TO, 'Resource', 'kod_r'),
			'product' => array(self::BELONGS_TO, 'Product', 'kod_p'),
		);
	}
        
        public function primaryKey()
	{
		return 'kod_p';
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'kod_p' => 'Продукт',
			'kod_r' => 'Ресурс',
			'quantity' => 'Кілкість',
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
		$criteria->compare('kod_p',$this->kod_p);
		$criteria->compare('kod_r',$this->kod_r);
		$criteria->compare('quantity',$this->quantity);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Relation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
