<?php
/* @var $this ArchiveRController */
/* @var $model ArchiveR */

$this->breadcrumbs=array(
	'Archive Rs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ArchiveR', 'url'=>array('index')),
	array('label'=>'Manage ArchiveR', 'url'=>array('admin')),
);
?>

<h1>Create ArchiveR</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>