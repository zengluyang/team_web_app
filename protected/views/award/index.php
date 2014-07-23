<?php
/* @var $this AwardController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Awards',
);

$this->menu=array(
	array('label'=>'Create Award', 'url'=>array('create')),
	array('label'=>'Manage Award', 'url'=>array('admin')),
);
?>

<h1>Awards</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
