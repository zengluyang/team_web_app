<?php
/* @var $this AwardController */
/* @var $model Award */

$this->breadcrumbs=array(
	'Awards'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Award', 'url'=>array('index')),
	array('label'=>'Create Award', 'url'=>array('create')),
	array('label'=>'View Award', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Award', 'url'=>array('admin')),
);
?>

<h1>Update Award <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>