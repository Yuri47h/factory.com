<?php
/* @var $this OrderController */
/* @var $model Order */

$this->breadcrumbs=array(
	'Замовлення'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Order', 'url'=>array('index')),
	array('label'=>'Create Order', 'url'=>array('create')),
	array('label'=>'Update Order', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Order', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Order', 'url'=>array('admin')),
);
?>

<h1>Перегляд замовлення #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'kod_p',
		'quantity',
		'date' => array(
                    'name' => 'date',
                    'value' => date("j.m.Y H:i", $model->date),  
                ),
	),
)); ?>
