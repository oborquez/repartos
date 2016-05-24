<?php
/* @var $this EvaluacionesController */

$this->breadcrumbs=array(
	'Evaluaciones',
	'Configuración'
);
?>
<div class="page-header">
    
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-cog page-header-icon"></i>&nbsp;&nbsp;Configuración</h1>

        <div class="col-xs-12 col-sm-8">
            
        </div>
    </div>
</div> <!-- / .page-header -->

<div class="panel">
	<div class="panel-body">
		<div class="form-inline form-group">
			<label class="">Típo de estadística:</label>
					<select id="tipo_estadistica" class="form-control">
							<option value="0" <? echo ($model->tipo_estadistica == 0)? "selected" : "" ?> >Número</option>
							<option value="1" <? echo ($model->tipo_estadistica == 1)? "selected" : "" ?> >Porcentaje</option>
						</select>
				<a id="savebtn" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</a>	
		</div>
	</div>
</div>

<script type="text/javascript">
		
	$("#savebtn").click(function(){

		$.getJSON( baseUrl+"/evaluaciones/services",{op:"saveConfig",tipo_estadistica:$("#tipo_estadistica").val()},function(r){
			if(r.status){
				$.growl.notice({title:"Guardado", message: "Se ha guardado correctamente" });
			}else{
				$.growl.warning({title:"Error", message: "Error al intentar guardar" });
			}
		})

	})	

</script>