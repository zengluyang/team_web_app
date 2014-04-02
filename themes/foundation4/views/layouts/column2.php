<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row">
	
	<div class="small-12 columns" id="content">
		<?php echo $content; ?>
	</div>
	
	<!-- <div class="small-3 columns" id="sidebar">
		<?php
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'Operations',
			));
			$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->menu,
				'htmlOptions'=>array('class'=>'operations'),
			));
			$this->endWidget();
		?>
	</div> --><!-- sidebar -->

</div>
<?php $this->endContent(); ?>
