<?php
/* @var $this TicketsController */

$this->breadcrumbs=array(
	'Perfil'

);

?>

<div class="row">
	<div class="col-sm-12">
		
		<?if(isset($msg)):?>
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<strong>Perfil guardado.</strong> Los datos de tu perfil se han guardado de manera satisfactoria.
		</div>
		<?endif?>
		<div class="col-sm-6">
				<form action="" class="panel form-horizontal" method="post" enctype="multipart/form-data">
					<div class="panel-heading">
						<span class="panel-title"><i class="fa fa-user"></i> Perfil de usuario</span>
					</div>
					<div class="panel-body">
						<div class="row form-group">
							<label class="col-sm-4 control-label">Username:</label>
							<div class="col-sm-8 text-primary">
								<?echo $model->username?>
							</div>
						</div>
						<div class="row form-group">
							<label class="col-sm-4 control-label">Nombre:</label>
							<div class="col-sm-8">
								<input type="text" name="nombre" class="form-control" value="<?echo $model->nombre?>">
							</div>
						</div>
						<div class="row form-group">
							<label class="col-sm-4 control-label">Email:</label>
							<div class="col-sm-8">
								<input type="email" name="email" class="form-control" value="<?echo $model->email?>">
							</div>
						</div>
						<div class="row form-group">
							<label class="col-sm-4 control-label">Password:</label>
							<div class="col-sm-8">
								<input type="password" name="password" class="form-control" value="" placeholder="Introducir sólo si  cambiarás de contraseña">
								<span class="text-warning">Introducir sólo si  cambiarás de contraseña</span>

							</div>
						</div>
						<hr>
						<div class="row form-group">
							<label class="col-sm-4 control-label">
								<img src="<?echo Yii::app()->baseUrl.Yii::app()->user->getState('image')?>" style="border-radius:50%">
							</label>	
							<div class="col-sm-8">
								<input type="file" name="image" class="form-control" value="" accept="image/*;capture=camera">
							</div>
						</div>
					</div>
					<div class="panel-footer text-right">
						<button class="btn btn-primary">Guardar</button>
					</div>
				</form>			
		</div>

		
	</div>
</div>