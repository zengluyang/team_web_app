<?php
/* @var $this UserController */
/* @var $data User */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_admin')); ?>:</b>
	<?php echo CHtml::encode($data->is_admin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_paper')); ?>:</b>
	<?php echo CHtml::encode($data->is_paper); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_project')); ?>:</b>
	<?php echo CHtml::encode($data->is_project); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('is_patent')); ?>:</b>
	<?php echo CHtml::encode($data->is_patent); ?>
	<br />

	*/ ?>

</div>