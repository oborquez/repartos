<?php
/* @var $this BibliotecaController */

$this->breadcrumbs=array(
	'Biblioteca',
);

$tags = BibliotecaTags::model()->findAll();

?>

<div class="page-header">
    
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-book page-header-icon"></i>&nbsp;&nbsp;Biblioteca</h1>

        <div class="col-xs-12 col-sm-2 pull-right">

        	<a href="<?echo Yii::app()->baseUrl?>/biblioteca/new" class="btn btn-primary btn-labeled" style="width: 100%;"><span class="btn-label icon fa fa-plus"></span>Agregar entrada</a>
        </div>
    </div>
</div> <!-- / .page-header -->


<!-- 11. $JQUERY_DATA_TABLES ===========================================================================

				jQuery Data Tables
-->
				<!-- Javascript -->
<script>
	init.push(function () {
		var table = $('#tickets-table').dataTable();
		$('#tickets-table_wrapper .table-caption').text('');
		$('#tickets-table_wrapper .dataTables_filter input').attr('placeholder', 'Buscar..');
		$('#tickets-table_wrapper #tickets-table_previous a').text('Anterior');
		$( "a:contains('Previous')" ).text("Anterior");
		$( "a:contains('Next')" ).text("Siguiente");
		
		$("#tbtickets a").tooltip();	
		$("#tbtickets img").tooltip();
		
	});


</script>
<!-- / Javascript -->

<div class="panel">
	<div class="panel-heading">
		<span class="panel-title"><i class="fa fa-book"></i> Entradas de biblioteca </span>
	</div>
	<div class="panel-body">

	<div class="row">
		<div class="col-sm-12 text-right">
			<? foreach($tags as $tag): ?>
				<a href="<?echo Yii::app()->baseUrl?>/biblioteca<? echo (($id == $tag->id)? "" : "/searchByTag/".$tag->id ) ?>" class="label label-<? echo (($id == $tag->id)? "success" : "" ) ?> label-tag">
					<?echo $tag->tag?>
					(<?echo count( $tag->entradas ) ?>)
				</a>
			<?endforeach?>
		</div>
	</div>
	<br>
		<div class="table-light">
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="tickets-table">
				<thead>
					<tr>
						<th>&nbsp;</th>
						<th>Título</th>
						<th>Tipo</th>
						<th class="text-center">Visitas</th>
						<th class="text-center">Comentarios</th>
						<th class="text-center">Opciones</th>
					</tr>
				</thead>
				<tbody id="tbEntradas">
					<?foreach($model as $m): ?>
					<tr entrada="<?echo $m->id?>">
						<td class="text-center">
							<img src="<?php echo Yii::app()->baseUrl.$m->usuario->image; ?>" style="width:30px; border-radius:50%;" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?echo $m->usuario->nombre?>">
						</td>
						<td><a href="<?echo Yii::app()->baseUrl?>/biblioteca/view/<?echo $m->id?>"><i class="fa fa-book"></i> <?echo $m->titulo?></a></td>
						<td><?echo BibliotecaEntradas::model()->getTipo( $m->tipo )?></td>
						<td class="text-center"><span class="label label-defautl"><?echo intval($m->visitas)?></span></td>
						<td class="text-center"><span class="label label-defautl"><?echo count($m->comentarios)?></span></td>
						<td class="text-center">
							<!--<a href="<?echo Yii::app()->baseUrl?>/tickets/view/<?echo $m->id?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ver ticket"><i class="fa fa-ticket"></i></a>-->
							<? if($m->id_user == Yii::app()->user->id): ?>	
							<a href="<?echo Yii::app()->baseUrl?>/biblioteca/edit/<?echo $m->id?>" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar ticket"><i class="fa fa-edit"></i></a>
							<a class="btn btn-danger btn-xs del-entry" data-toggle="tooltip" data-placement="top" title="" data-original-title="Eliminar entrada" entrada="<? echo $m->id?>"><i class="fa fa-times"></i></a>
							<?endif?>
						</td>

					</tr>
					<?endforeach?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- /11. $JQUERY_DATA_TABLES -->

<script type="text/javascript">
	
	$(document).ready(function(){
		$(".del-entry").click(function(){
			var id = $(this).attr("entrada");
			console.log(id);
			if(confirm( "Se eliminará la entrada" )){
				$.getJSON( baseUrl+"/biblioteca/json",{op:"delEntry",id:id},function(r){
					if(r.status){
						$("tr[entrada='"+id+"']").remove();
						$.growl.notice({title:"Eliminado", message: "Entrada eliminada de manera correcta" });

					}else{
						console.log(r);
						$.growl.warning({title:"Error", message: "Error al intentar eliminar el ticket" });
					}
				})
			}
		})
	})
</script>
