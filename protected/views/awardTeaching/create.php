<?php
/* @var $this AwardTeachingController */
/* @var $model AwardTeaching */

$this->breadcrumbs=array(
	'Award Teachings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AwardTeaching', 'url'=>array('index')),
	array('label'=>'Manage AwardTeaching', 'url'=>array('admin')),
);
?>

<h1>Create AwardTeaching</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>