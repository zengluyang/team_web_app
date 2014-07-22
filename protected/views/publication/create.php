<?php
/* @var $this PublicationController */
/* @var $model Publication */

$this->breadcrumbs=array(
	'Publications'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Publication', 'url'=>array('index')),
	array('label'=>'Manage Publication', 'url'=>array('admin')),
);
?>

<h1>Create Publication</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>