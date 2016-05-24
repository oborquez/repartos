<?php
/* @var $this EvaluacionesController */
$this->breadcrumbs=array(
	'Evaluaciones',
	'Paquetes de preguntas'=>array("/evaluaciones/paquetes"),
	"Preguntas [".$model->titulo."] "
);
?>
<style type="text/css">
	#tbody tr:active{
		background: rgba(245, 169, 67, 0.77);
	}
</style>


<div class="page-header">
    
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-question page-header-icon"></i>&nbsp;&nbsp;Preguntas</h1>

        <div class="col-xs-12 col-sm-8">
            
        </div>
    </div>
</div> <!-- / .page-header -->

<div class="panel">
	<div class="panel-heading">
		<span class="panel-title">Evaluaciones - Preguntas</span>
	</div>
	<div class="panel-body">
		<div class="row">
			
			<div class="col-sm-12">

				<!-- Tabla de de preguntas -->
				<div class="table-primary">
					<div class="table-header">
						<div class="table-caption">
							Preguntas del paquete "<? echo $model->titulo ?>"
							<button data-toggle="modal" data-target="#modal-new" class="btn btn-labeled btn-info pull-right"><span class="btn-label icon fa fa-plus"></span>Nueva pregunta</button>
						</div>
					</div>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Pregunta</th>
								<th>Tipo</th>
								<th>Opciones</th>
							</tr>
						</thead>
						<tbody id="tbody">
							<? if(count($model->preguntas) == 0): ?>	
							<tr>
								<td colspan="3"> 
									Aún no existen preguntas para el paquete <b><?echo $model->titulo?></b>  <br><br>
									
								</td>
							</tr>
							<?else:?>
							<script type="text/javascript">
							$(document).ready(function(){
								refreshTable(false);
							})
							</script>
							<?endif?>
 
						</tbody>
					</table>
				</div>
				<!-- / Tabla de preguntas -->
				
			</div>
		</div>
	</div>
</div>

<div id="modal-new" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
	<div class="modal-dialog ">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h4 class="modal-title"><i class="fa fa-question"></i> Añadir pregunta</h4>
			</div>
			<div class="modal-body">
				<form id="form-nueva-pregunta">	
					<div class="form-group">
						<label for="pregunta" class="col-sm-2 control-label">Título</label>
						<div class="col-sm-10">
							<input type="text" id="pregunta" name="pregunta" class="form-control" placeholder="Introduce la pregunta" >
						</div>
					</div> <!-- / .form-group -->				
					<hr>
					<div class="form-group">
						<label class="col-sm-12 control-label">Tipo de pregunta:</label>
					</div> <!-- / .form-group -->				

					<div class="form-group" >
						<label class="col-sm-4 " for="tipo_1">Excelente ~ Pésimo</label>
						<div class="col-sm-8">
							<input type="radio" id="tipo_1" name="tipo" value="1" placeholder="Introduce la pregunta" checked>
						</div>
					</div> <!-- / .form-group -->			

						<label class="col-sm-4 " for="tipo_2">Si/No</label>
						<div class="col-sm-8">
							<input type="radio" id="tipo_2" name="tipo" value="2" placeholder="Introduce la pregunta" >
						</div>
					</div> <!-- / .form-group -->			
					<input type="hidden" name="id_paquete" value="<?echo $model->id?>">
				</form>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" id="cnl-new">Cancelar</button>
				<button type="button" class="btn btn-primary" id="save-new" >Guardar</button>
			</div>

		</div> <!-- / .modal-content -->
	</div> <!-- / .modal-dialog -->

</div> <!-- / .modal -->
<!-- / Small modal -->


