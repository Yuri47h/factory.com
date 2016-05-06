<?php

class ResourceController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/mycolumn'; //Підключаємо своє меню

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
				'actions'=>array('index','view', 'create', 'update', 'delete'),
				'roles'=>array('storage','admin'),
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
	public function actionCreate()
	{
		$model=new Resource;
                $archive=new ArchiveR;

		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);

		if(isset($_POST['Resource']))
		{
                    $model->attributes=$_POST['Resource'];
                    
                    //перевірка чи існує ресурс с таким кодом, якщо так виводить флеш повідомлення
                    if(Resource::model()->findByPk($_POST['Resource']['kod_r'])){
                        Yii::app()->user->setFlash('resource_is','Ресурс с таким кодом вже є, будь ласка змініть код ресурсу');
                    } 
                    else if($model->save()){       
                            // якщо задається кількість то записується в ArchiveR
                            if ($_POST['Resource']['quantity']!=''){
                                $archive->attributes=$_POST['Resource'];
                                $archive->quantity=$_POST['Resource']['quantity'];
                                $archive->total = $model->price*$archive->quantity;
                               
                                if($archive->save()){
                                    $this->redirect(array('index'));
                                    
                                }
                            } else {
                                $this->redirect(array('index'));

                            }
                        }
		}

		$this->render('create',array(
			'model'=>$model,
			'archive'=>$archive,
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

		if(isset($_POST['Resource']))
		{
			$model->attributes=$_POST['Resource'];
			if($model->save())
				$this->redirect(array('view','id'=>$this->model->id));
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
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model=new Resource('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Resource']))
			$model->attributes=$_GET['Resource'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Resource the loaded model
	 * @throws CHttpException
	 */
	public static function loadModel($id)
	{
		$model=Resource::model()->findByPk(array($id));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Resource $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='resource-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
