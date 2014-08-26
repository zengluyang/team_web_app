<?php
/* @var $this ProjectTeachingController */
/* @var $model ProjectTeaching */

$this->breadcrumbs=array(
	'Project Teachings'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ProjectTeaching', 'url'=>array('index')),
	array('label'=>'Create ProjectTeaching', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#project-teaching-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Project Teachings</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'project-teaching-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'number',
		array(
			'name'=>'level',
			'type'=>'raw',
			'value'=>'$data->getLevelString()',
			'filter' => false,
			'htmlOptions'=>array('width'=>'80em'),
		),
		array(
			'name'=>'type',
			'type'=>'raw',
			'value'=>'$data->getTypeString()',
			'filter' => false,
			'htmlOptions'=>array('width'=>'80em'),
		),
		'start_date',
		'deadline_date',
		'conclude_date',
		'fund',
		array(
			'name'=>'peoples',
			'type'=>'raw',
			'value'=>'$data->getPeoples()',
			'filter' => false,
			'htmlOptions'=>array('width'=>'200em'),
		),
		array(
			'name'=>'director1',
			'type'=>'raw',
			'value'=>'isset($data->director1->name)?$data->director1->name:null',
			'filter' => false,
			'htmlOptions'=>array('width'=>'60em'),
		),
		array(
			'name'=>'director2',
			'type'=>'raw',
			'value'=>'isset($data->director2->name)?$data->director2->name:null',
			'filter' => false,
			'htmlOptions'=>array('width'=>'60em'),
		),
		'should_display',
		array(
			'name'=>'maintainer',
			'type'=>'raw',
			'value'=>'isset($data->maintainer->name)?isset($data->maintainer->name):null',
			'filter' => false,
			'htmlOptions'=>array('width'=>'60em'),
		),
		/*
		'is_intl',
		'is_provincial',
		'is_city',
		'is_school',
		'is_quality',
		'is_reform',
		'is_lab',
		'is_new_lab',		
		'maintainer_id',
		*/
		array(
			'class'=>'CButtonColumn',
			'htmlOptions'=>array('width'=>'70em'),
		),
	),
)); ?>
