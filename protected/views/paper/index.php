<?php
/* @var $this PaperController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'论文',
);

$this->menu=array(
	array('label'=>'创建论文', 'url'=>array('create')),
	array('label'=>'管理论文', 'url'=>array('admin')),
	array('label'=>'导入论文', 'url'=>array('upload')),
);
?>
<style>
    li.paper {
        margin-bottom: 10px;
    }
</style>
<h1>Papers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
    'itemsTagName'=>'ol',
	'itemView'=>'_view',
)); ?>
