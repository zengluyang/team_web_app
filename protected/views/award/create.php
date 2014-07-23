<?php
/* @var $this AwardController */
/* @var $model Award */

$this->breadcrumbs=array(
	'Awards'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Award', 'url'=>array('index')),
	array('label'=>'Manage Award', 'url'=>array('admin')),
);
?>

<h1>Create Award</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>