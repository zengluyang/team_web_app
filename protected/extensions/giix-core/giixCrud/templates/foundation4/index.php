<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php
echo "<?php\n
\$this->breadcrumbs = array(
	{$this->modelClass}::label(2),
	Yii::t('app', 'Index'),
);\n";
?>

$this->menu = array(
	array('label'=>Yii::t('app', 'Create') . ' ' . <?php echo $this->modelClass; ?>::label(), 'url' => array('create'), 'visible'=>!Yii::app()->user->isGuest ),
	array('label'=>Yii::t('app', 'Manage') . ' ' . <?php echo $this->modelClass; ?>::label(2), 'url' => array('admin'), 'visible'=>!Yii::app()->user->isGuest ),
// Or with more advanced security:
//	array('label'=>Yii::t('app', 'Create') . ' ' . <?php echo $this->modelClass; ?>::label(), 'url' => array('create'), 'visible' => Yii::app()->user->checkAccess('<?php echo $this->modelClass; ?>Create') ),
//	array('label'=>Yii::t('app', 'Manage') . ' ' . <?php echo $this->modelClass; ?>::label(2), 'url' => array('admin'), 'visible' => Yii::app()->user->checkAccess('<?php echo $this->modelClass; ?>Admin') ),
);
$this->layout = '//layouts/column1';
?>

<h1 class="subheader"><?php echo '<?php'; ?> echo GxHtml::encode(<?php echo $this->modelClass; ?>::label(2)); ?></h1>

<?php echo '<?php // Uncomment the following to secure access: 
// if (!Yii::app()->user->checkAccess(\'' . $this->modelClass . 'Index\')) { echo \'Access Denied\'; die; } ?>'; ?>


<?php 
/* Column Headings */
echo '<?php'; ?> $AttribLabels = <?php echo $this->modelClass; ?>::attributeLabels(); 
?>
<div class="row view headers">
	<div class="small-1 columns">
		<label>
			<?php echo '<?php'; ?> echo GxHtml::encode($AttribLabels['<?php echo $this->tableSchema->primaryKey; ?>']); <?php echo '?>'; ?>
		</label>
	</div>

<?php
$count=0;
foreach ($this->tableSchema->columns as $column):
	if ($column->isPrimaryKey)
		continue;
	if (++$count >= 6)
		continue;
?>
	<div class="small-2 columns">
		<label>
	<?php echo '<?php'; ?> echo GxHtml::encode($AttribLabels['<?php echo $column->name; ?>']); <?php echo '?>'; ?>
		</label>
	</div>
<?php endforeach; ?>
	<div class="small-1 columns">
		<br/>
	</div>
</div>


<?php echo "<?php"; ?> $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'tagName'=>'div',
	'itemsTagName'=>'div',
	'itemsCssClass'=>'items',
	'summaryCssClass'=>'summary subheader',
)); <?php '?>'; ?>
