<?php
/* @var $this PaperController */
/* @var $model Paper */

$this->breadcrumbs=array(
	'Papers'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'列出论文', 'url'=>array('index')),
	array('label'=>'创建论文', 'url'=>array('create')),
	array('label'=>'修改论文', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'删除论文', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'管理论文', 'url'=>array('admin')),
    array('label'=>'导入论文', 'url'=>array('upload')),
);
?>

<h1>View Paper #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
        'info',
        array(
            'label'=>'作者',
            'type'=>'raw',
            'value'=>$model->getAuthors(),
        ),
        array(
            'label'=>'状态',
            'type'=>'raw',
            'value'=>$model->getStatusString(),
        ),
        array(
            'label'=>'级别',
            'type'=>'raw',
            'value'=>$model->getLevelString(),
        ),
        'pass_date',
        'pub_date',
        'index_date',
        'sci_number',
        'ei_number',
        'istp_number',
        array(
            'label'=>'论文文件',
            'type'=>'raw',
            'value'=>
                isset($model->file_name)?
                CHtml::link($model->file_name,array('download','id'=>$model->primaryKey)):
                null,
        ),

        array(
            'label'=>'维护人员',
            'type'=>'raw',
            'value'=>
                isset($model->maintainer) ? 
                $model->maintainer->name :
                null,
        ),
        array(
            'label'=>'支柱项目',
            'type'=>'raw',
            'value'=>$model->getFundProjects(),
        ),
        array(
            'label'=>'报账项目',
            'type'=>'raw',
            'value'=>$model->getReimProjects(),
        ),
        array(
            'label'=>'成果项目',
            'type'=>'raw',
            'value'=>$model->getAchievementProjects(),
        ),
	),
)); ?>
<hr/>
<!-- <table class="detail-view" id="detail_view">
    <?php
    // $flag=false;
    // foreach(array_keys($model->attributeLabels()) as $attr) {
    //     if(isset($model->$attr)) {
    //         switch($attr) {
    //             case'peoples':
    //                 for($i=0;$i<count($model->peoples);$i++) {
    //                     echo '<tr class="'.
    //                         ($flag?'even':'odd').'"><th>'.
    //                         $model->getAttributeLabel('peoples').($i+1).
    //                         '</th><td>'.
    //                         $model->peoples[$i]->name.
    //                         '</td></tr>';
    //                     $flag = !$flag;
    //                 }
    //                 $flag = !$flag;
    //                 break;
    //             case 'file_name':
    //                 $aTag = CHtml::link($model->$attr,array('download','id'=>$model->primaryKey));
    //                 echo '<tr class="'.($flag?'even':'odd').'"><th>'.$model->getAttributeLabel($attr).'</th><td>'.$aTag.'</td></tr>';
    //                 break;
    //             case 'maintainer_id':
    //                 echo '<tr class="'.($flag?'even':'odd').'"><th>'.$model->getAttributeLabel($attr).'</th><td>'.$model->maintainer->name.'</td></tr>';
    //                 break;
    //             case 'status':
    //                 echo '<tr class="'.($flag?'even':'odd').'"><th>'.$model->getAttributeLabel($attr).'</th><td>'.$model->getStatusString().'</td></tr>';
    //                 break;
    //             default:
    //                 echo '<tr class="'.($flag?'even':'odd').'"><th>'.$model->getAttributeLabel($attr).'</th><td>'.$model->$attr.'</td></tr>';
    //                 break;
    //         }
    //     } else {
    //         echo '<tr class="'.($flag?'even':'odd').'"><th>'.$model->getAttributeLabel($attr).'</th><td><span class="null">未设置</span></td></tr>';
    //     }
    //     $flag = !$flag;
    // }

    ?>
</table> -->