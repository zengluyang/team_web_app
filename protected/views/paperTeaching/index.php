<?php
/* @var $this PaperTeachingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Paper Teachings',
);

$this->menu=array(
	array('label'=>'Create PaperTeaching', 'url'=>array('create')),
	array('label'=>'Manage PaperTeaching', 'url'=>array('admin')),
);
?>

<h1>Paper Teachings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
