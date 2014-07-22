<?php
/* @var $this PublicationController */
/* @var $model Publication */
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
		<?php echo $form->label($model,'press'); ?>
		<?php echo $form->textField($model,'press',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pub_date'); ?>
		<?php echo $form->textField($model,'pub_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_textbook'); ?>
		<?php echo $form->textField($model,'is_textbook'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_pub'); ?>
		<?php echo $form->textField($model,'is_pub'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'isbn_number'); ?>
		<?php echo $form->textField($model,'isbn_number',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->