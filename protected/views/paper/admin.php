<?php
/* @var $this PaperController */
/* @var $model Paper */

$this->breadcrumbs=array(
	'Papers'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Paper', 'url'=>array('index')),
	array('label'=>'Create Paper', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#paper-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Papers</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('查询','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'paper-grid',
	'dataProvider'=>$dataProvider,
    'ajaxUpdate'=>true,
	'filter'=>$model,
	'columns'=>array(

		'id',
		'info',
        /*
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
		'file_name',
		'is_high_level',
		'maintainer_id',
        */
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
