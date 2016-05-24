<?php
/* @var $this EvaluacionesController */

$this->breadcrumbs=array(
	'Evaluaciones',
	'Paquetes de preguntas'
);
?>


<div class="page-header">
    
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-folder page-header-icon"></i>&nbsp;&nbsp;Paquetes de preguntas</h1>


        <div class="col-xs-12 col-sm-2 pull-right">

            <a href="<?echo Yii::app()->baseUrl?>/biblioteca/view/43" class="btn btn-primary btn-labeled" style="width: 100%;"><span class="btn-label icon fa fa-youtube-play"></span> Video tutorial</a>
        </div>
    </div>
</div> <!-- / .page-header -->

<div class="panel">
	<div class="panel-heading">
		<span class="panel-title">Evaluaciones - paquetes de preguntas</span>
	</div>
	<div class="panel-body">
		<div class="row">
			
			<div class="col-sm-12">

				<!-- Tabla de paquetes de preguntas -->
				<div class="table-primary">
					<div class="table-header">
						<div class="table-caption">
							Paquetes de preguntas
							<button data-toggle="modal" data-target="#modal-new" class="btn btn-labeled btn-info pull-right"><span class="btn-label icon fa fa-plus"></span>Nuevo paquete</button>
						</div>
					</div>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Título</th>
								<th>Opciones</th>
							</tr>
						</thead>
						<tbody id="tbody">
							<? if(count($model) == 0): ?>	
							<tr>
								<td colspan="2"> 
									Aún no existen paquetes de preguntas para tu empresa <br><br>
									<button class="btn btn-sm btn-labeled btn-primary"><span class="btn-label icon fa fa-plus"></span>Nuevo paquete</button>
								</td>
							</tr>
							<?else:?>
							<? foreach($model as $m): ?>
								<tr rel="<?echo $m->id?>" >
									<td><?echo $m->titulo?></td>
									<td class="otpion-buttons">
										<a href="<?echo Yii::app()->baseUrl?>/evaluaciones/preguntas/<?echo $m->id?>" class="btn btn-sm btn-success" title="Administrar preguntas del paquete"><i class="fa fa-question"></i></a>
										<a class="btn btn-sm btn-danger delPaquete" title="Eliminar paquete" paquete="<?echo $m->id?>" > <i class="fa fa-times"></i></a>
									</td>
								</tr>
							<? endforeach ?>
							<?endif?>
 
						</tbody>
					</table>
				</div>
				<!-- / Tabla de paquetes de preguntas -->
				
			</div>
		</div>
	</div>
</div>

<script>
	init.push(function () {
		$('.otpion-buttons a').tooltip();
	});
</script>

<div id="modal-new" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
	<div class="modal-dialog ">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h4 class="modal-title"><i class="fa fa-folder"></i> Añadir paquete de preguntas</h4>
			</div>
			<div class="modal-body">
				
				<div class="form-group">
					<label for="titulo" class="col-sm-2 control-label">Título</label>
					<div class="col-sm-10">
						<input type="text" id="titulo" class="form-control" placeholder="Título del paquete de preguntas" >
					</div>
				</div> <!-- / .form-group -->				

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" id="cnl-new">Cancelar</button>
				<button type="button" class="btn btn-primary" id="save-new" >Guardar</button>
			</div>

		</div> <!-- / .modal-content -->
	</div> <!-- / .modal-dialog -->

</div> <!-- / .modal -->
<!-- / Small modal -->

<script type="text/javascript">

	$(document).ready(function(){
		$("#save-new").click(function(){
			var titulo = $("#titulo").val();
			if(titulo!=""){
				$.getJSON(baseUrl+"/evaluaciones/services",{op:"savePaquete",titulo:titulo},function(r){
					if(r.status){
						$.growl.notice({title:"Guardado", message: "El paquete se ha guardado correctamente" });
						window.location.href = baseUrl+"/evaluaciones/preguntas/"+r.id;
					}else{
						console.log(r);
						$.growl.warning({title:"Error", message: "Error al intentar guardar el paquete" });
					}
				})
			}
		})

		$(".delPaquete").click(function(){
			if(confirm( "¿En realidad desea eliminar el paquete?" )){
				var id = $(this).attr("paquete");
				$.getJSON(baseUrl+"/evaluaciones/services",{op:"delPaquete",id:id},function(r){
					if(r.status){
						$.growl.notice({title:"Eliminado", message: "El paquete se ha eliminado correctamente" });
						$("tr[rel='"+id+"']").fadeOut();
					}else{
						$.growl.warning({title:"Error", message: "Error al intentar guardar el paquete" });
					}
				})
			}
		})
	})	
	

</script>