<?php
/* @var $this PaperTeachingController */
/* @var $data PaperTeaching */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('info')); ?>:</b>
	<?php echo CHtml::encode($data->info); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pass_date')); ?>:</b>
	<?php echo CHtml::encode($data->pass_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pub_date')); ?>:</b>
	<?php echo CHtml::encode($data->pub_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('index_date')); ?>:</b>
	<?php echo CHtml::encode($data->index_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sci_number')); ?>:</b>
	<?php echo CHtml::encode($data->sci_number); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('ei_number')); ?>:</b>
	<?php echo CHtml::encode($data->ei_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('istp_number')); ?>:</b>
	<?php echo CHtml::encode($data->istp_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_first_grade')); ?>:</b>
	<?php echo CHtml::encode($data->is_first_grade); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_core')); ?>:</b>
	<?php echo CHtml::encode($data->is_core); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('other_pub')); ?>:</b>
	<?php echo CHtml::encode($data->other_pub); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_journal')); ?>:</b>
	<?php echo CHtml::encode($data->is_journal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_conference')); ?>:</b>
	<?php echo CHtml::encode($data->is_conference); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_intl')); ?>:</b>
	<?php echo CHtml::encode($data->is_intl); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_domestic')); ?>:</b>
	<?php echo CHtml::encode($data->is_domestic); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('filename')); ?>:</b>
	<?php echo CHtml::encode($data->filename); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_high_level')); ?>:</b>
	<?php echo CHtml::encode($data->is_high_level); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('maintainer_id')); ?>:</b>
	<?php echo CHtml::encode($data->maintainer_id); ?>
	<br />

	*/ ?>

</div>