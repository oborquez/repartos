<?php

/**
 * This is the model class for table "evaluaciones_preguntas".
 *
 * The followings are the available columns in table 'evaluaciones_preguntas':
 * @property integer $id
 * @property integer $id_paquete
 * @property string $pregunta
 * @property integer $tipo
 * @property integer $orden
 */
class EvaluacionesPreguntas extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EvaluacionesPreguntas the static model class
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
		return 'evaluaciones_preguntas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_paquete, pregunta, tipo, orden', 'required'),
			array('id_paquete, tipo, orden', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_paquete, pregunta, tipo, orden', 'safe', 'on'=>'search'),
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
			"paquete" => array(self::BELONGS_TO,"EvaluacionesPaquetes","id_paquete"),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_paquete' => 'Id Paquete',
			'pregunta' => 'Pregunta',
			'tipo' => 'Tipo',
			'orden' => 'Orden',
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
		$criteria->compare('id_paquete',$this->id_paquete);
		$criteria->compare('pregunta',$this->pregunta,true);
		$criteria->compare('tipo',$this->tipo);
		$criteria->compare('orden',$this->orden);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}