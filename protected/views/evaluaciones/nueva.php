<?php
/* @var $this EvaluacionesController */

$this->breadcrumbs=array(
	'Evaluaciones',
	'Nueva evaluación'
);
$paquetes = EvaluacionesPaquetes::model()->findAll("id_empresa =".getIdEmpresa());
$estructuras = EvaluacionesEventos::model()->estructuras();
$usuarios = Usuarios::model()->findAll( "id_empresa =".getIdEmpresa()." AND rol = 1" );
?>

<div class="row">
	        <div class="col-xs-12 col-sm-2 pull-right">

            <a href="<?echo Yii::app()->baseUrl?>/biblioteca/view/44" class="btn btn-primary btn-labeled" style="width: 100%;"><span class="btn-label icon fa fa-youtube-play"></span> Video tutorial</a>
        </div>
</div>

				<div class="panel">
					<div class="panel-heading">
						<span class="panel-title"><i class="fa fa-archive"></i> Nueva evaluación</span>
					</div>
					<div class="panel-body">
						
							<div class="wizard ui-wizard-evaluacion">
								<div class="wizard-wrapper">
									<ul class="wizard-steps">
										<li data-target="#wizard-evaluacion-step21" >
											<span class="wizard-step-number">1</span>
											<span class="wizard-step-caption">
												Paso 1
												<span class="wizard-step-description">Título y paquete</span>
											</span>
										</li
										><li data-target="#wizard-evaluacion-step22"> <!-- ! Remove space between elements by dropping close angle -->
											<span class="wizard-step-number">2</span>
											<span class="wizard-step-caption">
												Paso 2
												<span class="wizard-step-description">Fechas de evaluación</span>
											</span>
										</li
										><li data-target="#wizard-evaluacion-step23"> <!-- ! Remove space between elements by dropping close angle -->
											<span class="wizard-step-number">3</span>
											<span class="wizard-step-caption">
												Paso 3
												<span class="wizard-step-description">Evaluar a</span>
											</span>
										</li>
										<li data-target="#wizard-evaluacion-step24"> <!-- ! Remove space between elements by dropping close angle -->
											<span class="wizard-step-number">4</span>
											<span class="wizard-step-caption">
												Paso 4
												<span class="wizard-step-description">Evaluadores</span>
											</span>
										</li>
										<li data-target="#wizard-evaluacion-step25"> <!-- ! Remove space between elements by dropping close angle -->
											<span class="wizard-step-number">5</span>
											<span class="wizard-step-caption">
												Finish
											</span>
										</li>
									</ul> <!-- / .wizard-steps -->
								</div> <!-- / .wizard-wrapper -->
								<form id="form-wizard-evaluacion">
									<div class="wizard-content">
										<div class="wizard-pane" id="wizard-evaluacion-step21">
											
											<div class="form-group">
												<div >
													<label>Título</label>
													<input type="text" id="titulo" name="titulo" class="form-control" placeholder="Título de la evaluación" >
												</div>
											</div> <!-- / .form-group -->				

											<div class="form-group">
												<div >
												<label>Paquete</label>
													<select id="id_paquete" name="id_paquete" class="form-control">

														<? foreach($paquetes as $p): ?>
														<option value="<?echo $p->id?>" ><?echo $p->titulo?></option>
														<?endforeach?>
													</select>
												</div>
											</div> <!-- / .form-group -->				

											<a class="btn btn-primary wizard-next-step-btn">Siguiente</a>
										</div> <!-- / .wizard-pane -->
										<div class="wizard-pane" id="wizard-evaluacion-step22">
											<div class="form-group">
												<div >
												<label>Fecha inicial</label>
												<div class="input-group date" id="bs-datepicker-component">
													<input type="text" class="form-control" name="fecha_inicio" id="fecha_inicio"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												</div>
												</div>
											</div> <!-- / .form-group -->				
											<div class="form-group">
												<div >
												<label>Fecha final</label>
												<div class="input-group date" id="bs-datepicker-component2">
													<input type="text" class="form-control"  name="fecha_final" id="fecha_final"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												</div>
												</div>
											</div> <!-- / .form-group -->				
											<a class="btn wizard-prev-step-btn">Anterior</a>
											<a class="btn btn-primary wizard-next-step-btn">Siguiente</a>
										</div> <!-- / .wizard-pane -->
										<div class="wizard-pane" id="wizard-evaluacion-step23">
											<div class="form-group">
												<div >
												<label>Estructura</label>
													<select id="id_estructura" name="id_estructura" class="form-control">
														<? foreach($estructuras as $k=>$e): ?>
														<option value="<?echo $k?>" ><?echo $e?></option>
														<?endforeach?>
													</select>
												</div>
											</div> <!-- / .form-group -->				
											
											<!-- A un usuario -->
											<div class="form-group tipos" tipo="1">
												<div >
												<label>Evaluar a</label>
													<select id="id_evaluado" name="id_evaluado" class="form-control">
														<?foreach($usuarios as $u):?>
														<option value="<?echo $u->id?>"><?echo $u->nombre?></option>
														<?endforeach?>
													</select>
												</div>
											</div> <!-- / .form-group -->				
											
											<!-- Varios usuarios -->
											<div class="form-group tipos" tipo="2" style="display:none">
												<div >
												<label>Evaluar a</label>
													<div ><input type="checkbox" id="sel-todos"> <b>Seleccionar todos</b></div>
													<?foreach($usuarios as $u):?>
													<div ><input type="checkbox" class="cbx-evaluados" name="evaluados[<?echo $u->id?>]" > <?echo $u->nombre?></div>
													<?endforeach?>
												
												</div>
											</div> <!-- / .form-group -->		

											<!-- Varios ente o topico -->													
											<div class="form-group tipos" tipo="3" style="display:none">

												<div >
												<label>Evaluar a</label>
													<input type="text" name="evaluado" id="evaluado" class="form-control" placeholder="Introduce aquí el ente o tópico">
												</div>
											</div> <!-- / .form-group -->				
											
											
											<a class="btn wizard-prev-step-btn">Anterior</a>
											<a class="btn btn-primary wizard-next-step-btn">Siguiente</a>
										</div> <!-- / .wizard-pane -->
										<div class="wizard-pane" id="wizard-evaluacion-step24">
											<div>
												<label>Selecciona los evaluadores</label>
													<div ><input type="checkbox" id="sel-todos-evaluadores"> <b>Seleccionar todos</b></div>
													<?foreach($usuarios as $u):?>
													<div ><input type="checkbox" class="cbx-evaluadores" name="evaluador[<?echo $u->id?>]" > <?echo $u->nombre?></div>
													<?endforeach?>
											</div>		
											<br><br>			


											<a class="btn wizard-prev-step-btn">Anterior</a>
											<!--<button class="btn btn-success wizard-go-to-step-btn">Ir al paso 2</button>-->
											<a class="btn btn-primary wizard-next-step-btn">Siguiente</a>
										</div> <!-- / .wizard-pane -->
										<div class="wizard-pane" id="wizard-evaluacion-step25">
											Guardar para finalizar<br><br>
											<div id="btns-fin">
												<a class="btn wizard-prev-step-btn">Anterior</a>
												<!--<button class="btn btn-success wizard-go-to-step-btn">Ir al paso 2</button>-->
												<a  class="btn btn-primary" id="finalizar">Finalizar</a>
											</div>
											<a href="<?echo Yii::app()->baseUrl?>/evaluaciones/lista" class="btn btn-primary" id="go2List" style="display:none"><i class="fa fa-list"></i> Volver a lista de evaluaciones</a>
										</div> <!-- / .wizard-pane -->
									</div> <!-- / .wizard-content -->
								</form>
							</div> <!-- / .wizard -->
						
					</div>
				</div>

				<script>
					init.push(function () {
						$('.ui-wizard-evaluacion').pixelWizard({
							onChange: function () {
								//console.log('Paso actual: ' + this.currentStep());
							},
							onFinish: function () {
								// Disable changing step. To enable changing step just call this.unfreeze()
								this.freeze();
								console.log('Wizard is freezed');
								console.log('Finished!');
							}


						});

						$('.wizard-next-step-btn').click(function () {
							$(this).parents('.ui-wizard-evaluacion').pixelWizard('nextStep');
						});

						$('.wizard-prev-step-btn').click(function () {
							$(this).parents('.ui-wizard-evaluacion').pixelWizard('prevStep');
						});

						$('.wizard-go-to-step-btn').click(function () {
							$(this).parents('.ui-wizard-evaluacion').pixelWizard('setCurrentStep', 2);
						});

						$('#ui-wizard-modal').on('show.bs.modal', function (e) {
							var $modal = $(this),
							    $wizard = $modal.find('.ui-wizard-evaluacion'),
							    timer = null,
							    callback = function() {
							    	if (timer) clearTimeout(timer);
							    	if ($modal.hasClass('in')) {
							    		$wizard.pixelWizard('resizeSteps');
							    	} else {
							    		timer = setTimeout(callback, 10);
							    	}
							    };
							callback();
						});

						$('#bs-datepicker-component').datepicker();
						$('#bs-datepicker-component2').datepicker();

						//sel-todos

						$("#sel-todos").click(function(){
							if($(this).is(":checked")){
								$(".cbx-evaluados").attr("checked",true);
							}else{
								$(".cbx-evaluados").attr("checked",false);
							}
						})

						$("#id_estructura").change(function(){
							var tipo = $(this).val();
							console.log(tipo);
							$(".tipos").fadeOut(function(){
								$("div[tipo='"+tipo+"']").fadeIn();
							})
						})

						$("#sel-todos-evaluadores").click(function(){
							if($(this).is(":checked")){
								$(".cbx-evaluadores").attr("checked",true);
							}else{
								$(".cbx-evaluadores").attr("checked",false);
							}
						})

						$("#finalizar").click(function(){
							$.post(baseUrl+"/evaluaciones/services?op=nueva",$("#form-wizard-evaluacion").serialize(),function(r){
								$("#btns-fin").fadeOut();
								if(r.status){
									$.growl.notice({title:" <i class='fa fa-save'></i> Guardado", message: "Se ha guardado la evaluacón de manera correcta" });
									$("#go2List").fadeIn();
								}else{
									console.log(r);
									$.growl.warning({title:"<i class='fa fa-danger'></i> Error", message: "Error al intentar guardar" });
								}
							},"json")
						})

					});
				</script>				