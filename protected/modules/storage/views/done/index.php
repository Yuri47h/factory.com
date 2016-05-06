<?php
/* @var $this DoneController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Виконані замовлення',
);

$this->menu=array(
	array('label'=>'Create Done', 'url'=>array('create')),
	array('label'=>'Manage Done', 'url'=>array('admin')),
);
?>

<h1>Виконані замовлення</h1>

<?php $this->widget('zii.widgets.DoneCListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
