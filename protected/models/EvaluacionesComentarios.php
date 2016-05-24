<?php

/**
 * This is the model class for table "evaluaciones_comentarios".
 *
 * The followings are the available columns in table 'evaluaciones_comentarios':
 * @property integer $id
 * @property integer $id_evento
 * @property integer $id_evaluado
 * @property integer $id_evaluador
 * @property string $comentario
 */
class EvaluacionesComentarios extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EvaluacionesComentarios the static model class
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
		return 'evaluaciones_comentarios';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_evento, id_evaluado, id_evaluador, comentario', 'required'),
			array('id, id_evento, id_evaluado, id_evaluador', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_evento, id_evaluado, id_evaluador, comentario', 'safe', 'on'=>'search'),
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
			'comentario' => 'Comentario',
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
		$criteria->compare('comentario',$this->comentario,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}