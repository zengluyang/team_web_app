<?php
/* @var $this ProjectController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Projects',
);

$this->menu=array(
	array('label'=>'Create Project', 'url'=>array('create')),
	array('label'=>'Manage Project', 'url'=>array('admin')),
	array('label'=>'Import Project', 'url'=>array('upload')),
);
?>

<style>
    li.project {
        margin-bottom: 10px;
    }
</style>



<h1>Projects</h1>
<table>
	<tr>
		<th>项目级别类型</th>
		<th>项目名称</th>
		<th>时间段</th>
	</tr>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'itemsTagName' => 'tbody',

)); ?>
</table>

