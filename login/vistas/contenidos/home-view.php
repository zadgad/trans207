
<div class="full-box page-header">
	<h3 class="text-left">
		<i class="fas fa-home"></i> &nbsp; INICIO
	</h3>
	<p class="text-justify">
		Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit nostrum rerum animi natus beatae ex. Culpa blanditiis tempore amet alias placeat, obcaecati quaerat ullam, sunt est, odio aut veniam ratione.
	</p>
</div>

<!-- Content -->
<div class="full-box tile-container">
	
     <?php 
     if ($_SESSION['privilegio_spm']==1){
     	require_once "./controladores/usuarioControlador.php";
     	$ins_usuario= new usuarioControlador();
     	$total_usuario=$ins_usuario->datos_usuario_controlador("Conteo",0);

     	?>
	<a href="<?php echo SERVERURL; ?>user-list/" class="tile">
		<div class="tile-tittle">Usuarios</div>
		<div class="tile-icon">
			<i class="fas fa-user-secret fa-fw"></i>
			<p><?php echo $total_usuario->rowCount(); ?> Registrados</p>
		</div>
	</a>
    <?php
     } 
     ?>
	<a href="<?php echo SERVERURL; ?>company/" class="tile">
		<div class="tile-tittle">Socios</div>
		<div class="tile-icon">
			<i class="fas fa-store-alt fa-fw"></i>
			<p>1 Registrada</p>
		</div>
	</a>
	<a href="<?php echo SERVERURL; ?>company/" class="tile">
		<div class="tile-tittle">Vehiculos</div>
		<div class="tile-icon">
			<i class="fas fa-store-alt fa-fw"></i>
			<p>1 Registrada</p>
		</div>
	</a>

</div>
