<?php
/* @var $this PublicationController */
/* @var $model Publication */

$this->breadcrumbs=array(
	'Publications'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Publication', 'url'=>array('index')),
	array('label'=>'Create Publication', 'url'=>array('create')),
	array('label'=>'Update Publication', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Publication', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Publication', 'url'=>array('admin')),
);
?>

<h1>View Publication #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'info',
		'press',
		'pub_date',
		'is_textbook',
		'is_pub',
		'isbn_number',
		'description',
		array(
			'label'=>'编写人',
			'type'=>'raw',
			'value'=>$model->getPeoples(),
		),
	),
)); ?>
