<?php
/* @var $this PaperController */
/* @var $model Paper */

$this->breadcrumbs=array(
	'Papers'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Paper', 'url'=>array('index')),
	array('label'=>'Create Paper', 'url'=>array('create')),
	array('label'=>'Update Paper', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Paper', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Paper', 'url'=>array('admin')),
);
?>

<h1>View Paper #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
	),
    'id' => 'dumb_widget',
)); ?>
<table class="detail-view" id="detail_view">
    <?php
    $flag=false;
    foreach(array_keys($model->attributeLabels()) as $attr) {
        if(isset($model->$attr)) {
            switch($attr) {
                case'peoples':
                    for($i=0;$i<count($model->peoples);$i++) {
                        echo '<tr class="'.
                            ($flag?'even':'odd').'"><th>'.
                            $model->getAttributeLabel('peoples').($i+1).
                            '</th><td>'.
                            $model->peoples[$i]->name.
                            '</td></tr>';
                        $flag = !$flag;
                    }
                    $flag = !$flag;
                    break;
                case 'file_name':
                    $aTag = CHtml::link($model->$attr,array('download','id'=>$model->primaryKey));
                    echo '<tr class="'.($flag?'even':'odd').'"><th>'.$model->getAttributeLabel($attr).'</th><td>'.$aTag.'</td></tr>';
                    break;
                case 'maintainer_id':
                    echo '<tr class="'.($flag?'even':'odd').'"><th>'.$model->getAttributeLabel($attr).'</th><td>'.$model->maintainer->name.'</td></tr>';
                    break;
                case 'status':
                    echo '<tr class="'.($flag?'even':'odd').'"><th>'.$model->getAttributeLabel($attr).'</th><td>'.$model->getStatusString().'</td></tr>';
                    break;
                default:
                    echo '<tr class="'.($flag?'even':'odd').'"><th>'.$model->getAttributeLabel($attr).'</th><td>'.$model->$attr.'</td></tr>';
                    break;
            }
        } else {
            echo '<tr class="'.($flag?'even':'odd').'"><th>'.$model->getAttributeLabel($attr).'</th><td><span class="null">未设置</span></td></tr>';
        }
        $flag = !$flag;
    }

    ?>
</table>