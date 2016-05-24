<?php

class EmpresasController extends Controller
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
				'actions'=>array(),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array("areas","nuevaArea","tbAreas","json","editarArea"),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','admin'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


	public function actionAdmin()
	{
		$this->render('admin');
	}

	public function actionIndex()
	{
		$this->actionAdmin();
	}

	public function actionAreas()
	{
		$empresa = Empresas::model()->findByPk( Yii::app()->user->getState("id_empresa") );
		$this->render("areas",array("empresa"=>$empresa));
	}

	public function actionNuevaArea()
	{
		$model = new EmpresasAreas;
		$this->renderPartial( "area_form",array("model"=>$model) );
	}

	public function actionTbAreas()
	{
		$empresa = Empresas::model()->findByPk( Yii::app()->user->getState("id_empresa") );
		$this->renderPartial("tables/areas",array("empresa"=>$empresa));
	}

	public function actionEditarArea($id)
	{
		$model = EmpresasAreas::model()->findByPk($id);
		$this->renderPartial( "area_form",array("model"=>$model) );
	}

	/*JSON*/

	public function actionJson(){

		$op = $_GET["op"];

		switch($op){

			case "getEmpresas": 	$ret = $this->getEmpresas(); break;
			case "getEmpresas4Kendo": 	$ret = $this->getEmpresas4Kendo(); break;
			case "update" :			$ret = $this->update();	break;
			case "create":			$ret = $this->create();	break;
			case "delete":			$ret =	$this->delete();	break;
			case "guardarArea":		$ret = $this->guardarArea();	break;
			case "eliminarArea":	$ret = $this->eliminarArea();	break;
		}

		echo json_encode($ret);

	}


	public function getEmpresas($object = FALSE){

		$model = Empresas::model()->findAll();
		$ret = ($object)? $model : object2array($model);
		return $ret;

	}

	private function getEmpresas4Kendo(){

		$ret = array();
		$empresas = $this->getEmpresas();
		if(count($empresas)>0)
		foreach($empresas as $empresa){
			$ret[]=array("id_empresa"=>$empresa["id"],
							"nombreEmpresa"=>$empresa["nombre"]);
		}
		return $ret;

	}

	private function create(){
				
		$kmodel = Yii::app()->kendoData->_getModel();
		$model = new Empresas;
		$model->setAttributes($kmodel);
		$ret = ($model->save())? object2array($model) : FALSE;
	}

	private function update(){

		$kmodel = Yii::app()->kendoData->_getModel();
		$model = Empresas::model()->findByPk($kmodel["id"]);
		$model->setAttributes($kmodel);
		$ret = ($model->save())? object2array($model) : FALSE;

	}

	private function delete(){

		$kmodel = Yii::app()->kendoData->_getModel();
		$model = Empresas::model()->findByPk($kmodel["id"]);
		$ret = ($model->delete())? object2array($model) : FALSE;

	}

	private function guardarArea()
	{
		$id = intval($_GET["id"]);
		if($id == 0){ // insert
			$model = new EmpresasAreas;
		}else{ // update
			$model = EmpresasAreas::model()->findByPk($id);
		}
		$model->setAttributes( $_GET );
		$model->id_empresa = Yii::app()->user->getState("id_empresa");

		if($model->save()){
			$ret["status"] = true;
		}else{
			$ret["status"] = false;
			$ret["errors"] = $model->getErrors();
		}

		return $ret;

	}

	private function eliminarArea()
	{
		$id = intval($_GET["id"]);
		if($id>0){
			$model = EmpresasAreas::model()->findByPk($id);
			if($model->id_empresa == Yii::app()->user->getState("id_empresa")){
				if($model->delete()){
					$ret["status"] = true;
				}else{
					$ret["status"] = false;
					$ret["errors"] = $model->getErrors();
				}
			}else{	
				$ret["status"] = false;
				$ret["error"] = "No permitido para el usuario";
			}	
		}else{
			$ret["status"] = false;
			$ret["error"] = "datos incorrectos";
		}

		return $ret;
	}



}