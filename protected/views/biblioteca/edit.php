<?php
/* @var $this TicketsController */

$this->breadcrumbs=array(
	'Biblioteca'=>array("/Biblioteca"),
	$model->titulo

);

	$tipos = BibliotecaEntradas::model()->getTipos();

	$strTags = "";
	foreach ($model->tags as $key => $tag) $strTags .= ($strTags!="")? ",".$tag->tag->tag: $tag->tag->tag;
	

?>




<div class="row">
	<div class="col-sm-12">


		<form class="panel form-horizontal" id="form-new-entry" method="post">
			<div class="panel-heading">
				<span class="panel-title"><i class="fa fa-entry"></i> Edición de entrada de biblioteca</span>
			</div>
			<div class="panel-body">
				<div class="col-sm-8">
				<div class="form-group">
					<label for="titulo" class="col-sm-2 control-label">Título</label>
					<div class="col-sm-10">
						<input type="text" name="titulo" id="titulo" class="form-control" placeholder="Título de ticket">
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
						<textarea class="form-control" id="descripcion" name="descripcion"><?echo $model->descripcion?></textarea>
					</div>
				</div> <!-- / .form-group -->

				<div class="form-group">
					<label for="categorias" class="col-sm-2 control-label">Categorías</label>
					<div class="col-sm-10" class="select2-primary">
						<input type="hidden" id="categorias" name="categorias"  placeholder="Escoja o introduzca las categorías de la entrada de biblioteca" value="<?echo $strTags?>" >
					</div>
				</div> <!-- / .form-group -->


				<script type="text/javascript">
				init.push(function () {

					$("#categorias").select2({tags:[<? echo BibliotecaTags::model()->getStringTags() ?>]});

					if (! $('html').hasClass('ie8')) {
						$('#descripcion').summernote({
							height: 200,
							tabsize: 2,
							codemirror: {
								theme: 'monokai'
							}
						});
					}

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

				<input type="hidden" name="id" value="<?echo $model->id?>">

				<div class="form-group" style="margin-bottom: 0;">
					<div class="col-sm-offset-2 col-sm-10">
						<a href="<?echo Yii::app()->baseUrl?>/biblioteca" class="btn btn-primary"><i class="fa fa-book"></i> Volver a entradas</a>
						<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
						<!--<a href="<?echo Yii::app()->baseUrl?>/biblioteca" class="btn btn-danger"><i class="fa fa-times"></i> Eliminar</a>-->
					</div>
				</div> <!-- / .form-group -->
				</form>

				</div>

				<div class="col-sm-4">
								<!-- Primary table -->
								<div class="table-primary">
									<div class="table-header">
										<div class="table-caption">
											<i class="fa fa-files-o"> Archivos </i>
										</div>
									</div>
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Nombre</th>
												<th>&nbsp;</th>
												
											</tr>
										</thead>
										<tbody id="files-body"></tbody>
									</table>
									<div class="table-footer">
										<a data-toggle="modal" data-target="#modal-files" class="btn btn-primary" ><i class="fa fa-file"></i> Añadir archivo</a>
									</div>
								</div>

				</div>
			</div>
		


	</div>
</div>

<div id="modal-files" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h4 class="modal-title"><i class="fa fa-files-o"></i> Añadir archivos</h4>
			</div>
			<div class="modal-body">
									
<!-- 14. $DROPZONEJS_FILE_UPLOADS ==================================================================

				Dropzone.js file uploads
-->
				<!-- Javascript -->
				<script>
					init.push(function () {
						$("#dropzonejs-example").dropzone({
							url: baseUrl+"/biblioteca/uploadFiles/<?echo $model->id?>",
							paramName: "file", // The name that will be used to transfer the file
							maxFilesize: 3, // MB
							uploadMultiple : false,
							acceptedFiles : "image/*,.pdf,.psd,.doc,.docx,.ppt,.pptx,.xls,.xlsx",
							dictResponseError: "Archivo no permitido",
							thumbnailWidth: 138,
							thumbnailHeight: 120,
							previewTemplate: '<div class="dz-preview dz-file-preview"><div class="dz-details"><div class="dz-filename"><span data-dz-name></span></div><div class="dz-size">File size: <span data-dz-size></span></div><div class="dz-thumbnail-wrapper"><div class="dz-thumbnail"><img data-dz-thumbnail><span class="dz-nopreview">No preview</span><div class="dz-success-mark"><i class="fa fa-check-circle-o"></i></div><div class="dz-error-mark"><i class="fa fa-times-circle-o"></i></div><div class="dz-error-message"><span data-dz-errormessage></span></div></div></div></div><div class="progress progress-striped active"><div class="progress-bar progress-bar-success" data-dz-uploadprogress></div></div></div>',

							resize: function(file) {
								var info = { srcX: 0, srcY: 0, srcWidth: file.width, srcHeight: file.height },
									srcRatio = file.width / file.height;
								if (file.height > this.options.thumbnailHeight || file.width > this.options.thumbnailWidth) {
									info.trgHeight = this.options.thumbnailHeight;
									info.trgWidth = info.trgHeight * srcRatio;
									if (info.trgWidth > this.options.thumbnailWidth) {
										info.trgWidth = this.options.thumbnailWidth;
										info.trgHeight = info.trgWidth / srcRatio;
									}
								} else {
									info.trgHeight = file.height;
									info.trgWidth = file.width;
								}
								return info;
							},
							init: function(){
								this.on("success",function(file){
									getFiles()
								})
							}
						});
					});
				</script>
				<!-- / Javascript -->
				<div id="dropzonejs-example" class="dropzone-box">
					<div class="dz-default dz-message">
						<i class="fa fa-cloud-upload"></i>
						Pon tu archivo auí<br><span class="dz-text-small">o selecciona dando clic</span>
					</div>
					<form >
						<div class="fallback">
							<input name="file" type="file" multiple="" />
						</div>
					</form>
				</div>				
<!-- /14. $DROPZONEJS_FILE_UPLOADS -->
			</div>

		</div> <!-- / .modal-content -->
	</div> <!-- / .modal-dialog -->

</div> <!-- / .modal -->
<!-- / Small modal -->


<script type="text/javascript">
		// values
		
		$("#titulo").val("<?echo $model->titulo?>");
		$("#tipo").val(<?echo $model->tipo?>);


		$(document).ready(function(){

			getFiles();

		})

		var getFiles = function()
		{
			$("#files-body").html("");
			$.getJSON(baseUrl+"/biblioteca/json",{op:"getEntryFiles",id:<?echo $model->id?>},function(r){
				//console.log(r);	
				$.each(r.files,function(k,item){
						var tr = $("<tr>").attr("file",item.id)
						.append( $("<td>").append( item.nombre))
						.append( 
							$("<td>")
							.append($("<a>").attr("href",baseUrl+"/biblioteca/viewFile/"+item.id).addClass("btn btn-xs btn-primary").append($("<i>").addClass("fa fa-file")))
							.append(
								$("<a>").addClass("btn btn-xs btn-danger del-ticket").append($("<i>").addClass("fa fa-times"))
								.click(function(){
									if(confirm("En realidad desea eliminar el archivo?")){
										console.log(item.id);
										$.getJSON(baseUrl+"/biblioteca/json",{op:"delFile",id:item.id},function(r){
											console.log(r);
											if(r.status){
												$("tr[file='"+item.id+"']").fadeOut();
												$.growl.notice({title:"Eliminado", message: "Archivo eliminado de manera correcta" });
											}else{
												console.log(r);
												$.growl.warning({title:"Error", message: "Error al intentar eliminar el archivo" });
											}
										})
									}
								})
							)
							
						);
					$("#files-body").append(tr);		
				})

			})
		}

</script>
