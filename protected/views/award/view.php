<?php
/* @var $this AwardController */
/* @var $model Award */

$this->breadcrumbs=array(
	'Awards'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Award', 'url'=>array('index')),
	array('label'=>'Create Award', 'url'=>array('create')),
	array('label'=>'Update Award', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Award', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Award', 'url'=>array('admin')),
);
?>

<h1>View Award #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
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
