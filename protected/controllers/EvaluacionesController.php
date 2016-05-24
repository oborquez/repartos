<?php

class EvaluacionesController extends Controller
{

public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array(),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array("paquetes","grupos","grupo","services","preguntas","rPreguntas","nueva","lista","getEvaluaciones","evaluar","misResultados","disponibles","miEvaluacion","generarReporte","reporte","reporteGlobal","editarFechas","evaluadores","print","config"),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array("admin"),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	*  ACTIONS *********************************
	*/
	public function actionIndex()
	{
		switch (Yii::app()->user->getState("rol")) {
			case 1:
				$this->render("opcionesUsuario");
				break;
			
			default:
				$this->actionLista();
				break;
		}
	}


	public function actionPaquetes()
	{
		$model = EvaluacionesPaquetes::model()->findAll( "id_empresa =".getIdEmpresa() );
		$this->render('paquetes',array("model"=>$model));

	}

	public function actionPreguntas($id)
	{
		$model = EvaluacionesPaquetes::model()->findByPk( $id );
		$this->render("preguntas",array("model"=>$model));
	}

	public function actionRPreguntas($id)
	{
		$model = EvaluacionesPreguntas::model()->findAll( array( "condition" => "id_paquete =".$id, "order" => "orden ASC" ) );
		$this->renderPartial( "_preguntas",array("model"=>$model));
	}

	public function actionNueva()
	{
		$this->render("nueva");
	}

	public function actionLista()
	{
		$this->render("lista");
	}

	public function actionGetEvaluaciones()
	{
		switch (Yii::app()->user->getState("rol")) {
			case 2:
				$model = EvaluacionesEventos::model()->findAll( "id_empresa =".getIdEmpresa() );
				$this->renderPartial("_eventosAdmin",array("model"=>$model));
			break;		
		}
	}

	public function actionEvaluar($id)
	{
		$model = EvaluacionesEventos::model()->findByPk($id);
		$ej = EvaluacionesEjecutadas::model()->find( "id_evento =".$model->id." AND id_evaluador = ".Yii::app()->user->id  );
		if( ($model->id_estructura == 1 || $model->id_estructura == 3) && $ej ){
			$this->render("error",array( "titulo" => "Completo", "msg" => "Usted ya ha realizado esta evaluación." ));
		}else{
			$this->render("evaluar",array("model"=>$model));
		}		

		
	}

	public function actionDisponibles()
	{
		$model = EvaluacionesEvaluadores::model()->findAll( "id_usuario =".Yii::app()->user->id );
		$this->render( "disponibles",array("model"=>$model) );
	}

	public function actionMisResultados()
	{
		$model = EvaluacionesEvaluados::model()->findAll("id_usuario =".Yii::app()->user->id);
		$this->render("misResultados",array("model"=>$model));
	}

	public function actionMiEvaluacion($id)
	{
		$model = EvaluacionesEventos::model()->findByPk( $id );
		$this->render( "miEvaluacion", array("model" => $model) ); 
	}

	public function actionGenerarReporte($id)
	{
		$model = EvaluacionesEventos::model()->findByPk( $id );
		$this->render("generarReporte",array("model"=>$model));
	}

	public function actionReporte()
	{
		$model = EvaluacionesEventos::model()->findByPk( $_GET["ev"] );
		if($_GET["u"]==0){
			$usuario = new stdClass();
			$usuario->id = 0;
			$usuario->nombre = $model->evaluado;
			$usuario->image = "/assets/PixelAdmin/images/pixel-admin/avatar.png";
		}else{
			$usuario = Usuarios::model()->findByPk( $_GET["u"] );
		}
		$this->render( "reporte", array("model"=>$model,"usuario"=>$usuario) );
	}


	public function actionReporteGlobal($id)
	{
		$model = EvaluacionesEventos::model()->findByPk( $id );
		$this->render("reporteGlobal",array("model"=>$model));

	}

	public function actionEditarFechas($id)
	{
		$model = EvaluacionesEventos::model()->findByPk( $id );
		$this->render("editarFechas",array("model"=>$model));		
	}

	public function actionEvaluadores($id)
	{
		$evaluadores = EvaluacionesEjecutadas::model()->findAll( "id_evento =".$id );
		$model = EvaluacionesEventos::model()->findByPk( $id );
		$this->render("evaluadores",array( "model" => $model,"evaluadores" => $evaluadores ));
	}


	public function actionPrint()
	{
		$model = EvaluacionesEventos::model()->findByPk( $_GET["ev"] );
		if($_GET["u"]==0){
			$usuario = new stdClass();
			$usuario->id = 0;
			$usuario->nombre = $model->evaluado;
			$usuario->image = "/assets/PixelAdmin/images/pixel-admin/avatar.png";
		}else{
			$usuario = Usuarios::model()->findByPk( $_GET["u"] );
		}
		$this->renderPartial( "print", array("model"=>$model,"usuario"=>$usuario) );
	}

	public function actionConfig()
	{
		$model = $this->getConfig();
		$this->render( "config", array("model"=>$model) );
	}

