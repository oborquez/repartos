<?php

/**
 * This is the model class for table "evaluaciones_ejecutadas".
 *
 * The followings are the available columns in table 'evaluaciones_ejecutadas':
 * @property integer $id
 * @property integer $id_evento
 * @property integer $id_evaluado
 * @property integer $id_evaluador
 */
class EvaluacionesEjecutadas extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EvaluacionesEjecutadas the static model class
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
		return 'evaluaciones_ejecutadas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_evento, id_evaluado, id_evaluador', 'required'),
			array('id_evento, id_evaluado, id_evaluador', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_evento, id_evaluado, id_evaluador', 'safe', 'on'=>'search'),
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
			"evaluado"=>array(self::BELONGS_TO,"Usuarios","id_evaluado"),
			"evaluador"=>array(self::BELONGS_TO,"Usuarios","id_evaluador"),
			"evento"=>array(self::BELONGS_TO,"EvaluacionesEventos","id_evento"),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_evento' => 'Id Evento',
			'id_evaluado' => 'Id Evaluado',
			'id_evaluador' => 'Id Evaluador',
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
		$criteria->compare('id_evento',$this->id_evento);
		$criteria->compare('id_evaluado',$this->id_evaluado);
		$criteria->compare('id_evaluador',$this->id_evaluador);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}