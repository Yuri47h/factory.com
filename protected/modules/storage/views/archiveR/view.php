<?php
/* @var $this ArchiveRController */
/* @var $model ArchiveR */

$this->breadcrumbs=array(
	'Журнал надходжень матеріалів'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ArchiveR', 'url'=>array('index')),
	array('label'=>'Create ArchiveR', 'url'=>array('create')),
	array('label'=>'Update ArchiveR', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ArchiveR', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ArchiveR', 'url'=>array('admin')),
);
?>

<h1>Перегляд ресурсу #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'kod_r',
		'quantity',
		'total',
		'date' => array(
                    'name' => 'date',
                    'value' => date("j.m.Y H:i", $model->date),  
                ),
	),
)); ?>
