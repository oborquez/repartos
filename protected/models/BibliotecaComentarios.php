<?php

/**
 * This is the model class for table "biblioteca_comentarios".
 *
 * The followings are the available columns in table 'biblioteca_comentarios':
 * @property integer $id
 * @property integer $id_entrada
 * @property string $fecha
 * @property integer $id_user
 * @property string $comentario
 */
class BibliotecaComentarios extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BibliotecaComentarios the static model class
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
		return 'biblioteca_comentarios';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_entrada, fecha, id_user, comentario', 'required'),
			array('id_entrada, id_user', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_entrada, fecha, id_user, comentario', 'safe', 'on'=>'search'),
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
			'fecha' => 'Fecha',
			'id_user' => 'Id User',
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
		$criteria->compare('id_entrada',$this->id_entrada);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('comentario',$this->comentario,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}