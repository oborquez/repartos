<?
	function custom_menu()
	{	
		// init variables 
		$aMenu = array();
		$html = "";

		// menu values
		$aMenu["Introducción"] 	= array("roles"=>array("*"),"link"=>"biblioteca/view/42","icon"=>"youtube-play");
		$aMenu["Usuarios"] 	= array("roles"=>array("2","3"),"link"=>"usuarios","icon"=>"group");
		$aMenu["Empresas"] 	= array("roles"=>array("3"),"link"=>"usuarios","icon"=>"building-o");
		


		// build html
		foreach($aMenu as $k=>$i){
			$rol = Yii::app()->user->getState("rol");
			if( in_array($rol, $i["roles"]) || $i["roles"][0] == "*" ){
				$html.= htmlMenuItem( $k,$i );
			}
		}
		// final echo
		echo $html;
	}


	function htmlMenuItem( $i, $item )
	{	
		$dd = (isset( $item["dropdown"] ) && $item["dropdown"])? true  : false;
		$html = "";
		$html.="<li class='". (($dd)?"mm-dropdown" : '' )."' >";
		$html.="	<a href='".Yii::app()->baseUrl."/".$item["link"]."'><i class='menu-icon fa fa-".$item["icon"]."'></i><span class='mm-text'>".$i."</span></a>";
			
		if( $dd ){ 
			$html.="<ul>";
			foreach( $item[ "items" ] as $k=>$sub){

				$html .= htmlMenuItem( $k,$sub ); 
			}
			$html.="</ul>";
		}else{

		}

		$html.="</li>";
		
		return $html;
	}		
