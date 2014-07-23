<?php
/* @var $this SoftwareController */
/* @var $model Software */

$this->breadcrumbs=array(
	'Softwares'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Software', 'url'=>array('index')),
	array('label'=>'Create Software', 'url'=>array('create')),
	array('label'=>'View Software', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Software', 'url'=>array('admin')),
);
?>

<h1>Update Software <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>