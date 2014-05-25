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
        <div class="medium-4 columns">
            <?php

            //$maintainer = $model->maintainer;
            echo $form->label(People::model(),'作者');
            $listData = CHtml::listData($peoples,'id','name');
            $listData = array(null=>'选择作者')+$listData;
            //var_dump(($listData));
            echo $form->dropDownList(People::model(),'id',$listData);
            ?>
        </div>
        <div class="medium-4 columns end">
        <?php

        //$maintainer = $model->maintainer;
        echo $form->label($model,'维护人员');
        $listData = CHtml::listData($peoples,'id','name');
        $listData = array(null=>'选择维护人员')+$listData;
        //var_dump(($listData));
        echo $form->dropDownList($model,'maintainer_id',$listData);
        ?>  
        </div>
    </div>
    <div class="row">
        <div class="medium-4 columns">
            <label for="start_date">开始时间</label>
            <input name="start_date" id="start_date" type="text">
        </div>
        <div class="medium-4 columns end">
            <label for="end_date">截至时间</label>
            <input name="end_date" id="end_date" type="text">
        </div>
    	</div>
    <div class="row">
        <div class="medium-1 columns">
            <?php echo $form->label($model,'is_first_grade'); ?>
            <?php echo $form->checkBox($model,'is_first_grade'); ?>
        </div>
        <div class="medium-1 columns">
            <?php echo $form->label($model,'is_core'); ?>
            <?php echo $form->checkBox($model,'is_core'); ?>
        </div>
        <div class="medium-1 columns">
            <?php echo $form->label($model,'other_pub'); ?>
            <?php echo $form->checkBox($model,'other_pub'); ?>
        </div>
        <div class="medium-1 columns">
            <?php echo $form->label($model,'is_journal'); ?>
            <?php echo $form->checkBox($model,'is_journal'); ?>
        </div>
        <div class="medium-1 columns">
            <?php echo $form->label($model,'is_conference'); ?>
            <?php echo $form->checkBox($model,'is_conference'); ?>
        </div>
        <div class="medium-1 columns">
            <?php echo $form->label($model,'is_intl'); ?>
            <?php echo $form->checkBox($model,'is_intl'); ?>
        </div>
        <div class="medium-1 columns end">
            <?php echo $form->label($model,'is_domestic'); ?>
            <?php echo $form->checkBox($model,'is_domestic'); ?>
        </div>
    </div>
    <div class="row">
        <div class="medium-4 columns">
        <?php
        $projects = Project::model()->findAll();

        echo $form->label(Project::model(),'支柱项目');
        $listData = CHtml::listData($projects,'id','name');
        $listData = array(null=>'选择支柱项目')+$listData;
        //var_dump($listData);
        echo $form->dropDownList(
            Project::model(),
            'id',$listData,
            array('id'=>'fund_project','name'=>'Project[fund_id]')
        );
        ?>
        </div>
        <div class="medium-4 columns end">
        <?php

        echo $form->label(Project::model(),'报账项目');
        $listData = CHtml::listData($projects,'id','name');
        $listData = array(null=>'选择报账项目')+$listData;
        echo $form->dropDownList(
            Project::model(),
            'id',
            $listData,
            array('id'=>'reim_project','name'=>'Project[reim_id]')
        );
        ?>
        </div>
    </div>
    <div class="row buttons">
        <div class="medium-4 columns end">
        <?php
        echo CHtml::hiddenField('export','0');
        echo CHtml::submitButton('查询',array('id'=>'search_btn'));
        echo CHtml::Button('导出',array('id'=>'export_btn'));
        ?>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#export_btn').click(function(){
                $('#export').val('1');
                window.open("?"+$("#search_form").serialize(), "_blank");
            });
            $('#search_btn').click(function(){
                $('#export').val('0');
            });
        })
        $('select').select2({
            width: 'resolve',
            matcher: function(term,text) {
                var pinyin = new Pinyin();
                var mod=pinyin.getCamelChars(text.toUpperCase());
                return mod.indexOf(term.toUpperCase())==0;
            }
        });
    </script>

<?php $this->endWidget(); ?>

</div><!-- search-form -->

<?php
    Yii::app()->getClientScript()->
    registerCssFile(yii::app()->request->baseUrl.'/css/select2.css');

    Yii::app()->getClientScript()
    ->registerScriptFile(yii::app()->request->baseUrl.'/js/select2.js');

    Yii::app()->getClientScript()
    ->registerScriptFile(yii::app()->request->baseUrl.'/js/mootools-core-1.4.5.js');

    Yii::app()->getClientScript()
    ->registerScriptFile(yii::app()->request->baseUrl.'/js/pinyin.js');
?>