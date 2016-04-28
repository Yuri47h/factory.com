<?php
/* @var $this ResourceController */
/* @var $model Resource */

$this->breadcrumbs=array(
	'Resources'=>array('index'),
	'Manage',
);

$this->menu=array(

	array('label'=>'Додати ресурс', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#resource-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Журнал ресурсів</h1>


<?php echo CHtml::link('Розширений пошук','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'resource-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		
		'kod_r',
		'name',
		'price',
		'created' => array(
                    'name'=>'created',
                    'value'=>'date("j.m.Y. H:i", $data->created)',
                    'filter'=>FALSE,
                    'headerHtmlOptions' => array('width' => '100')
                    ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
