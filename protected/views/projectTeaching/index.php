<?php
/* @var $this ProjectTeachingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'教改项目',
);

$this->menu=array(
	array('label'=>'增加', 'url'=>array('create')),
	array('label'=>'管理', 'url'=>array('admin')),
	array('label'=>'导入', 'url'=>array('upload')),
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
<h1>教改项目</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'itemsTagName' => 'tbody',
)); ?>
</table>