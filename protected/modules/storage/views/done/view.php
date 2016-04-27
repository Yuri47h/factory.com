<?php
/* @var $this DoneController */
/* @var $model Done */

$this->breadcrumbs=array(
	'Dones'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Done', 'url'=>array('index')),
	array('label'=>'Create Done', 'url'=>array('create')),
	array('label'=>'Update Done', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Done', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Done', 'url'=>array('admin')),
);
?>

<h1>View Done #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'kod_p',
		'quantity',
		'costs',
		'date',
	),
)); ?>
