<?php
/* @var $this EvaluacionesController */
$this->breadcrumbs=array(
	'Evaluaciones',
	"Reporte ".$model->titulo
);
$ej = EvaluacionesEjecutadas::model()->findAll( "id_evento = ".$model->id." AND id_evaluado =".$usuario->id );
$dataGraph = EvaluacionesRespuestas::model()->totalPorRubroEventoUsuario( $model->id, $usuario->id );

?>

<style type="text/css">
	
	.divcolor-0{
		background: #FFFDE9;
		border-bottom: 3px solid #dedede; 
	}
	.divcolor-1{
		background: #fcfcfc;
		border-bottom: 3px solid #dedede; 
	}

</style>

<div class="page-header">
    
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-bar-chart-o page-header-icon"></i>&nbsp;&nbsp;Reporte </h1>

        <div class="col-xs-12 col-sm-8">
<a href="<?echo Yii::app()->baseUrl?>/evaluaciones/print/ev/<?echo $_GET["ev"]?>/u/<?echo $_GET["u"]?>" class="pull-right btn btn-primary" style="display: block;" target="_blank"><i class="fa fa-print"></i>&nbsp;&nbsp;Imprimir</a>            
        </div>
    </div>
</div> <!-- / .page-header -->


<div class="panel">
	<div class="panel-heading"><i class="fa fa-check-circle"></i> Resultados generales </div>	
	<div class="panel-body">
		<div class="row col-md-12">
			<div class="col-md-6 text-center">
				<img src="<?php echo Yii::app()->baseUrl.$usuario->image; ?>" alt="">
					<br>
					<h3><? echo $usuario->nombre ?></h3>
				
			</div>
			<div class="col-md-3 text-center">
				
				<div class="stat-panel">
					<div class="stat-cell bg-info valign-middle">
						<!-- Stat panel bg icon -->
						<i class="fa fa-group bg-icon"></i>
						<!-- Extra large text -->
						<span class="text-xlg"><span class="text-lg text-slim"></span><strong><? echo count($ej) ?></strong></span><br>
						<!-- Big text -->
						<span class="text-bg">Evaluadores</span><br>
						<!-- Small text -->
						<!--<span class="text-sm"><a href="#">See details in your profile</a></span>-->
					</div> <!-- /.stat-cell -->
				</div>

			<!--</div>
			<div class="col-md-3 text-center">-->
				<div class="stat-panel">
					<div class="stat-cell bg-success valign-middle">
						<!-- Stat panel bg icon -->
						<i class="fa fa-check-circle bg-icon"></i>
						<!-- Extra large text -->
						<span class="text-xlg"><span class="text-lg text-slim"></span><strong><? echo EvaluacionesRespuestas::model()->getCalificacionEvaluacionUsuario( $model->id, $usuario->id ) ?></strong></span><br>
						<!-- Big text -->
						<span class="text-bg">Calificación</span><br>
						<!-- Small text -->
						<!--<span class="text-sm"><a href="#">See details in your profile</a></span>-->
					</div> <!-- /.stat-cell -->
				</div>

			</div>
			<div class="col-md-3 text-center">
			<style type="text/css">
			.pa-flot-info{display: none}
			</style>
				<script type="text/javascript">

					
					init.push(function () {
						// Doughnut Chart Data
						var doughnutChartData = [
						{label: "Excelente/Si", data: <?echo $dataGraph["Excelente/Si"]?>}, 
						{label: "Muy bueno", data: <?echo $dataGraph["Muy bueno"]?>}, 
						{label: "Bueno", data: <?echo $dataGraph["Bueno"]?>}, 
						{label: "Regular", data: <?echo $dataGraph["Regular"]?>}, 
						{label: "Malo", data: <?echo $dataGraph["Malo"]?>}, 
						{label: "Muy malo", data: <?echo $dataGraph["Muy malo"]?>}, 
						{label: "Pésimo/No", data: <?echo $dataGraph["Pésimo/No"]?>} 

						];

						// Init Chart
						$('#grafica-total').pixelPlot(doughnutChartData, {
							series: {
								pie: {
									show: true,
									radius: 1,
									innerRadius: 0.5,
									label: {
										show: true,
										radius: 3 / 4,
										formatter: function (label, series) {
											return '<div style="font-size:10px;text-align:center;padding:2px;color:#000;">'+label+ ' ' + Math.round(series.percent) + '%</div>';
										},
										background: { opacity: 0 }
									}
								}
							}
						}, {
							height: 205
						});
					});
				

				</script>
				<div id="grafica-total"></div>
			</div>
		</div>
	</div>
</div>

