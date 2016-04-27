<?php
/* @var $this DoneController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Dones',
);

$this->menu=array(
	array('label'=>'Create Done', 'url'=>array('create')),
	array('label'=>'Manage Done', 'url'=>array('admin')),
);
?>

<h1>Dones</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
