
<!DOCTYPE html>
<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie9 gt-ie8"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="gt-ie8 gt-ie9 not-ie"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Reporte de evaluación - <? echo $usuario->nombre ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

	<!-- Open Sans font from Google CDN -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin" rel="stylesheet" type="text/css">

	<!-- Pixel Admin's stylesheets -->
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/PixelAdmin/stylesheets/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/PixelAdmin/stylesheets/pixel-admin.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/PixelAdmin/stylesheets/pages.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/PixelAdmin/stylesheets/rtl.min.css" rel="stylesheet" type="text/css">

	<!--[if lt IE 9]>
		<script src="assets/javascripts/ie.min.js"></script>
	<![endif]-->

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<style type="text/css">
	.invoice-recipient:before{
		content:""!important;
	}
	</style>

</head>
<?
$ej = EvaluacionesEjecutadas::model()->findAll( "id_evento = ".$model->id." AND id_evaluado =".$usuario->id );
$dataGraph = EvaluacionesRespuestas::model()->totalPorRubroEventoUsuario( $model->id, $usuario->id );
?>

<body class="page-invoice page-invoice-print">
	<script>
		window.onload = function () {
			window.print();
		};
	</script>

	<div class="invoice">
		<div class="invoice-header">
			<h3>
				<div>
					<img src="<?php echo Yii::app()->baseUrl.$usuario->image; ?>" alt="">
					
				</div>
			</h3>
			<address>
				<strong><? echo $usuario->nombre ?></strong><br>
				<strong>Evaluación: </strong><?echo $model->titulo?><br>
				Reporte de evaluación

				
			</address>
			<div class="invoice-date">
				<small><strong>Fecha</strong></small><br>
				<smal>
				<?echo date("d/m/y",strtotime($model->fecha_inicio))?> - <? echo date("d/m/y",strtotime($model->fecha_final))?>
				</smal>
			</div>
		</div> <!-- / .invoice-header -->
		<div class="invoice-info">
			<div class="invoice-recipient">
				<table style="width:200px;">
					<tr>
						<td><strong><i class="fa fa-group"></i> Evaluadores</strong></td>
						<td><? echo count($ej) ?></td>
					</tr>
				</table>
				
			</div> <!-- / .invoice-recipient -->
			<div class="invoice-total">
				<span><? echo EvaluacionesRespuestas::model()->getCalificacionEvaluacionUsuario( $model->id, $usuario->id ) ?></span>
				CALIFICACIÓN:
			</div> <!-- / .invoice-total -->
		</div> <!-- / .invoice-info -->
		<hr>
		<div class="invoice-table">
			<table>
				<thead>
					<tr>
						<th>
							Preguntas / Comentarios
						</th>
						<th>
							Gráfica
						</th>
						<th style="text-align:center">	E</th>
						<th style="text-align:center">MB</th>
						<th style="text-align:center">B</th>
						<th style="text-align:center">R</th>
						<th style="text-align:center">M</th>
						<th style="text-align:center">MM</th>
						<th style="text-align:center">P</th>
						<th style="text-align:center">Calificación:</th>
					</tr>
				</thead>
				<tbody>
					<? $n = 0; ?>
					<? foreach($model->paquete->preguntas as $preg): $n++;?>
					<? $dataGraphP = EvaluacionesRespuestas::model()->totalPorRubroEventoUsuarioPregunta( $model->id, $usuario->id, $preg->id );?>						
						<tr>
							<td>
								<?echo $n.".- ".$preg->pregunta?>
								<div class="invoice-description">
									<div><strong><i class="fa fa-comments"></i> Comentarios:</strong></div>
									<ul>
									<? $respuestas = EvaluacionesRespuestas::model()->findAll( "id_evento = ".$model->id." AND id_evaluado = ".$usuario->id." AND id_pregunta = ".$preg->id ); ?>
									<?foreach($respuestas as $res):?>
										<li><? echo $res->comentario ?></li>
									<?endforeach?>
									</ul>
								</div>
							</td>
							<td>


								<script type="text/javascript">
							      google.load("visualization", "1", {packages:["corechart"]});
							      google.setOnLoadCallback(drawChart);
							      function drawChart() {

							        var data = google.visualization.arrayToDataTable([
							          ['Calificaciones', '#'],
							          ['E', <?echo $dataGraphP["Excelente/Si"]?>],
							          ['MB',<?echo $dataGraphP["Muy bueno"]?>],
							          ['B', <?echo $dataGraphP["Bueno"]?>],
							          ['R', <?echo $dataGraphP["Regular"]?>],
							          ['M', <?echo $dataGraphP["Malo"]?>],
							          ['MM',<?echo $dataGraphP["Muy malo"]?>],
							          ['P', <?echo $dataGraphP["Pésimo/No"]?>]
							        ]);

							        var options = {
							          legend: 'none',
							        };

							        var chart = new google.visualization.PieChart(document.getElementById('piechart-<? echo $preg->id ?>'));

							        chart.draw(data, options);
							      }
							    </script>

							    <div id="piechart-<? echo $preg->id ?>" style="width: 100px; height: 50px;"></div>

								
							</td>
							<td style="text-align:center"><?echo $dataGraphP["Excelente/Si"]?></td>
							<td style="text-align:center"><?echo $dataGraphP["Muy bueno"]?></td>
							<td style="text-align:center"><?echo $dataGraphP["Bueno"]?></td>
							<td style="text-align:center"><?echo $dataGraphP["Regular"]?></td>
							<td style="text-align:center"><?echo $dataGraphP["Malo"]?></td>
							<td style="text-align:center"><?echo $dataGraphP["Muy malo"]?></td>
							<td style="text-align:center"><?echo $dataGraphP["Pésimo/No"]?></td>
							<td  style="font-size:1.5em;text-align:center"><strong><? echo EvaluacionesRespuestas::model()->getCalificacionEvaluacionUsuarioPregunta( $model->id, $usuario->id,$preg->id ) ?></strong></td>
						</tr>

					<?endforeach?>

				</tbody>
			</table>
		</div> <!-- / .invoice-table -->


		<div class="invoice-table">
			<table>
				<thead>
					<tr>
						<th>
							<i class="fa fa-comments"></i> Comengarios Generales
						</th>

					</tr>
				</thead>
				<tbody>
				<tr>
					<td>
						<ul>
						<? $comentarios = EvaluacionesComentarios::model()->findAll( "id_evento =".$model->id." AND id_evaluado = ".$usuario->id  ) ?>
						<? foreach($comentarios as $com): ?>
							<li><?echo $com->comentario?></li>
						<?endforeach?>
							
						</ul>						

					</td>
				</tr>
				</tbody>
			</table>
		</div> <!-- / .invoice-table -->

	</div> <!-- / .invoice -->


<!-- Pixel Admin's javascripts -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/PixelAdmin/javascripts/bootstrap.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/PixelAdmin/javascripts/pixel-admin.js"></script>

<script type="text/javascript">
	init.push(function () {
		// Javascript code here
	})
	window.PixelAdmin.start(init);
</script>


</body>
</html>