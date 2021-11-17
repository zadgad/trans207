<?php 
if ($_SESSION['privilegio_spm']!=1) {
	echo $lc->forzar_cierre_sesion_controlador();
	exit();
}
 ?>
<div class="full-box page-header">
	<h3 class="text-left">
		<i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO Socio
	</h3>
	<p class="text-justify">
		Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit nostrum rerum animi natus beatae ex. Culpa blanditiis tempore amet alias placeat, obcaecati quaerat ullam, sunt est, odio aut veniam ratione.
	</p>
</div>

<div class="container-fluid">
	<ul class="full-box list-unstyled page-nav-tabs">
		<li>
			<a class="active" href="<?php echo SERVERURL; ?>cliente-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO Socio</a>
		</li>
		<li>
			<a href="<?php echo SERVERURL; ?>cliente-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE Socios</a>
		</li>
		<li>
			<a href="<?php echo SERVERURL; ?>cliente-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR Socio</a>
		</li>
	</ul>	
</div>

<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-12 col-md-8">
			<form  class="form-neon FormularioAjax"action="<?php echo SERVERURL; ?>ajax/clienteAjax.php" method="POST" data-form="save" autocomplete="off">
				<fieldset>
					<legend><i class="far fa-address-card"></i> &nbsp; Información personal</legend>
					<div class="container-fluid">
						<div class="row">
							<div class="col-12 col-md-4">
								<div class="form-group">
									<label for="cliente_ci" class="bmd-label-floating">C.I.</label>
									<input type="text" pattern="[0-9-]{7,20}" class="form-control" name="cliente_ci_reg" id="cliente_ci" maxlength="20" required="">
								</div>
							</div>
							
							<div class="col-12 col-md-4">
								<div class="form-group">
									<label for="cliente_nombre" class="bmd-label-floating">Nombres</label>
									<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" class="form-control" name="cliente_nombre_reg" id="cliente_nombre" maxlength="35" >
								</div>
							</div>
							<div class="col-12 col-md-4">
								<div class="form-group">
									<label for="cliente_apellidos" class="bmd-label-floating">Apellidos</label>
									<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" class="form-control" name="cliente_apellidos_reg" id="cliente_apellidos" maxlength="35">
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="form-group">
									<label for="cliente_telefono" class="bmd-label-floating">Teléfono</label>
									<input type="text" pattern="[0-9()+]{8,20}" class="form-control" name="cliente_telefono_reg" id="cliente_telefono" maxlength="20">
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="form-group">
									<label for="cliente_categoria" class="bmd-label-floating">Categoria Licencia Conducir</label>
									<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}" class="form-control" name="cliente_categoria_reg" id="cliente_categoria" maxlength="190">
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="form-group">
									<label for="cliente_nacimiento" class="bmd-label-floating">Fecha Nac.</label>
									<input type="date" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}" class="form-control" name="cliente_nacimiento_reg" id="cliente_nacimiento" maxlength="20">
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="form-group">
									<label for="cliente_admicion" class="bmd-label-floating">Fecha de Afiliación</label>
									<input type="date" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}" class="form-control" name="cliente_admicion_reg" id="cliente_admicion" maxlength="190" value="">
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="form-group">
									<label for="cliente_monto" class="bmd-label-floating">Monto de Afiliación</label>
									<input type="number" pattern="[0-9()+]{8,20}" class="form-control" name="cliente_monto_reg" id="cliente_monto" maxlength="20">
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
									<label for="cliente_usuario" class="bmd-label-floating">Nombre de cliente</label>
									<input type="text" pattern="[a-zA-Z0-9]{1,35}" class="form-control" name="cliente_usuario_reg" id="cliente_usuario" maxlength="35">
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="form-group">
									<label for="cliente_email" class="bmd-label-floating">Email</label>
									<input type="email" class="form-control" name="cliente_email_reg" id="cliente_email" maxlength="70">
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
								<div class="form-group">
									<select class="form-control" name="cliente_rol_reg">
										<option value="Socio">Cliente</option>
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
	</div>
</div>