	public function actionGrupos()
	{
		$model = EvaluacionesGrupos::model()->findAll( "id_empresa = ".getIdEmpresa() );
		$this->render("grupos",array( "model" => $model ));
	}

	public function actionGrupo($id)
	{
		$model = EvaluacionesGrupos::model()->findByPk($id);
		$usuarios = Usuarios::model()->findAll( "id_empresa = ".getIdEmpresa()." ORDER BY nombre ASC" );
		if( $model->id_empresa == getIdEmpresa())
			$this->render("grupo",array( "model" => $model, "usuarios"=>$usuarios ));
		else
			$this->redirect("/site/error");
	}

	/**
	* 	SERVICES *********************************
	*/

	public function actionServices()
	{
		$op = ( isset($_GET["op"]) )? $_GET["op"] : $_POST["op"];			
		$ret = $this->{$op}();	
		$ret["origin_data_get"] = $_GET;
		$ret["origin_data_POST"] = $_POST;
	
		echo json_encode($ret);
	}


	private function savePaquete()
	{
		$titulo = $_GET["titulo"];
		$ret["strlen"] = strlen($titulo);
		if(strlen($titulo)>0){

			$model = new EvaluacionesPaquetes;
			$model->id_empresa = getIdEmpresa();
			$model->titulo = $titulo;
			$ret["status"] = $model->save();
			if(!$ret["status"]) $ret["errors"] = $model->getErrors();
			$ret["id"] = $model->primaryKey;

		}else{
			$ret["status"] = false;
			$ret["errors"] = "Título no permitido";
		}
		return $ret;
	}

	private function delPaquete()
	{
		$id = intval($_GET["id"]);
		$model = EvaluacionesPaquetes::model()->findByPk($id);
		if($model->id_empresa == getIdEmpresa()){
			$ret["status"] = $model->delete();
			if(!$ret["status"]) $ret["error"] = $model->getErrors();
		}else{
			$ret["status"] = false;
			$ret["error"] = "No tiene permiso para realizar la acción";
		}
		return $ret;
	}

	private function savePregunta()
	{
		$ret["status"] = true;
		$model = new EvaluacionesPreguntas;
		$model->id_paquete = $_GET["id_paquete"];
		$model->pregunta = $_GET["pregunta"];
		$model->tipo = $_GET["tipo"];
		$model->orden = 0;
		$ret["status"] = $model->save();
		if(!$ret["status"])	
			$ret["error"] = $model->getErrors();

		return $ret;
	}

	private function ordenarPreguntas()
	{
		$ids = explode("|", $_GET["ids"]);
		if(count($ids)>0){
			$k=0;
			foreach($ids as $id){
				$k++;
				$model = EvaluacionesPreguntas::model()->findByPk($id);
				$model->orden = $k;
				$ret["status"] = $model->save();
				if(!$ret["status"]) $ret["error"] = $model->getErrors();
			}
		}else{
			$ret["status"] = false;
			$ret["error"] = "Datos incorrectos";
		}
		return $ret;
	}

	private function editPregunta()
	{
		$id = intval($_GET["id_pregunta"]);
		$model = EvaluacionesPreguntas::model()->findByPk($id);
		$model->pregunta = $_GET["pregunta"];
		$model->tipo = $_GET["tipo"];
		$ret["status"] = $model->save();
		if(!$ret["status"]) $ret["error"] = $model->getErrors();
		return $ret;
	}

	private function delPregunta()
	{
		$id = intval( $_GET["id"] );
		$model = EvaluacionesPreguntas::model()->findByPk($id);
		if($model->paquete->id_empresa == getIdEmpresa()){
			$ret["status"] = $model->delete();
			if(!$ret["status"]) $ret["error"] = $model->getErrors();
		}else{
			$ret["status"] = false;
			$ret["error"] = "Acción no permitida";
		}
		return $ret;
	}

	private function nueva()
	{
		$model = new EvaluacionesEventos;

		// adecuamos las fechas
		$_POST["fecha_inicio"] = date("Y-m-d",strtotime( $_POST["fecha_inicio"] ));
		$_POST["fecha_final"] = date("Y-m-d",strtotime( $_POST["fecha_final"] ));

		$model->setAttributes( $_POST );
		$model->id_empresa = getIdEmpresa();
		$model->evaluado = $_POST["evaluado"];
		if($model->save()){
			$ret["status"] = true;
		}else{
			$ret["status"] = false;
			$ret["error"] = $model->getErrors();
		}

		// guardamos los evaluados segun su estructura
		switch ($model->id_estructura) {

			case 1: // muchos a uno
				$evaluado = new EvaluacionesEvaluados;
				$evaluado->id_evento = $model->id;
				$evaluado->id_usuario = $_POST["id_evaluado"];
				$evaluado->save();
			break;

			case 2: // muchos a muchos
				foreach( $_POST["evaluados"] as $id_evaluado=>$foo ){
					
					$evaluado = new EvaluacionesEvaluados;
					$evaluado->id_evento = $model->id;
					$evaluado->id_usuario = $id_evaluado;
					$evaluado->save();

				}
			break;

			case 3: // ente o topico
				// este viene en string y se guarda en la tabla de eventos
				// por el momento no es necesario realizar ninguna otra acción 
			break;
		}

		// guardamos a los evaluadores
		foreach($_POST["evaluador"] as $id_evaluador=>$foo){
			$evaluador = new EvaluacionesEvaluadores;
			$evaluador->id_evento = $model->id;
			$evaluador->id_usuario = $id_evaluador;
			$evaluador->save();
		}

		return $ret;
	}

