<?php
/* @var $this MatrizController */
/* @var $model Matriz */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'matriz-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ID_MATRIZ'); ?>
		<?php echo $form->textField($model,'ID_MATRIZ'); ?>
		<?php echo $form->error($model,'ID_MATRIZ'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CODIGO'); ?>
		<?php echo $form->textField($model,'CODIGO'); ?>
		<?php echo $form->error($model,'CODIGO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NOMBRE_MATRIZ'); ?>
		<?php echo $form->textField($model,'NOMBRE_MATRIZ',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'NOMBRE_MATRIZ'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->