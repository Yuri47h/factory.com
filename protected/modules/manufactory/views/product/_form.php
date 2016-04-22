<?php
/* @var $this ProductController */
/* @var $model Product */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'kod_p'); ?>
		<?php echo $form->textField($model,'kod_p'); ?>
		<?php echo $form->error($model,'kod_p'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
        <div class="row">
           <hr />
            <?php  $resource = CHtml::listData($allResoruce, 'kod_r','name'); ?>
            <?php echo $form->labelEx($modelResource,'name'); ?>
            <?php echo $form->dropDownList($modelResource,'kod_r',$resource); ?>
            <?php echo $form->error($modelResource,'name'); ?>
              
            <?php echo $form->labelEx($modelResource,'quantity'); ?>
            <?php echo $form->textField($modelResource,'quantity'); ?>
            <?php echo $form->error($modelResource,'quantity'); ?>
		
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->