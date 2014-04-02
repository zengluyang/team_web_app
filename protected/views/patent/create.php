<?php
/* @var $this PatentController */
/* @var $model Patent */

$this->breadcrumbs=array(
	'专利'=>array('index'),
	'添加',
);

$this->menu=array(
	array('label'=>'全部专利', 'url'=>array('index')),
	array('label'=>'管理专利', 'url'=>array('admin')),
);
?>

<h1>添加专利</h1>

<?php
$this->renderPartial('_form', array('model'=>$model));
?>
