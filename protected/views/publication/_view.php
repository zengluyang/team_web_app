<?php
/* @var $this PublicationController */
/* @var $data Publication */
?>

<div class="view">
	<li>
	<?php 
	// echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id));
	echo CHtml::encode($data->getPeoples());
	echo '. ';
	echo CHtml::encode($data->info);
	echo '. ISBN: ';
	echo CHtml::encode($data->isbn_number);
	echo '. (';
	echo CHtml::encode($data->description);
	echo ')';
	?>
	</li>

</div>