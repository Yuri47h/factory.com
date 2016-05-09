<?php


$this->menu=array(
	array('label'=>'Журнал користувачів', 'url'=>array('index')),
	
);
?>

<h1>Створити користувача</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>