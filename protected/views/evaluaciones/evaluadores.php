<?php
/* @var $this EvaluacionesController */
$this->breadcrumbs=array(
	'Evaluaciones',
	"Evaluadores - ".$model->titulo
);

?>

<div class="page-header">
    
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-group page-header-icon"></i>&nbsp;&nbsp;Evaluadores </h1>

        <div class="col-xs-12 col-sm-8">
            
        </div>
    </div>
</div> <!-- / .page-header -->



<div class="panel">
	<div class="panel-body">
		<div class="row">
			
			<div class="col-sm-12">

				
				<div class="table-primary">
					<div class="table-header">
						<div class="table-caption">
							Evaluadores
							
						</div>
					</div>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th colspan="2"><i class="fa fa-group"></i></th>
							</tr>
						</thead>
						<tbody>
							<? foreach($evaluadores as $e): ?>	
								<tr>
									<td style="width:24px"><img src="<? echo Yii::app()->baseUrl.$e->evaluador->image?>" style="width:24px;"></td>
									<td><?echo $e->evaluador->nombre?></td>
								</tr>
							<?endforeach?>

						</tbody>
					</table>
				</div>
				
				
			</div>
		</div>
	</div>
</div>