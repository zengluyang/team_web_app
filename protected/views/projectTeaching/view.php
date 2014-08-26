<?php
/* @var $this ProjectTeachingController */
/* @var $model ProjectTeaching */

$this->breadcrumbs=array(
	'教改项目'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'列出', 'url'=>array('index')),
	array('label'=>'增加', 'url'=>array('create')),
	array('label'=>'修改', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'删除', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'管理', 'url'=>array('admin')),
	array('label'=>'导入', 'url'=>array('upload')),
);
?>

<!-- <h1>查看教改项目 #<?php echo $model->id; ?></h1>
 -->
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'number',
		'fund_number',
		array(
			'label'=>'级别',
			'type'=>'raw',
			'value'=>$model->getLevelString(),
		),
		array(
			'label'=>'类别',
			'type'=>'raw',
			'value'=>$model->getTypeString(),
		),
		'start_date',
		'deadline_date',
		'conclude_date',
		'fund',
		array(
			'label'=>'人员',
			'type'=>'raw',
			'value'=>$model->getPeoples(),
		),
		array(
			'label'=>'负责人1',
			'type'=>'raw',
			'value'=>isset($model->director1->name)?$model->director1->name:null,
		),
		array(
			'label'=>'负责人2',
			'type'=>'raw',
			'value'=>isset($model->director2->name)?$model->director1->name:null,
		),
		'should_display',
		array(
			'label'=>'维护人',
			'type'=>'raw',
			'value'=>isset($model->maintainer->name)?$model->maintainer->name:null,
		),
	),
)); ?>
