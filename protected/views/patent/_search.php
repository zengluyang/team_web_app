<?php
/* @var $this PatentController */
/* @var $model Patent */
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
		<?php echo $form->label($model,'app_date'); ?>
		<?php echo $form->textField($model,'app_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'app_number'); ?>
		<?php echo $form->textField($model,'app_number',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'auth_number'); ?>
		<?php echo $form->textField($model,'auth_number',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'auth_date'); ?>
		<?php echo $form->textField($model,'auth_date'); ?>
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
		<?php echo $form->label($model,'abstract'); ?>
		<?php echo $form->textArea($model,'abstract',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->