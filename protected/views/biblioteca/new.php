<?php
/* @var $this TicketsController */

$this->breadcrumbs=array(
	'Biblioteca'=>array("/Biblioteca"),
	'Nueva entrada'

);

	$tipos = BibliotecaEntradas::model()->getTipos();

?>



<div class="row">
	<div class="col-sm-12">



		<form class="panel form-horizontal" id="form-new-ticket" method="post">
			<div class="panel-heading">
				<span class="panel-title"><i class="fa fa-book"></i> Nueva entrada de biblioteca</span>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label for="titulo" class="col-sm-2 control-label">Título</label>
					<div class="col-sm-10">
						<input type="text" name="titulo" id="titulo" class="form-control" placeholder="Título de entrada de biblioteca">
					</div>
				</div> <!-- / .form-group -->
				
				<div class="form-group">
					<label for="tipo" class="col-sm-2 control-label">Tipo</label>
					<div class="col-sm-10">
						<select id="tipo" name="tipo" class="form-control">
							<?foreach($tipos as $k=>$tipo):?>
							<option value="<?echo $k?>"><?echo $tipo?></option>
							<?endforeach?>
						</select>
					</div>
				</div> <!-- / .form-group -->

				<div class="form-group">
					<label for="descripcion" class="col-sm-2 control-label">Descripción</label>
					<div class="col-sm-10">
						<textarea class="form-control" id="descripcion" name="descripcion"></textarea>
					</div>
				</div> <!-- / .form-group -->


				<div class="form-group">
					<label for="categorias" class="col-sm-2 control-label">Categorías</label>
					<div class="col-sm-10" class="select2-primary">
						<input type="hidden" id="categorias" name="categorias"  placeholder="Escoja o introduzca las categorías de la entrada de biblioteca">
					</div>
				</div> <!-- / .form-group -->


				<script type="text/javascript">
				init.push(function () {

					$("#fecha_limite").datepicker({ "format" : "dd/mm/yyyy", language: "es" });

					if (! $('html').hasClass('ie8')) {
						$('#descripcion').summernote({
							height: 200,
							tabsize: 2,
							codemirror: {
								theme: 'monokai'
							}
						});
					}
						$("#categorias").select2({tags:[<? echo BibliotecaTags::model()->getStringTags() ?>]});
// Setup validation
						$("#form-new-ticket").validate({
							focusInvalid: false,
							rules: {
								'titulo': {
								  required: true,
								  minlength: 6
								},
								'descripcion': {
									required: true,
									
									
								},
								'tipo': {
									required: true,
									
								},

							},
							messages: {
								
							}
						});					
				})

				</script>

				

				<div class="form-group" style="margin-bottom: 0;">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
					</div>
				</div> <!-- / .form-group -->
			</div>
		</form>


	</div>
</div>