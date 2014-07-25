<?php
/* @var $this PaperTeachingController */
/* @var $model PaperTeaching */

$this->breadcrumbs=array(
	'Paper Teachings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PaperTeaching', 'url'=>array('index')),
	array('label'=>'Manage PaperTeaching', 'url'=>array('admin')),
);
?>

<h1>Create PaperTeaching</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>