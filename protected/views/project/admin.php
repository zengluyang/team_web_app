<?php
/* @var $this ProjectController */
/* @var $model Project */

$this->breadcrumbs=array(
	'科研项目'=>array('index'),
	'管理',
);

$this->menu=array(
	array('label'=>'List Project', 'url'=>array('index')),
	array('label'=>'Create Project', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#project-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>管理科研项目</h1>

<?php echo CHtml::link('筛选与查找','#',array('class'=>'search-button button small radius')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'project-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'name',
		'number',
		'fund_number',
		//'is_intl',
		//'is_national',
		/*
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
		*/
		'start_date',
		'deadline_date',
		'conclude_date',
		'app_date',
		'pass_date',
		'app_fund',
		'pass_fund',
		
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
