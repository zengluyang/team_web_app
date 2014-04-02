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
	GxHtml::valueEx(\$model) => array('view', 'id' => GxActiveRecord::extractPkValue(\$model, true)),
	Yii::t('app', 'Update'),
);\n";
?>

$this->menu = array(
	array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index'), 'visible'=>!Yii::app()->user->isGuest ),
	array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create'), 'visible'=>!Yii::app()->user->isGuest ),
	array('label' => Yii::t('app', 'View') . ' ' . $model->label(), 'url'=>array('view', 'id' => GxActiveRecord::extractPkValue($model, true)), 'visible'=>!Yii::app()->user->isGuest ),
	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url' => array('admin'), 'visible'=>!Yii::app()->user->isGuest ),
// Or with more advanced security:
//	array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index'), 'visible' => Yii::app()->user->checkAccess('<?php echo $this->modelClass; ?>Index') ),
//	array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create'), 'visible' => Yii::app()->user->checkAccess('<?php echo $this->modelClass; ?>Create') ),
//	array('label' => Yii::t('app', 'View') . ' ' . $model->label(), 'url'=>array('view', 'id' => GxActiveRecord::extractPkValue($model, true)), 'visible'=>Yii::app()->user->checkAccess('<?php echo $this->modelClass; ?>View')  ),
//	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin'), 'visible' => Yii::app()->user->checkAccess('<?php echo $this->modelClass; ?>Admin') ),
);
$this->layout = '//layouts/column1';
?>

<h1 class="subheader"><?php echo '<?php'; ?> echo Yii::t('app', 'Update') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php echo '<?php // Uncomment the following to secure access: 
// if (!Yii::app()->user->checkAccess(\'' . $this->modelClass . 'Update\')) { echo \'Access Denied\'; die; } ?>'; ?>

<?php echo "<?php\n"; ?>
$this->renderPartial('_form', array(
		'model' => $model));
?>
