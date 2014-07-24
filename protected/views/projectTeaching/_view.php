<?php
/* @var $this ProjectTeachingController */
/* @var $data ProjectTeaching */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('number')); ?>:</b>
	<?php echo CHtml::encode($data->number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_intl')); ?>:</b>
	<?php echo CHtml::encode($data->is_intl); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_provincial')); ?>:</b>
	<?php echo CHtml::encode($data->is_provincial); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_city')); ?>:</b>
	<?php echo CHtml::encode($data->is_city); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_school')); ?>:</b>
	<?php echo CHtml::encode($data->is_school); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('is_quality')); ?>:</b>
	<?php echo CHtml::encode($data->is_quality); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_reform')); ?>:</b>
	<?php echo CHtml::encode($data->is_reform); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_lab')); ?>:</b>
	<?php echo CHtml::encode($data->is_lab); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_new_lab')); ?>:</b>
	<?php echo CHtml::encode($data->is_new_lab); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('start_date')); ?>:</b>
	<?php echo CHtml::encode($data->start_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deadline_date')); ?>:</b>
	<?php echo CHtml::encode($data->deadline_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('conclude_date')); ?>:</b>
	<?php echo CHtml::encode($data->conclude_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fund')); ?>:</b>
	<?php echo CHtml::encode($data->fund); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('should_display')); ?>:</b>
	<?php echo CHtml::encode($data->should_display); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('maintainer_id')); ?>:</b>
	<?php echo CHtml::encode($data->maintainer_id); ?>
	<br />

	*/ ?>

</div>