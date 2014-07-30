<?php
/* @var $this PaperController */
/* @var $model Paper */

$this->breadcrumbs=array(
	'论文'=>array('index'),
	'创建',
);

$this->menu=array(
	array('label'=>'列出论文', 'url'=>array('index')),
	array('label'=>'管理论文', 'url'=>array('admin')),
	array('label'=>'导入论文', 'url'=>array('upload')),
	array('label'=>'导出全部论文', 'url'=>array('exportAll')),
);
?>

<h1>Create Paper</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>