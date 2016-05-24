<?php
/* @var $this EmpresasController */

$this->breadcrumbs=array(
	'Empresas'=>array('/empresas'),
	'Admin',
);
?>

<div class="page-header">
    
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-building-o page-header-icon"></i>&nbsp;&nbsp;Empresas</h1>

        <div class="col-xs-12 col-sm-8">
            
        </div>
    </div>
</div> <!-- / .page-header -->

<div id="gridEmpresas"></div>


<script type="text/javascript">

$(document).ready(function () {
        var crudServiceBaseUrl = baseUrl + "/empresas/json",
            dataSource = new kendo.data.DataSource({
                transport: {
                    read:  {
                        url: crudServiceBaseUrl + "?op=getEmpresas",
                        dataType: "json"
                    },
                    update: {
                        url: crudServiceBaseUrl + "?op=update",
                        dataType: "json"
                    },
                    destroy: {
                        url: crudServiceBaseUrl + "?op=delete",
                        dataType: "json"
                    },
                    create: {
                        url: crudServiceBaseUrl + "?op=create",
                        type:"GET",
                        dataType: "json"
                    },
                    parameterMap: function(options, operation) {
                        if (operation !== "read" && options.models) {
                            return {models: kendo.stringify(options.models)};
                        }
                    }
                },
                //autoSync: true,
                batch: true,
                pageSize: 20,
                schema: {
                    model: {
                        id: "id",
                        fields: {
                            id: { editable: false, nullable: true },
                            nombre: { type: "string", validation: { required: true, validationMessage : "Por favor introduzca un nombre para la empresa"} },
                        }
                    }
                }
            });
			
		
        $("#gridEmpresas").kendoGrid({
            dataSource: dataSource,
            pageable: true,
            height: 430,
            rezisable: true,
            toolbar: [{name: "create", text: "Agregar nueva empresa"}],
            columns: [
                { field: "nombre", title:"Nombre" },
	            { command: [{name : "edit", text : "Editar"}, {name:"destroy",text:"Eliminar", editable : { message : "seguro" } }], title: "&nbsp;", width: "180px" },
	            ],
            editable: { 
            	mode:"popup",
            	confirmation: "¿Estás seguro que quieres eliminar la empresa?",
        	},
        	edit: function (e) { 
                var editWindow = e.container.data("kendoWindow");
                var update = $(e.container).parent().find(".k-grid-update");  
				var cancel = $(e.container).parent().find(".k-grid-cancel"); 
                $(cancel).html('<span class="k-icon k-cancel"></span>Cancelar');
                $(update).html('<span class="k-icon k-update"></span>Guardar');
                
                if (e.model.isNew()){ 
                    e.container.data("kendoWindow").title('Nueva empresa');
                    
                }else{
                	e.container.data("kendoWindow").title('Actualizar');
            	}
       	    }

            
        });
    });
	
	

</script>