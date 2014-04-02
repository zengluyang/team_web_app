<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<div class="row wide form">

<?php echo "<?php \$form = \$this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl(\$this->route),
	'method' => 'get',
)); ?>\n"; ?>

<?php foreach($this->tableSchema->columns as $column): ?>
<?php
	$field = $this->generateInputField($this->modelClass, $column);
	if (strpos($field, 'password') !== false)
		continue;
?>
	<div class="small-4 columns">
		<label>
			<?php echo "<?php echo \$form->label(\$model, '{$column->name}'); ?>\n"; ?>
		</label>
		<?php echo "<?php " . $this->generateSearchField($this->modelClass, $column)."; ?>\n"; ?>
	</div>

<?php endforeach; ?>
	<div class="small-12 columns buttons">
		<?php echo "<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>\n"; ?>
	</div>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>

</div><!-- search-form -->
