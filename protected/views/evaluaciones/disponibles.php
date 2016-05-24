<?php
/* @var $this EvaluacionesController */

	$this->breadcrumbs=array(
		'Evaluaciones'=>array("/evaluaciones"),
		'Disponibles'
	);
	$today = date("Y-m-d");
?>
<div class="page-header">
    
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-check-circle page-header-icon"></i>&nbsp;&nbsp; Evaluaciones disponibles </h1>

        <div class="col-xs-12 col-sm-8">
            
        </div>
    </div>
</div> <!-- / .page-header -->

<div class="panel">
	<div class="panel-heading">
		Escoge una de las siguientes evaluaciones:
	</div>
	<div class="panel-body">
		<? $n = 0; ?>
		<?foreach($model as $m):?>
			<?if( $today >= $m->evento->fecha_inicio && $today <= $m->evento->fecha_final ):?>
				<?$n++;?>
				<a href="<?echo Yii::app()->baseUrl?>/evaluaciones/evaluar/<?echo $m->evento->id?>" class="btn btn-lg btn-labeled btn-success">
					<span class="btn-label icon fa fa-play"></span> <?echo $m->evento->titulo?>
				</a>

			<?endif?>
		<?endforeach?>
		<?if($n == 0) echo "No hay evaluaciones disponibles en este momento."?>
	</div>
</div>