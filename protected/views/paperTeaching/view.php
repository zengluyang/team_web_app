<?php
/* @var $this PaperTeachingController */
/* @var $model PaperTeaching */

$this->breadcrumbs=array(
	'Paper Teachings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PaperTeaching', 'url'=>array('index')),
	array('label'=>'Create PaperTeaching', 'url'=>array('create')),
	array('label'=>'Update PaperTeaching', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PaperTeaching', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PaperTeaching', 'url'=>array('admin')),
);
?>

<h1>View PaperTeaching #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'info',
		'status',
		'pass_date',
		'pub_date',
		'index_date',
		'sci_number',
		'ei_number',
		'istp_number',
		'is_first_grade',
		'is_core',
		'other_pub',
		'is_journal',
		'is_conference',
		'is_intl',
		'is_domestic',
		'filename',
		'is_high_level',
		'maintainer_id',
	),
)); ?>
