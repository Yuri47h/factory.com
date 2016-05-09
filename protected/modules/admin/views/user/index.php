<?php


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Журнал користувачів</h1>


<?php echo CHtml::link('Розширений пошук','#',array('class'=>'search-button')); ?>
<div class="search-form card-panel" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php 
    echo CHtml::form();
    echo CHtml::submitButton('Підтвердити',array('name'=>'checked'));
    echo CHtml::submitButton('Заблокувати',array('name'=>'block'));
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
        'selectableRows'=>2,
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
                array(
                    'class'=>'CCheckBoxColumn',
                    'id'=>'User_id'
                    ),
                'id',
		'username',
		'password',
		'role',
                'checked'=>array(
                    'name'=>'checked',
                    'value'=>'($data->checked == 0)? "Ні":"Так"',
                    'filter' => array(0=>'Ні', 1=>'Так'),
                ),
            
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

<?php echo CHtml::endForm();?>
