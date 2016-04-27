<?php
/* @var $this DoneController */
/* @var $model Done */

$this->breadcrumbs=array(
	'Dones'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Done', 'url'=>array('index')),
	array('label'=>'Create Done', 'url'=>array('create')),
	array('label'=>'View Done', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Done', 'url'=>array('admin')),
);
?>

<h1>Update Done <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>