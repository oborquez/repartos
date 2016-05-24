<?php

/**
 * This is the model class for table "evaluaciones_respuestas".
 *
 * The followings are the available columns in table 'evaluaciones_respuestas':
 * @property integer $id
 * @property integer $id_evento
 * @property integer $id_evaluado
 * @property integer $id_evaluador
 * @property integer $id_pregunta
 * @property integer $respuesta
 * @property string $comentario
 */
class EvaluacionesRespuestas extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EvaluacionesRespuestas the static model class
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
		return 'evaluaciones_respuestas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_evento, id_evaluado, id_evaluador, id_pregunta, respuesta, comentario', 'required'),
			array('id, id_evento, id_evaluado, id_evaluador, id_pregunta, respuesta', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_evento, id_evaluado, id_evaluador, id_pregunta, respuesta, comentario', 'safe', 'on'=>'search'),
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
			'id_pregunta' => 'Id Pregunta',
			'respuesta' => 'Respuesta',
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
		$criteria->compare('id_pregunta',$this->id_pregunta);
		$criteria->compare('respuesta',$this->respuesta);
		$criteria->compare('comentario',$this->comentario,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getCalificacionEvaluacionUsuario( $id_evento, $id_evaluado=0 )
	{
		if($id_evaluado > 0)
			$model = EvaluacionesRespuestas::model()->findAll( "id_evento =".$id_evento." AND id_evaluado =".$id_evaluado );
		else
			$model = EvaluacionesRespuestas::model()->findAll( "id_evento =".$id_evento );
		return $this->calcularCalificacion($model);
	}

	public function getCalificacionEvaluacionUsuarioPregunta( $id_evento, $id_evaluado=0, $id_pregunta )
	{
		if($id_evaluado > 0)
			$model = EvaluacionesRespuestas::model()->findAll( "id_evento =".$id_evento." AND id_evaluado =".$id_evaluado." AND id_pregunta =".$id_pregunta );
		else
			$model = EvaluacionesRespuestas::model()->findAll( "id_evento =".$id_evento." AND id_pregunta =".$id_pregunta );
		return $this->calcularCalificacion($model);
	}

	private function calcularCalificacion($model)
	{
		// obtenemos la configuración
		$config = EvaluacionesConfig::model()->find( "id_empresa = ".getIdEmpresa() );
		if(!$config){
			$config = new EvaluacionesConfig;
			$config->tipo_estadistica=0;
			$config->id_empresa=getIdEmpresa();
			$model->save();
		}		
		if(count($model) == 0) return 0;
		
		// hacemos uno u otro calculo según la configuración
		if($config->tipo_estadistica==0){ // por número
			
			$a = 0;
			foreach($model as $m) $a = $a + $m->respuesta;
			$prom = $a/count($model);
			$ret = round($prom,2);
		}else{ // por porcentaje de humbral

			$rValidas= array( "1","2" );
			$c=0;
			foreach($model as $m) if( in_array($m->respuesta, $rValidas) ) $c++;
			$calc = ($c*100)/count($model);
			$ret = round($calc)."%";
		}

		return $ret;
	}

	public function totalPorRubroEventoUsuario( $id_evento, $id_evaluado=0 )
	{
		if($id_evaluado > 0)
			$model = EvaluacionesRespuestas::model()->findAll( "id_evento =".$id_evento." AND id_evaluado =".$id_evaluado );
		else
			$model = EvaluacionesRespuestas::model()->findAll( "id_evento =".$id_evento );
		$valores = array(
				"Excelente/Si" => 0,
				"Muy bueno" => 0,
				"Bueno" => 0,
				"Regular" => 0,
				"Malo" => 0,
				"Muy malo" => 0,
				"Pésimo/No" => 0,
			);
		foreach($model as $m)
		{
			switch ($m->respuesta) {
				case 1: $valores["Excelente/Si"]++; break;
				case 2: $valores["Muy bueno"]++; break;
				case 3: $valores["Bueno"]++; break;
				case 4: $valores["Regular"]++; break;
				case 5: $valores["Malo"]++; break;
				case 6: $valores["Muy malo"]++; break;
				case 7: $valores["Pésimo/No"]++; break;
			}
		}

		return $valores;		
	}

	public function totalPorRubroEventoUsuarioPregunta( $id_evento, $id_evaluado, $id_pregunta )
	{
		if($id_evaluado > 0)
			$model = EvaluacionesRespuestas::model()->findAll( "id_evento =".$id_evento." AND id_evaluado =".$id_evaluado." AND id_pregunta =".$id_pregunta );
		else
			$model = EvaluacionesRespuestas::model()->findAll( "id_evento =".$id_evento." AND id_pregunta =".$id_pregunta );
		$valores = array(
				"Excelente/Si" => 0,
				"Muy bueno" => 0,
				"Bueno" => 0,
				"Regular" => 0,
				"Malo" => 0,
				"Muy malo" => 0,
				"Pésimo/No" => 0,
			);
		foreach($model as $m)
		{
			switch ($m->respuesta) {
				case 1: $valores["Excelente/Si"]++; break;
				case 2: $valores["Muy bueno"]++; break;
				case 3: $valores["Bueno"]++; break;
				case 4: $valores["Regular"]++; break;
				case 5: $valores["Malo"]++; break;
				case 6: $valores["Muy malo"]++; break;
				case 7: $valores["Pésimo/No"]++; break;
			}
		}

		return $valores;		
	}
}