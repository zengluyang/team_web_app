<?php
/* @var $this PatentController */
/* @var $model Patent */

$this->breadcrumbs=array(
	'专利'=>array('index'),
	'管理',
);

$this->menu=array(
	array('label'=>'全部专利', 'url'=>array('index')),
	array('label'=>'创建专利', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#patent-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>管理专利</h1>

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

<?php
//$dataProvider = $model->search();
$dataProvider = new CActiveDataProvider('Patent');
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'patent-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'app_date',
		'app_number',
		'auth_number',
		'auth_date',

		'is_intl',
		'is_domestic',
        array(
            'name'=>'peoples.name',
            'type'=>'raw',
            'header'=>'发明人&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
            'value'=>'$data->getAuthors()',
        ),
		array(
			'class'=>'CButtonColumn',
		),
	),
));?>
