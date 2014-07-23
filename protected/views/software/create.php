<?php
/* @var $this SoftwareController */
/* @var $model Software */

$this->breadcrumbs=array(
	'Softwares'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Software', 'url'=>array('index')),
	array('label'=>'Manage Software', 'url'=>array('admin')),
);
?>

<h1>Create Software</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>