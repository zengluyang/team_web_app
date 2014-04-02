<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>
<ul data-orbit data-options="timer_speed:5000;
pause_on_hover=false;
slide_number=false;">
  <li>
	<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/earth.jpg" alt="slide 1" />
	<div class="orbit-caption">
	  Caption One.
	</div>
  </li>
  <li>
	<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/space.jpg" alt="slide 2" />
	<div class="orbit-caption">
	  Caption Two.
	</div>
  </li>
  <li>
	<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/comet.jpg" alt="slide 3" />
	<div class="orbit-caption">
	  Caption Three.
	</div>
  </li>
</ul>




<p>Congratulations! You have successfully created your Yii application.</p>

<p>You may change the content of this page by modifying the following two files:</p>
<ul>
<!-- 	<li>View file: <code><?php echo __FILE__; ?></code></li>
	<li>Layout file: <code><?php echo $this->getLayoutFile('main'); ?></code></li> -->
</ul>

<p>For more details on how to further develop this application, please read
the <a href="http://www.yiiframework.com/doc/">documentation</a>.
Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,
should you have any questions.</p>

