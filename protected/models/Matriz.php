<?php

/**
 * This is the model class for table "matriz".
 *
 * The followings are the available columns in table 'matriz':
 * @property integer $ID_MATRIZ
 * @property integer $CODIGO
 * @property string $NOMBRE_MATRIZ
 */
class Matriz extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Matriz the static model class
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
		return 'matriz';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_MATRIZ, CODIGO', 'numerical', 'integerOnly'=>true),
			array('NOMBRE_MATRIZ', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_MATRIZ, CODIGO, NOMBRE_MATRIZ', 'safe', 'on'=>'search'),
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
			'ID_MATRIZ' => 'Id Matriz',
			'CODIGO' => 'Codigo',
			'NOMBRE_MATRIZ' => 'Nombre Matriz',
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

		$criteria->compare('ID_MATRIZ',$this->ID_MATRIZ);
		$criteria->compare('CODIGO',$this->CODIGO);
		$criteria->compare('NOMBRE_MATRIZ',$this->NOMBRE_MATRIZ,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}