<?php
/* @var $this MatrizController */
/* @var $model Matriz */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID_MATRIZ'); ?>
		<?php echo $form->textField($model,'ID_MATRIZ'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CODIGO'); ?>
		<?php echo $form->textField($model,'CODIGO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NOMBRE_MATRIZ'); ?>
		<?php echo $form->textField($model,'NOMBRE_MATRIZ',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->