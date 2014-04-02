<?php
/* @var $this PaperController */
/* @var $model Paper */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
    'id' => 'search_form'
));
$peoples = People::model()->findAll();
?>

    <div class="row">
        <?php

        //$maintainer = $model->maintainer;
        echo $form->label(People::model(),'作者');
        $listData = CHtml::listData($peoples,'id','name');
        $listData = array(null=>'选择作者')+$listData;
        //var_dump(($listData));
        echo $form->dropDownList(People::model(),'id',$listData);
        ?>
    </div>
    <div class="row">
        <label for="start_date">开始时间</label>
        <input name="start_date" id="start_date" type="text">
    </div>
    <div class="row">
        <label for="end_date">截至时间</label>
        <input name="end_date" id="end_date" type="text">
    </div>
	<div class="row">
        <?php

        //$maintainer = $model->maintainer;
        echo $form->label($model,'维护人员');
        $listData = CHtml::listData($peoples,'id','name');
        $listData = array(null=>'选择维护人员')+$listData;
        //var_dump(($listData));
        echo $form->dropDownList($model,'maintainer_id',$listData);
        ?>	</div>
	<div class="row buttons">
		<?php
        echo CHtml::hiddenField('export','0');
        echo CHtml::submitButton('查询',array('id'=>'search_btn'));
        echo CHtml::Button('导出',array('id'=>'export_btn'));
        ?>
	</div>
    <script>
        $(document).ready(function(){
            $('#export_btn').click(function(){
                $('#export').val('1');
                window.open("?"+$("#search_form").serialize(), "_blank");
            });
            $('#search_btn').click(function(){
                $('#export').val('0');
            });
        })

    </script>

<?php $this->endWidget(); ?>

</div><!-- search-form -->