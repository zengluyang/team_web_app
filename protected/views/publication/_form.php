<?php
/* @var $this PublicationController */
/* @var $model Publication */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'publication-form',
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
		<?php echo $form->labelEx($model,'info'); ?>
		<?php echo $form->textField($model,'info',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'info'); ?>
		</div>
	</div>

	<div class="row">
		<div class="medium-12 columns">
		<?php echo $form->labelEx($model,'press'); ?>
		<?php echo $form->textField($model,'press',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'press'); ?>
		</div>
	</div>

	<div class="row">
		<div class="medium-6 columns">
		<?php echo $form->labelEx($model,'pub_date'); ?>
		<?php echo $form->textField($model,'pub_date'); ?>
		<?php echo $form->error($model,'pub_date'); ?>
		</div>

		<div class="medium-6 columns">
		<?php echo $form->labelEx($model,'isbn_number'); ?>
		<?php echo $form->textField($model,'isbn_number',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'isbn_number'); ?>
		</div>

	</div>

	<div class="row">
		<div class="medium-6 columns">
		<?php echo $form->labelEx($model,'is_textbook'); ?>
		<?php echo $form->checkBox($model,'is_textbook'); ?>
		<?php echo $form->error($model,'is_textbook'); ?>
		</div>

		<div class="medium-6 columns">
		<?php echo $form->labelEx($model,'is_pub'); ?>
		<?php echo $form->checkBox($model,'is_pub'); ?>
		<?php echo $form->error($model,'is_pub'); ?>
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
				'Publication[peoples]',
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
        <div class="medium-12 columns end">
        <?php
        $projects = Project::model()->findAll();
        echo $form->labelEx($model,'fund_projects');
        echo CHtml::dropDownList(
            'Publication[fund_projects]',
            array(),
            Chtml::listData($projects, 'id', 'name'),
            array(
                'id'=>'fund_projects_select',
                'multiple'=>'multiple',
            )
        ); 

        ?>
        </div>
    </div>

    <div class="row">
        <div class="medium-12 columns end">
        <?php
        echo $form->labelEx($model,'reim_projects');
        echo CHtml::dropDownList(
            'Publication[reim_projects]',
            array(),
            Chtml::listData($projects, 'id', 'name'),
            array(
                'id'=>'reim_projects_select',
                'multiple'=>'multiple',
            )
        ); 

        ?>
        </div>
    </div>
    
    <div class="row">
        <div class="medium-12 columns end">
        <?php
        echo $form->labelEx($model,'achievement_projects');
        echo CHtml::dropDownList(
            'Publication[achievement_projects]',
            array(),
            Chtml::listData($projects, 'id', 'name'),
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
	$('#fund_projects_select').val([<?php echo $model->getFundProjects(',','id')?>]);
	$('#reim_projects_select').val([<?php echo $model->getReimProjects(',','id')?>]);
    $('#achievement_projects_select').val([<?php echo $model->getAchievementProjects(',','id')?>]);
	var selectionWithOrder=[<?php echo $model->getPeoplesJsArray('id')?>];
	$('#peoples_select').val(selectionWithOrder);
	$("select").select2({
			//placeholder: "选择编写人",
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