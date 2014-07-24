<?php
/* @var $this ProjectTeachingController */
/* @var $model ProjectTeaching */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-teaching-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="medium-12 columns">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
		</div>
	</div>

	<div class="row">
		<div class="medium-12 columns">
		<?php echo $form->labelEx($model,'number'); ?>
		<?php echo $form->textField($model,'number',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'number'); ?>
		</div>
	</div>

	<div class="row">
		<div class="medium-1 columns">
		<?php echo $form->labelEx($model,'is_intl'); ?>
		<?php echo $form->checkBox($model,'is_intl'); ?>
		<?php echo $form->error($model,'is_intl'); ?>
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

		<div class="medium-2 columns">
		<?php echo $form->labelEx($model,'is_quality'); ?>
		<?php echo $form->checkBox($model,'is_quality'); ?>
		<?php echo $form->error($model,'is_quality'); ?>
		</div>

		<div class="medium-2 columns">
		<?php echo $form->labelEx($model,'is_reform'); ?>
		<?php echo $form->checkBox($model,'is_reform'); ?>
		<?php echo $form->error($model,'is_reform'); ?>
		</div>

		<div class="medium-2 columns">
		<?php echo $form->labelEx($model,'is_lab'); ?>
		<?php echo $form->checkBox($model,'is_lab'); ?>
		<?php echo $form->error($model,'is_lab'); ?>
		</div>

		<div class="medium-2 columns end">
		<?php echo $form->labelEx($model,'is_new_lab'); ?>
		<?php echo $form->checkBox($model,'is_new_lab'); ?>
		<?php echo $form->error($model,'is_new_lab'); ?>
		</div>
	</div>

	<div class="row">
		<div class="medium-4 columns">
		<?php echo $form->labelEx($model,'start_date'); ?>
		<?php echo $form->textField($model,'start_date'); ?>
		<?php echo $form->error($model,'start_date'); ?>
		</div>

		<div class="medium-4 columns">
		<?php echo $form->labelEx($model,'deadline_date'); ?>
		<?php echo $form->textField($model,'deadline_date'); ?>
		<?php echo $form->error($model,'deadline_date'); ?>
		</div>

		<div class="medium-4 columns">
		<?php echo $form->labelEx($model,'conclude_date'); ?>
		<?php echo $form->textField($model,'conclude_date'); ?>
		<?php echo $form->error($model,'conclude_date'); ?>
		</div>
	</div>

	<div class="row">
		<div class="medium-4 columns">
		<?php echo $form->labelEx($model,'fund'); ?>
		<?php echo $form->textField($model,'fund',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'fund'); ?>
		</div>

		<div class="medium-4 columns">
        <?php

        //$maintainer = $model->maintainer;
        $peoples = People::model()->findAll();
        echo $form->label($model,'维护人员');
        $listData = CHtml::listData($peoples,'id','name');
        $listData = array(null=>'选择维护人员')+$listData;
        //var_dump(($listData));
        echo $form->dropDownList($model,'maintainer_id',$listData);
        ?>
		</div>

		<div class="medium-4 columns end">
		<?php echo $form->labelEx($model,'should_display'); ?>
		<?php echo $form->Checkbox($model,'should_display'); ?>
		<?php echo $form->error($model,'should_display'); ?>
		</div>

	</div>


	<div class="row buttons">
		<div class="medium-12 columns">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->