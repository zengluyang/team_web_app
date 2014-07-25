<?php
/* @var $this PaperTeachingController */
/* @var $model PaperTeaching */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'info'); ?>
		<?php echo $form->textField($model,'info',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pass_date'); ?>
		<?php echo $form->textField($model,'pass_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pub_date'); ?>
		<?php echo $form->textField($model,'pub_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'index_date'); ?>
		<?php echo $form->textField($model,'index_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sci_number'); ?>
		<?php echo $form->textField($model,'sci_number',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ei_number'); ?>
		<?php echo $form->textField($model,'ei_number',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'istp_number'); ?>
		<?php echo $form->textField($model,'istp_number',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_first_grade'); ?>
		<?php echo $form->textField($model,'is_first_grade'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_core'); ?>
		<?php echo $form->textField($model,'is_core'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'other_pub'); ?>
		<?php echo $form->textField($model,'other_pub',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_journal'); ?>
		<?php echo $form->textField($model,'is_journal'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_conference'); ?>
		<?php echo $form->textField($model,'is_conference'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_intl'); ?>
		<?php echo $form->textField($model,'is_intl'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_domestic'); ?>
		<?php echo $form->textField($model,'is_domestic'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'filename'); ?>
		<?php echo $form->textField($model,'filename',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_high_level'); ?>
		<?php echo $form->textField($model,'is_high_level'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'maintainer_id'); ?>
		<?php echo $form->textField($model,'maintainer_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->