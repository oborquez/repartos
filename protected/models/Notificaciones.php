<?php

/**
 * This is the model class for table "notificaciones".
 *
 * The followings are the available columns in table 'notificaciones':
 * @property integer $id
 * @property string $cuerpo
 * @property string $fecha
 * @property string $asunto
 * @property string $correo
 * @property integer $estado
 */
class Notificaciones extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Notificaciones the static model class
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
		return 'notificaciones';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cuerpo, fecha, asunto, correo, estado', 'safe'),
			array('estado', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, cuerpo, fecha, asunto, correo, estado', 'safe', 'on'=>'search'),
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
	 * @return array scopes rules.
	 */
	public function scopes() {
	    return array(
	        'desc' => array('order' => 'fecha DESC'),
	    );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cuerpo' => 'Cuerpo',
			'fecha' => 'Fecha',
			'asunto' => 'Asunto',
			'correo' => 'Correo',
			'estado' => 'Estado',
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
		$criteria->compare('cuerpo',$this->cuerpo,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('asunto',$this->asunto,true);
		$criteria->compare('correo',$this->correo,true);
		$criteria->compare('estado',$this->estado);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}