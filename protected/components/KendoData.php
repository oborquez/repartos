<?php
/*
*	Componente Yii
*	Manejo de datos entre Yii y kendoUI
*	omarborquez
*/


class KendoData extends CApplicationComponent{

	/*
	*	Parse $_GET with simple 
	*	kendo model to PHP Array
	*/
	public function _getModel(){

		$kModels = json_decode($_GET["models"]);
		return $this->simpleObject2Array($kModels[0]);
	}











	/* P R I V A T E S*/

	// parse unidimensional object to array PHP format 
	private function simpleObject2Array($obj){

		$array= array();
		if(count($obj)>0)
			foreach($obj as $k=>$v){
				$array[$k] = $v;
			}	
		return $array;
	}

}


