<?php
/* @var $this ProjectTeachingController */
/* @var $model ProjectTeaching */
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
		<?php echo $form->label($model,'is_intl'); ?>
		<?php echo $form->textField($model,'is_intl'); ?>
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
		<?php echo $form->label($model,'is_quality'); ?>
		<?php echo $form->textField($model,'is_quality'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_reform'); ?>
		<?php echo $form->textField($model,'is_reform'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_lab'); ?>
		<?php echo $form->textField($model,'is_lab'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_new_lab'); ?>
		<?php echo $form->textField($model,'is_new_lab'); ?>
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
		<?php echo $form->label($model,'fund'); ?>
		<?php echo $form->textField($model,'fund',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'should_display'); ?>
		<?php echo $form->textField($model,'should_display'); ?>
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