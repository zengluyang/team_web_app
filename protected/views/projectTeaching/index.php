<?php
/* @var $this ProjectTeachingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Project Teachings',
);

$this->menu=array(
	array('label'=>'Create ProjectTeaching', 'url'=>array('create')),
	array('label'=>'Manage ProjectTeaching', 'url'=>array('admin')),
);
?>
<table>
	<tr>
		<th><?php echo CHtml::encode(ProjectTeaching::model()->getAttributeLabel('name')); ?></th>
		<th><?php echo CHtml::encode(ProjectTeaching::model()->getAttributeLabel('number')); ?></th>
		<th><?php echo CHtml::encode(ProjectTeaching::model()->getAttributeLabel('level')); ?></th>
		<th><?php echo CHtml::encode(ProjectTeaching::model()->getAttributeLabel('type')); ?></th>
		<th><?php echo CHtml::encode(ProjectTeaching::model()->getAttributeLabel('start_date')); ?></th>
		<th><?php echo CHtml::encode(ProjectTeaching::model()->getAttributeLabel('conclude_date')); ?></th>
		<th><?php echo CHtml::encode(ProjectTeaching::model()->getAttributeLabel('peoples')); ?></th>
	</tr>
<h1>Project Teachings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'itemsTagName' => 'tbody',
)); ?>
</table>