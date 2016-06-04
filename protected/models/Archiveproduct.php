<?php

/**
 * This is the model class for table "archiveproduct".
 *
 * The followings are the available columns in table 'archiveproduct':
 * @property integer $id

 * @property string $name
 * @property integer $quantity
 * @property integer $cost
 * @property integer $date
 */
class Archiveproduct extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'archiveproduct';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kod_p, quantity, cost', 'required'),
			array('quantity, kod_p, cost, status, date', 'numerical', 'integerOnly'=>true),
                        array('status', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kod_p, quantity, cost, date, status', 'safe', 'on'=>'search'),
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
                   'product'=> array(self::BELONGS_TO, 'Product', 'kod_p'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'kod_p' => 'Продукт',
			'quantity' => 'Кількість',
			'cost' => 'Вартість',
			'date' => 'Дата',
                        'status'=>'Статус виготовлення',
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
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('cost',$this->cost);
		$criteria->compare('date',$this->date);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        public function searchMade()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('kod_p',$this->kod_p);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('cost',$this->cost);
		$criteria->compare('date',$this->date);
		$criteria->compare('status','yes');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
         public function primaryKey()
	{
		return 'id';
		
	}
        
        public function beforeSave() {
            if($this->isNewRecord){
                $this->date = time();
                $this->status = 'no';
        }
            return parent::beforeSave();
        }

        /**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Archiveproduct the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
