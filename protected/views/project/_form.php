<?php
/* @var $this ProjectController */
/* @var $model Project */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-form',
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
		<div class="medium-6 columns">
		<?php echo $form->labelEx($model,'number'); ?>
		<?php echo $form->textField($model,'number',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'number'); ?>
		</div>
		<div class="medium-6 columns">
		<?php echo $form->labelEx($model,'fund_number'); ?>
		<?php echo $form->textField($model,'fund_number',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'fund_number'); ?>

		</div>
	</div>
	<div class="row">
		<div class="medium-2 columns">
			<?php echo $form->labelEx($model,'is_intl'); ?>
			<?php echo $form->checkBox($model,'is_intl'); ?>
			<?php echo $form->error($model,'is_intl'); ?>
		</div>

		<div class="medium-2 columns">
			<?php echo $form->labelEx($model,'is_national'); ?>
			<?php echo $form->checkBox($model,'is_national'); ?>
			<?php echo $form->error($model,'is_national'); ?>
		</div>

		<div class="medium-2 columns">
			<?php echo $form->labelEx($model,'is_provincial'); ?>
			<?php echo $form->checkBox($model,'is_provincial'); ?>
			<?php echo $form->error($model,'is_provincial'); ?>
		</div>

		<div class="medium-2 columns">
			<?php echo $form->labelEx($model,'is_city'); ?>
			<?php echo $form->checkBox($model,'is_city'); ?>
			<?php echo $form->error($model,'is_city'); ?>
		</div>

		<div class="medium-2 columns">
			<?php echo $form->labelEx($model,'is_school'); ?>
			<?php echo $form->checkBox($model,'is_school'); ?>
			<?php echo $form->error($model,'is_school'); ?>
		</div>

		<div class="medium-2 columns end">
			<?php echo $form->labelEx($model,'is_enterprise'); ?>
			<?php echo $form->checkBox($model,'is_enterprise'); ?>
			<?php echo $form->error($model,'is_enterprise'); ?>
		</div>
	</div>
	<div class="row">
		<div class="medium-2 columns">
			<?php echo $form->labelEx($model,'is_NSF'); ?>
			<?php echo $form->checkBox($model,'is_NSF'); ?>
			<?php echo $form->error($model,'is_NSF'); ?>
		</div>

		<div class="medium-2 columns">
			<?php echo $form->labelEx($model,'is_973'); ?>
			<?php echo $form->checkBox($model,'is_973'); ?>
			<?php echo $form->error($model,'is_973'); ?>
		</div>

		<div class="medium-2 columns">
			<?php echo $form->labelEx($model,'is_863'); ?>
			<?php echo $form->checkBox($model,'is_863'); ?>
			<?php echo $form->error($model,'is_863'); ?>
		</div>

		<div class="medium-2 columns">
			<?php echo $form->labelEx($model,'is_NKTRD'); ?>
			<?php echo $form->checkBox($model,'is_NKTRD'); ?>
			<?php echo $form->error($model,'is_NKTRD'); ?>
		</div>

		<div class="medium-2 columns">
			<?php echo $form->labelEx($model,'is_DFME'); ?>
			<?php echo $form->checkBox($model,'is_DFME'); ?>
			<?php echo $form->error($model,'is_DFME'); ?>
		</div>

		<div class="medium-2 columns end">
			<?php echo $form->labelEx($model,'is_major'); ?>
			<?php echo $form->checkBox($model,'is_major'); ?>
			<?php echo $form->error($model,'is_major'); ?>
		</div>
	</div>
	<div class="row">
		<div class="medium-6 columns">
		<?php echo $form->labelEx($model,'start_date'); ?>
		<?php echo $form->textField($model,'start_date'); ?>
		<?php echo $form->error($model,'start_date'); ?>
		</div>

		<div class="medium-6 columns">
		<?php echo $form->labelEx($model,'deadline_date'); ?>
		<?php echo $form->textField($model,'deadline_date'); ?>
		<?php echo $form->error($model,'deadline_date'); ?>
		</div>
	</div>

	<div class="row">
		<div class="medium-6 columns">
		<?php echo $form->labelEx($model,'conclude_date'); ?>
		<?php echo $form->textField($model,'conclude_date'); ?>
		<?php echo $form->error($model,'conclude_date'); ?>
		</div>
		<div class="medium-6 columns">
		<?php echo $form->labelEx($model,'app_date'); ?>
		<?php echo $form->textField($model,'app_date'); ?>
		<?php echo $form->error($model,'app_date'); ?>
		</div>
	</div>

	<div class="row">
		<div class="medium-6 columns">
		<?php echo $form->labelEx($model,'pass_date'); ?>
		<?php echo $form->textField($model,'pass_date'); ?>
		<?php echo $form->error($model,'pass_date'); ?>
		</div>
	</div>

	<div class="row">
		<div class="medium-6 columns">
		<?php echo $form->labelEx($model,'app_fund'); ?>
		<?php echo $form->textField($model,'app_fund',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'app_fund'); ?>
		</div>
		<div class="medium-6 columns">
		<?php echo $form->labelEx($model,'pass_fund'); ?>
		<?php echo $form->textField($model,'pass_fund',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'pass_fund'); ?>
		</div>
	</div>

	
	<div class="row">
		<div class="medium-12 columns">
		<?php 
			//var_dump(Chtml::listData(People::model()->findAll(), 'id', 'name'));
			echo $form->labelEx($model,'execute_peoples');
			echo CHtml::dropDownList(
				'Project[execute_peoples]',
				array(),
	            Chtml::listData(People::model()->findAll(), 'id', 'name'),
	            array(
	            	'id'=>'execute_peoples_select',
	            	'multiple'=>'multiple',
	            )
	        ); 
		?>

		<input type="hidden" name="Project[execute_peoples_value]"/>
		</div>
	</div>

	<div class="row">
		<div class="medium-12 columns">
		<?php 
			//var_dump(Chtml::listData(People::model()->findAll(), 'id', 'name'));
			echo $form->labelEx($model,'liability_peoples');
			echo CHtml::dropDownList(
				'Project[liability_peoples]',
				array(),
	            Chtml::listData(People::model()->findAll(), 'id', 'name'),
	            array(
	            	'id'=>'liability_peoples_select',
	            	'multiple'=>'multiple',
	            )
	        ); 
		?>

		</div>

		<input type="hidden" name="Project[liability_peoples_value]"/>
	</div>

	<div class="row buttons">
		<div class="medium-12 columns">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('id'=>'submit_button')); ?>
		</div>
	</div>
