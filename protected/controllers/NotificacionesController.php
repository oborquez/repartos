<?php

class NotificacionesController extends Controller
{

	public  $n_herramientas = 33;


	public function actionIndex()
	{

		$this->redirect("/notificaciones/list");
	}

	
	public function actionSend()
	{
		Yii::import('application.extensions.phpmailer.JPhpMailer');
		$model = Notificaciones::model()->findAll( "estado = 0" );
		$c = 0;	$max = 10; // max email per call
		foreach($model as $n)
		{	
			$correos = explode(",", $n->correo);
			$c++;
			foreach($correos as $correo){
				$mail = new JPhpMailer;
				$mail->IsSMTP();
				$mail->Host = 'ssl://smtp.gmail.com';
				$mail->Port = 465;
				$mail->CharSet = "UTF-8";
				$mail->SMTPAuth = true;
				$mail->Username = 'notificaciones@empresainteligente.com';
				$mail->Password = 'intelige';
				$mail->SetFrom('cdt@empresainteligente.com', 'Evaluaciones - Bufete Empresa Inteligente');
				$mail->Subject = $n->asunto;
				$mail->AltBody = 'CDT - Sistema Empresa Inteligente';
				$mail->MsgHTML($this->emailLayout($n->cuerpo));
				$mail->AddAddress($correo, $correo);
				if(!$mail->Send()){
					echo "Mailer Error: " . $mail->ErrorInfo;
				}else{
					$n->estado = 1;
					$n->save();
				}
			}
			if($c == $max) return;
		}	
	}

	public function actionList()
	{	
		if(intval( Yii::app()->user->getState("rol")) == 3){
			$model = Notificaciones::model()->desc()->findAll();
			$this->render("list",array("model"=>$model));
		}else{
			$this->redirect("site/error");			
		}
	}

	public function actionView($id)
	{
		$model = Notificaciones::model()->findByPk($id);
		$this->render("view",array("model"=>$model));
	}

	private function emailLayout( $contain )
	{	

		/*
  background: #133b55;
  padding: 8px;
  color: #FFF;
  font-weight: bold;
  text-decoration: none;
  display: inline;	
		 */
		$html ="";

		$html .="<style>

			.abutton{
				  background: #133b55;
				  padding: 8px;
				  color: #FFF;
				  font-weight: bold;
				  text-decoration: none;
				  display: inline;					
			}		

		</style>";

		$html .="\n <div style='background:#eee; padding:10px;'>";
		$html .="\n 	<div style='background:#fff; padding:10px; border:1px solid #ccc; border-radius:5px; width:650px; margin:0 auto; color:#777; padding-top:20px;'>";
		$html .="\n <div style='font-size: 1.4em; color:#555; font-weight:bold; padding-bottom:10px; border-bottom: 5px solid #ddd; margin-bottom:30px;'><img src='http://evaluaciones.empresainteligente.com/assets/PixelAdmin/images/pixel-admin/main-navbar-logo.png'> Evaluaciones - Sistema Empresa Inteligente </div>";
		$html .= $contain;
		$html .="\n 		<div style='background:#f65d35; padding:10px; text-align:center; color:#fff;' >";
		$html .="\n 			<b>Sistema Empresa Inteligente ".date("Y")."</b><hr>Este correo fué generado de manera automática por el sistema del Centro de Desarrollo Tecnológico, no es necesario responderlo.<br> Cuidemos el medio ambiente, por favor, no imprima este correo electrónico si no es necesario. <br> Conoce más acerca de nuestro <a href='#' style='color:#fff!important;'>aviso de privacidad</a>";
		$html .="\n 		</div>";
		$html .="\n 	</div>";
		$html .="\n </div>";
		$html .="\n ";
		$html .="\n ";
		$html .="\n ";

		return $html;
	}


	

	function actionTest()
	{
		$this->render( "tests" );
	}


}