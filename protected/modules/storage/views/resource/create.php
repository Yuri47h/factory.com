
<?php if(Yii::app()->user->hasFlash('resource_is')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('resource_is'); ?>
</div>
<h1>Створити ресурс</h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'archive'=>$archive)); ?>
<?php else: ?>

<h1>Створити ресурс</h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'archive'=>$archive)); ?>
<?php endif; ?>