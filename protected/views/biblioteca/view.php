<?php

$this->breadcrumbs=array(
	'Biblioteca'=>array("/Biblioteca"),
	$model->titulo

);

	$tipo = BibliotecaEntradas::model()->getTipo( $model->tipo );

?>



<div class="row">
	<div class="col-sm-12">



		<form class="panel form-horizontal" id="form-new-" method="post">
			<div class="panel-heading">
				<span class="panel-title"><i class="fa fa-book"></i> <? echo $model->titulo ?></span>
			</div>
			<div class="panel-body">
			<div class="col-sm-2 text-center">
				<img src="<?echo Yii::app()->baseUrl.$model->usuario->image?>" style="border-radius:50%">
				<h4><i class="fa fa-user"></i> <?echo $model->usuario->nombre?></h4>
			</div>
			<div class="col-sm-10">
				<h1><i class="fa fa-book"></i> <?echo $model->titulo?> </h1>
				<p>
					
					<? foreach($model->tags as $tag): ?>
							<span class="label label-defautl"><? echo $tag->tag->tag ?></span>
							<?endforeach?>
				</p>
				<p><?echo $model->descripcion?></p>
				<? if(count($model->archivos)>0): ?>
				<p>
					
					<!-- Primary table -->
					<div class="table-light">
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
						<div class="table-footer"></div>
					</div>

				</p>
				<?endif?>

<!-- 16. $COMMENTS =================================================================================

				Comments
-->
			<div class="col-sm-12">
			<div class="panel widget-comments">
				<div class="panel-heading">
					<span class="panel-title"><i class="panel-title-icon fa fa-comment-o"></i></span>
					<a data-toggle="modal" data-target="#modal-comments" class="btn btn-primary btn-sm pull-right"><i class="fa fa-comment"></i> Añadir comentario</a>
				</div> <!-- / .panel-heading -->
				<div class="panel-body" id="tbcomments"></div> <!-- / .panel-body -->
			</div> <!-- / .panel -->
			<!-- /16. $COMMENTS -->
			</div>
		

			<div id="modal-comments" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
				<div class="modal-dialog ">
					<div class="modal-content">
						<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title"><i class="fa fa-comment"></i> Añadir comentario</h4>
						</div>
						<div class="modal-body">
							
							<div class="form-group">
								<label for="comment" class="col-sm-2 control-label">Comentario</label>
								<div class="col-sm-10">
									<textarea id="comment" class="form-control" placeholder="Comentario"></textarea>
								</div>
							</div> <!-- / .form-group -->				

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal" id="cnl-comment">Cancelar</button>
							<button type="button" class="btn btn-primary" id="save-comment" >Guardar</button>
						</div>

					</div> <!-- / .modal-content -->
				</div> <!-- / .modal-dialog -->

			</div> <!-- / .modal -->
			<!-- / Small modal -->

			</div>



				<script type="text/javascript">
				init.push(function () { 
					getFiles();
					getComments();
					$("#save-comment").click(function(){
						var comment = $("#comment").val();
						if(comment!=""){
							$.getJSON(baseUrl+"/biblioteca/json",{op:"saveComment",id:<?echo $model->id?>,comment:comment},function(r){
								if(r.status){
									$("#comment").val("");
									getComments();
									$("#cnl-comment").click();
									$.growl.notice({title:"Guardado", message: "El comentario se ha guardado correctamente" });
								}else{
									console.log(r);
									$.growl.warning({title:"Error", message: "Error al intentar guardar el comentario" });
								}
							})
						}
					});

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
									
								);
							$("#files-body").append(tr);		
						})

					})
				}

				var getComments = function()
				{
					$("#tbcomments").html("");
					$.get(baseUrl+"/biblioteca/comments/<?echo $model->id?>",function(data){
						$("#tbcomments").html(data);
					})
				}				
				</script>

				

			</div>
		</form>


	</div>
</div>