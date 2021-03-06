<?php
/* @var $this AwardController */
/* @var $model Award */

$this->breadcrumbs=array(
	'Awards'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Award', 'url'=>array('index')),
	array('label'=>'Create Award', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#award-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Awards</h1>

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
	'id'=>'award-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'project_name',
		'award_name',
		'award_date',
		'org_from',
		'is_intl',
		'is_national',
		'is_provincial',
		'is_city',
		'is_school',
		array(
			'name'=>'peoples',
			'type'=>'raw',
			'value'=>'$data->getPeoples()',
			'filter' => false,
			'htmlOptions'=>array('width'=>'200em'),
		),
		array(
			'class'=>'CButtonColumn',
			'htmlOptions'=>array('width'=>'70em'),
		),

	),
)); ?>
