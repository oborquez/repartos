
<h3>Datos básicos</h3>
<div id="bdate" class="" style="margin-bottom:100px;">

<form id="basic">
	<table class="table">
		<tr>
			<th>Username: </th>
			<td><?echo $model->username?></td>
		</tr>
		<tr>
			<th style="width:50px;"><label for="nombre" class="required">Nombre: </label></th>
			<td><input type="text" id="nombre" name="nombre" value="<?echo $model->nombre?>" required validationMessage="Debe introducir un nombre válido"></td>
		</tr>
		<tr>
			<th><label for="email" class="required">Email: </label></th>
			<td><input type="email" id="email" name="email" value="<?echo $model->email?>" required validationMessage="Debe introducir un email válido"></td>
		</tr>
		<tr>
			<th>&nbsp;</th>
			<td style="text-align:right;"><a class="k-button" id="basicButton" >Guardar</a></td>
		</tr>
		<tr>
			<td colspan="2" class="status"></td>
			
		</tr>
	</table>
</form>

	<h3>Imágen</h3>
	<table class="table">
		<tr>
			<td>
				<img id="profileImage" src="<?echo Yii::app()->request->baseUrl.'/usuarios/image128/'.Yii::app()->user->id?>">
			</td>
			<td>
				<input type="file" id="image" name="image" >
			</td>
		</tr>
	</table>
	
</div>


