<?php

class PerfilController extends Controller
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
				'actions'=>array('index'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('admin'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	public function actionIndex()
	{
		$model = Usuarios::model()->findByPk( Yii::app()->user->id );
		
		if(isset($_POST["nombre"])){ // get data

			$model->nombre = ($_POST["nombre"]!="")? $_POST["nombre"] : $model->nombre;
			$model->email = ($_POST["email"]!="")? $_POST["email"] : $model->email;
			if($_POST["password"]!=""){ // only if is not empty change password 
				$model->password = md5( $_POST["password"] );
			}
			$model->save();

			if(isset($_FILES["image"]) and $_FILES["image"]["name"] != "") 
				$this->guardarImagenPerfil( $model );

			$this->render('index',array("model"=>$model,"msg"=>true));

		}else{
			$this->render('index',array("model"=>$model));
		}


		
	}
	static function guardarImagenPerfil( $model ){
		
		$uf = CUploadedFile::getInstanceByName('image');
		$ext = $uf->getExtensionName();
		$ext = strtolower($ext);
		//echo $uf->getName();
		$name = Yii::getPathOfAlias('webroot')."/resources/users/".$uf->getName();
				
				$uf->saveAs($name);
		if( $ext == "jpg" || $ext == "png" || $ext == "jpeg" || $ext == "gif" ):
				//save image
				$name = Yii::getPathOfAlias('webroot')."/resources/users/".$uf->getName();
				$uf->saveAs($name);

				$imageName = "resources/users/".$model->id.".jpg";	
				// resize 80px
				$image1 = Yii::app()->image->load("resources/users/".$uf->getName());
  				$image1->resize(80, 80);
				if($image1->save($imageName))
					$model->image = "/".$imageName;
					$model->save();
				Yii::app()->user->setState("image",$model->image);	
				@unlink($name);
		endif;
		
		
	}	

	
}