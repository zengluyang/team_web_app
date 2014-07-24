<?php
/* @var $this ProjectTeachingController */
/* @var $model ProjectTeaching */

$this->breadcrumbs=array(
	'Project Teachings'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProjectTeaching', 'url'=>array('index')),
	array('label'=>'Create ProjectTeaching', 'url'=>array('create')),
	array('label'=>'View ProjectTeaching', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ProjectTeaching', 'url'=>array('admin')),
);
?>

<h1>Update ProjectTeaching <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>