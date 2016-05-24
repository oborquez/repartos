<?php

$this->breadcrumbs=array(
	'Notificaciones',
);

?>

<div class="page-header">
    
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-envelope page-header-icon"></i>&nbsp;&nbsp;Notificaciones</h1>

    </div>
</div> <!-- / .page-header -->

<!-- 11. $JQUERY_DATA_TABLES ===========================================================================

				jQuery Data Tables
-->
				<!-- Javascript -->
<script>
	init.push(function () {
		var table = $('#ppal-table').dataTable({
			"order":[0,'desc']
		});

		$('#ppal-table_wrapper .table-caption').text('');
		$('#ppal-table_wrapper .dataTables_filter input').attr('placeholder', 'Buscar..');
		$('#ppal-table_wrapper #ppal-table_previous a').text('Anterior');
		$( "a:contains('Previous')" ).text("Anterior");
		$( "a:contains('Next')" ).text("Siguiente");
		
		$("#tbPpal a").tooltip();	
		
	});


</script>
<!-- / Javascript -->

<div class="panel">
	<div class="panel-heading">
		<span class="panel-title"><i class="fa fa-envelope"></i> Notificaciones </span>
	</div>
	<div class="panel-body">
		<div class="table-light">
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="ppal-table">
				<thead>
					<tr>
						<th class="text-center">id</th>
						<th><i class="fa fa-bell"></i></th>
						<th><i class="fa fa-calendar"></i></th>
						<th><i class="fa fa-envelope"></i></th>
						<th><i class="fa fa-check-circle"></i></th>
					</tr>
				</thead>
				<tbody id="tbPpal">
					<?foreach($model as $m): ?>
					<tr item="<?echo $m->id?>">
						<td><?echo $m->id?></td>
						<td><a href="<?echo Yii::app()->baseUrl?>/notificaciones/view/<?echo $m->id?>"><?echo $m->asunto?></a></td>
						<td><? echo date( "d/m/y H:i:s", strtotime($m->fecha)) ?></td>
						<td><? echo $m->correo ?></td>
						<td><i class="fa fa-star<?echo ($m->estado == 1)? '' : '-o'?>"></td>
					</tr>
					<?endforeach?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- /11. $JQUERY_DATA_TABLES -->

