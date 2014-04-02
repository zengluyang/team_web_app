<?php
/* @var $this ProjectController */
/* @var $model Project */

$this->breadcrumbs=array(
	'Projects'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Project', 'url'=>array('index')),
	array('label'=>'Create Project', 'url'=>array('create')),
	array('label'=>'Update Project', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Project', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Project', 'url'=>array('admin')),
);
?>

<h1>View Project #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'number',
		'fund_number',
		'is_intl',
		'is_national',
		'is_provincial',
		'is_city',
		'is_school',
		'is_enterprise',
		'is_NSF',
		'is_973',
		'is_863',
		'is_NKTRD',
		'is_DFME',
		'is_major',
		'start_date',
		'deadline_date',
		'conclude_date',
		'app_date',
		'pass_date',
		'app_fund',
		'pass_fund',
	),
)); ?>
