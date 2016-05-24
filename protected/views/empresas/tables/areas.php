<?foreach($empresa->areas as $area):?>
<tr id="area_<?echo $area->id?>">
	<td><?echo $area->titulo?></td>
	<td><?echo $area->encargado?></td>
	<td>
		<a class="btn btn-smal" onclick="editarArea( <?echo $area->id?> )"><i class="icon-edit"></i> Editar</a>
		<a class="btn btn-smal" onclick="eliminarArea( <?echo $area->id?> )"><i class="icon-remove"></i> Eliminar</a>
	</td>
</tr>
<?endforeach?>