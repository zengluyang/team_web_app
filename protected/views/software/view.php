<?php
/* @var $this SoftwareController */
/* @var $model Software */

$this->breadcrumbs=array(
	'Softwares'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Software', 'url'=>array('index')),
	array('label'=>'Create Software', 'url'=>array('create')),
	array('label'=>'Update Software', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Software', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Software', 'url'=>array('admin')),
);
?>

<h1>View Software #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'reg_date',
		'reg_number',
		'department',
		'description',
		array(
			'label'=>'申请人',
			'type'=>'raw',
			'value'=>$model->getPeoples(),
		),
        array(
            'label'=>'报账项目',
            'type'=>'raw',
            'value'=>$model->getReimProjects(),
        ),
        array(
            'label'=>'成果项目',
            'type'=>'raw',
            'value'=>$model->getAchievementProjects(),
        ),
	),
)); ?>
