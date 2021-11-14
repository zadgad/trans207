<?php 
if ($_SESSION['privilegio_spm']!=1) {
	echo $lc->forzar_cierre_sesion_controlador();
	exit();
}
 ?>
<div class="full-box page-header">
	<h3 class="text-left">
		<i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO chofer
	</h3>
	<p class="text-justify">
		Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit nostrum rerum animi natus beatae ex. Culpa blanditiis tempore amet alias placeat, obcaecati quaerat ullam, sunt est, odio aut veniam ratione.
	</p>
</div>

<div class="container-fluid">
	<ul class="full-box list-unstyled page-nav-tabs">
		<li>
			<a class="active" href="<?php echo SERVERURL; ?>user-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO chofer</a>
		</li>
		<li>
			<a href="<?php echo SERVERURL; ?>user-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE choferS</a>
		</li>
		<li>
			<a href="<?php echo SERVERURL; ?>user-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR chofer</a>
		</li>
	</ul>	
</div>

<div class="container-fluid">
	<form  class="form-neon FormularioAjax"action="<?php echo SERVERURL; ?>ajax/choferAjax.php" method="POST" data-form="save" autocomplete="off">
		<fieldset>
			<legend><i class="far fa-address-card"></i> &nbsp; Información personal</legend>
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="chofer_dni" class="bmd-label-floating">DNI</label>
							<input type="text" pattern="[0-9-]{10,20}" class="form-control" name="chofer_dni_reg" id="chofer_dni" maxlength="20" required="">
						</div>
					</div>
					
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="chofer_nombre" class="bmd-label-floating">Nombres</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" class="form-control" name="chofer_nombre_reg" id="chofer_nombre" maxlength="35" >
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="chofer_apellido" class="bmd-label-floating">Apellidos</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" class="form-control" name="chofer_apellido_reg" id="chofer_apellido" maxlength="35">
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="chofer_telefono" class="bmd-label-floating">Teléfono</label>
							<input type="text" pattern="[0-9()+]{8,20}" class="form-control" name="chofer_telefono_reg" id="chofer_telefono" maxlength="20">
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="chofer_direccion" class="bmd-label-floating">Dirección</label>
							<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}" class="form-control" name="chofer_direccion_reg" id="chofer_direccion" maxlength="190">
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
							<input type="text" pattern="[a-zA-Z0-9]{1,35}" class="form-control" name="chofer_chofer_reg" id="chofer_chofer" maxlength="35">
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="chofer_email" class="bmd-label-floating">Email</label>
							<input type="email" class="form-control" name="chofer_email_reg" id="chofer_email" maxlength="70">
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="chofer_clave_1" class="bmd-label-floating">Contraseña</label>
							<input type="password" class="form-control" name="chofer_clave_1_reg" id="chofer_clave_1" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required="" >
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="chofer_clave_2" class="bmd-label-floating">Repetir contraseña</label>
							<input type="password" class="form-control" name="chofer_clave_2_reg" id="chofer_clave_2" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required="" >
						</div>
					</div>
				</div>
			</div>
		</fieldset>
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
							<select class="form-control" name="chofer_privilegio_reg">
								<option value="" selected="" disabled="">Seleccione una opción</option>
								<option value="1">Control total</option>
								<option value="2">Edición</option>
								<option value="3">Registrar</option>
							</select>
						</div>
					</div>
				</div>
			</div>
		</fieldset>
		<p class="text-center" style="margin-top: 40px;">
			<button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
			&nbsp; &nbsp;
			<button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
		</p>
	</form>
</div>