	private function evaluar()
	{
		$id_evaluado = (isset($_POST["id_evaluado"]))? $_POST["id_evaluado"] : 0;
		// preguntas
		foreach($_POST["pregunta"] as $k=>$v){
			$res = new EvaluacionesRespuestas;
			$res->id_evento = $_POST["id_evento"];
			$res->id_evaluado = $id_evaluado;
			$res->id_evaluador = Yii::app()->user->id;
			$res->id_pregunta = $k;
			$res->respuesta = $v;
			$res->comentario = $_POST["comentario"][$k];
			$flag["res"][$k] = $res->save();
			if(!$flag["res"][$k]) $ret["errors"][$k] = $res->getErrors();
			$ret["status"] =(in_array(false, $flag["res"]))? false : true;
		}
		// comentarios
		if($flag["res"][$k]){
			$com = new EvaluacionesComentarios;
			$com->id_evento = $_POST["id_evento"];
			$com->id_evaluado = $id_evaluado;
			$com->id_evaluador = Yii::app()->user->id;
			$com->comentario = $_POST["comentarios"];
			$com->save();
		}
		// ejecución
		$ej = new EvaluacionesEjecutadas;
		$ej->id_evento = $_POST["id_evento"];
		$ej->id_evaluado = $id_evaluado;
		$ej->id_evaluador = Yii::app()->user->id;
		$ej->save();

		return $ret;
	}

	// delete evento
	private function delEvento()
	{
		$id = $_GET["id"];
		$model = EvaluacionesEventos::model()->findByPk($id);
		if($model->delete()){

			// DELETE ALL RELATIONS

			EvaluacionesEjecutadas::model()->deleteAll( "id_evento = ".$id );
			EvaluacionesComentarios::model()->deleteAll( "id_evento = ".$id );
			EvaluacionesRespuestas::model()->deleteAll( "id_evento = ".$id );
			EvaluacionesEvaluados::model()->deleteAll( "id_evento = ".$id );
			EvaluacionesEvaluadores::model()->deleteAll( "id_evento = ".$id );

			$ret["status"] = true;
		}else{
			$ret["status"] = false;
			$ret["errors"] = $model->getErrors();
		}

		$ret["status"] = true;

		return $ret;
	}


	public function getConfig()
	{
		$model = EvaluacionesConfig::model()->find( "id_empresa = ".getIdEmpresa() );
		if(!$model){
			$model = new EvaluacionesConfig;
			$model->tipo_estadistica=0;
			$model->id_empresa=getIdEmpresa();
			$model->save();
		}
		return $model;
	}
	
	private function saveConfig()
	{
		$model = $this->getConfig();
		$model->tipo_estadistica = intval( $_GET["tipo_estadistica"] );
		if($model->save()){
			$ret["status"]=true;		
		}else{
			$ret["status"]=false;
			$ret["error"]=$model->getErrors();
		}
		
		return $ret;	
	}	

	private function saveGrupo()
	{
		$titulo = $_GET["titulo"];
		$ret["strlen"] = strlen($titulo);
		if(strlen($titulo)>0){

			$model = new EvaluacionesGrupos;
			$model->id_empresa = getIdEmpresa();
			$model->titulo = $titulo;
			$ret["status"] = $model->save();
			if(!$ret["status"]) $ret["errors"] = $model->getErrors();
			$ret["id"] = $model->primaryKey;

		}else{
			$ret["status"] = false;
			$ret["errors"] = "Título no permitido";
		}
		return $ret;		
	}

	private function delGrupo()
	{
		$id = intval($_GET["id"]);
		$model = EvaluacionesGrupos::model()->findByPk($id);
		if($model->id_empresa == getIdEmpresa()){
			$ret["status"] = $model->delete();
			if(!$ret["status"]) $ret["error"] = $model->getErrors();
		}else{
			$ret["status"] = false;
			$ret["error"] = "No tiene permiso para realizar la acción";
		}
		return $ret;		
	}

	private function saveGroupUsuarios()
	{
		$ret["status"] = true;
		$id_grupo = intval( $_GET["id_grupo"] );
		// primero eliminamos los usuario previos al grupo
		$delusers = EvaluacionesGruposUsuarios::model()->findAll( "id_grupo = ".$id_grupo );
		foreach($delusers as $deluser) $deluser->delete();

		//Obtener y guardar nuevos usuarios

		foreach($_GET as $k=>$v){
			if(substr($k,0,8) == "usuario_" ){
				$id_usuario =substr($k,8);
				$model = new EvaluacionesGruposUsuarios;
				$model->id_grupo = $id_grupo;
				$model->id_usuario = $id_usuario;
				$ret["status"] = $model->save();
			}
		}

		if(!$ret["status"])$ret["error"] = $model->getErrors();	
		return $ret;
	}

}