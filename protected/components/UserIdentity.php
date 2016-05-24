<?php

class UserIdentity extends CUserIdentity
 {
 private $_id;
 public $impersonar = false;
 public function authenticate()
 {
 $username=strtolower($this->username);
 $user=Usuarios::model()->find('LOWER(username)=?',array($username));
 if($user===null)
 $this->errorCode=self::ERROR_USERNAME_INVALID;
 else if(!$this->impersonar && !$user->validatePassword($this->password))
 $this->errorCode=self::ERROR_PASSWORD_INVALID;
 else
 {
	 $this->_id=$user->id;
	 $this->username=$user->username;
	 $this->setState("nombre",$user->nombre);
	 $this->setState("rol",$user->rol);
	 $this->setState("image",$user->image);
	 $this->setState("id_empresa",$user->id_empresa);
	 	
 $this->errorCode=self::ERROR_NONE;
 }
 return $this->errorCode==self::ERROR_NONE;
 }
 public function getId()
 {
 return $this->_id;
 }
 }