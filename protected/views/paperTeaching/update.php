<?php
/* @var $this PaperTeachingController */
/* @var $model PaperTeaching */

$this->breadcrumbs=array(
	'Paper Teachings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PaperTeaching', 'url'=>array('index')),
	array('label'=>'Create PaperTeaching', 'url'=>array('create')),
	array('label'=>'View PaperTeaching', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PaperTeaching', 'url'=>array('admin')),
);
?>

<h1>Update PaperTeaching <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>