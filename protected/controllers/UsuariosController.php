<?php

class UsuariosController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
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
				'actions'=>array('index','view','json'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('perfil','image','image128','imageProfile'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','json','impersonar'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/* images */
	public function actionImageProfile(){
		$uf = CUploadedFile::getInstanceByName('image');
		$ext = $uf->getExtensionName();
		$ext = strtolower($ext);
			if( $ext == "jpg" || $ext == "png" || $ext == "jpeg" || $ext == "gif" ):
					//save image
				$name = Yii::getPathOfAlias('webroot')."/resources/users/".$uf->getName();
				$uf->saveAs($name);
				
				// resize 128px
				$image1 = Yii::app()->image->load("resources/users/".$uf->getName());
  				$image1->resize(180, 180);
				$image1->save("resources/users/".Yii::app()->user->id."_128.jpg");
				// crop 128px
				$image2 = Yii::app()->image->load("resources/users/".Yii::app()->user->id."_128.jpg");
  				$image2->crop(128, 128);
				$image2->save("resources/users/".Yii::app()->user->id."_128.jpg");
				// resize 48px
				$image3 = Yii::app()->image->load("resources/users/".Yii::app()->user->id."_128.jpg");
  				$image3->resize(64, 64);
				$image3->save("resources/users/".Yii::app()->user->id."_64.jpg");
				@unlink($name);
					
						
			endif;
		/*$dev = new Dev;
		$dev->detail = Yii::getPathOfAlias('webroot')."/images/".$uf->getName();
		$dev->save();*/
		

	}

	public function actionImage($id){

		$file  = "resources/users/".$id."_64.jpg";
		$default = "resources/users/user_default_64.jpg";
		if(file_exists($file)){
			header('Content-Type: image/jpeg');
			readfile($file);
		}else{
			header('Content-Type: image/jpeg');
			readfile($default);
		}	

	}

	public function actionImage128($id){

		$file  = "resources/users/".$id."_128.jpg";
		$default = "resources/users/user_default_128.jpg";
		if(file_exists($file)){
			header('Content-Type: image/jpeg');
			readfile($file);
		}else{
			header('Content-Type: image/jpeg');
			readfile($default);
		}	

	}

	public function actionPerfil(){

		$model = $this->loadModel(Yii::app()->user->id);
		$this->render('perfil',array("model"=>$model));
		
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		/*$model = Usuarios::model()->findAll();
		$this->render("index",array("model"=>$model));
		*/
		$rol = Yii::app()->user->getState("rol");
		
		switch($rol){

			case 2: $this->actionUsuariosEmpresa(); break;
			case 3: $this->actionAdmin(); break;


		}
	}

	/*
	*	only acces to user rol 2
	*/
	public function actionUsuariosEmpresa(){

		$this->render("usuariosEmpresa");
	}


	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		
		$model=new Usuarios('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Usuarios']))
			$model->attributes=$_GET['Usuarios'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionImpersonar( $id )
	{	
		if( Yii::app()->user->getState("rol") == 3 ){ // sólo si es administrador
			$usuario = Usuarios::model()->findByPk( $id );
			$model=new LoginForm;
			$model->username = $usuario->username;
			$model->password = $usuario->password;
			if($model->impersonar()){
				$ret["status"] = true;
			}else{
				$ret["impersonar"] = $model->impersonar();
				$ret["status"] = false;
				$ret["yii_errors"] = $model->getErrors();
			}

		}else{
			$ret["status"] = false;
			$ret["error"] = "No permitido";
		}	
		echo json_encode( $ret ) ;

	}	

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Usuarios the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Usuarios::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Usuarios $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='usuarios-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}


	// json


	public function actionJson(){


		switch($_GET["op"]){

			case "getUsuarios":	 			$ret = $this->_getUsuarios(); 	break;
			case "getUsuariosEmpresa":	 	$ret = $this->_getUsuariosEmpresa(); 	break;
			case "updateUsuarioEmpresa":	$ret = $this-> _updateUsuarioEmpresa(); break;
			case "createUsuarioEmpresa":	$ret = $this-> _createUsuarioEmpresa(); break;
			case "create":		 			$ret = $this->_create(); 		break;
			case "update":		 			$ret = $this->_update(); 		break;
			case "delete":		 			$ret = $this->_delete(); 		break;
			case "getRoles":	 			$ret = $this->_getRoles();	    break;
			case "saveBasicData":			$ret = $this->_saveBasicData();	break;
			case "newPassword":				$ret = $this->_newPassword(); 	break;
			case "check_username":			$ret = $this->_check_username($_GET["username"]); break;	
			case "passReset": 				$ret = $this->passReset(); break;

		}

		// $ret debe de ser un array
		echo json_encode( $ret );

		

	}

	private function _getUsuarios(){

		$model = Usuarios::model()->with('empresa')->findAll(" rol != 1 ");
		$aRoles = Usuarios::model()->roles();
		
		$aModel =	object2Array($model); 
		
		foreach($model as $k=>$v)
			$aModel[$k]["Empresa"] = array('id_empresa'=>$v->empresa->id,'nombreEmpresa'=>$v->empresa->nombre);
			
		foreach($aModel as $k=>$v)
			$aModel[$k]["Rol"] = array( "rol" => $v["rol"], "rolName" => $aRoles[$v["rol"]] );
		return $aModel;
		


	}


	private function _create(){

		$aRoles = Usuarios::model()->roles();
		
		$model = new Usuarios;
		$kmodel = Yii::app()->kendoData->_getModel();
		$model->setAttributes($kmodel);
		$model->rol = $kmodel["Rol"]->rol;
		$model->id_empresa = $kmodel["Empresa"]->id_empresa;
		
		// add md5 password  -- default password "user"
		$pass = strtolower(f_ts());
		$model->password = md5($pass);
		$model->image = "/assets/PixelAdmin/images/pixel-admin/avatar.png";
		
		if($model->save()){
			$return = object2Array($model);
			$return["Empresa"] = array("id_empresa",$model->id_empresa, 'nombreEmpresa'=>$kmodel["Empresa"]->nombreEmpresa);
			$return["Rol"] = array("rol"=>$model->rol, 'rolName'=> $aRoles[$model->rol]); 


			// crear notificación:
			$notif = new Notificaciones;
			$notif->cuerpo = "<h1> Bienvenido a la herramienta de Evaluaciones </h1>
				<p> Apreciable ".$model->nombre.". </p>
				<p> Le damos la más coordial de las bienvenidas a nuestra aplicación web, desarrollada especialmente para la consultoría de su empresa  </p>
				<h2> Datos de acceso: </h2>
				<p> 
					Puedes acceder a la siguiente dirección, introduciendo los datos que se presentan a continuación 
					<br /> URL: <a href='http://evaluaciones.empresainteligente.com'>http://evaluaciones.empresainteligente.com</a>
					<br /> USERNAME: ".$model->username."
					<br /> PASSWORD: ".$pass."
				</p>
				<p><b>Nota: </b> Te recomendamos cambiar tu contraseña una vez que accedas a nuestra aplicación, en la sección de perfil</p>";
			$notif->fecha  = date("Y-m-d H:i");
			$notif->asunto = "Bienvenido a la herramienta de Evaluaciones";
			$notif->correo = $model->email;
			$notif->save();

			return $return;
		}
	}


	private function _getRoles(){

		return Usuarios::model()->roles4Kendo(); 

	}


	public function _check_username($username){

		$model = Usuarios::model()->find("username = '" . $username."'");
		$check = (isset($model->id) && $username != "")? FALSE : TRUE; 
		return array("check"=>$check);
	}


	private function _update(){

		$aRoles = Usuarios::model()->roles();

		$kmodel = Yii::app()->kendoData->_getModel();
		$model = $this->loadModel($kmodel["id"]);
		$model->setAttributes($kmodel);
		$model->rol = $kmodel["Rol"]->rol;
		$model->id_empresa = $kmodel["Empresa"]->id_empresa;
				
		if($model->save()){
			$return = object2Array($model);
			$return["Rol"] = array("rol"=>$model->rol, 'rolName'=> $aRoles[$model->rol]); 
			return $return;
		}	
	}

	private function _delete(){

		$kmodel = Yii::app()->kendoData->_getModel();
		$model = $this->loadModel($kmodel["id"]);
		if($model->delete()){
			return object2Array($model);
		}

	}


	private function _saveBasicData(){
 
		$model = Usuarios::model()->find("id = ".Yii::app()->user->id);
		$model->setAttributes($_GET);
		$ret["status"] = ($model->save())? TRUE : FALSE;
		return $ret;


	}

	private function _newPassword(){

		if($_GET["password"] == $_GET["repassword"]){
			$model = Usuarios::model()->find("id = ".Yii::app()->user->id);
			$model->setAttributes($_GET);
			$model->password = md5($model->password);
			$ret["status"] = ($model->save())? TRUE : FALSE;
		}else{
			$ret["status"] = FALSE;
		}
		return $ret;

	}


	/* EMPRESAS */

	private function _getUsuariosEmpresa(){

		$ret = array();
		if(Yii::app()->user->getState('rol') == 2){

			$criteria = new CDbCriteria;
			$criteria->select = "id, username,nombre,email";
			$criteria->condition = "rol = 1 AND id_empresa = ".Yii::app()->user->id_empresa;
			$model = Usuarios::model()->findAll($criteria);
			$ret = object2Array($model);

			foreach($ret as $k=>$usuario){
				unset($ret[$k]["id_empresa"]);
				unset($ret[$k]["rol"]);
				unset($ret[$k]["password"]);
			}


		}else{

			$ret["state"]=false;

		}

		return $ret;

	}


	private function _updateUsuarioEmpresa(){
		$ret = array();
		if(Yii::app()->user->getState('rol') == 2){
				
			$kmodel = Yii::app()->kendoData->_getModel();
			$model = $this->loadModel($kmodel["id"]);
			$model->setAttributes($kmodel);
			$ret = ($model->save())? object2Array($model) : FALSE;
			
		}else{

			$ret["state"]=false;

		}

		return $ret;
	}


	private function _createUsuarioEmpresa(){

		$kmodel = Yii::app()->kendoData->_getModel();
		$model = new Usuarios;
		$model->setAttributes($kmodel);
		
		$pass = f_ts();
		$pass = strtolower(f_ts());
		$model->id_empresa = Yii::app()->user->getState('id_empresa');
		$model->rol = 1;
		$model->password = md5($pass);
		$model->image = "/assets/PixelAdmin/images/pixel-admin/avatar.png";

		if($model->save()){
			// crear notificación:
			$notif = new Notificaciones;
			$notif->cuerpo = "<h1> Bienvenido a la herramienta de Evaluaciones </h1>
				<p> Apreciable ".$model->nombre.". </p>
				<p> Le damos la más coordial de las bienvenidas a nuestra aplicación web, desarrollada especialmente para la consultoría de su empresa  </p>
				<h2> Datos de acceso: </h2>
				<p> 
					Puedes acceder a la siguiente dirección, introduciendo los datos que se presentan a continuación 
					<br /> URL: <a href='http://evaluaciones.empresainteligente.com'>http://evaluaciones.empresainteligente.com</a>
					<br /> USERNAME: ".$model->username."
					<br /> PASSWORD: ".$pass."
				</p>
				<p><b>Nota: </b> Te recomendamos cambiar tu contraseña una vez que accedas a nuestra aplicación, en la sección de perfil</p>";
			$notif->fecha  = date("Y-m-d H:i");
			$notif->asunto = "Bienvenido a la herramienta de Evaluaciones";
			$notif->correo = $model->email;
			$notif->save();
			$ret =  object2Array($model);
		}else{
			$ret = FALSE;
		}
		return $ret; 	

	}

	private function passReset()
	{
		$username = $_GET["username"];
		$model = Usuarios::model()->find("username = '".$username."' ");
		$pass = f_ts();
		$model->password = md5($pass);
		//$model->password = "password";
			$ret["status"] = ($model->save())? true : false;	
		if(!$ret["status"]){	
			$ret["errors"] = $model->getErrors();
		}else{
			$notif = new Notificaciones;
			$notif->cuerpo = "<h1> Solicitud de cambio de contraseña </h1>
				<p> Apreciable ".$model->nombre.". </p>
				<p> Le enviamos la información solicitada.</p>
				<h2> Datos de acceso: </h2>
				<p> 
					Puedes acceder a la siguiente dirección, introduciendo los datos que se presentan a continuación 
					<br /> URL: <a href='http://evaluaciones.empresainteligente.com'>http://evaluaciones.empresainteligente.com</a>
					<br /> USERNAME: ".$model->username."
					<br /> PASSWORD: ".$pass."
				</p>
				<p><b>Nota: </b> Te recomendamos cambiar tu contraseña una vez que accedas a nuestra aplicación, en la sección de perfil</p>";
			$notif->fecha  = date("Y-m-d H:i");
			$notif->asunto = "Solicitud de cambio de contraseña";
			$notif->correo = $model->email;
			$notif->save();			
		}
		return $ret;
	}

}
