<?php
/* @var $this PaperController */
/* @var $model Paper */
/* @var $form CActiveForm */
?>
<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'paper-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
    <style>
        #Paper_info {
            resize: none;
        }
    </style>
	<div class="row">
        <div class="medium-12 columns end">
		<?php echo $form->labelEx($model,'info'); ?>
		<?php echo $form->textArea($model,'info',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'info'); ?>
        </div>
	</div>
    <style>
       div.author {
            display: inline-block;
            margin-right: 5px;
        }
    </style>

    <div class="row" id="authors">
        <div class="medium-12 columns end">
        <?php
        $peoples = People::model()->findAll();
        $authors = $model->peoples;
        //var_dump($authors);
        for($i=0;$i<5;$i++) {
            echo '<div class="author">';
            echo $form->label($model,'作者'.($i+1));
            $select='<select name="Paper'.'[peoples]['.$i.']'.'">';
            $select.='<option value="0" selected="selected">'.'选择作者'."</option>";
            foreach($peoples as $p) {
                $selected="";
                if($i<count($authors) && $authors[$i]->id==$p->id)
                    $selected="selected";
                $select.='<option '.$selected.' value="'.$p->id.'">'.$p->name."</option>";
            }
            $select.='<select>';
            echo $select;
            echo '</div>';
        }
        ?>
        </div>
    </div>

	<div class="row">
        <div class="medium-12 columns end">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList(
            $model,'status',
            array($model::LABEL_PASSED,$model::LABEL_PUBLISHED,$model::LABEL_INDEXED),
            array()); ?>
		<?php echo $form->error($model,'status'); ?>
        </div>
	</div>

	<div class="row" id="pass_date">
        <div class="medium-12 columns end">
		<?php echo $form->labelEx($model,'pass_date'); ?>
		<?php echo $form->textField($model,'pass_date',array('placeholder'=>'日期格式: yyyy-mm-dd')); ?>
		<?php echo $form->error($model,'pass_date'); ?>
        </div>
	</div>

	<div class="row" id="pub_date">
        <div class="medium-12 columns end">
		<?php echo $form->labelEx($model,'pub_date'); ?>
		<?php echo $form->textField($model,'pub_date',array('placeholder'=>'日期格式: yyyy-mm-dd')); ?>
		<?php echo $form->error($model,'pub_date'); ?>
        </div>
	</div>

	<div class="row" id="index_date">
         <div class="medium-12 columns end">
		<?php echo $form->labelEx($model,'index_date'); ?>
		<?php echo $form->textField($model,'index_date',array('placeholder'=>'日期格式 :yyyy-mm-dd')); ?>
		<?php echo $form->error($model,'index_date'); ?>
        </div>
	</div>

	<div class="row" id="index_number">
        <div class="medium-12 columns end">
		<?php echo $form->labelEx($model,'sci_number'); ?>
		<?php echo $form->textField($model,'sci_number',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'sci_number'); ?>
		<?php echo $form->labelEx($model,'ei_number'); ?>
		<?php echo $form->textField($model,'ei_number',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'ei_number'); ?>
		<?php echo $form->labelEx($model,'istp_number'); ?>
		<?php echo $form->textField($model,'istp_number',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'istp_number'); ?>
        </div>
	</div>

	<div class="row">
        <div class="medium-1 columns">
    		<?php echo $form->labelEx($model,'is_first_grade'); ?>
            <?php echo $form->checkBox($model,'is_first_grade'); ?>
    		<?php echo $form->error($model,'is_first_grade'); ?>
        </div>
        <div class="medium-1 columns">
            <?php echo $form->labelEx($model,'is_core'); ?>
    		<?php echo $form->checkBox($model,'is_core'); ?>
    		<?php echo $form->error($model,'is_core'); ?>
        </div>
        <div class="medium-1 columns">
        <?php echo $form->labelEx($model,'other_pub'); ?>
		<?php echo $form->checkBox($model,'other_pub'); ?>
		<?php echo $form->error($model,'other_pub'); ?>
        </div>
        <div class="medium-1 columns">
        <?php echo $form->labelEx($model,'is_journal'); ?>
		<?php echo $form->checkBox($model,'is_journal'); ?>
		<?php echo $form->error($model,'is_journal'); ?>
        </div>
        <div class="medium-1 columns">
        <?php echo $form->labelEx($model,'is_conference'); ?>
		<?php echo $form->checkBox($model,'is_conference'); ?>
		<?php echo $form->error($model,'is_conference'); ?>
        </div>
        <div class="medium-1 columns">
		<?php echo $form->labelEx($model,'is_intl'); ?>
		<?php echo $form->checkBox($model,'is_intl'); ?>
		<?php echo $form->error($model,'is_intl'); ?>
        </div>
        <div class="medium-1 columns">
		<?php echo $form->labelEx($model,'is_domestic'); ?>
		<?php echo $form->checkBox($model,'is_domestic'); ?>
		<?php echo $form->error($model,'is_domestic'); ?>
        </div>
        <div class="medium-1 columns end">
		<?php echo $form->labelEx($model,'is_high_level'); ?>
		<?php echo $form->checkBox($model,'is_high_level'); ?>
		<?php echo $form->error($model,'is_high_level'); ?>
        </div>
	</div>

    <div class="row">
        <div class="medium-12 columns end">
        <?php echo $form->labelEx($model,'uploadedFile'); ?>
        <?php echo $form->fileField($model,'uploadedFile'); ?>
        <?php echo $form->error($model,'uploadedFile'); ?>
        </div>
    </div>

    <div class="row">
        <div class="medium-12 columns end">
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

	<div class="row buttons">
        <div class="medium-12 columns end">
		<?php echo CHtml::submitButton(
            $model->isNewRecord ? '创建' : '保存'
        ); ?>
        </div>
    </div>

