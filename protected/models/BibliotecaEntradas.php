<?php

/**
 * This is the model class for table "biblioteca_entradas".
 *
 * The followings are the available columns in table 'biblioteca_entradas':
 * @property integer $id
 * @property integer $id_user
 * @property integer $visitas
 * @property string $titulo
 * @property string $descripcion
 * @property integer $tipo
 */
class BibliotecaEntradas extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BibliotecaEntradas the static model class
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
		return 'biblioteca_entradas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, visitas, titulo, descripcion, tipo', 'safe'),
			array('id_user, visitas, tipo', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_user, visitas, titulo, descripcion, tipo', 'safe', 'on'=>'search'),
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
			"usuario" => array(self::BELONGS_TO,"Usuarios","id_user"),
			"archivos" => array( self::HAS_MANY,"BibliotecaArchivos",'id_entrada'),
			"tags" => array( self::HAS_MANY,"BibliotecaEntradasTags",'id_entrada'),
			"comentarios" => array( self::HAS_MANY,"BibliotecaComentarios",'id_entrada'),
			//"links" => array( self::HAS_MANY,"BibliotecaLinks",'id_entrada'),
			//"videos" => array( self::HAS_MANY,"BibliotecaVideos",'id_entrada'),
			//"escrito" => array( self::HAS_ONE,"BibliotecaEscrito",'id_entrada'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_user' => 'Id User',
			'visitas' => 'Visitas',
			'titulo' => 'Titulo',
			'descripcion' => 'Descripcion',
			'tipo' => 'Tipo',
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
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('visitas',$this->visitas);
		$criteria->compare('titulo',$this->titulo,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('tipo',$this->tipo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}



	/**
	* This function get an array of etntry trypes
	 */

	public function getTipos()
	{
		//(0 archivos,1 link, 2 video, 3 escrito)
		return array(0=>"Archivos",1=>"Link",2=>"Video",3=>"Escrito");
	}

	/* Get the type of specific entry  */
	public function getTipo( $tipo ){
		$tipos = $this->getTipos();
		return $tipos[$tipo];
	}



}