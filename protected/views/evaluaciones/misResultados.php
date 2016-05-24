<?php
/* @var $this EvaluacionesController */
$this->breadcrumbs=array(
	'Evaluaciones'=>array("/evaluaciones"),
	"Mis resultados"
);
?>
<div class="page-header">
    
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-check-circle page-header-icon"></i>&nbsp;&nbsp;Mis resultados</h1>

        <div class="col-xs-12 col-sm-8">
            
        </div>
    </div>
</div> <!-- / .page-header -->

<div class="panel">
	<div class="panel-body">
	
		<div class="row">
			
			<div class="col-sm-12">

				<!-- Tabla de de preguntas -->
				<div class="table-primary">
					<div class="table-header">
						<div class="table-caption">
							Lista de evaluaciones
						</div>
					</div>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Evaluación</th>
								<th class="text-center">Fecha inicio</th>
								<th class="text-center">Fecha final</th>
								<th class="text-center">Evaluadores</th>
								<th class="text-center">Calificación</th>
								<!--<th class="text-center">Cal %</th>-->
								<th class="text-center">Opciones</th>
							</tr>
						</thead>
						<tbody id="tbody">
							<? $hoy = time() ?>
							<?foreach($model as $m):?>
								<? $ej = EvaluacionesEjecutadas::model()->findAll( "id_evento = ".$m->evento->id." AND id_evaluado =".Yii::app()->user->id ) ?>
								<? if(strtotime($m->evento->fecha_final) <= $hoy): ?>
								<tr>
									<td><? echo $m->evento->titulo ?> </td>
									<td class="text-center"><? echo date("d/m/Y",strtotime($m->evento->fecha_inicio)) ?></td>
									<td class="text-center"><? echo date("d/m/Y",strtotime($m->evento->fecha_final)) ?></td>
									<td class="text-center"><? echo count($ej) ?></td>
									<td class="text-center"><? echo EvaluacionesRespuestas::model()->getCalificacionEvaluacionUsuario( $m->evento->id, Yii::app()->user->id ) ?></td>
									<!--<td class="text-center">0</td>-->
									<td class="text-center"><a href="<? echo Yii::app()->baseUrl ?>/evaluaciones/miEvaluacion/<?echo $m->evento->id?>" class="btn  btn-warning"><i class="fa fa-bar-chart-o"></i> Evaluación</a></td>
								</tr>
								<?endif?>
							<?endforeach?>
						</tbody>
					</table>
				</div>
				<!-- / Tabla de preguntas -->
				
			</div>
		</div>	

	</div> 
</div>