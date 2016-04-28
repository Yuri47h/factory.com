<?php
/* @var $this ResourceController */
/* @var $model Resource */

$this->breadcrumbs=array(
	'Resources'=>array('index'),
	'Create',
);
?>

<h1>Створити ресурс</h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'archive'=>$archive)); ?>