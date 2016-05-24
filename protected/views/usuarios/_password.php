
<h3>Cambiar password</h3>
<div style="min-height:300px;">

<form id="_password">
	<table class="table">
		<tr>
			<th><label for="password" class="required">Nuevo password: </label></th>
			<td><input type="password" id="password" name="password"  required validationMessage="Debe introducir un password válido"></td>
		</tr>
		<tr>
			<th><label for="repassword" class="required">Confirmar password: </label></th>
			<td><input type="password" id="repassword" name="repassword" required custom></td>
		</tr>
		<tr>
			<th>&nbsp;</th>
			<td style="text-align:right;"><a class="k-button" id="passwordButton" >Guardar</a></td>
		</tr>
		<tr>
			<td colspan="2" class="status"></td>			
		</tr>
	</table>
</form>
</div>