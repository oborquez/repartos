<? $hoy = time() ?>

<?foreach($model as $e):?>
	<tr rel="<?echo $e->id?>" class="tr-evento">
		<td><?echo $e->titulo?></td>
		<td class="text-center"><?echo date("d-m-Y",strtotime($e->fecha_inicio))?></td>	
		<td class="text-center"><?echo date("d-m-Y",strtotime($e->fecha_final))?></td>	
		<td class="text-center">
				
			<? if(strtotime($e->fecha_final) <= $hoy): ?>
				<a href="<? echo Yii::app()->baseUrl ?>/evaluaciones/generarReporte/<?echo $e->id?>" class="btn btn-sm btn-primary"><i class="fa fa-bar-chart-o"></i></a>
			<?endif?>
			<a href="<? echo Yii::app()->baseUrl ?>/evaluaciones/evaluadores/<?echo $e->id?>" class="btn btn-sm btn-warning"><i class="fa fa-group"></i></a>
			<a href="<? echo Yii::app()->baseUrl ?>/evaluaciones/editarFechas/<?echo $e->id?>" class="btn btn-sm btn-success edit-evento" evento="<?echo $e->id;?>" ><i class="fa fa-edit"></i></a>
			<a class="btn btn-sm btn-danger del-evento" evento="<?echo $e->id;?>"><i class="fa fa-times"></i></a>
		</td>
	</tr>
<?endforeach?>

<script type="text/javascript">
	
	$(document).ready(function(){

		$(".del-evento").click(function(r){

			if(confirm("¿En realidad deseas eliminar la evaluación?")){

				var id_evento = $(this).attr("evento");
				
				$.getJSON(baseUrl+"/evaluaciones/services",{op:"delEvento",id : id_evento },function(r){

					if(r.status){
						$("tr[rel='"+id_evento+"']").fadeOut();
						$.growl.notice({title:"Guardado", message: "La evaluación ha sido eliminada de manera correcta" });
					}else{
						console.log(r);
						$.growl.notice({title:"Error", message: "Hubo un error al intentar eliminar la evaluación" });
					}

				})

			}

		})

	})

</script>