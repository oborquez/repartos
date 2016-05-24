<html>
<head>
	<title>Envío de correos DOCTUM</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
	<style type="text/css">
		body{ background: #eee; }
		.container{
			width:600px;
			padding: 10px;
			background: #fff;
			margin: 0 auto;
			border-radius: 5px;
			box-shadow: 0px 0px 10px #777;
			color:#333;
		}
		.enviado{
			padding: 10px;
			background: #BCF5A9;
			margin-bottom: 10px;
			border-radius: 4px;
		}
		.enviado:hover{ background: #BEF781; }
	</style>

	<div class="container">
	<h2>Envío de correos</h2>	
	<?foreach($model as $m):?>
		<div class="enviado"><?echo $m->asunto?> para <?echo $m->correo?></div>
	<?endforeach;?>
	</div>
</body>
</html>



