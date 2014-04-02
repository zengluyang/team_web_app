<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
    <?php //Yii::app()->bootstrap->register(); ?>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'团队介绍', 'url'=>array('#/about')),
                array('label'=>'科研','url'=>array('#/research'),
                    'items'=>array(
                        array('label'=>'研究方向', 'url'=>array('#/research/interest')),
                        array('label'=>'科研项目', 'url'=>array('#/research/project')),
                    ),
                ),
                array('label'=>'学术成果','url'=>array('#/achievement'),
                    'items'=>array(
                        array('label'=>'论文', 'url'=>array('/paper')),
                        array('label'=>'专利', 'url'=>array('/patent')),
                        array('label'=>'专著', 'url'=>array('#/publication')),
                    ),
                ),
                array('label'=>'硕博培养','url'=>array('#/admission'),
                    'items'=>array(
                        array('label'=>'招生要求', 'url'=>array('#/requirement')),
                        array('label'=>'导师介绍', 'url'=>array('#/tutor')),
                        array('label'=>'素质拓展', 'url'=>array('#/extracurricular')),
                    ),
                ),
                array('label'=>'教学','url'=>array('#/teaching'),
                    'items'=>array(
                        array('label'=>'教学课程', 'url'=>array('#/course')),
                        array('label'=>'实验建设', 'url'=>array('#/experiment')),
                        array('label'=>'教研成果', 'url'=>array('#/publication')),
                    ),
                ),
                array('label'=>'People','url'=>array('/people'),
                ),
				array('label'=>'管理登录', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'管理退出 ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Powerd &copy; <?php echo date('Y'); ?> by zly.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
