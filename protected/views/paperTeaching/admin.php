<?php
/* @var $this PaperTeachingController */
/* @var $model PaperTeaching */

$this->breadcrumbs=array(
	'Paper Teachings'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List PaperTeaching', 'url'=>array('index')),
	array('label'=>'Create PaperTeaching', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#paper-teaching-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Paper Teachings</h1>

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
	'id'=>'paper-teaching-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'info',
		'status',
		'pass_date',
		'pub_date',
		'index_date',

		array(
			'name'=>'level',
			'type'=>'raw',
			'value'=>'$data->getLevelString()',
			'filter' => false,
			'htmlOptions'=>array('width'=>'80em'),
		),
		/*
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
		*/
		array(
			'class'=>'CButtonColumn',
			'htmlOptions'=>array('width'=>'70em'),
		),
	),
)); ?>
