<?php
/* @var $this ProjectController */
/* @var $data Project */
?>
<tr>
	<td><?php echo CHtml::encode($data->getLevelString('，')); ?></td>
	<td><?php echo CHtml::encode($data->name); ?></td>
	<td><?php echo CHtml::encode(date('Y年m月',strtotime($data->start_date)).'~'.date('Y年m月',strtotime($data->conclude_date))); ?></td>
</tr>