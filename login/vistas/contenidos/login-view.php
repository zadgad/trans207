<div class="login-container">
	<div class="login-content">
		<p class="text-center ">
			<img src="<?php echo SERVERURL; ?>vistas/assets/avatar/imagen.jpg" class="img-cir" alt="Avatar">
		</p>
		<p class="text-center tipo-letra">
			Inicia sesión con tu cuenta
		</p>
		<form action="" method="POST" autocomplete="off" >
			<div class="form-group tipo-letra">
				<label for="UserName" class="bmd-label-floating"><i class="fas fa-user-secret "></i> &nbsp; Usuario</label>
				<input type="text" class="form-control" id="UserName" name="usuario_log" pattern="[a-zA-Z0-9]{1,35}" maxlength="35" required="" >
			</div>
			<div class="form-group tipo-letra">
				<label for="UserPassword" class="bmd-label-floating"><i class="fas fa-key"></i> &nbsp; Contraseña</label>
				<input type="password" class="form-control" id="UserPassword" name="clave_log" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required="" >
			</div>
			<button type="submit" class="btn-login text-center">Iniciar Sesion</button>
			
		</form>
		
	</div>
</div>

<?php 
if (isset($_POST['usuario_log']) && isset($_POST['clave_log'])) {
	require_once "./controladores/loginControlador.php";
	$ins_login=new loginControlador();
	echo $ins_login->iniciar_sesion_controlador();
}

 ?>