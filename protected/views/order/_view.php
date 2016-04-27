<?php
/* @var $this OrderController */
/* @var $data Order */
?>

<div class="view">

	

	<b><?php echo CHtml::encode($data->getAttributeLabel('kod_p')); ?>:</b>
	<?php echo  CHtml::link(CHtml::encode($data->product->name), array('//manufactory/product/view','id'=>$data->product->kod_p)); ?>
       
        
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('quantity')); ?>:</b>
	<?php echo CHtml::encode($data->quantity); ?>
	<br />
        <b><?php echo CHtml::encode('Собівартість ресурсів'); ?>:</b>
	<?php echo CHtml::encode((Order::costs($data->kod_p)*$data->quantity).' грн'); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode(date("j.m.Y H:m", $data->date)); ?>
	<br />


</div>