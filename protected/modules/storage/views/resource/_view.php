<?php
/* @var $this ResourceController */
/* @var $data Resource */
?>

<div class="view">

	

	<b><?php echo CHtml::encode($data->getAttributeLabel('kod_r')); ?>:</b>
	<?php echo CHtml::encode($data->kod_r); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('quantity')); ?>:</b>
	<?php echo CHtml::encode($data->quantity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode($data->price); ?>
	<br />


</div>