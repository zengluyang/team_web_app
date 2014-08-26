<?php
/* @var $this ProjectTeachingController */
/* @var $model ProjectTeaching */

$this->breadcrumbs=array(
	'教改项目'=>array('index'),
	'增加',
);

$this->menu=array(
	array('label'=>'列出', 'url'=>array('index')),
	array('label'=>'管理', 'url'=>array('admin')),
	array('label'=>'导入', 'url'=>array('upload')),
);
?>

<!-- <h1>Create ProjectTeaching</h1>
 -->
<?php $this->renderPartial('_form', array('model'=>$model)); ?>