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
		<i class="fas fa-sync fa-spin"></i> &nbsp; ACTUALIZAR venta
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
			<a href="<?php echo SERVERURL; ?>auto-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO venta</a>
		</li>
		<li>
			<a href="<?php echo SERVERURL; ?>auto-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE ventaS</a>
		</li>
		<li>
			<a href="<?php echo SERVERURL; ?>auto-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR venta</a>
		</li>
	</ul>	
</div>
<?php 
}
 ?>
<div class="container-fluid">
 <?php 
require_once "./controladores/ventaControlador.php";
$ins_venta=new ventaControlador();
$datos_venta=$ins_venta->datos_venta_controlador("Unico",$pagina[1]);

 if($datos_venta->rowCount()==1){

	$campos=$datos_venta->fetch();

    ?>
	<form  class="form-neon FormularioAjax"action="<?php echo SERVERURL; ?>ajax/ventaAjax.php" method="POST" data-form="update" autocomplete="off">
		<input type="hidden" name="venta_id_up" value="<?php echo $pagina[1]; ?>">
		<fieldset>
			<legend><i class="far fa-address-card"></i> &nbsp; Información personal</legend>
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="venta_dni" class="bmd-label-floating">DNI</label>
							<input type="text" pattern="[0-9-]{10,20}" class="form-control" name="venta_dni_up" id="venta_dni" maxlength="20" value="<?php echo $campos['venta_dni']; ?>">
						</div>
					</div>
					
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="venta_nombre" class="bmd-label-floating">Nombres</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" class="form-control" name="venta_nombre_up" id="venta_nombre" maxlength="35" value="<?php echo $campos['venta_nombre']; ?>">
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="venta_apellido" class="bmd-label-floating">Apellidos</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" class="form-control" name="venta_apellido_up" id="venta_apellido" maxlength="35" value="<?php echo $campos['venta_apellido']; ?>">
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="venta_telefono" class="bmd-label-floating">Teléfono</label>
							<input type="text" pattern="[0-9()+]{8,20}" class="form-control" name="venta_telefono_up" id="venta_telefono" maxlength="20" value="<?php echo $campos['venta_telefono']; ?>">
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="venta_direccion" class="bmd-label-floating">Dirección</label>
							<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}" class="form-control" name="venta_direccion_up" id="venta_direccion" maxlength="190" value="<?php echo $campos['venta_direccion']; ?>">
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
							<label for="venta_venta" class="bmd-label-floating">Nombre de venta</label>
							<input type="text" pattern="[a-zA-Z0-9]{1,35}" class="form-control" name="venta_venta_up" id="venta_venta" maxlength="35" value="<?php echo $campos['venta_venta']; ?>">
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="venta_email" class="bmd-label-floating">Email</label>
							<input type="email" class="form-control" name="venta_email_up" id="venta_email" maxlength="70" value="<?php echo $campos['venta_email']; ?>">
						</div>
					</div>
                    <?php if ($_SESSION['privilegio_spm']==1 && $campos['venta_id']!=1) {
                    	
                    ?>

					<div class="col-12">
						<div class="form-group">
							<span>Estado de la cuenta &nbsp; <?php if ($campos['venta_estado']=="Activa")
							{
								echo '<span class="badge badge-info">Activa</span>';
								
							}else{
								echo '<span class="badge badge-danger">Deshabilitada</span>';

							} ?> </span>
							<select class="form-control" name="venta_estado_up">
								<option value="Activa" <?php  if ($campos['venta_estado']=="Activa") {
									echo 'selected=""';
								}?> >Activa</option>
								<option value="Deshabilitada" <?php  if ($campos['venta_estado']=="Deshabilitada") {
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
							<label for="venta_clave_nueva_1" class="bmd-label-floating">Contraseña</label>
							<input type="password" class="form-control" name="venta_clave_nueva_1" id="venta_clave_nueva_1" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" >
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="venta_clave_nueva_2" class="bmd-label-floating">Repetir contraseña</label>
							<input type="password" class="form-control" name="venta_clave_nueva_2" id="venta_clave_nueva_2" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" >
						</div>
					</div>
				</div>
			</div>
		</fieldset>
		<?php if ($_SESSION['privilegio_spm']==1 && $campos['venta_id']!=1) {
                    	
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
							<select class="form-control" name="venta_privilegio_up">
								
								<option value="1" <?php if ($campos['venta_privilegio']==1) {
									echo 'selected=""';
									
								} ?> >Control total <?php if ($campos['venta_privilegio']==1) {
									echo '(Actual)';
									
								} ?></option>

								<option value="2" <?php if ($campos['venta_privilegio']==2) {
									echo 'selected=""';
									
								} ?>>Edición <?php if ($campos['venta_privilegio']==2) {
									echo '(Actual)';
									
								} ?></option>
								

								<option value="3" <?php if ($campos['venta_privilegio']==3) {
									echo 'selected=""';
									
								} ?>>Registrar <?php if ($campos['venta_privilegio']==3) {
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
			<p class="text-center">Para poder guardar los cambios en esta cuenta debe de ingresar su nombre de venta y contraseña</p>
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="venta_admin" class="bmd-label-floating">Nombre de venta</label>
							<input type="text" pattern="[a-zA-Z0-9]{1,35}" class="form-control" name="venta_admin" id="venta_admin" maxlength="35" required="" >
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