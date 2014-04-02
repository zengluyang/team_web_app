<?php
/* @var $this ProjectController */
/* @var $data Project */
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('fund_number')); ?>:</b>
	<?php echo CHtml::encode($data->fund_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_intl')); ?>:</b>
	<?php echo CHtml::encode($data->is_intl); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_national')); ?>:</b>
	<?php echo CHtml::encode($data->is_national); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_provincial')); ?>:</b>
	<?php echo CHtml::encode($data->is_provincial); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('is_city')); ?>:</b>
	<?php echo CHtml::encode($data->is_city); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_school')); ?>:</b>
	<?php echo CHtml::encode($data->is_school); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_enterprise')); ?>:</b>
	<?php echo CHtml::encode($data->is_enterprise); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_NSF')); ?>:</b>
	<?php echo CHtml::encode($data->is_NSF); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_973')); ?>:</b>
	<?php echo CHtml::encode($data->is_973); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_863')); ?>:</b>
	<?php echo CHtml::encode($data->is_863); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_NKTRD')); ?>:</b>
	<?php echo CHtml::encode($data->is_NKTRD); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_DFME')); ?>:</b>
	<?php echo CHtml::encode($data->is_DFME); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_major')); ?>:</b>
	<?php echo CHtml::encode($data->is_major); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('app_date')); ?>:</b>
	<?php echo CHtml::encode($data->app_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pass_date')); ?>:</b>
	<?php echo CHtml::encode($data->pass_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('app_fund')); ?>:</b>
	<?php echo CHtml::encode($data->app_fund); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pass_fund')); ?>:</b>
	<?php echo CHtml::encode($data->pass_fund); ?>
	<br />

	*/ ?>

</div>