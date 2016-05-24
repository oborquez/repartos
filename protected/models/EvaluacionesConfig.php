<?php

/**
 * This is the model class for table "evaluaciones_config".
 *
 * The followings are the available columns in table 'evaluaciones_config':
 * @property integer $id
 * @property integer $id_empresa
 * @property integer $tipo_estadistica
 */
class EvaluacionesConfig extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EvaluacionesConfig the static model class
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
		return 'evaluaciones_config';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_empresa, tipo_estadistica', 'required'),
			array('id_empresa, tipo_estadistica', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_empresa, tipo_estadistica', 'safe', 'on'=>'search'),
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
			'id_empresa' => 'Id Empresa',
			'tipo_estadistica' => 'Tipo Estadistica',
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
		$criteria->compare('tipo_estadistica',$this->tipo_estadistica);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}