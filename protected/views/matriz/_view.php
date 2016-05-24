<?php
/* @var $this MatrizController */
/* @var $data Matriz */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_MATRIZ')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_MATRIZ), array('view', 'id'=>$data->ID_MATRIZ)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CODIGO')); ?>:</b>
	<?php echo CHtml::encode($data->CODIGO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NOMBRE_MATRIZ')); ?>:</b>
	<?php echo CHtml::encode($data->NOMBRE_MATRIZ); ?>
	<br />


</div>