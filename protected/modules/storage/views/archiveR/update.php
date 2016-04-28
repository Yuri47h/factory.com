<?php
/* @var $this ArchiveRController */
/* @var $model ArchiveR */

$this->breadcrumbs=array(
	'Archive Rs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ArchiveR', 'url'=>array('index')),
	array('label'=>'Create ArchiveR', 'url'=>array('create')),
	array('label'=>'View ArchiveR', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ArchiveR', 'url'=>array('admin')),
);
?>

<h1>Update ArchiveR <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>