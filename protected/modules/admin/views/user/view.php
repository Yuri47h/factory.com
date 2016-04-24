<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Журнал користувачів', 'url'=>array('index')),
	array('label'=>'Створити користувача', 'url'=>array('create')),
	
	array('label'=>'Оновити користувача', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Видалити користувача', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	
);
?>

<h1>Перегляд користувача #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'password',
		'role',
	),
)); ?>
