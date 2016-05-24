<?php
/* @var $this EvaluacionesController */
$this->breadcrumbs=array(
	'Evaluaciones',
	"Generar reporte"
);
?>

<div class="page-header">
    
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-bar-chart-o page-header-icon"></i>&nbsp;&nbsp;Generar reporte </h1>

        <div class="col-xs-12 col-sm-8">
            
        </div>
    </div>
</div> <!-- / .page-header -->

<div class="panel">
	<div class="panel-body">
		<?if($model->id_estructura ==1):?>
			<? $evaluado = EvaluacionesEvaluados::model()->find("id_evento =".$model->id) ?>	
			<a href="<?echo Yii::app()->baseUrl?>/evaluaciones/reporte/ev/<?echo $model->id?>/u/<?echo $evaluado->id_usuario ?>" class="btn btn-lg btn-labeled btn-success">
				<span class="btn-label icon fa fa-check-circle"></span>
				Generar reporte de <? echo $evaluado->usuario->nombre ?> 
			</a>			
		<?elseif($model->id_estructura ==2):?>
			
			<a href="<?echo Yii::app()->baseUrl?>/evaluaciones/reporteGlobal/<?echo $model->id?>" class="btn btn-lg btn-labeled btn-success">
				<span class="btn-label icon fa fa-check-circle"></span>
				Generar reporte global 
			</a>

			<? $evaluados = EvaluacionesEvaluados::model()->findAll("id_evento =".$model->id) ?>
			<table class="table">
				<thead> 
					<tr>
						<th>Colaborador</th>
						<th>Opciones</th>
					</tr>
				</thead>
				<tbody>
			<?foreach($evaluados as $evaluado):?>
					<tr>
						<td><?echo $evaluado->usuario->nombre?></td>
						<td>
							<a href="<?echo Yii::app()->baseUrl?>/evaluaciones/reporte/ev/<?echo $model->id?>/u/<?echo $evaluado->id_usuario?>" class="btn btn-success"><i class="fa fa-bar-chart-o"></i> Resultados</a>
						</td>
					</tr>
			<?endforeach?>
				</tbody>
			</table>
		<?else:?>
			<a href="<?echo Yii::app()->baseUrl?>/evaluaciones/reporte/ev/<?echo $model->id?>/u/0" class="btn btn-lg btn-labeled btn-success">
				<span class="btn-label icon fa fa-check-circle"></span>
				Generar reporte de <? echo $model->evaluado ?> 
			</a>	
		<?endif?>	
	</div>
</div>