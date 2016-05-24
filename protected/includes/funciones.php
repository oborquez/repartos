<?
/**
 * Funcion para
 * hacer debug de contenido
 * de un array
 */
function _ve($arr,$max=0){
	$html = "\n<div style='margin-left:100px;font-size:10px;font-family:sans-serif;'>";
	if (is_array($arr)){
		if (count($arr)==0){
			$html .= "&nbsp;";	
		}else{
			$ii=0;
			foreach ($arr as $k=>$ele){
				if ($max==0 or ($max>0 and $ii<$max)) 
				$html .= "\n<div style='float:left;'><b>$k <span style='color:#822;'>&rarr;</span> </b></div>"
						  ."\n<div style='border:1px #ddd solid;font-size:10px;font-family:sans-serif;'>"._ve($ele,$max)."</div>";
				else break; 
				$ii++; 
			}
		}
	}elseif(is_object($arr)){ 

		$html .= _ove($arr,$max);

	}else{	
		$html .= ($arr==NULL)? "&nbsp;":$arr;
	} 
	$html .= "</div>";
	return $html;
}
 

/**
 * Funcion para
 * hacer debug de contenido
 * de un array
 */
function _ove($arr,$max=0){
	$html = "\n<div style='margin-left:100px;font-size:10px;font-family:sans-serif;'>";
	if (is_object($arr)){
		if (count($arr)==0){
			$html .= "&nbsp;";	
		}else{
			$ii=0;
			foreach ($arr as $k=>$ele){
				if ($max==0 or ($max>0 and $ii<$max)) 
				$html .= "\n<div style='float:left;'><b>$k <span style='color:#822;'>&rarr;</span> </b></div>"
						  ."\n<div style='border:1px #ddd solid;font-size:10px;font-family:sans-serif;'>"._ove($ele,$max)."</div>";
				else break; 
				$ii++; 
			}
		}
	}elseif(is_array($arr)){ 

		$html .= _ve($arr,$max);

	}else{	
		

		$html .= ($arr===NULL)? "&nbsp;":$arr;

	}
	$html .= "</div>";
	return $html;
}
 

/**
 * debuelve un time stamp en caracteres
 * unico.
 */
function f_ts($ts=''){
	global $config_site;
	//crear timestamp
	if ($ts==''){
		if (isset($config_site['diferencia_horaria']))
			$ts=time() + intval($config_site['diferencia_horaria'])*3600; 
		else
			$ts=time();
	}
	$ts=$ts - 1034000000;
	$ts=f_num2alpha($ts);
	return $ts;
}
/**
 * Convierte  el time stamp creado
 * con la funcion _ts() en tiempo en 
 * segundos como si fuera un time()
 */
function f_tsi($k){
	//inversa de timestamp
	$tsi=f_alpha2num($k);
	$tsi=$tsi + 1034000000;
	return $t;
}

/**
* Esta funcion recibe el nombre o la direccion del archivo 
* y verifica que no sea un SCRIPT
* 
* @author: Omar Borquez
* @email: omar_sty@hotmail.com
**/
function archivoNoScript($ext){
	$ret = TRUE;	
	$aExtensionScripts = array('php','js','htm','html','asp','aspx','exe');
	if(in_array($ext,$aExtensionScripts)) $ret = FALSE;
	return $ret;
} 

function f_num2alpha($n) {
    $r = '';
    for ($i = 1; $n >= 0 && $i < 10; $i++) {
        $r = chr(0x41 + ($n % pow(26, $i) / pow(26, $i - 1))) . $r;
        $n -= pow(26, $i);
    }
    return $r;
}
function f_alpha2num($a) {
    $r = 0;
    $l = strlen($a);
    for ($i = 0; $i < $l; $i++) {
        $r += pow(26, $i) * (ord($a[$l - $i - 1]) - 0x40);
    }
    return $r - 1;
}



/* 
only simple objetc
*/

