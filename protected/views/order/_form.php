<?php
/* @var $this OrderController */
/* @var $model Order */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'order-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля з <span class="required">*</span> є обов'язковими.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		
                <?php 
                //Якщо зміна замовлення то унеможливлює зміну продукту, тільки зміна кількості
                    if(isset($model->id)){
                        echo $form->label($model,'kod_p');
                        echo $form->dropDownList($model,'kod_p',  Product::allProduct(), array('disabled'=>"disabled"));
                    }
                    else {
                        echo $form->label($model,'kod_p');
                        echo $form->dropDownList($model,'kod_p',  Product::allProduct(), array('empty'=>'Виберіть продукт'));
                    } ?>
		<?php echo $form->error($model,'kod_p'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'quantity'); ?>
		<?php echo $form->textField($model,'quantity'); ?>
		<?php echo $form->error($model,'quantity'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Надіслати запит' : 'Зберегти'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->