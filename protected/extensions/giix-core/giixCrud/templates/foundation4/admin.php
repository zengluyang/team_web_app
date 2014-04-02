<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php
echo "<?php\n
\$this->breadcrumbs = array(
	\$model->label(2) => array('index'),
	Yii::t('app', 'Manage'),
);\n";
?>

$this->menu = array(
	array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index'), 'visible'=>!Yii::app()->user->isGuest ),
	array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create'), 'visible'=>!Yii::app()->user->isGuest ),
// Or with more advanced security:
//	array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index'), 'visible' => Yii::app()->user->checkAccess('<?php echo $this->modelClass; ?>Index') ),
//	array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create'), 'visible' => Yii::app()->user->checkAccess('<?php echo $this->modelClass; ?>Create') ),
);
$this->layout = '//layouts/column1';

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('<?php echo $this->class2id($this->modelClass); ?>-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1 class="subheader"><?php echo '<?php'; ?> echo Yii::t('app', 'Manage') . ' ' . GxHtml::encode($model->label(2)); ?></h1>

<?php echo '<?php // Uncomment the following to secure access: 
// if (!Yii::app()->user->checkAccess(\'' . $this->modelClass . 'Admin\')) { echo \'Access Denied\'; die; } ?>'; ?>

<p>
You may optionally enter a comparison operator (&lt;, &lt;=, &gt;, &gt;=, &lt;&gt; or =) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo "<?php echo GxHtml::link(Yii::t('app', 'Advanced Search') . ' &hellip;', '#', array('class' => 'search-button button small radius secondary')); ?>"; ?>

<div class="search-form">
<?php echo "<?php \$this->renderPartial('_search', array(
	'model' => \$model,
)); ?>\n"; ?>
</div><!-- search-form -->

<?php echo '<?php'; ?> $this->widget('zii.widgets.grid.CGridView', array(
	'id' => '<?php echo $this->class2id($this->modelClass); ?>-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
<?php
$count = 0;
foreach ($this->tableSchema->columns as $column) {
	if (++$count == 7)
		echo "\t\t/*\n";
	echo "\t\t" . $this->generateGridViewColumn($this->modelClass, $column).",\n";
}
if ($count >= 7)
	echo "\t\t*/\n";
?>
		array(
			'class' => 'CButtonColumn',
		),
	),
//	'tagName'=>'div',
//	'itemsCssClass'=>'items',
	'summaryCssClass'=>'summary subheader',
)); ?>
