<? include_once(Yii::app()->basePath."/includes/menu.php")  ?>
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
	<!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin" rel="stylesheet" type="text/css">-->

	<!-- Pixel Admin's stylesheets -->
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/PixelAdmin/stylesheets/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/PixelAdmin/stylesheets/pixel-admin.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/PixelAdmin/stylesheets/widgets.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/PixelAdmin/stylesheets/rtl.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/PixelAdmin/stylesheets/themes.min.css" rel="stylesheet" type="text/css">

	<!-- KENDO & Custom functions -->

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/kendoUI/styles/kendo.silver.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/kendoUI/styles/kendo.common.min.css" />

	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/js/custom/functions.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/js/kendoUI/js/kendo.all.min.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/js/kendoUI/js/cultures/kendo.culture.es-MX.min.js"></script>	



	<!--[if lt IE 9]>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/PixelAdmin/javascripts/ie.min.js"></script>
	<![endif]-->
	<script type="text/javascript">
		kendo.culture("es-MX");
		var baseUrl = "<? echo Yii::app()->request->baseUrl?>";
	</script>	

</head>



<body class="theme-asphalt main-menu-animated">

<script>var init = [];</script>

<div id="main-wrapper">


<!-- 2. $MAIN_NAVIGATION ===========================================================================

	Main navigation
-->
	<div id="main-navbar" class="navbar navbar-inverse" role="navigation">
		<!-- Main menu toggle -->
		<button type="button" id="main-menu-toggle"><i class="navbar-icon fa fa-bars icon"></i><span class="hide-menu-text">HIDE MENU</span></button>
		
		<div class="navbar-inner">
			<!-- Main navbar header -->
			<div class="navbar-header">

				<!-- Logo -->
				<a href="<?echo Yii::app()->baseUrl?>" class="navbar-brand">
					<div><img alt="Pixel Admin" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/PixelAdmin/images/pixel-admin/main-navbar-logo.png"></div>
					<?php echo Yii::app()->name ?>
				</a>

				<!-- Main navbar toggle -->
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar-collapse"><i class="navbar-icon fa fa-bars"></i></button>

			</div> <!-- / .navbar-header -->

			<div id="main-navbar-collapse" class="collapse navbar-collapse main-navbar-collapse">
				<div>
					<ul class="nav navbar-nav"></ul> <!-- / .navbar-nav -->

					<div class="right clearfix">
						<ul class="nav navbar-nav pull-right right-navbar-nav">

							


							<li class="dropdown">
								<a href="#" class="dropdown-toggle user-menu" data-toggle="dropdown">
									<img src="<?php echo Yii::app()->baseUrl.Yii::app()->user->getState("image"); ?>" alt="">
									<span><?echo Yii::app()->user->name?></span>
								</a>
								<ul class="dropdown-menu">
									<li><a href="<?echo Yii::app()->baseUrl?>/perfil"><i class="fa fa-user"></i>&nbsp;&nbsp;Perfil</a></li>
									<li><a href="#"><i class="dropdown-icon fa fa-cog"></i>&nbsp;&nbsp;Configuración</a></li>
									<li class="divider"></li>
									<li><a href="<?echo Yii::app()->baseUrl?>/site/logout"><i class="dropdown-icon fa fa-power-off"></i>&nbsp;&nbsp;Salir</a></li>
								</ul>
							</li>
						</ul> <!-- / .navbar-nav -->
					</div> <!-- / .right -->
				</div>
			</div> <!-- / #main-navbar-collapse -->
		</div> <!-- / .navbar-inner -->
	</div> <!-- / #main-navbar -->
<!-- /2. $END_MAIN_NAVIGATION -->


	<div id="main-menu" role="navigation">
		<div id="main-menu-inner">
			
			<div style="margin-bottom: -47px;border-bottom: 1px solid; border-top: none; text-align:center; padding:20px;padding-top:50px;">
				<?
					$id_empresa = getIdEmpresa();
					if($id_empresa > 0):
				?>
					<img src="<?echo Yii::app()->baseUrl?>/resources/empresas/logo_<?echo $id_empresa?>.png" style="width:100%">
				<?else:?>
					<img src="<?echo Yii::app()->baseUrl?>/resources/empresas/logo_default.png" style="width:100%">
				<?endif?>

			</div>
			<ul class="navigation">
				<li>
					<a href="<?echo Yii::app()->baseUrl?>/"><i class="menu-icon fa fa-home"></i><span class="mm-text">Home</span></a>
					
				</li>
				<?custom_menu()?>
			
		</div> <!-- / #main-menu-inner -->
	</div> <!-- / #main-menu -->
<!-- /4. $MAIN_MENU -->
	<div id="content-wrapper">

		<?php if(isset($this->breadcrumbs)):?>
		<!-- Breadcrumbs  -->	
		<ul class="breadcrumb breadcrumb-page">
			<div class="breadcrumb-label text-light-gray">Tu estás aquí: </div>
			<li><a href="<?echo Yii::app()->baseUrl?>">Home</a></li>
			<?
			foreach ($this->breadcrumbs as $key=>$bc) {

				if(is_array($bc)){
					?><li><a href="<?echo Yii::app()->baseUrl.$bc[0]?>"><?echo $key ?></a></li> <?
				}else{
					?><li><a href="#"><?echo $bc?></a></li> <?
				}

			}
			
			?>
			
		</ul>
		<?php endif?>	

		<!-- Flash notifications -->
		<?php
		    foreach(Yii::app()->user->getFlashes() as $key => $message) {
		        //echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
		        $ts = f_ts();
		        ?>
					<div class="alert alert-<?echo $key?>" id="message-<?echo $ts?>">
						<button type="button" class="close" data-dismiss="alert">×</button>
						<?echo $message?>
					</div>
					<script type="text/javascript">
						$(document).ready(function(){
							setTimeout(function(){ $("#message-<?echo $ts?>").fadeOut() }, 6000);
						})
					</script>

		        <?
		    }
		?>


		<!-- Main content -->	
		<?php echo $content; ?>

	</div><!-- #content-wrapper -->


	<div class="row text-center">
		<? echo Yii::app()->name ?>
		<a href="http://empresainteligente.com" target="_blank">

			<!--<img src="<?echo Yii::app()->baseUrl?>/images/eia.png">-->
		</a>	
	</div>
		
	<div id="main-menu-bg"></div>
</div> <!-- / #main-wrapper -->

<!-- Get jQuery from Google CDN -->
<!--[if !IE]> -->
	<script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js">'+"<"+"/script>"); </script>
<!-- <![endif]-->
<!--[if lte IE 9]>
	<script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js">'+"<"+"/script>"); </script>
<![endif]-->


<!-- Pixel Admin's javascripts -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/PixelAdmin/javascripts/bootstrap.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/PixelAdmin/javascripts/pixel-admin.js"></script>

<script type="text/javascript">
	init.push(function () {
		// Javascript code here
	})
	window.PixelAdmin.start(init);
</script>

</body>
</html>