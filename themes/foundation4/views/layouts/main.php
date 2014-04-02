<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->

<head>
	<meta charset="utf-8" />
	<meta name="language" content="en" />
	<meta name="viewport" content="width=device-width" />
  
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/foundation.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/custom.css" />
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/vendor/modernizr.js"></script>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
	<div class="">
	<nav class="top-bar" data-topbar>
		<ul class="title-area">
			<li class="name">
				<h1><a href="index.php">网络技术团队</a></h1>
			</li>
    <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
			<li class="toggle-topbar menu-icon"><a href="#"><span>导航</span></a></li>
		</ul>

		<section class="top-bar-section">
<?php $this->widget('zii.widgets.CMenu',array(
	'htmlOptions'=>array('class'=>''),
	'items'=>array(
		array('label'=>'团队介绍','url'=>array('site/about')),
        array('label'=>'科研','url'=>array('#/research'),
            'items'=>array(
                array('label'=>'研究方向', 'url'=>array('#/research/interest')),
                array('label'=>'科研项目', 'url'=>array('#/research/project')),
            ),
            'itemOptions'=>array('class'=>'has-dropdown'),
             'submenuOptions'=>array('class'=>'dropdown'),
        ),	
		array('label'=>'学术成果','url'=>array('#/achievement'),
			//'htmlOptions'=>array('class'=>''),
			'itemOptions'=>array('class'=>'has-dropdown'), 
			'submenuOptions'=>array('class'=>'dropdown'),
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
            'itemOptions'=>array('class'=>'has-dropdown'),
            'submenuOptions'=>array('class'=>'dropdown'),
        ),
        array('label'=>'教学','url'=>array('#/teaching'),
            'items'=>array(
                array('label'=>'教学课程', 'url'=>array('#/course')),
                array('label'=>'实验建设', 'url'=>array('#/experiment')),
                array('label'=>'教研成果', 'url'=>array('#/publication')),
            ),
            'itemOptions'=>array('class'=>'has-dropdown'),
            'submenuOptions'=>array('class'=>'dropdown'),
        ),
	),
)); 

$this->widget('zii.widget.CMenu',array(
	'htmlOptions' => array('class'=>'right'),
	'items' => array(
		array('label'=>'管理', 
			'visible'=>(isset($this->menu) && !Yii::app()->user->isGuest),
			'url'=>array('#'), 
			'itemOptions'=>array('class'=>'has-dropdown not-click'), 
			'submenuOptions'=>array('class'=>'dropdown'),
			'items'=>$this->menu,
		),
		array('label'=>'登录',
			'url'=>array('/site/login'),
			'visible'=>Yii::app()->user->isGuest,
			'itemOptions'=>array('class'=>''), 
		),
		array('label'=>'登出 ('.Yii::app()->user->name.')', 
			'url'=>array('/site/logout'), 
			'visible'=>!Yii::app()->user->isGuest,
			'itemOptions'=>array('class'=>''), 
		), 
	)
	));

?>


		</section>
	</nav>
	</div>
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
			'separator'=>'',
		)); ?>
	<?php endif?>

	<?php echo $content;?>

	<div class="footer-top bg-fblue">
	  <div class="row property">
	    <div class="medium-4 columns">
	      <div class="property-info">
	        <h3>网络技术团队</h3>
	        <p>网络技术团队自上世纪80年代中期开始从事计算机网络、无线网络领域的研究工作，是国内开展无线网络技术研究的先行者之一。
	        </p>
	      </div>
	    </div>
	    
	     <div class="medium-4 columns">
	          <div class="learn-links">
	            <h3 class="">研究方向</h4>
	            <ul>
	              <li><a href="#">网络体系结构与协议</a></li>
	              <li><a href="#">无线自组织网络</a></li>
	              <li><a href="#">无线传感网(WSN)与物联网</a></li>
	              <li><a href="#">宽带无线移动网络技术</a></li>
	              <li><a href="#">无线网络新技术</a></li>
	            </ul>
	          </div>
	      </div>

	      <div class="medium-4 columns">
	          <div class="connect-links">
	            <h3 class="">联系我们</h4>
	            <p>成都市高新区（西区）西源大道2006号电子科技大学清水河校区科研楼B区 邮编：611731</p>
	            <a href="#" class="small button">Stay Connected</a>
	          </div>
	      </div>

	  </div>
	</div>


	
	<div class="small-12 columns" id="footer">
		<div class="row">
			<p class="copyright">Copyright &copy; <?php echo date('Y'); ?> by NTRG, UESTC.<br/>
			All Rights Reserved.<br/>
			<?php echo Yii::powered(); ?>
		</div>
	</div>

	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/vendor/zepto.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/vendor/zepto.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/vendor/jquery.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/foundation.min.js"></script>
	<!--
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/foundation/foundation.alerts.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/foundation/foundation.clearing.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/foundation/foundation.cookie.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/foundation/foundation.forms.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/foundation/foundation.interchange.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/foundation/foundation.joyride.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/foundation/foundation.magellan.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/foundation/foundation.orbit.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/foundation/foundation.placeholder.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/foundation/foundation.reveal.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/foundation/foundation.section.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/foundation/foundation.tooltips.js"></script>
	-->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/foundation/foundation.dropdown.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/foundation/foundation.topbar.js"></script>
	<script>
		$(document).foundation();
		if (!("ontouchstart" in document.documentElement)) {
    		document.documentElement.className += " no-touch";
		}
	</script>
</body>
</html>
