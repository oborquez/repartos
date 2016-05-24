<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */

$this->breadcrumbs=array(
    "Usuarios"=>array("/usuarios"),
	'Administración',
);

$this->menu=array(
	array('label'=>'List Usuarios', 'url'=>array('index')),
	array('label'=>'Create Usuarios', 'url'=>array('create')),
);

?>

<div class="page-header">
    
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-group page-header-icon"></i>&nbsp;&nbsp;Usuarios</h1>

        <div class="col-xs-12 col-sm-8">
            
        </div>
    </div>
</div> <!-- / .page-header -->


 
<div id="gUsuarios"></div>

<script type="text/javascript">

    //var dataSource = <? echo json_encode(object2Array($model)); ?>;


    $(document).ready(function () {
        var crudServiceBaseUrl = baseUrl + "/usuarios/json",
            dataSource = new kendo.data.DataSource({
                transport: {
                    read:  {
                        url: crudServiceBaseUrl + "?op=getUsuarios",
                        dataType: "json"
                        
                    },
                    update: {
                        url: crudServiceBaseUrl + "?op=update",
                        dataType: "json",
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
                            email: { type: "email", validation:{required: true, validationMessage : "Correo electrónico inválido"} },
                            Empresa: {  defaultValue: { id_empresa: 1, nombreEmpresa: "Empresa", validationMessage : "Elíje una empresa"} },
                            Rol: {  defaultValue: { rol: 1, rolName: "Usuario", validationMessage : "Elíje un rol"} }
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
                { field: "Empresa", title: "Empresa", editor: empresasDDL, template: "#=Empresa.nombreEmpresa#" },
                { field: "Rol", title: "Rol", editor: rolesDDL, template: "#=Rol.rolName#" },
                { command: [{name : "edit", text : ""},{name:"impersonar", text:"Impersonar", click:impersonar} , {name:"destroy",text:"", editable : { message : "seguro" } }], title: "&nbsp;", width: "280px" },
                //{ field: "rol", title: "Rol", editor: rolesDDL, template: "#=rol.RolName#" },
                //{ field: "rol_text", title:"Rol" }

                ],
            editable: { 
                mode:"popup",
                confirmation: "¿Estás seguro que quieres eliminar el usuario?",
            },
            edit: function (e) { 
                //console.log(e);
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
    
    function impersonar(e) {
        e.preventDefault();
        var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
        var id = dataItem.id;
        if(confirm("Estás a punto de tomar la identidad de "+dataItem.username)){
            $.getJSON( baseUrl+"/usuarios/impersonar/"+id,function(r){
                if(r.status){
                    window.location.href = baseUrl+"/evaluaciones";
                }
            })
        }
    }    
    var roles = <? echo json_encode(Usuarios::model()->roles4Kendo()) ?>;
    
    function rolesDDL(container, options) { 
        
        $('<input required data-text-field="rolName" data-value-field="rol" data-bind="value:' + options.field + '"/>')
            .appendTo(container)
            .kendoDropDownList({
                autoBind: false,
                dataSource: {
                    transport: {
                        read:{
                            url: baseUrl + "/usuarios/json?op=getRoles",
                            dataType: "json"
                        }
                    }
                }

            });
        }

    function empresasDDL(container, options) { 
            
        $('<input required data-text-field="nombreEmpresa" data-value-field="id_empresa" data-bind="value:' + options.field + '"/>')
            .appendTo(container)
            .kendoDropDownList({
                autoBind: false,
                dataSource: {
                    transport: {
                        read:{
                            url: baseUrl + "/empresas/json?op=getEmpresas4Kendo",
                            dataType: "json"
                        }
                    }
                }

            });
        }

</script>



