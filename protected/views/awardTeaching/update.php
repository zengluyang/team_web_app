<?php
/* @var $this AwardTeachingController */
/* @var $model AwardTeaching */

$this->breadcrumbs=array(
	'Award Teachings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AwardTeaching', 'url'=>array('index')),
	array('label'=>'Create AwardTeaching', 'url'=>array('create')),
	array('label'=>'View AwardTeaching', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage AwardTeaching', 'url'=>array('admin')),
);
?>

<h1>Update AwardTeaching <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>