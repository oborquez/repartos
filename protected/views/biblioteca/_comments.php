<? foreach($model as $m): ?>
<div class="comment" id-comment="<?echo $m->id?>" >
	<img src="<?php echo Yii::app()->baseUrl.$m->usuario->image; ?>" alt="" class="comment-avatar">
	<div class="comment-body">
		<div class="comment-by">
			<a href="#" title=""><?echo $m->usuario->nombre?></a>
		</div>
		<div class="comment-text">
			<?echo getLinks($m->comentario)?>
		</div>
		<div class="comment-actions">
			<? if($m->id_user == Yii::app()->user->id): ?>
			<!--<a href="#"><i class="fa fa-pencil edt-comment"></i>Editar</a>-->
			<a style="cursor:pointer" class="rmv-comment"><i class="fa fa-times "></i>Eliminar</a>
			<?endif?>
			<span class="pull-right"><? echo date("d/m/Y H:i:s", strtotime($m->fecha)) ?></span>
		</div>
	</div> <!-- / .comment-body -->
</div> <!-- / .comment -->

<?endforeach?>
<script type="text/javascript">
	
	$(document).ready(function(){
		$(".rmv-comment").click(function(){
			if(confirm("¿En realidad desea eliminar el comentario?")){
				var id = $(this).parent().parent().parent().attr("id-comment");
				$.getJSON(baseUrl+"/biblioteca/json",{op:"delComment",id:id},function(r){
					if(r.status){
						$("div[id-comment='"+id+"']").remove();
						$.growl.notice({title:"Guardado", message: "El comentario se ha eliminado correctamente" });
					}else{
						$.growl.warning({title:"Error", message: "Error al intentar eliminar el comentario" });
					}
				})	
			}
			
			
		})
	})

</script>		


<?

function getLinks($str)
{
		// The Regular Expression filter
	$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

	// The Text you want to filter for urls
	//$str = "The text you want to filter goes here. http://google.com";

	// Check if there is a url in the text
	if(preg_match($reg_exUrl, $str, $url)) {

	       // make the urls hyper links
	       return preg_replace($reg_exUrl, "<a href='{$url[0]}' target='_blank'>{$url[0]}</a> ", $str);

	} else {

	       // if no urls in the text just return the text
	       return $str;

	}
}

?>