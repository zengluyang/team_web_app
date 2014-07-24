<?php
/* @var $this ProjectTeachingController */
/* @var $model ProjectTeaching */

$this->breadcrumbs=array(
	'Project Teachings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProjectTeaching', 'url'=>array('index')),
	array('label'=>'Manage ProjectTeaching', 'url'=>array('admin')),
);
?>

<h1>Create ProjectTeaching</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>