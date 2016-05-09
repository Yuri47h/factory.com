<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection">
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">
        
        <!-- Bootstrap core CSS -->
        <link href="/css/bootstrap.min.css" rel="stylesheet">

        <!-- Material Design Bootstrap -->
        <link href="/css/mdb.css" rel="stylesheet">

        <!-- Template style -->
        <link href="/css/style.css" rel="stylesheet">
        <link href="/css/hover.css" rel="stylesheet">
        

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<?php //Присвоюємо id ?>
<body id="<?php echo Yii::app()->controller->action->id?>"  class="<?php echo Yii::app()->controller->id.'_'.Yii::app()->controller->action->id?>" >

<div  id="page">
    <div class="navbar z-depth-2 info-color">
	<div id="header" >
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div class="container ">
		<?php $this->widget('zii.widgets.CMenu',array(
                     'htmlOptions' => array(
                    'class'=>'nav navbar-nav',
                        ),
			'items'=>array(
				array('label'=>'Головна', 'url'=>array('/site/index'),'linkOptions'=>array('class'=>'box-shadow-outset'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>"Зворотній зв'язок", 'url'=>array('/site/contact'),'linkOptions'=>array('class'=>'box-shadow-outset')),
                                array('label'=>'Адміністрування', 'url'=>array('/admin'),'linkOptions'=>array('class'=>'box-shadow-outset'),'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Ввійти', 'url'=>array('/site/login'),'linkOptions'=>array('class'=>'box-shadow-outset'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Вийти ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'),'linkOptions'=>array('class'=>'box-shadow-outset'), 'visible'=>!Yii::app()->user->isGuest),
                                array('label'=>'Реєстрація', 'url'=>array('/site/registration'),'linkOptions'=>array('class'=>'box-shadow-outset'), 'visible'=>Yii::app()->user->isGuest),
			),
		)); ?>
	</div><!-- mainmenu -->
	</div><!-- mainmenu -->
	
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>
                
       
	<?php echo $content; ?>
      
	<div class="clear"></div>

	

</div><!-- page -->
<div id="footer" class="footer-copyright page-footer info-color darken-1">
		&copy; <?php echo date('Y'); ?> by Yuri Hayduchyk.<br/>
		Всі права захищені.<br/>
	</div><!-- footer -->

</body>
</html>
