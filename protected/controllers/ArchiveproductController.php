<?php

class ArchiveproductController extends Controller
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
				'actions'=>array('index', 'admin','made'),
				'roles'=>array('storage', 'manufactory'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Archiveproduct');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Archiveproduct('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Archiveproduct']))
			$model->attributes=$_GET['Archiveproduct'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
        
        public function actionMade(){
            $model=new Archiveproduct('searchMade');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Archiveproduct']))
			$model->attributes=$_GET['Archiveproduct'];

		$this->render('madeproduct',array(
			'model'=>$model,
		));
            
        }

        /**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Archiveproduct the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Archiveproduct::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Archiveproduct $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='archiveproduct-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
