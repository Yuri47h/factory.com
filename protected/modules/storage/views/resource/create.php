<?php
/* @var $this ResourceController */
/* @var $model Resource */

$this->breadcrumbs=array(
	'Resources'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Журнал ресурсів', 'url'=>array('index')),
	
);
?>

<h1>Create Resource</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>