<div class="panel">
	<div class="panel-heading"><i class="fa fa-bar-chart-o"></i> Resultados por pregunta</div>
	<div class="panel-body">
		<? $flag = 0; ?>
		<? $n = 0; ?>
		<? foreach($model->paquete->preguntas as $preg): $n++;?>
		<div class="row divcolor-<?echo $flag?>">
		<? $flag = ($flag)? 0 : 1 ?>
			<h3><?echo $n.".- ".$preg->pregunta?></h3>
			<div class="col-md-3">
				

			<? $dataGraphP = EvaluacionesRespuestas::model()->totalPorRubroEventoUsuarioPregunta( $model->id, $usuario->id, $preg->id );?>	


								<div class="table-primary">
									
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Respuestas</th>
												<th>#</th>
											</tr>
										</thead>
										<tbody>
										<tr>
											<td>Excelente/Si</td>
											<td><?echo $dataGraphP["Excelente/Si"]?></td>
										</tr>
										<tr>
											<td>Muy bueno</td>
											<td><?echo $dataGraphP["Muy bueno"]?></td>
										</tr>
										<tr>
											<td>Bueno</td>
											<td><?echo $dataGraphP["Bueno"]?></td>
										</tr>
										<tr>
											<td>Regular</td>
											<td><?echo $dataGraphP["Malo"]?></td>
										</tr>
										<tr>
											<td>Malo</td>
											<td><?echo $dataGraphP["Regular"]?></td>
										</tr>
										<tr>
											<td>Muy malo</td>
											<td><?echo $dataGraphP["Muy malo"]?></td>
										</tr>
										<tr>
											<td>Pésimo/No</td>
											<td><?echo $dataGraphP["Pésimo/No"]?></td>
										</tr>
										</tbody>
									</table>
									<div class="table-footer">
										<strong style="font-size:1.5em; color:#af8640" >
										Calificación  : <? echo EvaluacionesRespuestas::model()->getCalificacionEvaluacionUsuarioPregunta( $model->id, $usuario->id,$preg->id ) ?>
										</strong>
									</div>
								</div>			


			</div>


			<style type="text/css">
			.div-respuestas{
				font-size: 14px;
  				//height: 200px;
  				border:1px dashed #ddd;
  				//overflow: scroll;
			}
			.div-respuestas div{
				border-bottom: 1px solid #FFFAD7;
				padding: 5px;
			}
			.div-respuestas div:hover{
				background: #FFFAD7;
				
			}
			</style>
			<div class="col-md-7"> 
				<h4><i class="fa fa-comments"></i> Comentarios de pregunta</h4> 
				<div class="div-respuestas">
				<? $respuestas = EvaluacionesRespuestas::model()->findAll( "id_evento = ".$model->id." AND id_evaluado = ".$usuario->id." AND id_pregunta = ".$preg->id ); ?>
				<?foreach($respuestas as $res):?>
					<div><? echo $res->comentario ?></div>
				<?endforeach?>
				</div>
			</div>
			<div class="col-md-2">  

				<script type="text/javascript">

					
					init.push(function () {
						// Doughnut Chart Data
						var doughnutChartData = [
						{label: "E", data: <?echo $dataGraphP["Excelente/Si"]?>}, 
						{label: "MB", data: <?echo $dataGraphP["Muy bueno"]?>}, 
						{label: "B", data: <?echo $dataGraphP["Bueno"]?>}, 
						{label: "R", data: <?echo $dataGraphP["Regular"]?>}, 
						{label: "M", data: <?echo $dataGraphP["Malo"]?>}, 
						{label: "MM", data: <?echo $dataGraphP["Muy malo"]?>}, 
						{label: "P", data: <?echo $dataGraphP["Pésimo/No"]?>} 

						];

						// Init Chart
						$('#grafica-pregunta-<?echo $preg->id?>').pixelPlot(doughnutChartData, {
							series: {
								pie: {
									show: true,
									radius: 1,
									innerRadius: 0.5,
									label: {
										show: true,
										radius: 3 / 4,
										formatter: function (label, series) {
											return '<div style="font-size:8px; text-align:center;padding:2px;color:#000;">'+label+ ' ' + Math.round(series.percent) + '%</div>';
										},
										background: { opacity: 0 }
									}
								}
							}
						}, {
							height: 205
						});
					});
				

				</script>
				<div id="grafica-pregunta-<?echo $preg->id?>"></div>

			</div>
		</div>
		<?endforeach?>	
		<div class="row">
			<h3><i class="fa fa-comments"></i> Comentarios</h3>
			<div class="div-respuestas">
				<? $comentarios = EvaluacionesComentarios::model()->findAll( "id_evento =".$model->id." AND id_evaluado = ".$usuario->id  ) ?>
				<? foreach($comentarios as $com): ?>
					<div><?echo $com->comentario?></div>
				<?endforeach?>
			</div>

		</div>
	</div>
</div>