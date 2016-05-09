

<h1>Виконані замовлення</h1>

<?php $this->widget('zii.widgets.DoneCListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
