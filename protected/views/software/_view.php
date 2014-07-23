<?php
/* @var $this SoftwareController */
/* @var $data Software */
?>

<div class="view">
	<li>
	<?php echo CHtml::encode($data->name); ?>.
	<?php echo CHtml::encode($data->getAttributeLabel('reg_date')); ?>:
	<?php echo CHtml::encode($data->reg_date); ?>, 
	<?php echo CHtml::encode($data->getAttributeLabel('reg_number')); ?>:
	<?php echo CHtml::encode($data->reg_number); ?>, 
	<?php echo CHtml::encode($data->getAttributeLabel('peoples')); ?>:
	<?php echo CHtml::encode($data->getPeoples()); ?>.
	</li>
</div>