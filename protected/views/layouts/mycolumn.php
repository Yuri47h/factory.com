<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/users'); ?>
<div class="span-19">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="span-5 last">
	<div id="sidebar">
	<?php
            if(Yii::app()->user->checkAccess('admin')){
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Операції з корстувачами',
		));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>  User::menu_admin('right'),
			'htmlOptions'=>array('class'=>'operations'),
		));
		$this->endWidget();
            }
                $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Виробництво',
		));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>  User::menu('right', 'order'),
			'htmlOptions'=>array('class'=>'operations'),
		));
		$this->endWidget();
                
                
                
                $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Операції з матеріалами',
		));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>  User::menu('right','resource'),
			'htmlOptions'=>array('class'=>'operations'),
		));
		$this->endWidget();
                
                
                
                $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Операції з продукцією',
		));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>  User::menu('right', 'product'),
			'htmlOptions'=>array('class'=>'operations'),
		));
		$this->endWidget();
            
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Архів',
		));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>  User::menu_archive('right'),
			'htmlOptions'=>array('class'=>'operations'),
		));
		$this->endWidget();
            
	?>
	</div><!-- sidebar -->
</div>
<?php $this->endContent(); ?><?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

