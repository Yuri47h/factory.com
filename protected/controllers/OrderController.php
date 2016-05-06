<?php

class OrderController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/mycolumn';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
                return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','create', 'update','cancelorder'),
				'roles'=>array('manufactory'),
			),
                        array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view', ),
				'roles'=>array('storage'),
			),
                    
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
        
        
        // Дописуєм actionCreate для того щоб за необхідним продуктом робилося замовлення на ресурси
            public function actionCreate() {
                $model = new Order;
                $product = new Archiveproduct; //створюємо модель для добавлення в Архів замовлень

                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

                if (isset($_POST['Order'])) {
                    
                    
                    $product->attributes =$_POST['Order'];
                    $product->cost = Product::costProduct($product->kod_p)*$product->quantity;
                   
                    $product->save();
                    
                    
                    //повертаємо всі необхідні ресусри та кожен ресурс зберігаємо
                    foreach (Relation::resourcesByKod_p($_POST['Order']['kod_p']) as $one) {
                        
                        $model->kod_p = $_POST['Order']['kod_p'];
                        $model->kod_r = $one->kod_r;
                        $model->order_id = $product->id;
                        //Вираховуємо необхідну кількість ресурсів
                        $model->quantity = $one->quantity*$_POST['Order']['quantity'];
                        $model->cost = $model->quantity*Resource::price($model->kod_r);
                        $model->save();
                
                       
                     
                        $model = new Order;
                    };
                   
                            
                
                   $this->redirect(array('view', 'id' => $model->id));
                }

                $this->render('create', array(
                    'model' => $model,
                ));
            }

            /**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Order']))
		{
			$model->attributes=$_POST['Order'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		
                if(isset($_POST)){
                    
                    
                            if(Order::model()->deleteAllByAttributes(array('order_id'=>key($_POST)))){
                                Archiveproduct::model()->deleteByPk(key($_POST));                     
                                
                                
                            }  
                        
                } 
                $dataProvider=new CActiveDataProvider('Order');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
               
	}

	/**
	 * Manages all models.
	 */
	

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Order the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Order::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Order $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='order-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
       
}
