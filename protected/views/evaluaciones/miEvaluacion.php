<?php
/* @var $this EvaluacionesController */
$this->breadcrumbs=array(
	'Evaluaciones'=>array("/evaluaciones"),
	"Mis resultados"=>array("/evaluaciones/misResultados"),
	$model->titulo	
);

$ej = EvaluacionesEjecutadas::model()->findAll( "id_evento = ".$model->id." AND id_evaluado =".Yii::app()->user->id );
$dataGraph = EvaluacionesRespuestas::model()->totalPorRubroEventoUsuario( $model->id, Yii::app()->user->id );
?>
<div class="page-header">
    
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-bar-chart-o page-header-icon"></i>&nbsp;&nbsp;Evaluación: <? echo $model->titulo ?></h1>

        <div class="col-xs-12 col-sm-8">
            
        </div>
    </div>
</div> <!-- / .page-header -->

<div class="panel">
	<div class="panel-heading"><i class="fa fa-check-circle"></i> Resultados generales </div>	
	<div class="panel-body">
		<div class="row col-md-12">
			<div class="col-md-3 text-center">
				<img src="<?php echo Yii::app()->baseUrl.Yii::app()->user->getState("image"); ?>" alt="">
					<br>
					<h3><? echo Yii::app()->user->name ?></h3>
				
			</div>
			<div class="col-md-5 text-center">
				
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
						<span class="text-xlg"><span class="text-lg text-slim"></span><strong><? echo EvaluacionesRespuestas::model()->getCalificacionEvaluacionUsuario( $model->id, Yii::app()->user->id ) ?></strong></span><br>
						<!-- Big text -->
						<span class="text-bg">Calificación</span><br>
						<!-- Small text -->
						<!--<span class="text-sm"><a href="#">See details in your profile</a></span>-->
					</div> <!-- /.stat-cell -->
				</div>

			</div>
			<div class="col-md-4 text-center">
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
		<? $n = 0; ?>
		<? foreach($model->paquete->preguntas as $preg): $n++;?>
		<div class="row">
			<h3><?echo $n.".- ".$preg->pregunta?></h3>
			<div class="col-md-4">
				<div class="stat-panel text-center">
					<div class="stat-cell bg-warning valign-middle">
						<!-- Stat panel bg icon -->
						<i class="fa fa-question bg-icon"></i>
						<!-- Extra large text -->
						<span class="text-xlg"><span class="text-lg text-slim"></span><strong><? echo EvaluacionesRespuestas::model()->getCalificacionEvaluacionUsuarioPregunta( $model->id, Yii::app()->user->id,$preg->id ) ?></strong></span><br>
						<!-- Big text -->
						<span class="text-bg">Calificación pregunta</span><br>
						<!-- Small text -->
						<!--<span class="text-sm"><a href="#">See details in your profile</a></span>-->
					</div> <!-- /.stat-cell -->
				</div>				
			</div>
			<style type="text/css">
			.div-respuestas{
				font-size: 14px;
  				height: 200px;
  				border:1px solid #ccc;
  				overflow: scroll;
			}
			.div-respuestas div{
				border-bottom: 1px solid #FFFAD7;
				padding: 5px;
			}
			.div-respuestas div:hover{
				background: #FFFAD7;
				
			}
			</style>
			<div class="col-md-4">  
				<div class="div-respuestas">
				<? $respuestas = EvaluacionesRespuestas::model()->findAll( "id_evento = ".$model->id." AND id_evaluado = ".Yii::app()->user->id." AND id_pregunta = ".$preg->id ); ?>
				<?foreach($respuestas as $res):?>
					<div><? echo $res->comentario ?></div>
				<?endforeach?>
				</div>
			</div>
			<div class="col-md-4">  

			<? $dataGraphP = EvaluacionesRespuestas::model()->totalPorRubroEventoUsuarioPregunta( $model->id, Yii::app()->user->id, $preg->id );
 ?>	
				<script type="text/javascript">

					
					init.push(function () {
						// Doughnut Chart Data
						var doughnutChartData = [
						{label: "Excelente/Si", data: <?echo $dataGraphP["Excelente/Si"]?>}, 
						{label: "Muy bueno", data: <?echo $dataGraphP["Muy bueno"]?>}, 
						{label: "Bueno", data: <?echo $dataGraphP["Bueno"]?>}, 
						{label: "Regular", data: <?echo $dataGraphP["Regular"]?>}, 
						{label: "Malo", data: <?echo $dataGraphP["Malo"]?>}, 
						{label: "Muy malo", data: <?echo $dataGraphP["Muy malo"]?>}, 
						{label: "Pésimo/No", data: <?echo $dataGraphP["Pésimo/No"]?>} 

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
				<div id="grafica-pregunta-<?echo $preg->id?>"></div>

			</div>
		</div>
		<?endforeach?>
		<div class="row">
			<h3>Comentarios</h3>
			<div class="div-respuestas">
				<? $comentarios = EvaluacionesComentarios::model()->findAll( "id_evento =".$model->id." AND id_evaluado = ".Yii::app()->user->id  ) ?>
				<? foreach($comentarios as $com): ?>
					<div><?echo $com->comentario?></div>
				<?endforeach?>
			</div>

		</div>

	</div>
</div>