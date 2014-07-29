<?php
/* @var $this SoftwareController */
/* @var $model Software */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'software-form',
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
		<?php echo $form->labelEx($model,'reg_date'); ?>
		<?php echo $form->textField($model,'reg_date'); ?>
		<?php echo $form->error($model,'reg_date'); ?>
		</div>
	</div>

	<div class="row">
		<div class="medium-12 columns">
		<?php echo $form->labelEx($model,'reg_number'); ?>
		<?php echo $form->textField($model,'reg_number',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'reg_number'); ?>
		</div>
	</div>

	<div class="row">
		<div class="medium-12 columns">
		<?php echo $form->labelEx($model,'department'); ?>
		<?php echo $form->textField($model,'department',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'department'); ?>
		</div>
	</div>

	<div class="row">
		<div class="medium-12 columns">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'description'); ?>
		</div>
	</div>

	<div class="row">
		<div class="medium-12 columns">
		<?php 
			//var_dump(Chtml::listData(People::model()->findAll(), 'id', 'name'));
			echo $form->labelEx($model,'peoples');
			echo CHtml::dropDownList(
				'Software[peoples]',
				array(),
	            Chtml::listData(People::model()->findAll(), 'id', 'name'),
	            array(
	            	'id'=>'peoples_select',
	            	'multiple'=>'multiple',
	            )
	        ); 
		?>

		</div>
	</div>

	<div class="row">
		<div class="medium-12 columns">
		<?php 
			//var_dump(Chtml::listData(People::model()->findAll(), 'id', 'name'));
			echo $form->labelEx($model,'fund_projects');
			echo CHtml::dropDownList(
				'Software[fund_projects]',
				array(),
	            Chtml::listData(Project::model()->findAll(), 'id', 'name'),
	            array(
	            	'id'=>'fund_projects_select',
	            	'multiple'=>'multiple',
	            )
	        ); 
		?>

		</div>
	</div>

	<div class="row">
		<div class="medium-12 columns">
		<?php 
			//var_dump(Chtml::listData(People::model()->findAll(), 'id', 'name'));
			echo $form->labelEx($model,'reim_projects');
			echo CHtml::dropDownList(
				'Software[reim_projects]',
				array(),
	            Chtml::listData(Project::model()->findAll(), 'id', 'name'),
	            array(
	            	'id'=>'reim_projects_select',
	            	'multiple'=>'multiple',
	            )
	        ); 
		?>

		</div>
	</div>

	<div class="row">
		<div class="medium-12 columns">
		<?php 
			//var_dump(Chtml::listData(People::model()->findAll(), 'id', 'name'));
			echo $form->labelEx($model,'achievement_projects');
			echo CHtml::dropDownList(
				'Software[achievement_projects]',
				array(),
	            Chtml::listData(Project::model()->findAll(), 'id', 'name'),
	            array(
	            	'id'=>'achievement_projects_select',
	            	'multiple'=>'multiple',
	            )
	        ); 
		?>

		</div>
	</div>

	<div class="row buttons">
		<div class="medium-12 columns">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		</div>
	</div>
<script>
$(document).ready(function(){
	var selectionWithOrder=[<?php echo $model->getPeoples(',','id')?>];
	$('#peoples_select').val(selectionWithOrder);
	$("#peoples_select").select2({
			placeholder: "选择编写人",
			width: 'resolve',
			matcher: function(term,text) {
				var pinyin = new Pinyin();
				var mod=pinyin.getCamelChars(text.toUpperCase());
				return mod.indexOf(term.toUpperCase())==0;
			}
	});
});
$(document).ready(function(){
	var selectionWithOrder=[<?php echo $model->getReimProjects(',','id')?>];
	$('#fund_projects_select').val([<?php echo $model->getFundProjects(',','id')?>]);
	$('#reim_projects_select').val(selectionWithOrder);
	$('#achievement_projects_select').val([<?php echo $model->getAchievementProjects(',','id')?>]);
	$("#fund_projects_select").select2({
			placeholder: "选择支柱项目",
			width: 'resolve',
			matcher: function(term,text) {
				var pinyin = new Pinyin();
				var mod=pinyin.getCamelChars(text.toUpperCase());
				return mod.indexOf(term.toUpperCase())==0;
			}
	});
	$("#reim_projects_select").select2({
			placeholder: "选择报账项目",
			width: 'resolve',
			matcher: function(term,text) {
				var pinyin = new Pinyin();
				var mod=pinyin.getCamelChars(text.toUpperCase());
				return mod.indexOf(term.toUpperCase())==0;
			}
	});
	$("#achievement_projects_select").select2({
			placeholder: "选择成果项目",
			width: 'resolve',
			matcher: function(term,text) {
				var pinyin = new Pinyin();
				var mod=pinyin.getCamelChars(text.toUpperCase());
				return mod.indexOf(term.toUpperCase())==0;
			}
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