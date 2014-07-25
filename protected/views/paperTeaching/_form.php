<?php
/* @var $this PaperTeachingController */
/* @var $model PaperTeaching */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'paper-teaching-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'info'); ?>
		<?php echo $form->textField($model,'info',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'info'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pass_date'); ?>
		<?php echo $form->textField($model,'pass_date'); ?>
		<?php echo $form->error($model,'pass_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pub_date'); ?>
		<?php echo $form->textField($model,'pub_date'); ?>
		<?php echo $form->error($model,'pub_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'index_date'); ?>
		<?php echo $form->textField($model,'index_date'); ?>
		<?php echo $form->error($model,'index_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sci_number'); ?>
		<?php echo $form->textField($model,'sci_number',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'sci_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ei_number'); ?>
		<?php echo $form->textField($model,'ei_number',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'ei_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'istp_number'); ?>
		<?php echo $form->textField($model,'istp_number',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'istp_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_first_grade'); ?>
		<?php echo $form->textField($model,'is_first_grade'); ?>
		<?php echo $form->error($model,'is_first_grade'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_core'); ?>
		<?php echo $form->textField($model,'is_core'); ?>
		<?php echo $form->error($model,'is_core'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'other_pub'); ?>
		<?php echo $form->textField($model,'other_pub',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'other_pub'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_journal'); ?>
		<?php echo $form->textField($model,'is_journal'); ?>
		<?php echo $form->error($model,'is_journal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_conference'); ?>
		<?php echo $form->textField($model,'is_conference'); ?>
		<?php echo $form->error($model,'is_conference'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_intl'); ?>
		<?php echo $form->textField($model,'is_intl'); ?>
		<?php echo $form->error($model,'is_intl'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_domestic'); ?>
		<?php echo $form->textField($model,'is_domestic'); ?>
		<?php echo $form->error($model,'is_domestic'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'filename'); ?>
		<?php echo $form->textField($model,'filename',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'filename'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_high_level'); ?>
		<?php echo $form->textField($model,'is_high_level'); ?>
		<?php echo $form->error($model,'is_high_level'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'maintainer_id'); ?>
		<?php echo $form->textField($model,'maintainer_id'); ?>
		<?php echo $form->error($model,'maintainer_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->