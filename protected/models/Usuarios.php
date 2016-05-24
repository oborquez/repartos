<?php

/**
 * This is the model class for table "usuarios".
 *
 * The followings are the available columns in table 'usuarios':
 * @property integer $id
 * @property integer $id_empresa
 * @property string $username
 * @property string $password
 * @property string $nombre
 * @property string $email
 * @property integer $rol
 * @property string $image
 */
class Usuarios extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Usuarios the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usuarios';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_empresa, username, password, nombre, email, rol, image', 'safe'),
			array('id_empresa, rol', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('username, password, nombre, email, rol', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'empresa' => array(self::BELONGS_TO, 'Empresas', 'id_empresa')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_empresa' => 'Id Empresa',
			'username' => 'Username',
			'password' => 'Password',
			'nombre' => 'Nombre',
			'email' => 'Email',
			'rol' => 'Rol',
			'image' => 'Image',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('id_empresa',$this->id_empresa);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('rol',$this->rol);
		$criteria->compare('image',$this->image);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/*
		Get system Rols
	*/ 
	public function roles()
	{
		return array(

			1 => "Usuario",
			2 => "Lider",
			3 => "Administrador",
			4 => "Consultor"

		);
	}

	/* 
		Get system rols for Kendo UI
	*/
	public function roles4Kendo()
	{
		$aRoles = $this->roles();
		foreach( $aRoles as $k=>$v )
			$ret[] = array( "rol" => $k, "rolName" => $v );
		return 	$ret;	
	}


	public function arrayAdminRules(){
	 	
		$array = array();
		$criteria=new CDbCriteria;
		$criteria->condition = "rol = 3";
		$admins = Usuarios::model()->findall($criteria);
		foreach($admins as $admin)
			$array[$admin["id"]]=$admin["username"];
		return $array;	
	 }

	public function arrayNoClientesRules(){
	 	
		$array = array();
		$criteria=new CDbCriteria;
		$criteria->condition = "rol != 1";
		$admins = Usuarios::model()->findall($criteria);
		foreach($admins as $admin)
			$array[$admin["id"]]=$admin["username"];
		return $array;	
	 }

	public function arrayClientesRules(){
	 	
		$array = array();
		$criteria=new CDbCriteria;
		$criteria->condition = "rol = 1";
		$admins = Usuarios::model()->findall($criteria);
		foreach($admins as $admin)
			$array[$admin["id"]]=$admin["username"];
		return $array;	
	 }


	public function arrayConsultorRules(){
	 	
		$array = array();
		$criteria=new CDbCriteria;
		$criteria->condition = "rol = 2";
		$admins = Usuarios::model()->findall($criteria);
		foreach($admins as $admin)
			$array[$admin["id"]]=$admin["username"];
		return $array;	
	 }

	public function getConsultores(){

		$array = array();
		$criteria=new CDbCriteria;
		$criteria->condition = "rol = 2";
		$admins = Usuarios::model()->findall($criteria);
		foreach($admins as $admin)
			$array[$admin["id"]]=$admin["nombre"];
		return $array;	

		
	}

	public function getClientes(){

		$array = array();
		$criteria=new CDbCriteria;
		$criteria->condition = "rol = 1";
		$usuarios = Usuarios::model()->findall($criteria);
		foreach($usuarios as $usuario)
			$array[$usuario["id"]]=$usuario["nombre"];
		return $array;	

		
	}


	 public function getUsuarioNombre($id){
	 	$model = Usuarios::model()->findByPk($id);
		return $model->nombre;
	 }	
		



public function validatePassword($password)
 {
 	return $this->hashPassword($password)===$this->password;
 }
 public function hashPassword($password)
 {
 	return md5($password);
 }	



}



