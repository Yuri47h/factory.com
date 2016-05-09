<?php


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#archive-r-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Журнал надходжень матеріалів</h1>

<?php echo CHtml::link('Розширений пошук','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'archive-r-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'kod_r'=>array(
                    'name'=>'kod_r',
                    'value'=>'$data->resource->name',
                ),
		'quantity'=>array(
                    'name'=>'quantity',
                    'value'=>'$data->quantity." шт."',
                ),
		'total'=>array(
                    'name'=>'total',
                    'value'=>'$data->total." грн"',
                ),
		'date' => array(
                    'name' => 'date',
                    'value' => 'date("j.m.Y H:i", $data->date)',
                    'filter' => FALSE,
                    'headerHtmlOptions' => array('width' => '200'),
                ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
