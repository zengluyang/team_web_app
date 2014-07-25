<?php
/* @var $this ProjectTeachingController */
/* @var $data ProjectTeaching */
?>

<div class="view">
<tr>
<td><?php echo CHtml::encode($data->name); ?></td>
<td><?php echo CHtml::encode($data->number); ?></td>
<td><?php echo CHtml::encode($data->getLevelString()); ?></td>
<td><?php echo CHtml::encode($data->getTypeString()); ?></td>
<td><?php echo CHtml::encode($data->start_date); ?></td>
<td><?php echo CHtml::encode($data->conclude_date); ?></td>
<td><?php echo CHtml::encode($data->getPeoples()); ?></td>
</tr>
</div>