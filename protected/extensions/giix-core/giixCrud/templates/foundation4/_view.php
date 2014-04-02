<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<div class="row view">
	<div class="small-1 columns">
		<?php echo '<?php'; ?> echo GxHtml::link(GxHtml::encode($data-><?php echo $this->tableSchema->primaryKey; ?>), array('view', 'id' => $data-><?php echo $this->tableSchema->primaryKey; ?>),array('class'=>'button tiny radius')); <?php echo "?>\n"; ?>
	</div>

<?php
$count=0;
foreach ($this->tableSchema->columns as $column):
	if ($column->isPrimaryKey)
		continue;
	if (++$count == 6) {
		//echo "\t<?php /*\n";
		echo '<a href="#" data-dropdown="drop<?php echo $data->' . $this->tableSchema->primaryKey . '; ?>" class="small-1 columns button tiny secondary radius">&hellip;</a>';
		echo '<div id="drop<?php echo $data->' . $this->tableSchema->primaryKey . '; ?>" class="f-dropdown large content" data-dropdown-content>';
	}
?>
	<div class="small-2 columns">
<?php if ($count >= 6) { ?>
		<label>
	<?php echo '<?php'; ?> echo GxHtml::encode($data->getAttributeLabel('<?php echo $column->name; ?>')); <?php echo '?>'; ?>
		</label>
<?php } ?>
<?php if (!$column->isForeignKey): ?>
	<?php echo '<?php'; ?> echo GxHtml::encode($data-><?php echo $column->name; ?>); <?php echo "?>\n"; ?>
<?php else: ?>
	<?php
	$relations = $this->findRelation($this->modelClass, $column);
	$relationName = $relations[0];
	?>
	<?php echo '<?php'; ?> echo GxHtml::encode(GxHtml::valueEx($data-><?php echo $relationName; ?>)); <?php echo "?>\n"; ?>
<?php endif; ?>
	<br /></div>
<?php endforeach; ?>
<?php
if($count>=7) {
	echo "\t</div>\n";
	
}
?>
</div>
