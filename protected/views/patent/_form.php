<?php
/* @var $this PatentController */
/* @var $model Patent */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'patent-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'app_date'); ?>
		<?php echo $form->textField($model,'app_date'); ?>
		<?php echo $form->error($model,'app_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'app_number'); ?>
		<?php echo $form->textField($model,'app_number',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'app_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'auth_number'); ?>
		<?php echo $form->textField($model,'auth_number',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'auth_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'auth_date'); ?>
		<?php echo $form->textField($model,'auth_date'); ?>
		<?php echo $form->error($model,'auth_date'); ?>
	</div>

	<div class="row">
		<div class="large-1 medium-2 small-6 columns">
		<?php echo $form->labelEx($model,'is_intl'); ?>
		<?php echo $form->checkBox($model,'is_intl'); ?>
		<?php echo $form->error($model,'is_intl'); ?>
		</div>
		<div class="large-1 medium-2 small-6 columns end">
		<?php echo $form->labelEx($model,'is_domestic'); ?>
		<?php echo $form->checkBox($model,'is_domestic'); ?>
		<?php echo $form->error($model,'is_domestic'); ?>
		</div>
	</div>
    <?php
/*        $peoples = People::model()->findAll(array(
            'select'=>'name',
        ));
        $names =  array();
        foreach($peoples as $p) {
            array_push($names,$p->name);
        }

    for($i=0;$i<5;$i++) {
        $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
            'name'=>'Patent[people]['.$i.']',
            'source'=>$names,
            // additional javascript options for the autocomplete plugin
            'options'=>array(
                'minLength'=>'1',
            ),
            'htmlOptions'=>array(
                'style'=>'height:20px;',
            ),
        ));
        //echo CHtml::activeDropDownList($peoples[$i], 'name', CHtml::listData(People::model()->findAll(), 'id', 'name'));
        echo "<br />";
    }*/
    $peoples = People::model()->findAll();
    $authors = $model->peoples;
    //var_dump($authors);
    for($i=0;$i<5;$i++) {
        echo $form->label($model,'发明人'.($i+1));
        $select='<select name="Patent'.'[peoples]['.$i.']'.'">';
        $select.='<option value="0">'.'选择发明人'."</option>";
        foreach($peoples as $p) {
            $selected="";
            if($i<count($authors) && $authors[$i]->id==$p->id)
                $selected="selected";
            $select.='<option '.$selected.' value="'.$p->id.'">'.$p->name."</option>";
        }
        $select.='<select>';
        echo $select;
    }
    ?>
    <div class="row">
        <?php echo $form->labelEx($model,'abstract'); ?>
        <?php echo $form->textArea($model,'abstract',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'abstract'); ?>
    </div>


    <div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->