<!-- 	<input id="execute_peoples" name="Project[execute_peoples]" type="hidden"/>
 -->
<script>
	$(document).ready(function() { 
		var selectionWithOrder = <?php echo $model->getExecutePeoplesJsForSelect2Init()?>;
		$("#execute_peoples_select").select2({
			placeholder: "选择人员",
			width: 'resolve',
			matcher: function(term,text) {
				var pinyin = new Pinyin();
				var mod=pinyin.getCamelChars(text.toUpperCase());
				return mod.indexOf(term.toUpperCase())==0;
			}
		});
		$("#execute_peoples_select").select2("data", selectionWithOrder);
		$('#submit_button').click(function(e){
			//e.preventDefault();
			var data = $('#execute_peoples_select').select2('data');
			//console.log(data);
	        // Push each item into an array
	        var finalResult = [];
	        for(var i=0;i<data.length;i++){
	        	finalResult.push(data[i].id);
	        }
	        
	        console.log(finalResult);
	        $("input[name='Project[execute_peoples_value]']").val(finalResult);
		});
	});

	$(document).ready(function(){
		var selectionWithOrder = <?php echo $model->getLiabilityPeoplesJsForSelect2Init()?>;
		$("#liability_peoples_select").select2({
			placeholder: "选择人员",
			width: 'resolve',
			matcher: function(term,text) {
				var pinyin = new Pinyin();
				var mod=pinyin.getCamelChars(text.toUpperCase());
				return mod.indexOf(term.toUpperCase())==0;
			}
		}); 
		$("#liability_peoples_select").select2("data", selectionWithOrder);
		$('#submit_button').click(function(e){
			//e.preventDefault();
			var data = $('#liability_peoples_select').select2('data');
			//console.log(data);
	        // Push each item into an array
	        var finalResult = [];
	        for(var i=0;i<data.length;i++){
	        	finalResult.push(data[i].id);
	        }
	        
	        console.log(finalResult);
	        $("input[name='Project[liability_peoples_value]']").val(finalResult);
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