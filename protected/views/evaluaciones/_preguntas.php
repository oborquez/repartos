<? foreach($model as $p): ?>
	<tr class="pregunta" rel="<?echo $p->id?>" id="pregunta_<?echo $p->id?>">
		<td><?echo $p->pregunta?></td>
		<td><? echo ($p->tipo == 1)? "Excelente ~ Pésimo" : "Si/No" ?></td>
		<td class="otpion-buttons">
			<a class="btn btn-sm btn-success btn-edt-pregunta" title="Editar pregunta" data-toggle="modal" data-target="#modal-edit" pregunta="<?echo $p->pregunta?>" tipo="<?echo $p->tipo?>" id_pregunta="<?echo $p->id?>"><i class="fa fa-edit"></i></a>
			<a class="btn btn-sm btn-danger del-pregunta" title="Eliminar pregunta" rel="<?echo $p->id?>" > <i class="fa fa-times"></i></a>
		</td>
	</tr>
<?endforeach?>


<script>
	init.push(function () {
		$('.otpion-buttons a').tooltip();
	});
	$(document).ready(function(){
		$( "#tbody" ).sortable({
			update : function(){ ordenar() } 
		});
		
		$(".btn-edt-pregunta").click(function(){

			var id_pregunta = $(this).attr("id_pregunta");
			var pregunta = $(this).attr("pregunta");
			var tipo = $(this).attr("tipo");
			console.log(id_pregunta);
			$("#form-editar-pregunta #pregunta").val(pregunta);
			$("#form-editar-pregunta #id_pregunta").val(id_pregunta);
			$("#form-editar-pregunta #tipo_"+tipo).attr("checked",true);

		})

		$(".del-pregunta").click(function(){
			var id = $(this).attr("rel");
			if(confirm( "Está a punto de eliminar una pregunta" )){
				$.getJSON(baseUrl+"/evaluaciones/services",{op:"delPregunta",id:id},function(r){
					if(r.status){
						$.growl.notice({title:"Eliminada", message: "La pregunta se ha eliminado de manera correcta" });
						$("#pregunta_"+id).fadeOut();
						ordenar();
					}else{
						$.growl.warning({title:"Error", message: "Error al intentar eliminar la pregunta" });
					}
				})
			}
		})
	})		

</script>