<?php
/* @var $this ProjectController */
/* @var $model Project */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'number'); ?>
		<?php echo $form->textField($model,'number',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fund_number'); ?>
		<?php echo $form->textField($model,'fund_number',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'fund_number'); ?>
	</div>
	<div class="row">
		<div class="medium-1 columns">
			<?php echo $form->labelEx($model,'is_intl'); ?>
			<?php echo $form->checkBox($model,'is_intl'); ?>
			<?php echo $form->error($model,'is_intl'); ?>
		</div>

		<div class="medium-1 columns">
			<?php echo $form->labelEx($model,'is_national'); ?>
			<?php echo $form->checkBox($model,'is_national'); ?>
			<?php echo $form->error($model,'is_national'); ?>
		</div>

		<div class="medium-1 columns">
			<?php echo $form->labelEx($model,'is_provincial'); ?>
			<?php echo $form->checkBox($model,'is_provincial'); ?>
			<?php echo $form->error($model,'is_provincial'); ?>
		</div>

		<div class="medium-1 columns">
			<?php echo $form->labelEx($model,'is_city'); ?>
			<?php echo $form->checkBox($model,'is_city'); ?>
			<?php echo $form->error($model,'is_city'); ?>
		</div>

		<div class="medium-1 columns">
			<?php echo $form->labelEx($model,'is_school'); ?>
			<?php echo $form->checkBox($model,'is_school'); ?>
			<?php echo $form->error($model,'is_school'); ?>
		</div>

		<div class="medium-1 columns end">
			<?php echo $form->labelEx($model,'is_enterprise'); ?>
			<?php echo $form->checkBox($model,'is_enterprise'); ?>
			<?php echo $form->error($model,'is_enterprise'); ?>
		</div>
	</div>
	<div class="row">
		<div class="medium-1 columns">
			<?php echo $form->labelEx($model,'is_NSF'); ?>
			<?php echo $form->checkBox($model,'is_NSF'); ?>
			<?php echo $form->error($model,'is_NSF'); ?>
		</div>

		<div class="medium-1 columns">
			<?php echo $form->labelEx($model,'is_973'); ?>
			<?php echo $form->checkBox($model,'is_973'); ?>
			<?php echo $form->error($model,'is_973'); ?>
		</div>

		<div class="medium-1 columns">
			<?php echo $form->labelEx($model,'is_863'); ?>
			<?php echo $form->checkBox($model,'is_863'); ?>
			<?php echo $form->error($model,'is_863'); ?>
		</div>

		<div class="medium-1 columns">
			<?php echo $form->labelEx($model,'is_NKTRD'); ?>
			<?php echo $form->checkBox($model,'is_NKTRD'); ?>
			<?php echo $form->error($model,'is_NKTRD'); ?>
		</div>

		<div class="medium-1 columns">
			<?php echo $form->labelEx($model,'is_DFME'); ?>
			<?php echo $form->checkBox($model,'is_DFME'); ?>
			<?php echo $form->error($model,'is_DFME'); ?>
		</div>

		<div class="medium-1 columns end">
			<?php echo $form->labelEx($model,'is_major'); ?>
			<?php echo $form->checkBox($model,'is_major'); ?>
			<?php echo $form->error($model,'is_major'); ?>
		</div>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'start_date'); ?>
		<?php echo $form->textField($model,'start_date'); ?>
		<?php echo $form->error($model,'start_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'deadline_date'); ?>
		<?php echo $form->textField($model,'deadline_date'); ?>
		<?php echo $form->error($model,'deadline_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'conclude_date'); ?>
		<?php echo $form->textField($model,'conclude_date'); ?>
		<?php echo $form->error($model,'conclude_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'app_date'); ?>
		<?php echo $form->textField($model,'app_date'); ?>
		<?php echo $form->error($model,'app_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pass_date'); ?>
		<?php echo $form->textField($model,'pass_date'); ?>
		<?php echo $form->error($model,'pass_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'app_fund'); ?>
		<?php echo $form->textField($model,'app_fund',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'app_fund'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pass_fund'); ?>
		<?php echo $form->textField($model,'pass_fund',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'pass_fund'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->