<?php
/* @var $this EvaluacionesController */
$this->breadcrumbs=array(
	'Evaluaciones'=>array("/evaluaciones"),
	"Mis resultadoss"=>array("/evaluaciones/misResultados"),
	$model->titulo	
);
?>
<div class="page-header">
    
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-check-circle page-header-icon"></i>&nbsp;&nbsp;Evaluación: <? echo $model->titulo ?></h1>

        <div class="col-xs-12 col-sm-8">
            
        </div>
    </div>
</div> <!-- / .page-header -->

<div class="panel">
	<div class="panel-heading"> Datos generales </div>	
	<div class="panel-body">
		<div class="row sm-12">
			<div clas="sm-4 text-center">
				<img src="<?php echo Yii::app()->baseUrl.Yii::app()->user->getState("image"); ?>" alt="">
				<div class="row">
					<? echo Yii::app()->user->name ?>
				</div>	
			</div>
			<div clas="sm-4 text-center">
				
			</div>
			<div clas="sm-4 text-center">
				
			</div>
		</div>
	</div>
</div>