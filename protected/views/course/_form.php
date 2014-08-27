<?php
/* @var $this CourseController */
/* @var $model Course */
/* @var $form CActiveForm */
?>
<?php 
$this->widget('ext.kindeditor.KindEditorWidget',array(
    'id'=>'description_textarea',   //Textarea id
    // Additional Parameters (Check http://www.kindsoft.net/docs/option.html)
    'items' => array(
        //'width'=>'700px',
        //'height'=>'300px',
        'themeType'=>'default',
        'allowImageUpload'=>true,
        'allowFileManager'=>true,
        // 'items'=>array(
        //     'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic',
        //     'underline', 'removeformat', '|', 'justifyleft', 'justifycenter',
        //     'justifyright', 'insertorderedlist','insertunorderedlist', '|',
        //     'emoticons', 'image', 'link',),
    ),
));
$this->widget('ext.kindeditor.KindEditorWidget',array(
    'id'=>'textbook_textarea',   //Textarea id
    // Additional Parameters (Check http://www.kindsoft.net/docs/option.html)
    'items' => array(
        //'width'=>'700px',
        //'height'=>'300px',
        'themeType'=>'default',
        'allowImageUpload'=>true,
        'allowFileManager'=>true,
        // 'items'=>array(
        //     'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic',
        //     'underline', 'removeformat', '|', 'justifyleft', 'justifycenter',
        //     'justifyright', 'insertorderedlist','insertunorderedlist', '|',
        //     'emoticons', 'image', 'link',),
    ),
)); 
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'course-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="medium-12 columns">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
		</div>
	</div>

	<div class="row">
		<div class="medium-12 columns">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('visibility'=>'hidden','id'=>'description_textarea')); ?>
		<?php echo $form->error($model,'description'); ?>
		</div>
	</div>

	<div class="row">

		<div class="medium-6 columns">
		<?php echo $form->labelEx($model,'semester'); ?>
		<?php echo $form->textField($model,'semester',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'semester'); ?>
		</div>

		<div class="medium-6 columns">
		<?php echo $form->labelEx($model,'duration'); ?>
		<?php echo $form->textField($model,'duration',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'duration'); ?>
		</div>
	</div>

	<div class="row">
		<div class="medium-12 columns">
		<?php echo $form->labelEx($model,'textbook'); ?>
		<?php echo $form->textArea($model,'textbook',array('visibility'=>'hidden','id'=>'textbook_textarea')); ?>
		<?php echo $form->error($model,'textbook'); ?>
		</div>
	</div>

	<div class="row">
		<div class="medium-12 columns">
		<?php 
			//var_dump(Chtml::listData(People::model()->findAll(), 'id', 'name'));
			echo $form->labelEx($model,'peoples');
			echo CHtml::dropDownList(
				'Course[peoples]',
				array(),
	            Chtml::listData(People::model()->findAll(), 'id', 'name'),
	            array(
	            	'id'=>'peoples_select',
	            	'multiple'=>'multiple',
	            )
	        ); 
		?>

		</div>
		<input type="hidden" name="Course[peoples_value]"/>
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
			placeholder: "授课教师",
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
        $("input[name='Course[peoples_value]']").val(finalResult);
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