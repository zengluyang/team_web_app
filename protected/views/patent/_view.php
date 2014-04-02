<?php
/* @var $this PatentController */
/* @var $data Patent */
?>

<style>
    .view {
        margin-bottom: 15px;
    }
</style>


<div class="view"">

    <div>
    <?php echo CHtml::encode($data->is_intl?'国际发明专利:&nbsp':''); ?>
	<strong><?php echo CHtml::encode($data->name); ?></strong>&nbsp
    </div>
	<?php echo CHtml::encode(date('Y年m月d日',strtotime($data->app_date))); ?>申请,&nbsp申请号:
	<?php echo CHtml::encode($data->app_number); ?>,
	<?php
        if(trim($data->auth_number)!='') {
            echo CHtml::encode(' 授权号:'.$data->auth_number);
            echo CHtml::encode(', 授权时间:'.date('Y年m月d日',strtotime(($data->auth_date))));
        }
    ?>
	发明人:
	<?php
    for($i=0;$i<count($data->peoples);$i++) {
        echo CHtml::encode($data->peoples[$i]->name);
        if($i!=count($data->peoples)-1){
            echo CHtml::encode(', ');
        }
    }
    ?>
    &nbsp<a class="more" href="#" style="">更多</a>
    <div class="abstract" style="display: none;">
        <strong>简介:&nbsp</strong>
        <?php echo $data->abstract;?>
        
    </div>
	<?php /*echo CHtml::encode($data->abstract);*/ ?>
</div>