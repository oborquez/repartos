<?php

/**
 * This is the model class for table "biblioteca_archivos".
 *
 * The followings are the available columns in table 'biblioteca_archivos':
 * @property integer $id
 * @property integer $id_entrada
 * @property string $nombre
 * @property string $archivo
 * @property string $extension
 */
class BibliotecaArchivos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BibliotecaArchivos the static model class
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
		return 'biblioteca_archivos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_entrada, nombre, archivo, extension', 'required'),
			array('id_entrada', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_entrada, nombre, archivo, extension', 'safe', 'on'=>'search'),
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
			'id_entrada' => 'Id Entrada',
			'nombre' => 'Nombre',
			'archivo' => 'Archivo',
			'extension' => 'Extension',
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
		$criteria->compare('id_entrada',$this->id_entrada);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('archivo',$this->archivo,true);
		$criteria->compare('extension',$this->extension,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}