<?php

/**
 * This is the model class for table "order".
 *
 * The followings are the available columns in table 'order':
 * @property integer $id
 * @property integer $kod_p
 * @property integer $quantity
 * @property integer $date
 */
class Order extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kod_r, kod_p, quantity, cost, order_id', 'required'),
			array('kod_r, kod_p, quantity, date, order_id, cost', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kod_r, order_id, kod_p, quantity, date, cost', 'safe', 'on'=>'search'),
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
                    'resource'=> array(self::BELONGS_TO, 'Resource', 'kod_r'),
                    'product'=> array(self::BELONGS_TO, 'Product', 'kod_p'),
                    'archiveproduct'=> array(self::BELONGS_TO, 'archiveproduct', 'order_id'),
		);
	}
      

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'kod_r' => 'Ресурс',
			'kod_p' => 'Продукт',
			'quantity' => 'Кількість',
			'date' => 'Дата замовлення',
			'cost' => 'Вартість ресурсів',
			'order_id' => 'Ідентифікатор замовлення',
		);
	}
        
        public function beforeSave() {
            
            
            if ($this->isNewRecord){
                $this->date = time();
            }
            return parent::beforeSave();
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
		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('kod_r',$this->kod_r);
		$criteria->compare('cost',$this->cost);
		$criteria->compare('kod_p',$this->kod_p);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('date',$this->date);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        //перевірка чи можливо виконати замовлення
        public static function possibility($kod_r, $quantity){
            $resource = Resource::model()->findByPk(array('kod_r'=>$kod_r));
                 if ($quantity > $resource->quantity) {
                    return FALSE;
                }
                else return TRUE;
                
        }
        //кнопка відміни
        public static function Cancelorder($data){
           
         return CHtml::submitButton('Відмінити замовлення',array('name'=>"$data->order_id", 'value'=>"Відмінити замовлення"));
            
        }

        








        /**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Order the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
