<?php
/* @var $this ProjectController */
/* @var $model Project */
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
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'number'); ?>
		<?php echo $form->textField($model,'number',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fund_number'); ?>
		<?php echo $form->textField($model,'fund_number',array('size'=>60,'maxlength'=>255)); ?>
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

	<div class="row">
		<?php echo $form->label($model,'is_enterprise'); ?>
		<?php echo $form->textField($model,'is_enterprise'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_NSF'); ?>
		<?php echo $form->textField($model,'is_NSF'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_973'); ?>
		<?php echo $form->textField($model,'is_973'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_863'); ?>
		<?php echo $form->textField($model,'is_863'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_NKTRD'); ?>
		<?php echo $form->textField($model,'is_NKTRD'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_DFME'); ?>
		<?php echo $form->textField($model,'is_DFME'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_major'); ?>
		<?php echo $form->textField($model,'is_major'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'start_date'); ?>
		<?php echo $form->textField($model,'start_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'deadline_date'); ?>
		<?php echo $form->textField($model,'deadline_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'conclude_date'); ?>
		<?php echo $form->textField($model,'conclude_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'app_date'); ?>
		<?php echo $form->textField($model,'app_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pass_date'); ?>
		<?php echo $form->textField($model,'pass_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'app_fund'); ?>
		<?php echo $form->textField($model,'app_fund',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pass_fund'); ?>
		<?php echo $form->textField($model,'pass_fund',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->