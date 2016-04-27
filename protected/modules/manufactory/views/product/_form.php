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

	<?php echo $form->errorSummary(array($model)); ?>

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
           <!--якщо оновити перевіряємо чи передана модель $modelRelation, вона передається тільки у котроллері Update-->
           <?php $i=0;
                if(isset($modelRelation)){
               
               foreach ($modelRelation as $one){
                 
                $model->quantity=$one->quantity;
                $model->kod_r=$one->kod_r;
                
                echo $form->labelEx($model,'kod_r');
                $resource = CHtml::listData(Resource::model()->findAll(), 'kod_r','name');
                echo CHtml::dropDownList("resources[$i][kod_r]",$model->kod_r, $resource);
                        
                echo $form->labelEx($model,'quantity');
                echo CHtml::textField("resources[$i][quantity]",$model->quantity );
                echo CHtml::textField("resources[$i][bufer_kod_r]",$model->kod_r, array('style'=>'display:none'));
                echo CHtml::textField("resources[$i][bufer_kod_p]",$model->kod_p, array('style'=>'display:none'));

                $i++;
                echo "<hr>";
               }
               
            } else { 
                $i = 0;
                foreach (Resource::model()->findAll() as $one){
                echo '<div class="row_resource">';
                
                $resource = CHtml::listData(Resource::model()->findAll(), 'kod_r','name');
                
                echo $form->labelEx($model,'kod_r');
                echo $form->dropDownList($model,'kod_r',$resource, array('empty'=>'--Виберіть ресус--','name'=>'kod_r'.$i ));
                echo $form->error($model,'name');

                echo $form->labelEx($model,'quantity');
                echo $form->textField($model,'quantity', array("name"=>'quantity'.$i));
                echo $form->error($model,'quantity');
                echo '</div>';
                $i++;
           
                }} ?>
		
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->