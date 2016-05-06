<?php
/* @var $this OrderController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Замовлення',
);


?>

<h1>Замовлення</h1>

<?php $this->widget('zii.widgets.MyCListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_vieworder',
)); ?>
