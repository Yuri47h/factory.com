<?php
/* @var $this ResourceController */
/* @var $model Resource */

$this->breadcrumbs=array(
	'Resources'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Журнал ресурсів', 'url'=>array('index')),
	array('label'=>'Додати ресурс', 'url'=>array('create')),
	array('label'=>'Update Resource', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Resource', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Resource', 'url'=>array('admin')),
);
?>

<h1>View Resource #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'kod_r',
		'name',
		'price',
	),
)); ?>