<?php $this->endWidget(); ?>
<script>
    $(document).ready(function() {
        $("textarea").keydown(function(e) {
            if (e.keyCode == 13) {
                e.preventDefault();
            }
        });
        $('#pass_date').show();
        $('#pub_date, #index_date').hide();
        $('#index_number').hide();
        var changeInputByStatus = function(status){
            switch(status){
                case 0:
                    console.log('0 pass');
                    $('#pass_date').fadeIn();
                    $('#pub_date').hide();
                    $('#index_date').hide();
                    $('#index_number').hide();
                    break;
                case 1:
                    console.log('1 pub');
                    $('#pass_date').hide();
                    $('#pub_date').fadeIn();
                    $('#index_date').hide();
                    $('#index_number').hide();
                    break;
                case 2:
                    console.log('2 index');
                    $('#pass_date').hide();
                    $('#pub_date').hide();
                    $('#index_date').fadeIn();
                    $('#index_number').fadeIn();
                    break;
            }
        };
        changeInputByStatus(parseInt($('#Paper_status').val()));
        $('#Paper_status').change(function(){
            var status = parseInt($(this).val());
            changeInputByStatus(status);
        });
        $('#authors select').change(function(){
            var valSelected = $(this).val();
            var onChangeName = $(this).attr('name');
            var reset = false;
            $('#authors select').each(function(){
                if($(this).attr('name')!=onChangeName && valSelected!='0'){
                    if($(this).val()==valSelected) {
                        reset = true;
                    }
                }
            });
            if(reset){
                $(this).val('0');
                alert('请勿选择相同作者！');
            }
        });
        $('select').select2({
            width: 'resolve',
            matcher: function(term,text) {
                var pinyin = new Pinyin();
                var mod=pinyin.getCamelChars(text.toUpperCase());
                return mod.indexOf(term.toUpperCase())==0;
            }
        });

    });
</script>
</div><!-- form -->

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