<?php
/* @var $this EvaluacionesController */
$this->breadcrumbs=array(
	'Evaluaciones'=>array("/evalaciones"),
	"Error"
);
?>

<div class="alert alert-danger alert-dark">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong><? echo $titulo ?></strong> <? echo $msg ?>
	<a href="<?echo Yii::app()->baseUrl?>/evaluaciones" class="btn btn-default"> Volver </a>
</div>