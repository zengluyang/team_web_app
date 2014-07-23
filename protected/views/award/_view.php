<?php
/* @var $this AwardController */
/* @var $data Award */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('project_name')); ?>:</b>
	<?php echo CHtml::encode($data->project_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('award_name')); ?>:</b>
	<?php echo CHtml::encode($data->award_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('award_date')); ?>:</b>
	<?php echo CHtml::encode($data->award_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('org_from')); ?>:</b>
	<?php echo CHtml::encode($data->org_from); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_intl')); ?>:</b>
	<?php echo CHtml::encode($data->is_intl); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_national')); ?>:</b>
	<?php echo CHtml::encode($data->is_national); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('is_provincial')); ?>:</b>
	<?php echo CHtml::encode($data->is_provincial); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_city')); ?>:</b>
	<?php echo CHtml::encode($data->is_city); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_school')); ?>:</b>
	<?php echo CHtml::encode($data->is_school); ?>
	<br />

	*/ ?>

</div>