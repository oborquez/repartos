<?php  
  $baseUrl = Yii::app()->baseUrl; 
  $cs = Yii::app()->getClientScript();
  $cs->registerScriptFile($baseUrl.'/js/custom/usuarios.js');
?>
<h1>Mi perfil</h1>

<? 

$this->widget('CTabView',array(
    'activeTab'=>"campos",
    'tabs'=>array(
        'datos'=>array(
            'title'=>'Datos básicos',
            'view'=>'_datosBasicos',
            'data'=>array('model'=>$model)
        ),
        'proyecciones'=>array(
            'title'=>'Password',
            'view'=>'_password',
            //'data'=>array('model'=>$model_duponts)
        ),
        
    ),
    'htmlOptions'=>array(
        'style'=>'width:100%;'
    )
));
?>
<script type="text/javascript">

$(document).ready(function(){
	
	$('ul.tabs').addClass('nav').addClass('nav-tabs');
	$('a.active').parent().addClass('active');
	
	$('ul.tabs a').click(function(){
		$('li.active').attr('class','');
		$(this).parent().addClass('active');
	});

});

</script>
