<?php
/* @var $this ProjectController */
/* @var $model Project */

$this->breadcrumbs=array(
	'科研项目'=>array('index'),
	'增加',
);

$this->menu=array(
	array('label'=>'List Project', 'url'=>array('index')),
	array('label'=>'Manage Project', 'url'=>array('admin')),
);
?>

<h1>增加科研项目</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>