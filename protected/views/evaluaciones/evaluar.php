<?php
/* @var $this EvaluacionesController */
$this->breadcrumbs=array(
	'Evaluaciones',
	"Evaluarción [".$model->titulo."] "
);
?>
<style type="text/css">
	
 .unselectable{
 	
   -ms-user-select: none; /* IE 10+ */
   -moz-user-select: -moz-none;
   -khtml-user-select: none;
   -webkit-user-select: none;
   user-select: none;

 }

</style>
<div class="page-header">
    
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-check-circle page-header-icon"></i>&nbsp;&nbsp;Evaluación: <? echo $model->titulo ?></h1>

        <div class="col-xs-12 col-sm-8">
            
        </div>
    </div>
</div> <!-- / .page-header -->
<form id="form-evaluar" >

<div class="panel">
	<div class="panel-heading">Evaluar a:</div>
	<div class="panel-body" style="font-weight:bold">
	<? if($model->id_estructura==1): ?>
		<? $evaluado = EvaluacionesEvaluados::model()->find( "id_evento =".$model->id ); ?>
		<? echo $evaluado->usuario->nombre ?>
		<input type="hidden" name="id_evaluado" value="<?echo $evaluado->id_usuario?>">
	<?elseif($model->id_estructura==2): ?>

		<? $evaluados = EvaluacionesEvaluados::model()->findAll( "id_evento =".$model->id ); ?>
		<select id="id_evaluado" name="id_evaluado" class="form-control">
		<option value="0"><b>Selecciona para evaluar</b></option>	
		<?foreach($evaluados as $evaluado):?>
			<?if($evaluado->id_usuario != Yii::app()->user->id):?>
				<? $ejecutada = EvaluacionesEjecutadas::model()->find( "id_evaluado =".$evaluado->id_usuario." AND id_evaluador =".Yii::app()->user->id ); ?>
				<?if(!$ejecutada): ?>
					<option value="<?echo $evaluado->id_usuario?>"><?echo $evaluado->usuario->nombre?></option>
				<?endif?>
			<?endif?>
		<?endforeach?>
		</select>
	<?else:?>
		<?echo $model->evaluado?>
	<?endif?>
	</div>
</div>

<div id="div-preguntas" style="<? echo ($model->id_estructura==2)?"display:none":"" ?>">
<?$n = 0; ?>
<?foreach($model->paquete->preguntas as $pregunta): $n++;  ?>
<div class="panel">
	<div class="panel-heading">
		<span class="panel-title"><?echo $n.".- ".$pregunta->pregunta?></span>
	</div>
	<div class="panel-body" >
		<? if($pregunta->tipo == 1): ?>
		<label class="label label-success"><input type="radio" name="pregunta[<?echo $pregunta->id?>]" value="1"> Excelente</label>
		<label class="label label-success"><input type="radio" name="pregunta[<?echo $pregunta->id?>]" value="2"> Muy bueno</label>
		<label class="label label-primary"><input type="radio" name="pregunta[<?echo $pregunta->id?>]" value="3"> Bueno</label>
		<label class="label label-default"><input type="radio" name="pregunta[<?echo $pregunta->id?>]" value="4"> Regular</label>
		<label class="label label-warning"><input type="radio" name="pregunta[<?echo $pregunta->id?>]" value="5"> Malo</label>
		<label class="label label-danger"><input type="radio" name="pregunta[<?echo $pregunta->id?>]" value="6"> Muy malo</label>
		<label class="label label-danger"><input type="radio" name="pregunta[<?echo $pregunta->id?>]" value="7"> Pésimo</label>
		<?else:?>
			<label class="label label-success"><input type="radio" name="pregunta[<?echo $pregunta->id?>]" value="1"> Si</label>
			<label class="label label-danger"><input type="radio" name="pregunta[<?echo $pregunta->id?>]" value="7"> No</label>
		<?endif?>
		<textarea class="form-control" name="comentario[<?echo $pregunta->id?>]" placeholder="Introduce un comentario"></textarea>
	</div>

</div>
<?endforeach?>

<div class="panel">
	<div class="panel-heading">
		<span class="panel-title"><i class="fa fa-comment"></i> Comentarios generales</span>
	</div>
	<div class="panel-body text-center">
		<textarea class="form-control" name="comentarios" placeholder="Introduce un comentario"></textarea>
		<br>
		<a class="btn btn-primary" id="save"><i class="fa fa-save"></i> Guardar y finalizar evaluación</a>
		
	</div>

</div>
</div>

<div class="panel" id="btn-return" style="display:none;">
	<div class="panel-body text-center">
		<a href="<?echo Yii::app()->baseUrl?>/evaluaciones/disponibles" class="btn btn-primary" ><i class="fa fa-check-circle"></i> Volver a evaluaciones</a>
	</div>

</div>
<input type="hidden" name="id_evento" value="<?echo $model->id?>">

</form>


<script type="text/javascript">
	
	init.push(function () {

		$("#id_evaluado").change(function(){

			$("#div-preguntas").show();
			$(this).addClass("unselectable");

		})

		$("#save").click(function(){
			$(this).fadeOut();
			var flag = true;
			var n_preguntas = <?echo $n?>;
			var n_radio =$( "input:checked" ).length;
			if(n_preguntas != n_radio) flag = false;
			$.each($("textarea"),function(){
				if($(this).val()=="") flag = false;
			})

			if(flag){

				$.post(baseUrl+"/evaluaciones/services?op=evaluar",$("#form-evaluar").serialize(),function(r){
					console.log(r);
					if(r.status){
						$.growl.notice({title:" <i class='fa fa-save'></i> Guardado", message: "Se ha guardado la evaluacón de manera correcta" });
						$("#div-preguntas").fadeOut();
						$("#btn-return").fadeIn();

					}else{
						console.log(r);
						$.growl.warning({title:"<i class='fa fa-danger'></i> Error", message: "Hubo un error al intentar guardar la evaluación" });
					}

				},"json")

			}else{
				$("#save").fadeIn();
				$.growl.warning({title:"<i class='fa fa-danger'></i> Valores incorrectos", message: "Es necesario contestar todas las preguntas y comentarios" });
			}
		})

	});	

</script>