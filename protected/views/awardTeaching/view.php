<?php
/* @var $this AwardTeachingController */
/* @var $model AwardTeaching */

$this->breadcrumbs=array(
	'Award Teachings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List AwardTeaching', 'url'=>array('index')),
	array('label'=>'Create AwardTeaching', 'url'=>array('create')),
	array('label'=>'Update AwardTeaching', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete AwardTeaching', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AwardTeaching', 'url'=>array('admin')),
);
?>

<h1>View AwardTeaching #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'project_name',
		'award_name',
		'award_date',
		'org_from',
		array(
			'label'=>'获奖级别',
			'type'=>'raw',
			'value'=>$model->getLevelString(),
		),
		array(
			'label'=>'获奖人',
			'type'=>'raw',
			'value'=>$model->getPeoples(),
		),
	),
)); ?>
