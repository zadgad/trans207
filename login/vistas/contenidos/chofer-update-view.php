<?php 
if ($lc->encryption($_SESSION['id_spm'])!=$pagina[1]) {
	if ($_SESSION['privilegio_spm']!=1) {
	echo $lc->forzar_cierre_sesion_controlador();
	exit();
   }
	
 }
 ?>
<div class="full-box page-header">
	<h3 class="text-left">
		<i class="fas fa-sync fa-spin"></i> &nbsp; ACTUALIZAR chofer
	</h3>
	<p class="text-justify">
		Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit nostrum rerum animi natus beatae ex. Culpa blanditiis tempore amet alias placeat, obcaecati quaerat ullam, sunt est, odio aut veniam ratione.
	</p>
</div>
<?php 
if ($_SESSION['privilegio_spm']==1){

 ?>

<div class="container-fluid">
	<ul class="full-box list-unstyled page-nav-tabs">
		<li>
			<a href="<?php echo SERVERURL; ?>user-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO chofer</a>
		</li>
		<li>
			<a href="<?php echo SERVERURL; ?>user-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE choferS</a>
		</li>
		<li>
			<a href="<?php echo SERVERURL; ?>user-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR chofer</a>
		</li>
	</ul>	
</div>
<?php 
}
 ?>
<div class="container-fluid">
 <?php 
