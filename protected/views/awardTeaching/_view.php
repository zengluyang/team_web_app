<?php
/* @var $this AwardTeachingController */
/* @var $data AwardTeaching */
?>

<div class="view">
	<tr>
		<td><?php echo CHtml::encode($data->project_name); ?></td>
		<td><?php echo CHtml::encode($data->award_name); ?></td>
		<td><?php echo CHtml::encode($data->award_date); ?></td>
		<td><?php echo CHtml::encode($data->org_from); ?></td>
		<td><?php echo CHtml::encode($data->getPeoples()); ?></td>
	</tr>
</div>