<?php
/* @var $this ArchiveproductController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Archiveproducts',
);

$this->menu=array(
	array('label'=>'Create Archiveproduct', 'url'=>array('create')),
	array('label'=>'Manage Archiveproduct', 'url'=>array('admin')),
);
?>

<h1>Archiveproducts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
