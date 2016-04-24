<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Журнал користувачів', 'url'=>array('index')),
	array('label'=>'Створити користувача', 'url'=>array('create')),
	array('label'=>'Перегляд користувача', 'url'=>array('view', 'id'=>$model->id)),

);
?>

<h1>Оновити коритсувача <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>