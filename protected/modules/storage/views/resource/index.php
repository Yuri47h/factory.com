<?php


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
                'price'=>array(
                    'name'=>'price',
                    'value'=>'$data->price." грн"',
                ),
                'quantity'=>array(
                    'name'=>'quantity',
                    'value'=>'$data->quantity." шт."',
                ),
		
		array(
			'class'=>'CButtonColumn',
                    'headerHtmlOptions' => array('width' => '100'),
                    
		),
	),
)); ?>
