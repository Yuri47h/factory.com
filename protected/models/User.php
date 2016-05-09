<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property integer $role
 */
class User extends CActiveRecord
{
    const ROLE_ADMIN = 'admin';
    const ROLE_MANUFACTORY = 'manufactory';
    const ROLE_STORAGE = 'storage';
    const ROLE_BANNED = 'banned';
    public $verifyCode;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, role', 'required'),
			
			array('username, role, password', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, password, role, checked', 'safe', 'on'=>'search'),
                        array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(), 'on'=>'registration'),
		);
	}
         public function primaryKey()
	{
		return 'id';
		
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
			'username' => "Ім'я",
			'password' => 'Пароль',
			'role' => 'Роль',
                        'checked'=>'Підтверджений',
                        'verifyCode'=>'Код с зображення'
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('role',$this->role);
                $criteria->compare('checked',$this->checked);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        //перед записом в БД поствимо відмітку, що користувач не перевірений
        public function beforeSave(){
            if($this->isNewRecord){
                $this->checked=0;
            }
            return parent::beforeSave();
        }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        //Створюємо своє меню
        public static function menu($position, $type){
            
            $menu_arr = array(); 
             if ($position=="right"){
                 if($type=='order'){
                //Виводимо для кожного користувача своє меню
                    if (Yii::app()->user->checkAccess('storage')){
                        $menu_arr[] = array('label'=>'Журнал активних замовлень ('.count(Order::model()->findAll()).')', 'url'=>array('//storage/done/order'),'linkOptions'=>array('class'=>'collection-item'));
                                             
                    }
                  
                    if (Yii::app()->user->checkAccess('manufactory')){
                        $menu_arr[] = array('label'=>'Зробити замовлення для виготовлення продукції', 'url'=>array('/order/create'),'linkOptions'=>array('class'=>'collection-item'));
                        $menu_arr[] = array('label'=>'Журнал активних замовлень', 'url'=>array('/order/index'),'linkOptions'=>array('class'=>'collection-item'), 'visible'=>!Yii::app()->user->checkAccess('admin'));
                    }
                    
                    $menu_arr[] = array('label'=>'Стан виробництва продукції', 'url'=>array('/archiveproduct/admin'),'linkOptions'=>array('class'=>'collection-item'));
                 }
                    
                 
                 if($type=='resource'){
                //Виводимо для кожного користувача своє меню
                    if (Yii::app()->user->checkAccess('storage')){
                          
                        $menu_arr[] = array('label'=>'Склад матеріалів', 'url'=>array('//storage/resource/index'),'linkOptions'=>array('class'=>'collection-item'));
                        $menu_arr[] = array('label'=>'Додати новий матеріал', 'url'=>array('//storage/resource/create'),'linkOptions'=>array('class'=>'collection-item')); 
                        $menu_arr[] = array('label'=>'Нова поставка існуючого матеріалу', 'url'=>array('//storage/archiver/create'),'linkOptions'=>array('class'=>'collection-item'));                       
                        
                        
	
                        
                         
                    }
                 }
                
                
                if($type=='product'){
                if(Yii::app()->user->checkAccess('manufactory')){
                    $menu_arr[] = array('label'=>'Номенклатура продукцї', 'url'=>array('//manufactory/product/index'),'linkOptions'=>array('class'=>'collection-item'));
                    $menu_arr[] = array('label'=>'Створити новий продукт', 'url'=>array('//manufactory/product/create'),'linkOptions'=>array('class'=>'collection-item'));
                    
                    
                
                }
                
                }
                
                
            
            }
            return $menu_arr; 
        }
        //меню архів
        public static function menu_archive($position){
            
                $menu_arr = array();
            if ($position == "right") {
                $menu_arr[] = array('label' => 'Облік надходження матеріалів', 'url' => array('//storage/archiveR/admin'),'linkOptions'=>array('class'=>'collection-item'));
                $menu_arr[] = array('label' => 'Готова продукція та використані матеріальні ресурси', 'url' => array('//storage/done/index'),'linkOptions'=>array('class'=>'collection-item'));
                $menu_arr[] = array('label' => 'Використані матеріали', 'url' => array('//storage/done/admin'),'linkOptions'=>array('class'=>'collection-item'));
                $menu_arr[] = array('label' => 'Створена продукція', 'url' => array('//archiveproduct/made'),'linkOptions'=>array('class'=>'collection-item'));
                
                
            }

            return $menu_arr; 
        }
        //для адміна додаємо додаткове меню
        public static function menu_admin($position){
            
            $menu_arr = array();        
             if ($position=="right"){           
                     $menu_arr[] = array('label'=>'Журнал користувачів', 'url'=>array('//admin/user'),'linkOptions'=>array('class'=>'collection-item'));  
                    $menu_arr[] = array('label'=>'Створити користувача', 'url'=>array('//admin/user/create'),'linkOptions'=>array('class'=>'collection-item')); 
             }
         
            return $menu_arr; 
        }
}
