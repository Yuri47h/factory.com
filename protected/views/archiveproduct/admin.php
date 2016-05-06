<?php
/* @var $this ArchiveproductController */
/* @var $model Archiveproduct */

$this->breadcrumbs=array(
	'Archiveproducts'=>array('index'),
	'Manage',
);

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

<h1>Manage Archiveproducts</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'archiveproduct-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
                'kod_p'=>array(
                    'name'=>'kod_p',
                    'value'=>'$data->product->name',
                ),
		'quantity',
		'cost',
		'status',
                'date' => array(
                    'name' => 'date',
                    'value' => 'date("j.m.Y H:i", $data->date)',
                    'filter' => FALSE,
                    'headerHtmlOptions' => array('width' => '100'),
                ),
	),
)); ?>
