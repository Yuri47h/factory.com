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
        <!-- Material Design Icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

        <!-- Bootstrap core CSS -->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css" rel="stylesheet">

        <!-- Material Design Bootstrap -->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/mdb.css" rel="stylesheet">

        <!-- Template style -->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet">
        

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<?php //Присвоюємо id ?>
<body id="<?php echo Yii::app()->controller->action->id ?>" >

<div  id="page">
    <div class="navbar z-depth-2 info-color">
	<div id="header" >
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="container ">
		<?php $this->widget('zii.widgets.CMenu',array(
                    'htmlOptions' => array(
                    'class'=>'nav navbar-nav',
                        ),
			'items'=>array(
				array('label'=>'Головна', 'url'=>array('/site/index')),
				array('label'=>'Додаткова сторінка', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Контакти', 'url'=>array('/site/contact')),
                                array('label'=>'Адмінка', 'url'=>array('/admin'),'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Ввійти', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Вийти ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                                array('label'=>'Реєстрація', 'url'=>array('/site/registration'), 'visible'=>Yii::app()->user->isGuest),
			),
		)); ?>
	</div><!-- mainmenu -->
        </div>
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		&copy; <?php echo date('Y'); ?> by Yuri Hayduchyk.<br/>
		Всі права захищені.<br/>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
