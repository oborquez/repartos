<?php

class BibliotecaController extends Controller
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
			array('allow',  // allow all logged users 
				'actions'=>array('index','json','new',"edit","view","uploadFiles","viewFile","searchByTag","comments"),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


	/**
		ACTIONS
	*/
	public function actionIndex()
	{
		$model = BibliotecaEntradas::model()->findAll(array( 'order'=>"titulo ASC" ));
		$this->render('index',array("model"=>$model));
	}

	/* 
		ACTION: Add new entry function
	*/
	public function actionNew()
	{
		
		if(isset($_POST["titulo"])){

			$model = new BibliotecaEntradas;
			$model->setAttributes($_POST);
			$model->id_user = Yii::app()->user->id;
			if($model->save()){

				// tags
				$tags = explode(",", $_POST["categorias"]);
				if(count($tags)>0){
					foreach($tags as $tag){	
						$this->saveTagEntry( $model->id, $tag );
					}	
				}
				Yii::app()->user->setFlash('success', "<b><i class='fa fa-save'></i> Guardado</b> Se ha creado una nueva entrada de biblioteca de manera correcta");
				$this->redirect("edit/".$model->id);				
			}
			
		}else{
			$this->render("new");
		}
	}

	/*
		ACTION: Edit an specific entry by id (Primary key) 
	*/
	public function actionEdit($id)
	{
		$model = BibliotecaEntradas::model()->findByPk($id);
		if(isset($_POST["titulo"])){
			$model->setAttributes($_POST);
			if($model->save()){

				// tags
				$this->deleteEntryTags( $id ); // going to delete all entry tags, after
				$tags = explode(",", $_POST["categorias"]);
				if(count($tags)>0){
					foreach($tags as $tag){	
						$this->saveTagEntry( $model->id, $tag );
					}	
				}
				Yii::app()->user->setFlash('success', "<b><i class='fa fa-save'></i> Guardado</b> La entrada de biblioteca se ha guardado de manera correcta");
				
			}
		}
		
		$this->render("edit",array("model"=>$model));
		
	}

	/*
		ACTION: the principal vew of an specific entry by id (Primary key)
	*/
	public function actionView($id)
	{
		$model = BibliotecaEntradas::model()->findByPk($id);
		$this->render("view",array("model"=>$model));		
	}

	/*
		ACTION: Json services, make a specific action by OP REQUEST 
	*/
	public function actionJson()
	{
		
		$op = ( isset($_GET["op"]) )? $_GET["op"] : $_POST["op"];			
		$ret = $this->{$op}();	
		$ret["origin_data_get"] = $_GET;
		$ret["origin_data_POST"] = $_POST;
	
		echo json_encode($ret);
	}

	/* 
		Upload files action
	*/
	public function actionUploadFiles($id)
	{
		
		if(isset($_FILES["file"]) && $_FILES["file"]["name"]!="")
		{
			$uf = CUploadedFile::getInstanceByName('file');
			$newName = $id.f_ts().".".$uf->getExtensionName();
			$ext = $uf->getExtensionName();
			if(archivoNoScript($ext)){
				$name = Yii::getPathOfAlias('webroot')."/resources/biblioteca/".$newName;
				if($uf->saveAs($name)){
					$model = new BibliotecaArchivos;
					$model->id_entrada = $id;
					$model->archivo = $newName;
					$model->nombre = $uf->getName();
					$model->extension = $ext;
					
					if($model->save()){
						$ret["status"] = true;
						$ret["fileName"] = $newName;
					}else{
						$ret["status"] = false;
						$ret["error"] = "Error al intentar guardar información de archivo";
					}
					
				}

			}else{

				$ret["status"] = false;
				$ret["error"] = "Archivo no permitido";

			}
		}else{

			$ret["status"] = false;
			$ret["error"] = "No ha seleccionado archivo a subir";

 		}

	}	

	public function actionViewFile($id)
	{
		$model = BibliotecaArchivos::model()->findByPk($id);
		$this->render("viewFile",array("model"=>$model));
	}

	public function actionSearchByTag($id)
	{
		
		$model = BibliotecaEntradas::model()->with( array( "tags" =>array( "condition"=>"id_tag =".$id ) ) )->findAll(array("order"=>"titulo ASC"));
		$this->render( "index", array("model"=>$model,"id"=>$id));
	}
	public function actionComments($id)
	{
		$model = BibliotecaComentarios::model()->findAll( array("condition"=>"id_entrada =".$id,"order"=>"fecha") );
		$this->renderPartial("_comments",array("model"=>$model));
	}	

	/**
		SERVICES
	*/


	/* 
		SERVICE : add new visit only if the visitor is not the author
	*/	
	private function addVisit()
	{
		$id = intval($_GET["id"]);
		$model = BibliotecaEntradas::model()->findByPk($id);
		if($model->id_user != Yii::app()->user->id)	{
			$model->visitas++;	
			$model->save();
		}
		// don't need return any information
	}	

	/* 
		Delete entry by id
	*/
	private function delEntry()
	{
		$model = BibliotecaEntradas::model()->findByPk($_GET["id"]);
		
		/* delete all relations */
		
		// tags
		foreach( $model->tags as $tag )
			$tag->delete();
		//archivos
		foreach( $model->archivos as $archivo ){
			$arch = Yii::getPathOfAlias('webroot')."/resources/biblioteca/".$archivo->archivo;	
			@unlink($arch);
			$archivo->delete();
		}
		//comentarios
		foreach( $model->comentarios as $comentario )
			$comentario->delete();

		$ret["status"] = $model->delete();

		return $ret;
	}

	private function getEntryFiles()
	{
		$model = BibliotecaArchivos::model()->findAll( "id_entrada =".intval($_GET["id"]) );
		return array( "files"=>object2Array($model) );
	}

	private function delFile()
	{
		$id  = $_GET["id"];
		$model = BibliotecaArchivos::model()->findByPk($id);
		$archivo = Yii::getPathOfAlias('webroot')."/resources/biblioteca/".$model->archivo;	
		if($model->delete()){
			$ret["status"] = true;
			@unlink($archivo);
		}else{
			$ret["status"] = false;
			$ret["error"] = $model->getErrors();
		}	
		return $ret;
	}

	private function saveComment()
	{
		$id_entrada = intval($_GET["id"]);

		$model = new BibliotecaComentarios;
		$model->fecha = date("Y-m-d H:i:s");
		$model->comentario = nl2br($_GET["comment"]);
		$model->id_user = Yii::app()->user->id;
		$model->id_entrada = $id_entrada;
		if($model->save()){
			$ret["status"] = true;
			//$this->sendMailComment( $model->id );
			
		}else{
			$ret["status"] = false;
			$ret["error"] = $model->getErrors();
		}	
		return $ret;
	}

	private function delComment()
	{
		$id = intval($_GET["id"]);
		$model = BibliotecaComentarios::model()->findByPk($id);
		if($model->delete()){
			$ret["status"] = true;
		}else{
			$ret["status"] = false;
			$ret["error"] = $model->getErrors();
		}	
		return $ret;
	}		
	/**
		Others functions
	*/	

	private function saveTagEntry( $id , $tag )
	{

		// exists entry ??
		$model = BibliotecaTags::model()->find( "tag = '".$tag."'" );
		
		if(!$model){ 
			//save tag
			$model = new BibliotecaTags;
			$model->tag = $tag;
			$model->save();
		}			

		//save entry tag
		$entry = BibliotecaEntradas::model()->findByPk( $id );
		$entrytag = new BibliotecaEntradasTags;
		$entrytag->id_entrada = $id;
		$entrytag->id_tag = $model->id;
		if($entrytag->save()){ // update total number
			$tags = BibliotecaEntradasTags::model()->findAll( "id_tag =".$model->id );
			$model->total = count($tags);
			$model->save();

		}
	}

	private function deleteEntryTags( $id )
	{
		$model = BibliotecaEntradasTags::model()->findAll( "id_entrada =".$id );
		foreach($model as $m){ $m->delete(); }
	}	




}
