<?php
/* @var $this DoneController */
/* @var $model Done */

$this->breadcrumbs=array(
	'Dones'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Done', 'url'=>array('index')),
	array('label'=>'Manage Done', 'url'=>array('admin')),
);
?>

<h1>Create Done</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>