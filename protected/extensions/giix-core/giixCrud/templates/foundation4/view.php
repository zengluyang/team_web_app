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
	GxHtml::valueEx(\$model),
);\n";
?>

$this->menu=array(
	array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index'), 'visible'=>!Yii::app()->user->isGuest ),
	array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create'), 'visible'=>!Yii::app()->user->isGuest ),
	array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('update', 'id' => $model-><?php echo $this->tableSchema->primaryKey; ?>), 'visible'=>!Yii::app()->user->isGuest ),
	array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model-><?php echo $this->tableSchema->primaryKey; ?>), 'confirm'=>'Are you sure you want to delete this item?'), 'visible'=>!Yii::app()->user->isGuest ),
	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url' => array('admin'), 'visible'=>!Yii::app()->user->isGuest ),
// Or with more advanced security:
//	array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index'), 'visible' => Yii::app()->user->checkAccess('<?php echo $this->modelClass; ?>Index') ),
//	array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create'), 'visible' => Yii::app()->user->checkAccess('<?php echo $this->modelClass; ?>Create') ),
//	array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('update', 'id' => $model-><?php echo $this->tableSchema->primaryKey; ?>), 'visible'=>Yii::app()->user->checkAccess('<?php echo $this->modelClass; ?>Update') ),
//	array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model-><?php echo $this->tableSchema->primaryKey; ?>), 'confirm'=>'Are you sure you want to delete this item?'), 'visible'=>Yii::app()->user->checkAccess('<?php echo $this->modelClass; ?>Delete') ),
//	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin'), 'visible' => Yii::app()->user->checkAccess('<?php echo $this->modelClass; ?>Admin') ),
);
$this->layout = '//layouts/column1';
?>

<h1 class="subheader"><?php echo '<?php'; ?> echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php echo '<?php // Uncomment the following to secure access: 
// if (!Yii::app()->user->checkAccess(\'' . $this->modelClass . 'View\')) { echo \'Access Denied\'; die; } ?>'; ?>

<?php echo '<?php'; ?> $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
<?php
foreach ($this->tableSchema->columns as $column)
		echo $this->generateDetailViewAttribute($this->modelClass, $column) . ",\n";
?>
	),
	'tagName' => 'div',
	'htmlOptions' => array('class'=>'row detailView panel radius'),
//	'itemCssClass' => '',
	'itemTemplate' => '<div class="{class} small-4 columns"><label>{label}</label><span>{value}<br /></span></div>',
)); ?>

<?php foreach (GxActiveRecord::model($this->modelClass)->relations() as $relationName => $relation): ?>
<?php if ($relation[0] == GxActiveRecord::HAS_MANY || $relation[0] == GxActiveRecord::MANY_MANY): ?>
<h2><?php echo '<?php'; ?> echo GxHtml::encode($model->getRelationLabel('<?php echo $relationName; ?>')); ?></h2>
<?php echo "<?php\n"; ?>
	echo GxHtml::openTag('ul');
	foreach($model-><?php echo $relationName; ?> as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('<?php echo strtolower($relation[1][0]) . substr($relation[1], 1); ?>/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
<?php echo '?>'; ?>
<?php endif; ?>
<?php endforeach; ?>
