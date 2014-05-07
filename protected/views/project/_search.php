<?php
/* @var $this ProjectController */
/* @var $model Project */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<div class="medium-4 columns">
			<?php echo $form->label($model,'name'); ?>
			<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		</div>

		<div class="medium-4 columns">
			<?php echo $form->label($model,'number'); ?>
			<?php echo $form->textField($model,'number',array('size'=>60,'maxlength'=>255)); ?>
		</div>

		<div class="medium-4 columns end">
			<?php echo $form->label($model,'fund_number'); ?>
			<?php echo $form->textField($model,'fund_number',array('size'=>60,'maxlength'=>255)); ?>
		</div>
	</div>
	<div class="row">
		<div class="medium-1 columns">
			<?php echo $form->label($model,'is_intl'); ?>
			<?php echo $form->checkBox($model,'is_intl'); ?>
		</div>

		<div class="medium-1 columns">
			<?php echo $form->label($model,'is_national'); ?>
			<?php echo $form->checkBox($model,'is_national'); ?>
		</div>

		<div class="medium-1 columns">
			<?php echo $form->label($model,'is_provincial'); ?>
			<?php echo $form->checkBox($model,'is_provincial'); ?>
		</div>

		<div class="medium-1 columns">
			<?php echo $form->label($model,'is_city'); ?>
			<?php echo $form->checkBox($model,'is_city'); ?>
		</div>

		<div class="medium-1 columns">
			<?php echo $form->label($model,'is_school'); ?>
			<?php echo $form->checkBox($model,'is_school'); ?>
		</div>

		<div class="medium-1 columns">
			<?php echo $form->label($model,'is_enterprise'); ?>
			<?php echo $form->checkBox($model,'is_enterprise'); ?>
		</div>

		<div class="medium-1 columns">
			<?php echo $form->label($model,'is_NSF'); ?>
			<?php echo $form->checkBox($model,'is_NSF'); ?>
		</div>

		<div class="medium-1 columns">
			<?php echo $form->label($model,'is_973'); ?>
			<?php echo $form->checkBox($model,'is_973'); ?>
		</div>

		<div class="medium-1 columns">
			<?php echo $form->label($model,'is_863'); ?>
			<?php echo $form->checkBox($model,'is_863'); ?>
		</div>

		<div class="medium-1 columns">
			<?php echo $form->label($model,'is_NKTRD'); ?>
			<?php echo $form->checkBox($model,'is_NKTRD'); ?>
		</div>

		<div class="medium-1 columns">
			<?php echo $form->label($model,'is_DFME'); ?>
			<?php echo $form->checkBox($model,'is_DFME'); ?>
		</div>

		<div class="medium-1 columns end">
			<?php echo $form->label($model,'is_major'); ?>
			<?php echo $form->checkBox($model,'is_major'); ?>
		</div>
	</div>
	<div class="row">
		<div class="medium-4 columns ">
			<?php echo $form->label($model,'start_date'); ?>
			<?php echo $form->textField($model,'start_date'); ?>
		</div>

		<div class="medium-4 columns ">
			<?php echo $form->label($model,'deadline_date'); ?>
			<?php echo $form->textField($model,'deadline_date'); ?>
		</div>

		<div class="medium-4 columns end">
			<?php echo $form->label($model,'conclude_date'); ?>
			<?php echo $form->textField($model,'conclude_date'); ?>
		</div>
	</div>
	<div class="row">
		<div class="medium-4 columns">
			<?php echo $form->label($model,'app_date'); ?>
			<?php echo $form->textField($model,'app_date'); ?>
		</div>

		<div class="medium-4 columns end">
			<?php echo $form->label($model,'pass_date'); ?>
			<?php echo $form->textField($model,'pass_date'); ?>
		</div>
	</div>
	<div class="row">
		<div class="medium-4 columns">
			<?php echo $form->label($model,'app_fund'); ?>
			<?php echo $form->textField($model,'app_fund',array('size'=>15,'maxlength'=>15)); ?>
		</div>

		<div class="medium-4 columns end">
			<?php echo $form->label($model,'pass_fund'); ?>
			<?php echo $form->textField($model,'pass_fund',array('size'=>15,'maxlength'=>15)); ?>
		</div>
	</div>
	<div class="row">
    	<div class="medium-4 columns">
        <?php
        $peoples = People::model()->findAll();

        echo $form->label(People::model(),'参与人员（实际执行）');
        $listData = CHtml::listData($peoples,'id','name');
        $listData = array(null=>'选择参与人员')+$listData;
        echo $form->dropDownList(
        	People::model(),
        	'id',$listData,
        	array('id'=>'execute_people','name'=>'People[execute_id]')
        );
        ?>
    	</div>
    	<div class="medium-4 columns end">
        <?php

        echo $form->label(People::model(),'参与人员（责任书）');
        $listData = CHtml::listData($peoples,'id','name');
        $listData = array(null=>'选择参与人员')+$listData;
        echo $form->dropDownList(
        	People::model(),
        	'id',
        	$listData,
        	array('id'=>'liability_people','name'=>'People[liability_id]')
        );
        ?>
    	</div>
    </div>
	<div class="row buttons">
		<div class="medium-4 columns end">
		<?php echo CHtml::submitButton('Search',array('class'=>'button small radius')); ?>
		</div>
	</div>


<?php $this->endWidget(); ?>

</div><!-- search-form -->
<script type="text/javascript">
$(document).ready(function(){
	
		$("#execute_people").select2({
			placeholder: "选择人员",
			width: 'resolve',
			matcher: function(term,text) {
				var pinyin = new Pinyin();
				var mod=pinyin.getCamelChars(text.toUpperCase());
				return mod.indexOf(term.toUpperCase())==0;
			}
		}); 
		$("#liability_people").select2({
			placeholder: "选择人员",
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