<div id="modal-edit" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
	<div class="modal-dialog ">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h4 class="modal-title"><i class="fa fa-edit"></i> Editar pregunta</h4>
			</div>
			<div class="modal-body">
				<form id="form-editar-pregunta">	
					<input type="hidden" name="id_pregunta" id="id_pregunta" vaue="0">
					<div class="form-group">
						<label for="pregunta" class="col-sm-2 control-label">Título</label>
						<div class="col-sm-10">
							<input type="text" id="pregunta" name="pregunta" class="form-control" placeholder="Introduce la pregunta" >
						</div>
					</div> <!-- / .form-group -->				
					<hr>
					<div class="form-group">
						<label class="col-sm-12 control-label">Tipo de pregunta:</label>
					</div> <!-- / .form-group -->				

					<div class="form-group" >
						<label class="col-sm-4 " for="tipo_1">Excelente ~ Pésimo</label>
						<div class="col-sm-8">
							<input type="radio" id="tipo_1" name="tipo" value="1" placeholder="Introduce la pregunta" checked>
						</div>
					</div> <!-- / .form-group -->			

						<label class="col-sm-4 " for="tipo_2">Si/No</label>
						<div class="col-sm-8">
							<input type="radio" id="tipo_2" name="tipo" value="2" placeholder="Introduce la pregunta" >
						</div>
					</div> <!-- / .form-group -->			
				</form>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" id="cnl-edit">Cancelar</button>
				<button type="button" class="btn btn-primary" id="save-edit" >Guardar</button>
			</div>

		</div> <!-- / .modal-content -->
	</div> <!-- / .modal-dialog -->

</div> <!-- / .modal -->
<!-- / Small modal -->


<script type="text/javascript">
	
	$(document).ready(function(){

		$("#save-new").click(function(){

			var pregunta = $("#form-nueva-pregunta #pregunta").val();
			if(pregunta.length > 0){
				$.getJSON( baseUrl+"/evaluaciones/services?op=savePregunta",$("#form-nueva-pregunta").serialize(),function(r){
					console.log(r);
					if(r.status){

						$.growl.notice({title:"Guardado", message: "La pregunta se ha guardado correctamente" });
						$("#cnl-new").click();
						$("#form-nueva-pregunta #pregunta").val("");
						refreshTable(true);

					}else{
						console.log(r);
						$.growl.warning({title:"Error", message: "Error al intentar guardar la pregunta" });
						
					}

				})
			}else{
				$.growl.warning({title:"Error", message: "La pregunta no puede estar vacía, itroduzca una pregunta válida" });
			}


		})

		$("#save-edit").click(function(){
			var pregunta = $("#form-editar-pregunta #pregunta").val();
			if(pregunta.length > 0){
				$.getJSON( baseUrl+"/evaluaciones/services?op=editPregunta",$("#form-editar-pregunta").serialize(),function(r){
					console.log(r);
					if(r.status){

						$.growl.notice({title:"Guardado", message: "La pregunta se ha guardado correctamente" });
						$("#cnl-edit").click();
						$("#form-editar-pregunta #pregunta").val("");
						refreshTable(true);

					}else{
						console.log(r);
						$.growl.warning({title:"Error", message: "Error al intentar guardar la pregunta" });
						
					}

				})
			}else{
				$.growl.warning({title:"Error", message: "La pregunta no puede estar vacía, itroduzca una pregunta válida" });
			}
		})

	})

	var refreshTable = function(ordenar)
	{
		$.get( baseUrl+"/evaluaciones/rPreguntas/<?echo $model->id?>" , function(data){
			$("#tbody").html(data);
			if(ordenar) ordenar();
		})
	}

	var ordenar = function()
	{
		var indexes = "";
		$.each($(".pregunta"),function(){
			indexes += (indexes == "")? $(this).attr("rel") : "|"+$(this).attr("rel");
		})
		$.getJSON( baseUrl+"/evaluaciones/services",{op:"ordenarPreguntas",ids:indexes},function(r){
			if(r.status){
				$.growl.notice({title:" <i class='fa fa-save'></i> Orden guardado", message: "El orden se ha guardado correctamente" });
			}else{
				console.log(r);
				$.growl.warning({title:"<i class='fa fa-danger'></i> Error", message: "Error al intentar ordenar las preguntas" });
			}
		})
	}
</script>