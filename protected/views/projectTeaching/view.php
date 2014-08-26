<?php
/* @var $this ProjectTeachingController */
/* @var $model ProjectTeaching */

$this->breadcrumbs=array(
	'Project Teachings'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List ProjectTeaching', 'url'=>array('index')),
	array('label'=>'Create ProjectTeaching', 'url'=>array('create')),
	array('label'=>'Update ProjectTeaching', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ProjectTeaching', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProjectTeaching', 'url'=>array('admin')),
);
?>

<h1>View ProjectTeaching #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'number',
		array(
			'label'=>'级别',
			'type'=>'raw',
			'value'=>$model->getLevelString(),
		),
		array(
			'label'=>'类别',
			'type'=>'raw',
			'value'=>$model->getTypeString(),
		),
		'start_date',
		'deadline_date',
		'conclude_date',
		'fund',
		array(
			'label'=>'人员',
			'type'=>'raw',
			'value'=>$model->getPeoples(),
		),
		array(
			'label'=>'负责人1',
			'type'=>'raw',
			'value'=>isset($model->director1->name)?$model->director1->name:null,
		),
		array(
			'label'=>'负责人2',
			'type'=>'raw',
			'value'=>isset($model->director2->name)?$model->director1->name:null,
		),
		'should_display',
		array(
			'label'=>'维护人',
			'type'=>'raw',
			'value'=>isset($model->maintainer->name)?$model->maintainer->name:null,
		),
	),
)); ?>
