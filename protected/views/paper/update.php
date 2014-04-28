<?php
/* @var $this PaperController */
/* @var $model Paper */

$this->breadcrumbs=array(
	'论文'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'修改',
);

$this->menu=array(
	array('label'=>'列出论文', 'url'=>array('index')),
	array('label'=>'创建论文', 'url'=>array('create')),
	array('label'=>'查看论文', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'管理论文', 'url'=>array('admin')),
	array('label'=>'导入论文', 'url'=>array('upload')),
?>

<h1>Update Paper <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>