<?php
/* @var $this PaperController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Papers',
);

$this->menu=array(
	array('label'=>'Create Paper', 'url'=>array('create')),
	array('label'=>'Manage Paper', 'url'=>array('admin')),
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
