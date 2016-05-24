<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */

$this->breadcrumbs=array(
	'Administración',
);



?>

<div class="page-header">
    
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-group page-header-icon"></i>&nbsp;&nbsp;Usuarios</h1>
        <div class="col-xs-12 col-sm-2 pull-right">

            <a href="<?echo Yii::app()->baseUrl?>/biblioteca/view/41" class="btn btn-primary btn-labeled" style="width: 100%;"><span class="btn-label icon fa fa-youtube-play"></span> Video tutorial</a>
        </div>
    </div>
</div> <!-- / .page-header -->

 
<div id="gUsuarios"></div>

<script type="text/javascript">

	


	$(document).ready(function () {
        var crudServiceBaseUrl = baseUrl + "/usuarios/json",
            dataSource = new kendo.data.DataSource({
                transport: {
                    read:  {
                        url: crudServiceBaseUrl + "?op=getUsuariosEmpresa",
                        dataType: "json"
                    },
                    update: {
                        url: crudServiceBaseUrl + "?op=updateUsuarioEmpresa",
                        dataType: "json"
                    },
                    destroy: {
                        url: crudServiceBaseUrl + "?op=delete",
                        dataType: "json"
                    },
                    create: {
                        url: crudServiceBaseUrl + "?op=createUsuarioEmpresa",
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
                            username: { 
                            	type: "string", 
                            	validation: {
						       		//required: { message: "Instroduzca un username" },
						       		custom: function(input){
										input.attr("data-custom-msg","El username ya se encuentra en uso");
						       			var vurl = baseUrl + "/usuarios/json?op=check_username&username="+input.val();
						       			var ret = $.ajax({ 
									      url: vurl, 
									      async: false
									  	 }).responseText;
									   	ret = $.parseJSON(ret);
						       			return ret.check;
						       		} 
							    }

                            },
                            nombre: { type: "string", validation: { required: true, validationMessage : "Por favor introduzca un nombre"} },
                            email: { type: "email", validation:{required: true, validationMessage : "Correo electrónico inválido"} }
                        }
                    }
                }
            });
			
		
        $("#gUsuarios").kendoGrid({
            dataSource: dataSource,
            pageable: true,
            height: 430,
            rezisable: true,
            toolbar: [{name: "create", text: "Agregar nuevo"}],
            columns: [
                { field:"username", title: "Username" },
            	{ field: "nombre", title:"Nombre" },
	            { field: "email", title:"Correo" },
	            { command: [{name : "edit", text : ""}, {name:"destroy",text:"", editable : { message : "seguro" } }], title: "&nbsp;", width: "180px" },
	            

	            ],
            editable: { 
            	mode:"popup",
            	confirmation: "¿Estás seguro que quieres eliminar el usuario?",
        	},
        	edit: function (e) { 
                var editWindow = e.container.data("kendoWindow");
                var update = $(e.container).parent().find(".k-grid-update");  
				var cancel = $(e.container).parent().find(".k-grid-cancel"); 
                $(cancel).html('<span class="k-icon k-cancel"></span>Cancelar');
                $(update).html('<span class="k-icon k-update"></span>Guardar');
                
                if (e.model.isNew()){ 
                    e.container.data("kendoWindow").title('Nuevo usuario');
                    
                }else{
                	e.container.data("kendoWindow").title('Actualizar');
                	$("div[data-container-for='username']").css({"padding":"8px"}).html("<b>"+e.model.username+"</b>");
            	}
       	    }

            
        });
    });
	
	

</script>



