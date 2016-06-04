<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Журнал продукцї', 'url'=>array('index')),
	array('label'=>'Створити продукт', 'url'=>array('create')),
	array('label'=>'Редагувати продукт', 'url'=>array('update', 'id'=>$model->kod_p)),
	array('label'=>'Видалити продукт', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->kod_p),'confirm'=>'Are you sure you want to delete this item?')),

);
?>

<h1>Перегляд продукту #<?php echo $model->kod_p; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'kod_p',
		'name',
                 array(               
            'label'=>'Ресурси',             
            'value'=>$model->findresource(),
            
            
             
        ),
	),
)); 

?>
