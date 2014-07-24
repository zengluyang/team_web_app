<?php
/* @var $this AwardTeachingController */
/* @var $model AwardTeaching */
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
		<?php echo $form->label($model,'project_name'); ?>
		<?php echo $form->textField($model,'project_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'award_name'); ?>
		<?php echo $form->textField($model,'award_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'award_date'); ?>
		<?php echo $form->textField($model,'award_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'org_from'); ?>
		<?php echo $form->textField($model,'org_from',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_intl'); ?>
		<?php echo $form->textField($model,'is_intl'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_national'); ?>
		<?php echo $form->textField($model,'is_national'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_provincial'); ?>
		<?php echo $form->textField($model,'is_provincial'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_city'); ?>
		<?php echo $form->textField($model,'is_city'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_school'); ?>
		<?php echo $form->textField($model,'is_school'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->