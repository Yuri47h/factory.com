<?php
/* @var $this OrderController */
/* @var $data Order */
?>


<?php echo CHtml::form();?>

<div class="view">

	

	<b><?php echo CHtml::encode($data->getAttributeLabel('kod_r')); ?>:</b>
	<?php echo  CHtml::link(CHtml::encode($data->resource->name), array('//storage/resource/view/','id'=>$data->kod_r)); ?>
       
        
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('quantity')); ?>:</b>
	<?php echo CHtml::encode($data->quantity); ?>
        
	<br />
        <b><?php echo CHtml::encode($data->getAttributeLabel('cost')); ?>:</b>
	<?php echo CHtml::encode($data->cost .' грн'); ?>
	<br />
        
        <b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode(date("j.m.Y. H:i", $data->date)); ?>
	<br />
            
        
        
        <?php
        if (Order::possibility($data->kod_r, $data->quantity) == FALSE) {
            echo "Замовлення не може бути виконане, тому що не вистачає ресурсів.";
        } else {
            echo Done::actionCompleted($data);
        }
        ?>
    
          
          

</div>


<?php echo CHtml::endForm();?>

