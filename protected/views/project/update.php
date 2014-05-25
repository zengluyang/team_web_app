<?php
/* @var $this ProjectController */
/* @var $model Project */

$this->breadcrumbs=array(
	'科研项目'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'修改',
);

$this->menu=array(
	array('label'=>'List Project', 'url'=>array('index')),
	array('label'=>'Create Project', 'url'=>array('create')),
	array('label'=>'View Project', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Project', 'url'=>array('admin')),
);
?>

<h1>修改项目 #<?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>