function simpleObject2Array($obj){

	$array= array();
	if(count($obj)>0)
		foreach($obj as $k=>$v){
			$array[$k] = $v;
		}	
	return $array;
}

function object2Array($obj){

	$array = array();
	if(count($obj)>0)
		foreach($obj as $k=>$v){
			if(is_object($v)){
				foreach($v as $k2=>$v2)
					$array[$k][$k2]=$v2;
			}else{
				$array[$k] = $v;	
			}
			
		}
	return $array;

}

/* include kendo */

function includeKendo()
{
	$base_url = Yii::app()->baseUrl; 
	$cs = Yii::app()->getClientScript();
	$cs->registerScriptFile($base_url.'/js/kendoUI/js/kendo.all.min.js');
	$cs->registerScriptFile($base_url.'/js/kendoUI/js/cultures/kendo.culture.es-MX.min.js');
	$cs->registerScriptFile($base_url.'/js/kendoUI/js/kendo.custom.js');
	$cs->registerCssFile($base_url.'/js/kendoUI/styles/kendo.silver.min.css');
	$cs->registerCssFile($base_url.'/js/kendoUI/styles/kendo.common.min.css');
	
}

/* Include jQuery UI*/
function includeJQueryUI()
{
	Yii::app()->clientScript->registerCssFile( Yii::app()->clientScript->getCoreScriptUrl().'/jui/css/base/jquery-ui.css' );
	Yii::app()->clientScript->registerCoreScript('jquery.ui');
}

/* include highcharts */
function includeHighcharts()
{
	$base_url = Yii::app()->baseUrl; 
	$cs = Yii::app()->getClientScript();
	$cs->registerScriptFile($base_url.'/js/highcharts/js/highcharts.js');
}


function getIdEmpresa()
{

	return Yii::app()->user->getState('id_empresa');

}

function getEmpresa()
{
	return Empresas::model()->findByPk( getIdEmpresa() );
}

function fechaComun( $date , $format = "Y-m-d") // input Y-m-d 2013-10-11
{
	$split = explode("-",$date);

	switch( $format ){

		default:
		case "Y-m-d": 	return intval($split[2]) . " de " . _getMes( $split[1] ) . " del " . $split[0];  break;
		case "d-m-Y": 	return intval($split[0]) . " de " . _getMes( $split[1] ) . " del " . $split[2];  break;

	}
	

}

function _getmes( $mes )
{		
		$mes = intval($mes);
		
		$meses[0] = "error";			 $meses[1] = "Enero";		 $meses[2] = "Febrero";
		$meses[3] = "Marzo";			 $meses[4] = "Abril";		 $meses[5] = "Mayo";
		$meses[6] = "Junio";			 $meses[7] = "Julio";		 $meses[8] = "Agosto";
		$meses[9] = "Septiembre";	     $meses[10] = "Octubre";	 $meses[11] = "Noviembre";
		$meses[12] = "Diciembre";
		return $meses[$mes];				
}


function getPrevDay($date="")
{
	$date = ($date!="") ? $date : date('Y-m-d');
	return date('Y-m-d', strtotime($date .' -1 day'));	
	
}

function getNextDay($date="")
{
	$date = ($date!="") ? $date : date('Y-m-d');
	return date('Y-m-d', strtotime($date .' -1 day'));
}


function getFechaComunHora( $date ) // "Y-m-d H:i"
{
	
	$Ymd = date("Y-m-d",strtotime( $date ));
	$hora = date( "H:i",strtotime( $date ) );
	return fechaComun( $Ymd ) . " a las " . $hora;
}

/*
	Obtiene los destinatarios a los que posteriormente
	se les enviará una notificación de correo electrónico
	recibiendo como parámentro el ID de la empresa	
*/
function getDestinatariosEmpresa( $id_empresa )
{
	$a = array();
	$empresa = Empresas::model()->findByPk( $id_empresa );
	$a[] = $empresa->lider->email;
	foreach($empresa->consultores as $c) $a[] = $c->consultor->email;
	return $a;		
}