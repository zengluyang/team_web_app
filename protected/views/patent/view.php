<?php
/* @var $this PatentController */
/* @var $model Patent */

$this->breadcrumbs=array(
	'Patents'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'所有专利', 'url'=>array('index')),
	array('label'=>'增加专利', 'url'=>array('create')),
	array('label'=>'修改专利', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'删除专利', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'管理专利', 'url'=>array('admin')),
    array('label'=>'导入专利', 'url'=>array('upload')),
);
?>

<h1><?php echo $model->name; ?></h1>

<?php $this->Widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
	),
));?>
<table class="detail-view" id="yw1">
    <?php
    $flag=false;

    foreach(array_keys($model->attributeLabels()) as $attr) {
        if($attr!='peoples') {
            echo '<tr class="'.($flag?'even':'odd').'"><th>'.$model->getAttributeLabel($attr).'</th><td>'.$model->$attr.'</td></tr>';
            $flag = !$flag;
        } else if ($attr=='peoples'){
            for($i=0;$i<count($model->peoples);$i++) {
                echo '<tr class="'.
                    ($flag?'even':'odd').'"><th>'.
                    $model->getAttributeLabel('peoples').($i+1).
                    '</th><td>'.
                    $model->peoples[$i]->name.
                    '</td></tr>';
                $flag = !$flag;
            }

        }
    }
    ?>
</table>
