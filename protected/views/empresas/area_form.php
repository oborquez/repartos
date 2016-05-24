
<div id="notif_modal"></div>
<form id="area_form">
<table class="table">
	<tr>
		<td><label>Título</label></td>
		<td><input id="titulo" name="titulo" value="<?echo $model->titulo?>"></td>
	</tr>
	<tr>
		<td><label>Encargado</label></td>
		<td><input name="encargado" value="<?echo $model->encargado?>"></td>
	</tr>
</table>
	<input type="hidden" name="id" value="<?echo intval($model->id)?>">
</form>
