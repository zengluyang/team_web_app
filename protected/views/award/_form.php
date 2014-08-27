<?php
/* @var $this AwardController */
/* @var $model Award */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'award-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="medium-6 columns">
		<?php echo $form->labelEx($model,'project_name'); ?>
		<?php echo $form->textField($model,'project_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'project_name'); ?>
		</div>

		<div class="medium-6 columns">
		<?php echo $form->labelEx($model,'award_name'); ?>
		<?php echo $form->textField($model,'award_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'award_name'); ?>
		</div>
	</div>

	<div class="row">
		<div class="medium-6 columns">
		<?php echo $form->labelEx($model,'award_date'); ?>
		<?php echo $form->textField($model,'award_date'); ?>
		<?php echo $form->error($model,'award_date'); ?>
		</div>

		<div class="medium-6 columns">
		<?php echo $form->labelEx($model,'org_from'); ?>
		<?php echo $form->textField($model,'org_from',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'org_from'); ?>
		</div>
	</div>

	<div class="row">
        <div class="medium-1 columns">
		<?php echo $form->labelEx($model,'is_intl'); ?>
		<?php echo $form->checkBox($model,'is_intl'); ?>
		<?php echo $form->error($model,'is_intl'); ?>
        </div>

        <div class="medium-1 columns">
		<?php echo $form->labelEx($model,'is_national'); ?>
		<?php echo $form->checkBox($model,'is_national'); ?>
		<?php echo $form->error($model,'is_national'); ?>
        </div>

        <div class="medium-1 columns">
		<?php echo $form->labelEx($model,'is_provincial'); ?>
		<?php echo $form->checkBox($model,'is_provincial'); ?>
		<?php echo $form->error($model,'is_provincial'); ?>
        </div>

        <div class="medium-1 columns">
		<?php echo $form->labelEx($model,'is_city'); ?>
		<?php echo $form->checkBox($model,'is_city'); ?>
		<?php echo $form->error($model,'is_city'); ?>
        </div>

        <div class="medium-1 columns end">
		<?php echo $form->labelEx($model,'is_school'); ?>
		<?php echo $form->checkBox($model,'is_school'); ?>
		<?php echo $form->error($model,'is_school'); ?>
        </div>
	</div>


	<div class="row">
		<div class="medium-12 columns">
		<?php 
			//var_dump(Chtml::listData(People::model()->findAll(), 'id', 'name'));
			echo $form->labelEx($model,'peoples');
			echo CHtml::dropDownList(
				'Award[peoples]',
				array(),
	            Chtml::listData(People::model()->findAll(), 'id', 'name'),
	            array(
	            	'id'=>'peoples_select',
	            	'multiple'=>'multiple',
	            )
	        ); 
		?>

		</div>
		<input type="hidden" name="Award[peoples_value]"/>
	</div>
	<div class="row buttons">
		<div class="medium-12 columns">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('id'=>'submit_button')); ?>
        </div>
	</div>

<script>
$(document).ready(function(){
	var selectionWithOrder=<?php echo $model->getPeoplesJsForSelect2Init()?>;
	$("#peoples_select").select2({
			placeholder: "选择获奖人",
			width: 'resolve',
			matcher: function(term,text) {
				var pinyin = new Pinyin();
				var mod=pinyin.getCamelChars(text.toUpperCase());
				return mod.indexOf(term.toUpperCase())==0;
			}
	}); 
	$("#peoples_select").select2("data", selectionWithOrder);
	$('#submit_button').click(function(e){
		//e.preventDefault();
		var data = $('#peoples_select').select2('data');
		//console.log(data);
        // Push each item into an array
        var finalResult = [];
        for(var i=0;i<data.length;i++){
        	finalResult.push(data[i].id);
        }
        
        console.log(finalResult);
        $("input[name='Award[peoples_value]']").val(finalResult);
	});
});
</script>
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
<?php $this->endWidget(); ?>

</div><!-- form -->