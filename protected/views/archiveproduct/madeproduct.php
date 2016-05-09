<?php


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#archiveproduct-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Список виготовленої продукції</h1>

<?php echo CHtml::link('Розширений пошук','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'archiveproduct-grid',
	'dataProvider'=>$model->searchMade(),
	'filter'=>$model,
	'columns'=>array(
                'kod_p'=>array(
                    'name'=>'kod_p',
                    'value'=>'$data->product->name',
                ),
		'quantity'=>array(
                    'name'=>'quantity',
                    'value'=>'$data->quantity." шт."',
                ),
		'cost'=>array(
                    'name'=>'cost',
                    'value'=>'$data->cost." грн"',
                ),
                'date' => array(
                    'name' => 'date',
                    'value' => 'date("j.m.Y H:m", $data->date)',
                    'filter' => FALSE,
                    'headerHtmlOptions' => array('width' => '200'),
                ),
	),
)); ?>
