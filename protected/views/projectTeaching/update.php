<?php
/* @var $this ProjectTeachingController */
/* @var $model ProjectTeaching */

$this->breadcrumbs=array(
	'教改项目'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'修改',
);

$this->menu=array(
	array('label'=>'列出', 'url'=>array('index')),
	array('label'=>'增加', 'url'=>array('create')),
	array('label'=>'查看', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'管理', 'url'=>array('admin')),
	array('label'=>'上传', 'url'=>array('admin')),
);
?>

<!-- <h1>Update ProjectTeaching <?php echo $model->id; ?></h1>
 -->
<?php $this->renderPartial('_form', array('model'=>$model)); ?>