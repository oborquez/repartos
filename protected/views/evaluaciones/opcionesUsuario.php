<div class="page-header">
    
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-check-circle page-header-icon"></i>&nbsp;&nbsp;Opciones: <? echo $model->titulo ?></h1>
        <div class="col-xs-12 col-sm-2 pull-right">

            <a href="<?echo Yii::app()->baseUrl?>/biblioteca/view/45" class="btn btn-primary btn-labeled" style="width: 100%;"><span class="btn-label icon fa fa-youtube-play"></span> Video tutorial</a>
        </div>
    </div>
</div> <!-- / .page-header -->

<div class="panel">
	<div class="panel-heading"> Seleccione la opción deseada </div>
	<div class="panel-body">
		
		<a href="<?echo Yii::app()->baseUrl?>/evaluaciones/disponibles" class="btn btn-lg btn-labeled btn-success">
			<span class="btn-label icon fa fa-check-circle"></span> Evaluaciones disponibles 
		</a>
		
		<a href="<?echo Yii::app()->baseUrl?>/evaluaciones/misResultados" class="btn btn-lg btn-labeled ">
			<span class="btn-label icon fa fa-bar-chart-o"></span> Mis resultados 
		</a>
		
	</div>

</div>