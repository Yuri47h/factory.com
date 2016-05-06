<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/registration.css">

<?php if(Yii::app()->user->hasFlash('registration')): ?>


<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('registration'); ?>
</div>

<?php else: ?>








<div class="materialContainer">
    <div class="box">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'user-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>
    <div class="title">Поля з <span class="required">*</span> є обов'язковими.</div>

    <?php echo $form->errorSummary($model ); ?>
    
    

    <div class="input">
        <?php echo $form->labelEx($model,'username'); ?>
        <?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>255,)); ?>
        <?php echo $form->error($model,'username'); ?>
        
         <span class="spin"></span>
    </div>

    <div class="input">
        <?php echo $form->labelEx($model,'password'); ?>
        <?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'password'); ?>
        
         <span class="spin"></span>
    </div>

    <div class="input" id='select'>
        <?php echo $form->labelEx($model,'role'); ?>
        <?php echo $form->dropDownList($model,'role',array(
            'manufactory'=>'Менеджер цеху',
            'storage'=>'Менеджер складу',
            'admin'=>'Адміністратор',
            ),
                array('empty'=>'Виберіть вашу посаду',)); ?>
        
        <?php echo $form->error($model,'role'); ?>
    </div>


	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<div>
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model,'verifyCode'); ?>
		</div>
		<div class="hint">Введіть код із зображення</div>
		<?php echo $form->error($model,'verifyCode'); ?>
	</div>
	<?php endif; ?>
   

        <div class="buttons">
		<?php echo CHtml::submitButton('Зареєструватися'); ?>
	</div>

<?php $this->endWidget(); ?>
    </div>
    

</div><!-- form -->
<?php endif; ?>