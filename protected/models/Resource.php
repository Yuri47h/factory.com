<?php

/**
 * This is the model class for table "resource".
 *
 * The followings are the available columns in table 'resource':
 * @property integer $id
 * @property integer $kod_r
 * @property string $name
 * @property integer $quantity
 * @property integer $price
 */
class Resource extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'resource';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
        
        // Встановлюємо первинний ключ
        public function primaryKey()
	{
		return 'kod_r';
		
	}
        
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kod_r, name, price', 'required'),
			array('kod_r, quantity, price', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kod_r, quantity, name, price', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * Сворюємо зв'язок між таблицями resource і product за допомогою пов'язуючої таблиці relations
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'relation' => array(self::HAS_MANY, 'Relation', 'kod_r'),
			'product' => array(self::HAS_MANY, 'Product', 'kod_r', 'through'=>'relation'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'kod_r' => 'Код ресурсу',
			'name' => 'Назва',
			'price' => 'Ціна',
                        'quantity'=> 'Кількість'
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
		$criteria->compare('kod_r',$this->kod_r);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('quantity',$this->quantity);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                            'pageSize'=>100,
                        ),
		));
	}
        
        // Повертає ціну на шуканий ресурс
        public static function price ($kod_r){
            $resource = Resource::model()->findByPk($kod_r);
            return $resource->price;
        }
        
         //Метод повертає всі ресурси та формує масив з них
        public static function allResource(){
           $resource = CHtml::listData(Resource::model()->findAll(), 'kod_r', 'name');
           return $resource;
        }
        
        

        /**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Resource the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
