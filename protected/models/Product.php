<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property integer $id
 * @property integer $kod_p
 * @property string $name
 *
 * The followings are the available model relations:
 * @property Relation[] $relations
 */
class Product extends CActiveRecord
{
    public $kod_r;
   
    public $quantity;
 
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kod_p, name', 'required'),
			array('kod_p', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kod_p, name', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * Сворюємо зв'язок між таблицями product і resource за допомогою пов'язуючої таблиці relations
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'relation' => array(self::HAS_MANY, 'Relation', 'kod_p'),
			'resource' => array(self::HAS_MANY, 'Resource', 'kod_r', 'through'=>'relation'),
		);
	}
        
        // Встановлюємо первинний ключ
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
			'kod_p' => 'Код продукту',
			'name' => 'Назва продукту',
                    // додаємо дочірні поля
			'kod_r' => 'Ресурс',
			'quantity' => 'Кількість для виготовлення одиниці продукції',
                        
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
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        //метод повертає перелік ресурсів ресурсів для виготовлення товару
       
        public function findresource() {

           foreach ($this->resource as $one) {
               $arr[] = $one->name;
           }
           return implode(", ", $arr);
       }

       public function afterSave() {
            parent::afterSave();
            if ($this->isNewRecord) {

                // Якщо ми додаємо товар,  то потрібно додати й необхідні зв"язки з ресурами
                $relation = new Relation();
                
                $relation->quantity = $_POST['Product']['quantity'];
                $relation->kod_r = $_POST['Product']['kod_r'];
                $relation->kod_p = $_POST['Product']['kod_p'];
                $relation->save();
            }   
            // якщо продукт оновлюється
            else {  
                foreach ($_POST['resources'] as $one) {
                    //проходимо циклом по базі resources і оновлюємо записи по вибраних критеріях
                    $criteria = new CDbCriteria();
                    $criteria->condition = "kod_p =".$one['bufer_kod_p'];
                    $criteria->addCondition("kod_r =".$one['bufer_kod_r'], 'AND');
                    
                    Relation::model()->updateAll(array(
                       'kod_p' => $this->kod_p,
                       'kod_r' => $one['kod_r'],
                       'quantity' => $one['quantity'],
                           ), $criteria);
                }
            }
        }

       /**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Product the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
