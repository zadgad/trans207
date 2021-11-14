<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	
	<title><?php echo COMPANY; ?></title>
	
	
	<?php include "./vistas/inc/Link.php"; ?>
</head>

<body>
	<?php
		$peticionAjax=false;
		require_once "./controladores/vistasControlador.php";
		$IV = new vistasControlador();

		$vistas=$IV->obtener_vistas_controlador();

		if($vistas=="login" || $vistas=="404"){
			require_once "./vistas/contenidos/".$vistas."-view.php";

		}else
		{
		session_start(['name'=>'SPM']);

		$pagina=explode("/",$_GET['views']);
		require_once "./controladores/loginControlador.php";

		$lc=new loginControlador();
		if (!isset($_SESSION['token_spm']) ||!isset($_SESSION['usuario_spm']) || !isset($_SESSION['privilegio_spm']) || !isset($_SESSION['id_spm'])) {
			echo $lc->forzar_cierre_sesion_controlador();
			exit();
		}
	?>
	<!-- Main container -->
	<main class="full-box main-container">
		<!-- Nav lateral -->
		<?php include "./vistas/inc/NavLateral.php"; ?>

		<!-- Page content -->
		<section class="full-box page-content">
			<?php 
				include "./vistas/inc/NavBar.php";

				include  $vistas;
			?>
		</section>
	</main>

	
	<?php
        include "./vistas/inc/LogOut.php"; 
		}
		include "./vistas/inc/Script.php"; 
	?>
</body>
</html>
<!--REDES SOCILAES
<div class="sticky-container">
    <ul class="sticky">
        <li>
            <i class="facebookcol fab fa-facebook">Facebook</i>

            <p><a href="https://web.facebook.com/profile.php?id=100007338885245" ></a></p>
        </li>
        <li>
            <i class="twittercol fab fa-twitter">Twitter</i>
            <p><a href="https://twitter.com" ></a></p>
        </li>
        <li>
            <i class="whatsappcol fab fa-whatsapp">Whatsap</i>
            <p><a href="#" ></a></p>
        </li>
        <li>
            <i class="instagramcol fab fa-instagram">Instagram</i>
            <p><a href="https://www.linkedin.com/company" ></a></p>
        </li>
        <li>
            <i class="youtubecol fab fa-youtube">YouYube</i>
            <p><a href="http://www.youtube.com/" ></a></p>
        </li>
        <li>
            <i class="ayudacol fas fa-user ">Desarrollador</i>
            <p><a href="#" ></a></p>
        </li>
    </ul>
</div>-->