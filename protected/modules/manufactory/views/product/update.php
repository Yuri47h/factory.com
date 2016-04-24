<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->name=>array('view','id'=>$model->kod_p),
	'Update',
);

$this->menu=array(
	array('label'=>'Журнал продукцї', 'url'=>array('index')),
	array('label'=>'Створити продукт', 'url'=>array('create')),
	array('label'=>'Перегладя цього продукту', 'url'=>array('view', 'id'=>$model->kod_p)),
	
);
?>

<h1>Update Product <?php echo $model->kod_p; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'allResource'=>$allResource, 'modelRelation'=>$modelRelation,)); ?>