<?php
/* @var $this EvaluacionesController */
$this->breadcrumbs=array(
	'Evaluaciones',
	"Evaluarción [".$model->titulo."] "
);
?>

<div class="page-header">
    
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-check-circle page-header-icon"></i>&nbsp;&nbsp;Evaluación: <? echo $model->titulo ?></h1>

        <div class="col-xs-12 col-sm-8">
            
        </div>
    </div>
</div> <!-- / .page-header -->

<div class="panel">
	<div class="panel-body">
		Ya has realizado esta evaluación <a href="<?echo Yii::app()->baseUrl?>/evaluaciones/disponibles" class="btn ">Volver</a>
	</div>
</div>