require_once "./controladores/choferControlador.php";
$ins_chofer=new choferControlador();
$datos_chofer=$ins_chofer->datos_chofer_controlador("Unico",$pagina[1]);

 if($datos_chofer->rowCount()==1){

	$campos=$datos_chofer->fetch();

    ?>
	<div class="row justify-content-center">
		<div class="col-12 col-md-8">
			<form  class="form-neon FormularioAjax"action="<?php echo SERVERURL; ?>ajax/choferAjax.php" method="POST" data-form="update" autocomplete="off">
				<input type="hidden" name="chofer_id_up" value="<?php echo $pagina[1]; ?>">
				<fieldset>
					<legend><i class="far fa-address-card"></i> &nbsp; Información personal</legend>
					<div class="container-fluid">
						<div class="row">
							<div class="col-12 col-md-4">
								<div class="form-group">
									<label for="chofer_dni" class="bmd-label-floating">DNI</label>
									<input type="text" pattern="[0-9-]{10,20}" class="form-control" name="chofer_dni_up" id="chofer_dni" maxlength="20" value="<?php echo $campos['chofer_dni']; ?>">
								</div>
							</div>
							
							<div class="col-12 col-md-4">
								<div class="form-group">
									<label for="chofer_nombre" class="bmd-label-floating">Nombres</label>
									<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" class="form-control" name="chofer_nombre_up" id="chofer_nombre" maxlength="35" value="<?php echo $campos['chofer_nombre']; ?>">
								</div>
							</div>
							<div class="col-12 col-md-4">
								<div class="form-group">
									<label for="chofer_apellido" class="bmd-label-floating">Apellidos</label>
									<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" class="form-control" name="chofer_apellido_up" id="chofer_apellido" maxlength="35" value="<?php echo $campos['chofer_apellido']; ?>">
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="form-group">
									<label for="chofer_telefono" class="bmd-label-floating">Teléfono</label>
									<input type="text" pattern="[0-9()+]{8,20}" class="form-control" name="chofer_telefono_up" id="chofer_telefono" maxlength="20" value="<?php echo $campos['chofer_telefono']; ?>">
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="form-group">
									<label for="chofer_direccion" class="bmd-label-floating">Dirección</label>
									<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}" class="form-control" name="chofer_direccion_up" id="chofer_direccion" maxlength="190" value="<?php echo $campos['chofer_direccion']; ?>">
								</div>
							</div>
						</div>
					</div>
				</fieldset>
				<br><br><br>
				<fieldset>
					<legend><i class="fas fa-user-lock"></i> &nbsp; Información de la cuenta</legend>
					<div class="container-fluid">
						<div class="row">
							<div class="col-12 col-md-6">
								<div class="form-group">
									<label for="chofer_chofer" class="bmd-label-floating">Nombre de chofer</label>
									<input type="text" pattern="[a-zA-Z0-9]{1,35}" class="form-control" name="chofer_chofer_up" id="chofer_chofer" maxlength="35" value="<?php echo $campos['chofer_chofer']; ?>">
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="form-group">
									<label for="chofer_email" class="bmd-label-floating">Email</label>
									<input type="email" class="form-control" name="chofer_email_up" id="chofer_email" maxlength="70" value="<?php echo $campos['chofer_email']; ?>">
								</div>
							</div>
							<?php if ($_SESSION['privilegio_spm']==1 && $campos['chofer_id']!=1) {
								
							?>

							<div class="col-12">
								<div class="form-group">
									<span>Estado de la cuenta &nbsp; <?php if ($campos['chofer_estado']=="Activa")
									{
										echo '<span class="badge badge-info">Activa</span>';
										
									}else{
										echo '<span class="badge badge-danger">Deshabilitada</span>';

									} ?> </span>
									<select class="form-control" name="chofer_estado_up">
										<option value="Activa" <?php  if ($campos['chofer_estado']=="Activa") {
											echo 'selected=""';
										}?> >Activa</option>
										<option value="Deshabilitada" <?php  if ($campos['chofer_estado']=="Deshabilitada") {
											echo 'selected=""';
										}?>>Deshabilitada</option>
									</select>
								</div>
							</div>

						<?php 
						} 
						?>
						</div>
					</div>
				</fieldset>
				<br><br><br>
				<fieldset>
					<legend style="margin-top: 40px;"><i class="fas fa-lock"></i> &nbsp; Nueva contraseña</legend>
					<p>Para actualizar la contraseña de esta cuenta ingrese una nueva y vuelva a escribirla. En caso que no desee actualizarla debe dejar vacíos los dos campos de las contraseñas.</p>
					<div class="container-fluid">
						<div class="row">
							<div class="col-12 col-md-6">
								<div class="form-group">
									<label for="chofer_clave_nueva_1" class="bmd-label-floating">Contraseña</label>
									<input type="password" class="form-control" name="chofer_clave_nueva_1" id="chofer_clave_nueva_1" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" >
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="form-group">
									<label for="chofer_clave_nueva_2" class="bmd-label-floating">Repetir contraseña</label>
									<input type="password" class="form-control" name="chofer_clave_nueva_2" id="chofer_clave_nueva_2" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" >
								</div>
							</div>
						</div>
					</div>
				</fieldset>
				<?php if ($_SESSION['privilegio_spm']==1 && $campos['chofer_id']!=1) {
								
				?>

				<br><br><br>
				<fieldset>
					<legend><i class="fas fa-medal"></i> &nbsp; Nivel de privilegio</legend>
					<div class="container-fluid">
						<div class="row">
							<div class="col-12">
								<p><span class="badge badge-info">Control total</span> Permisos para registrar, actualizar y eliminar</p>
								<p><span class="badge badge-success">Edición</span> Permisos para registrar y actualizar</p>
								<p><span class="badge badge-dark">Registrar</span> Solo permisos para registrar</p>
								<div class="form-group">
									<select class="form-control" name="chofer_privilegio_up">
										
										<option value="1" <?php if ($campos['chofer_privilegio']==1) {
											echo 'selected=""';
											
										} ?> >Control total <?php if ($campos['chofer_privilegio']==1) {
											echo '(Actual)';
											
										} ?></option>

										<option value="2" <?php if ($campos['chofer_privilegio']==2) {
											echo 'selected=""';
											
										} ?>>Edición <?php if ($campos['chofer_privilegio']==2) {
											echo '(Actual)';
											
										} ?></option>
										

										<option value="3" <?php if ($campos['chofer_privilegio']==3) {
											echo 'selected=""';
											
										} ?>>Registrar <?php if ($campos['chofer_privilegio']==3) {
											echo '(Actual)';
											
										} ?></option>
										
									</select>
								</div>
							</div>
						</div>
					</div>
				</fieldset>
				<?php } ?>
				<br><br><br>
				<fieldset>
					<p class="text-center">Para poder guardar los cambios en esta cuenta debe de ingresar su nombre de chofer y contraseña</p>
					<div class="container-fluid">
						<div class="row">
							<div class="col-12 col-md-6">
								<div class="form-group">
									<label for="chofer_admin" class="bmd-label-floating">Nombre de chofer</label>
									<input type="text" pattern="[a-zA-Z0-9]{1,35}" class="form-control" name="chofer_admin" id="chofer_admin" maxlength="35" required="" >
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="form-group">
									<label for="clave_admin" class="bmd-label-floating">Contraseña</label>
									<input type="password" class="form-control" name="clave_admin" id="clave_admin" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required="" >
								</div>
							</div>
						</div>
					</div>
				</fieldset>
				<?php 
				if ($lc->encryption($_SESSION['id_spm'])!=$pagina[1]) {?>
					<input type="hidden" name="tipo_cuenta" value="Impropia">
				<?php }else{ ?>
				<input type="hidden" name="tipo_cuenta" value="Propia">
				<?php 
				}
				?>
				<p class="text-center" style="margin-top: 40px;">
					<button type="submit" class="btn btn-raised btn-success btn-sm"><i class="fas fa-sync-alt"></i> &nbsp; ACTUALIZAR</button>
				</p>
			</form>
		</div>
	</div>
	<?php 
	}
	else{


	 ?>
	<div class="alert alert-danger text-center" role="alert">
		<p><i class="fas fa-exclamation-triangle fa-5x"></i></p>
		<h4 class="alert-heading">¡Ocurrió un error inesperado!</h4>
		<p class="mb-0">Lo sentimos, no podemos mostrar la información solicitada debido a un error.</p>
	</div>
	<?php 
}
	 ?>
</div>