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

<h1>Project Teachings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
