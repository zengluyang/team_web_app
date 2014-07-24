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
		'is_intl',
		'is_provincial',
		'is_city',
		'is_school',
		'is_quality',
		'is_reform',
		'is_lab',
		'is_new_lab',
		'start_date',
		'deadline_date',
		'conclude_date',
		'fund',
		'should_display',
		'maintainer_id',
	),
)); ?>
