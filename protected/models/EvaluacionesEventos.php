<?php

/**
 * This is the model class for table "evaluaciones_eventos".
 *
 * The followings are the available columns in table 'evaluaciones_eventos':
 * @property integer $id
 * @property integer $id_empresa
 * @property integer $id_paquete
 * @property integer $id_estructura
 * @property string $titulo
 * @property string $fecha_inicio
 * @property string $fecha_final
 * @property string $evaluado
 */
class EvaluacionesEventos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EvaluacionesEventos the static model class
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
		return 'evaluaciones_eventos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_empresa, id_paquete, id_estructura, titulo, fecha_inicio, fecha_final', 'safe'),
			array('id_empresa, id_paquete, id_estructura', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_empresa, id_paquete, id_estructura, titulo, fecha_inicio, fecha_final, evaluado', 'safe', 'on'=>'search'),
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
			"empresa" => array(self::BELONGS_TO, "Empresas","id_empresa" ),
			"paquete" => array(self::BELONGS_TO, "EvaluacionesPaquetes","id_paquete"),
			"evaluados" => array(self::HAS_MANY, "EvaluacionesEvaluados", "id_evento"),
			"evaluadores" => array(self::HAS_MANY,"EvaluacionesEvaluadores","id_evento"),
			"ejecutadas" => array(self::HAS_MANY,"EvaluacionesEjecutadas","id_evento")
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
			'id_paquete' => 'Id Paquete',
			'id_estructura' => 'Id Estructura',
			'titulo' => 'Titulo',
			'fecha_inicio' => 'Fecha Inicio',
			'fecha_final' => 'Fecha Final',
			'evaluado' => 'Evaluado',
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
		$criteria->compare('id_paquete',$this->id_paquete);
		$criteria->compare('id_estructura',$this->id_estructura);
		$criteria->compare('titulo',$this->titulo,true);
		$criteria->compare('fecha_inicio',$this->fecha_inicio,true);
		$criteria->compare('fecha_final',$this->fecha_final,true);
		$criteria->compare('evaluado',$this->evaluado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function estructuras()
	{
		return array( 
			1 => "Varios usuarios a un usuario", 
			2 => "Uno o varios usuarios a varios usuarios", 
			3 => "Uno o varios usuarios a un ente o tópico" 
		);
	}

	public function getEstructura($id)
	{
		$estructuaras = $this->estructuaras();
		return $estructuaras[$id];
	}
}