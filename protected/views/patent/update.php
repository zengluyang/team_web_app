<?php
/* @var $this PatentController */
/* @var $model Patent */

$this->breadcrumbs=array(
	'专利'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'更改',
);

$this->menu=array(
	array('label'=>'全部专利', 'url'=>array('index')),
	array('label'=>'增加专利', 'url'=>array('create')),
	array('label'=>'查看专利', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'管理专利', 'url'=>array('admin')),
    array('label'=>'导入专利', 'url'=>array('upload')),
);
?>

<h1>更改专利 <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>