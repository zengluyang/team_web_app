<?php
/* @var $this PaperController */
/* @var $model Paper */

$this->breadcrumbs=array(
	'Papers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Paper', 'url'=>array('index')),
	array('label'=>'Manage Paper', 'url'=>array('admin')),
);
?>

<h1>Create Paper</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>