<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<!DOCTYPE html>



<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie9 gt-ie8"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="gt-ie8 gt-ie9 not-ie"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

	<meta name="language" content="es" />

	<!-- Open Sans font from Google CDN -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin" rel="stylesheet" type="text/css">

	<!-- Pixel Admin's stylesheets -->
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/PixelAdmin/stylesheets/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/PixelAdmin/stylesheets/pixel-admin.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/PixelAdmin/stylesheets/widgets.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/PixelAdmin/stylesheets/pages.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/PixelAdmin/stylesheets/rtl.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/PixelAdmin/stylesheets/themes.min.css" rel="stylesheet" type="text/css">


	<!--[if lt IE 9]>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/PixelAdmin/javascripts/ie.min.js"></script>
	<![endif]-->

</head>
<body class="theme-asphalt page-signin">
<script>
	var init = [];
</script>
	<!-- Page background -->
	<div id="page-signin-bg">
		<!-- Background overlay -->
		<div class="overlay"></div>
		<!-- Replace this with your bg image -->
		<?  $bgn = rand ( 1 , 9 )  ?>
		<img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/PixelAdmin/demo/signin-bg-1.jpg" alt="">
	</div>
	<!-- / Page background -->

	<!-- Container -->
	<div class="signin-container">

		<!-- Left side -->
		<div class="signin-info">
			<a href="<?echo Yii::app()->baseUrl?>" class="logo">
				<img src="<?echo Yii::app()->baseUrl?>/images/eia_support_sign_24.png" alt="" style="margin-top: -5px;">
				<? echo Yii::app()->name ?>
			</a> <!-- / .logo -->
			<div class="slogan">
				LamdeTI
			</div> <!-- / .slogan -->
			<ul>
				<!--<li><i class="fa fa-archive signin-icon"></i> Gestión de evaluaciones </li>
				<li><i class="fa fa-bar-chart-o signin-icon"></i> Reportes estadísticos</li>-->
				<!--<li><i class="fa fa-tasks signin-icon"></i> Seguimiento de acciones</li>-->
			</ul> <!-- / Info list -->

		</div>
		<!-- / Left side -->

		<!-- Right side -->
		<div class="signin-form">

			<!-- Form -->
			<form id="signin-form_id" method="post" action="<?echo Yii::app()->baseUrl?>/site/login">
				<div class="signin-text">
					<span>Accede con tu cuenta</span>
				</div> <!-- / .signin-text -->
				<div>
					<div class="alert alert-danger" id="error-login" style="display:none"></div>
				</div>
				<div class="form-group w-icon">
					<input type="text" name="LoginForm[username]" id="username_id" class="form-control input-lg" placeholder="Username">
					<span class="fa fa-user signin-form-icon"></span>
				</div> <!-- / Username -->

				<div class="form-group w-icon">
					<input type="password" name="LoginForm[password]" id="password_id" class="form-control input-lg" placeholder="Password">
					<span class="fa fa-lock signin-form-icon"></span>
				</div> <!-- / Password -->

				<div class="form-actions">
					<input type="submit" value="Acceder" class="signin-btn bg-primary">
					<a href="#" class="forgot-password" id="forgot-password-link">¿Olvidaste tu contraseña?</a>
				</div> <!-- / .form-actions -->

				
				<div class="row text-center" style="margin-top:20px;">
					<?php echo CHtml::encode($this->pageTitle); ?>
					<!--<img src="<? echo Yii::app()->baseUrl ?>/images/eia.png">-->
				</div>

			</form>
			<!-- / Form -->

			<!-- / "Sign In with" block -->

			<!-- Password reset form -->
			<div class="password-reset-form" id="password-reset-form">
				<div class="header">
					<div class="signin-text">
						<span>Password reset</span>
						<div class="close">&times;</div>
					</div> <!-- / .signin-text -->
				</div> <!-- / .header -->
				
				<!-- Form -->
				<form action="index.html" id="password-reset-form_id">
					<div class="alert alert-success" style="display:none" id="alert-enviado">
						<button type="button" class="close" data-dismiss="alert">×</button>
						<strong><i class="fa fa-envelope"></i> Eviado</strong> La información se ha enviado a tu correo
					</div>
					<div class="alert" style="display:none" id="alert-problemas">
						<button type="button" class="close" data-dismiss="alert">×</button>
						<strong>Nota</strong><span id="problemas"></span>
					</div>
					<div class="alert alert-danger" style="display:none" id="alert-no-enviado">
						<button type="button" class="close" data-dismiss="alert">×</button>
						<strong>Error</strong> <span id="errors"></span>
					</div>
					<div class="form-group w-icon">
						<input type="text" name="password_reset_email" id="p_user" class="form-control input-lg" placeholder="Introduce tu Username">
						<span class="fa fa-user signin-form-icon"></span>
					</div> <!-- / Email -->

					<div class="form-actions">
						<a type="submit" id="passwordReset" class="btn signin-btn bg-primary"><i class="fa fa-envelope"></i> Enviar nuevo password</a>
					</div> <!-- / .form-actions -->
				</form>
				<!-- / Form -->
			</div>
			<!-- / Password reset form -->
		</div>
		<!-- Right side -->
		
		
	</div>
	<!-- / Container -->


<!-- Get jQuery from Google CDN -->
<!--[if !IE]> -->
	<script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js">'+"<"+"/script>"); </script>
<!-- <![endif]-->
<!--[if lte IE 9]>
	<script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js">'+"<"+"/script>"); </script>
<![endif]-->


<!-- Pixel Admin's javascripts -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/PixelAdmin/javascripts/bootstrap.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/PixelAdmin/javascripts/pixel-admin.min.js"></script>

<script type="text/javascript">
	// Resize BG
	init.push(function () {


		<?php echo $content; ?>

		var $ph  = $('#page-signin-bg'),
		    $img = $ph.find('> img');

		$(window).on('resize', function () {
			$img.attr('style', '');
			if ($img.height() < $ph.height()) {
				$img.css({
					height: '100%',
					width: 'auto'
				});
			}
		});

		$("#passwordReset").click(function(){

			

			var username = 	$("#p_user").val();
			if(username.length > 0 ){

				$.getJSON( "<?echo Yii::app()->baseUrl?>/usuarios/json",{op:"passReset",username:username},function(r){
					if(r.status){
						$("#alert-enviado").fadeIn();
					}else{
						$("#errors").html("Hubo un error al intentar enviar el nuevo password");
						$("#alert-no-enviado").fadeIn();
					}
				})

			}else{
				$("#problemas").html(" Debe introducir username válido");
				$("#alert-problemas").fadeIn();
			}

		})

	});

	// Show/Hide password reset form on click
	init.push(function () {
		$('#forgot-password-link').click(function () {
			$('#password-reset-form').fadeIn(400);
			return false;
		});
		$('#password-reset-form .close').click(function () {
			$('#password-reset-form').fadeOut(400);
			return false;
		});
	});

	// Setup Sign In form validation
	init.push(function () {
		$("#signin-form_id").validate({ focusInvalid: true, errorPlacement: function () {} });
		
		// Validate username
		$("#username_id").rules("add", {
			required: true,
			minlength: 3
		});

		// Validate password
		$("#password_id").rules("add", {
			required: true,
			minlength: 3
		});


	});

	// Setup Password Reset form validation
	init.push(function () {
		$("#password-reset-form_id").validate({ focusInvalid: true, errorPlacement: function () {} });
		
		// Validate email
		$("#p_email_id").rules("add", {
			required: true,
			email: true
		});

		<!-- Main content -->	
	

	});

	window.PixelAdmin.start(init);
</script>

	


</body>
</html>
