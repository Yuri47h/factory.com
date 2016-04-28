<?php
/* @var $this ArchiveRController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Archive Rs',
);

$this->menu=array(
	array('label'=>'Create ArchiveR', 'url'=>array('create')),
	array('label'=>'Manage ArchiveR', 'url'=>array('admin')),
);
?>

<h1>Archive Rs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
