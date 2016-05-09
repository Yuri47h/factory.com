<?php

/**
 * This is the model class for table "done".
 *
 * The followings are the available columns in table 'done':
 * @property integer $id
 * @property integer $kod_p
 * @property integer $quantity
 * @property integer $cost
 * @property integer $date
 */
class Done extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'done';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kod_r, order_id, quantity, cost, date', 'required'),
			array('kod_r, quantity, order_id, cost, date', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kod_r, quantity, order_id, cost, date', 'safe', 'on'=>'search'),
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
                    'resource'=>array(self::BELONGS_TO, 'Resource','kod_r'),
                    'archiveproduct'=>array(self::HAS_MANY, 'Archiveproduct','id'),
                    'product'=> array(self::HAS_MANY, 'Product','kod_p', 'through' =>'archiveproduct'),
		);
	}
        public function primaryKey()
	{
		return 'order_id';
		
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'order_id' => 'Індентифікаор замовлення',
			'kod_r' => 'Ресурс',
			'quantity' => 'Кількість',
			'cost' => 'Вартість',
			'date' => 'Дата виконання замовлення',
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
		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('kod_r',$this->kod_r);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('cost',$this->cost);
		$criteria->compare('date',$this->date);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                            'pageSize'=>100,
                        ),
		));
	}
        

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Done the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        
        //Створює кнопку при натисканні на яку замовлення виконужться, вноситься запис до БД Done, та вираховується кількість
        public static function actionCompleted($data){
            // повертаємо всі ресуси
            
        //приймаємо id замовлення
            if ($_POST["$data->id"]){
               
                if (!Order::possibility($data->kod_r, $data->quantity)) {
                    
                   echo "Замовлення не може бути виконане, тому що не вистачає ресурсів.";
                } 
                else {
                    $model = new Done;
                    $model->kod_r = $data->kod_r;
                    $model->quantity = $data->quantity;
                    $model->cost = $data->cost;
                    $model->order_id = $data->order_id;
                    $model->date = time();
                    if ($model->save()) {
                        echo "Замовлення успішно виконане!";
                    }
                }  
            }
            else  return CHtml::submitButton('Виконати замовлення',array('name'=>"$data->id"));
        }
        
      
        public function afterSave() {
             // Видаляэмо цей запис з активних замовлень
            $criteria = new CDbCriteria();
                $criteria->condition = "order_id =".$this->order_id;
                $criteria->addCondition("kod_r =".$this->kod_r);
            Order::model()->deleteAll($criteria);
            
            $resource = Resource::model()->findByPk($this->kod_r);
            $resource->quantity -= $this->quantity;
            $resource->update(array('quantity'));
           
            
            
           
            if (!Order::model()->findAllByAttributes(array('order_id'=>  $this->order_id))){
                
                $archive = Archiveproduct::model()->findByPk($this->order_id);
                $archive->status = 'yes';
                $archive->date = time();
                $archive->update(array('status', 'date'));                
            }
                    
            
            
            
            return parent::afterSave();
        }
}
