
<? if(isset($errorCode) ):?>
	console.log("LoginErrorCode -> <? echo $errorCode ?> ");
	<?if($errorCode == 1):?>
		$("#error-login").html("Usuario no existe, favor de verificar").fadeIn();
	<?else:?>
		$("#error-login").html("Contraseña incorrecta, por favor verifique que utiliza correctamente las mayúsculas y minúsculas").fadeIn();
	<?endif?>
	
<?else:?>
	console.log("No login error");
<?endif?>
