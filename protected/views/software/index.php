<?php
/* @var $this SoftwareController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Softwares',
);

$this->menu=array(
	array('label'=>'Create Software', 'url'=>array('create')),
	array('label'=>'Manage Software', 'url'=>array('admin')),
);
?>

<h1>Softwares</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'itemsTagName'=>'ol',
)); ?>
