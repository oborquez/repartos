
/* profile */

function saveBasic(){

	myAlert("success","Guardado correcto","La información se ha guardado correctamente.");
}

$(document).ready(function(){
 
 	var validator = $("#basic").kendoValidator().data("kendoValidator");

    $("#basicButton").click(function() {
        if (validator.validate()) {
        	var url = baseUrl + "/usuarios/json?op=saveBasicData";
           	var param = $("#basic").serialize();
           	$.getJSON(url,param,function(r){
           		if(r.status)
           			myAlert("success","Guardado correcto","La información se ha guardado correctamente.");		
           		else
           			myAlert("error","Error","Hubo un problema con al intentar guardar la información");
           	});	
           	
        }
    });

    //var validatorPassword = $("#_password").kendoValidator().data("kendoValidator");
	var validatorPassword = $("#_password").kendoValidator({
		rules:{
			custom : function(input){
				return $("#password").val() === input.val();
			}
		},
		messages : {
			required : function(input){
				if(input.attr("id") == "repassword"){
					return "Debe introducir la confirmación";
				}
			},
			custom : "La confirmación no coincide con el nuevo password"
		}
	}).data("kendoValidator");

    $("#passwordButton").click(function() {
        if (validatorPassword.validate()) {
        	var url = baseUrl + "/usuarios/json?op=newPassword";
           	var param = $("#_password").serialize();
           	$.getJSON(url,param,function(r){
           		if(r.status)
           			myAlert("success","Guardado correcto","El password ha cambiado correctamente.");		
           		else
           			myAlert("error","Error","Hubo un problema con al intentar guardar la información");
           	});	
        }
    });


    // picture profile
   $("#image").kendoUpload({
        async: {
            saveUrl: baseUrl+"/usuarios/imageProfile",
            autoUpload: true,
        },
        multiple: false,
       	showFileList :false,
       	success: onSuccessImage
    });


});


function onSuccessImage(e){
	
	var prev =  $("#profileImage").attr("src");
	$("#profileImage")
	.attr("src",baseUrl+"/usuarios/image128/user_opacity_128.jpg")
	.delay(3000)
	.attr("src",prev);

} 