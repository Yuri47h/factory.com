<h1>Активні замовлення</h1>

<?php $this->widget('zii.widgets.MyCListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_vieworder',
)); ?>
