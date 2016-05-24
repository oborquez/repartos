<?php

$this->breadcrumbs=array(
	'Notificaciones'=>array("/notificaciones/list"),
	$model->asunto

);


?>



<div class="row">
	<div class="col-sm-12">



		<form class="panel form-horizontal" id="form-new-" method="post">
			<div class="panel-heading">
				<span class="panel-title"><i class="fa fa-envelope"></i> <? echo $model->asunto ?></span>
			</div>
			<div class="panel-body">

				<div class="row">
					<label class="col-md-2 control-label">Asunto</label>
					<div class="col-md-10"><?echo $model->asunto?></div>
				</div>
				<div class="row">
					<label class="col-md-2 control-label">Fecha</label>
					<div class="col-md-10"><?echo date("d/m/y H:i:s",strtotime( $model->fecha ))?></div>
				</div>

				<div class="row">
					<label class="col-md-2 control-label">Correo</label>
					<div class="col-md-10"><?echo $model->correo?></div>
				</div>

				<div class="row">
					<label class="col-md-2 control-label">Mensaje</label>
					<div class="col-md-10"><?echo $model->cuerpo?></div>
				</div>
				
				<div class="row">
					<label class="col-md-2 control-label">Estado</label>
					<div class="col-md-10"><i class="fa fa-star<?echo ($model->estado == 1)? '' : '-o'?>"></i></div>
				</div>
				

				
				

			</div>
		</form>


	</div>
</div>