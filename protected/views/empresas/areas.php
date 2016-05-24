<?php
/* @var $this LecturasController */
$this->breadcrumbs=array(
	'Áreas de la empresa'
);
?>


<h1>Áreas de la empresa</h1>
<h3><?echo $empresa->nombre?></h3>

<div class="row ar">
	<a  class="btn btn-small" onclick="modalNueva()">
		<i class="icon-plus"></i>
		 Añadir área
	</a>
</div>

<table class="table">
	<thead>
		<tr>
			<th>Área</th>
			<th>Encargado</th>
			<th>Opciones</th>
		</tr>
	</thead>
	<tbody id="tbAreas"></tbody>
</table>


<script type="text/javascript">
	
	$(document).ready(function(){

		fillTbAreas();

	});

	var urlJSON = baseUrl + "/empresas/json";

	var fillTbAreas = function()
	{
		$.get(baseUrl+"/empresas/tbAreas",function(data){
			if(data){
				$("#tbAreas").html("").html(data);
			}
		});
	}

	var modalNueva = function()
	{
		$.get(baseUrl+"/empresas/nuevaArea",function(data){
			var boton = '	<a  class="btn btn-small" onclick="guardarArea()"><i class="icon-ok"></i>Guardar</a>';
			_modal("Nueva área de empresa",data,boton);
		})
	}

	var guardarArea = function()
	{
		var titulo = $("#titulo").val();
		
		if(titulo != ""){

			$.getJSON( baseUrl+"/empresas/json?op=guardarArea",$("#area_form").serialize(),function(r){
				if(r.status){
					_notificacion("exito","OK","Se ha guardado el área correctamente");
					fillTbAreas();
					$(".modal-content .close").click();
				}else{
					$(".modal-content .close").click();
					_notificacion("error","Error","Hubo un error al intentar guardar");
					console.log(r);
				}
			})

		}else{
			$("#notif_modal")
			.addClass("alert alert-error")
			.html("Debe introducir un titulo de área antes de guardar");
		}
	}

	var editarArea = function(id)
	{
		$.get(baseUrl+"/empresas/editarArea/"+id,function(data){
			var boton = '	<a  class="btn btn-small" onclick="guardarArea()"><i class="icon-ok"></i>Guardar</a>';
			_modal( "Edición de empresa",data,boton );
		})
	}

	var eliminarArea = function(id)
	{	if(confirm( "En realidad desea eliminar el área" ))
		$.getJSON(urlJSON,{op:"eliminarArea",id:id},function(r){
			if(r.status){
				_notificacion("exito", "OK" ,"Se ha eliminado el área correctamente");
				$("#area_"+id).fadeOut();
			}else{
				_notificacion("error", "Error" ,"Hubo un error al intentar eliminar");
				console.log(r);
			}
		})
	}

</script>