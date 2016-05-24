<?php
/* @var $this EvaluacionesController */

$this->breadcrumbs=array(
	'Evaluaciones',
	'Lista de evaluaciones'
);
	$paquetes = EvaluacionesPaquetes::model()->findAll("id_empresa =".getIdEmpresa());
?>


<div class="page-header">
    
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-list page-header-icon"></i>&nbsp;&nbsp;Lista de evaluaciones</h1>

        <div class="col-xs-12 col-sm-2 pull-right">

            <a href="<?echo Yii::app()->baseUrl?>/biblioteca/view/44" class="btn btn-primary btn-labeled" style="width: 100%;"><span class="btn-label icon fa fa-youtube-play"></span> Video tutorial</a>
        </div>
    </div>
</div> <!-- / .page-header -->


<div class="panel">
	<div class="panel-heading">
		<span class="panel-title"><i class="fa fa-archive"></i> Evaluaciones</span>
	</div>
	<div class="panel-body">
		<div class="row">
			
			<div class="col-sm-12">

				<!-- Tabla de de preguntas -->
				<div class="table-primary">
					<div class="table-header">
						<div class="table-caption">
							Lista de evaluaciones
							<a href="<?echo Yii::app()->baseUrl?>/evaluaciones/nueva" class="btn btn-labeled btn-info pull-right"><span class="btn-label icon fa fa-plus"></span>Nueva evaluación</a>
						</div>
					</div>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Evaluación</th>
								<th class="text-center">Fecha inicial</th>
								<th class="text-center">Fecha límite</th>
								<th class="text-center">Opciones</th>
							</tr>
						</thead>
						<tbody id="tbody">
					</table>
				</div>
				<!-- / Tabla de preguntas -->
				
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	
	$(document).ready(function(){
		$.get(baseUrl+"/evaluaciones/getEvaluaciones",function(data){

			$("#tbody").html(data);

		})
	})

</script>
