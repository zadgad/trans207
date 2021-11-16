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
		<i class="fas fa-sync fa-spin"></i> &nbsp; ACTUALIZAR cliente
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
			<a href="<?php echo SERVERURL; ?>cliente-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO cliente</a>
		</li>
		<li>
			<a href="<?php echo SERVERURL; ?>cliente-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE clienteS</a>
		</li>
		<li>
			<a href="<?php echo SERVERURL; ?>cliente-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR cliente</a>
		</li>
	</ul>	
</div>
<?php 
}
 ?>
<div class="container-fluid">
 <?php 
require_once "./controladores/clienteControlador.php";
$ins_cliente=new clienteControlador();
$datos_cliente=$ins_cliente->datos_cliente_controlador("Unico",$pagina[1]);

 if($datos_cliente->rowCount()==1){

	$campos=$datos_cliente->fetch();

    ?>
	<form  class="form-neon FormularioAjax"action="<?php echo SERVERURL; ?>ajax/clienteAjax.php" method="POST" data-form="update" autocomplete="off">
		<input type="hidden" name="cliente_id_up" value="<?php echo $pagina[1]; ?>">
						<fieldset>
					<legend><i class="far fa-address-card"></i> &nbsp; Información personal</legend>
					<div class="container-fluid">
						<div class="row">
							<div class="col-12 col-md-4">
								<div class="form-group">
									<label for="cliente_ci" class="bmd-label-floating">C.I.</label>
									<input type="text" pattern="[0-9-]{7,20}" class="form-control" name="cliente_ci_up" id="cliente_ci" maxlength="20" required="" value="<?php echo $campos['cliente_ci']; ?>">
								</div>
							</div>
							
							<div class="col-12 col-md-4">
								<div class="form-group">
									<label for="cliente_nombre" class="bmd-label-floating">Nombres</label>
									<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" class="form-control" name="cliente_nombre_up" id="cliente_nombre" maxlength="35" value="<?php echo $campos['cliente_nombre']; ?>">
								</div>
							</div>
							<div class="col-12 col-md-4">
								<div class="form-group">
									<label for="cliente_apellidos" class="bmd-label-floating">Apellidos</label>
									<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" class="form-control" name="cliente_apellidos_up" id="cliente_apellidos" maxlength="35" value="<?php echo $campos['cliente_apellidos']; ?>">
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="form-group">
									<label for="cliente_telefono" class="bmd-label-floating">Teléfono</label>
									<input type="text" pattern="[0-9()+]{8,20}" class="form-control" name="cliente_telefono_up" id="cliente_telefono" maxlength="20" value="<?php echo $campos['cliente_telefono']; ?>">
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="form-group">
									<label for="cliente_categoria" class="bmd-label-floating">Categoria Licencia Conducir</label>
									<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}" class="form-control" name="cliente_categoria_up" id="cliente_categoria" maxlength="190" value="<?php echo $campos['cliente_categoria']; ?>">
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="form-group">
									<label for="cliente_nacimiento" class="bmd-label-floating">Fecha Nac.</label>
									<input type="date" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}" class="form-control" name="cliente_nacimiento_up" id="cliente_nacimiento" maxlength="20" value="<?php echo $campos['cliente_nacimiento']; ?>">
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="form-group">
									<label for="cliente_admicion" class="bmd-label-floating">Fecha de Afiliación</label>
									<input type="date" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}" class="form-control" name="cliente_admicion_up" id="cliente_admicion" maxlength="190" value="<?php echo $campos['cliente_admicion']; ?>">
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="form-group">
									<label for="cliente_monto" class="bmd-label-floating">Monto de Afiliación</label>
									<input type="number" pattern="[0-9()+]{8,20}" class="form-control" name="cliente_monto_up" id="cliente_monto" maxlength="20" value="<?php echo $campos['cliente_monto']; ?>">
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
									<input type="text" pattern="[a-zA-Z0-9]{1,35}" class="form-control" name="cliente_usuario_up" id="cliente_usuario" maxlength="35" value="<?php echo $campos['cliente_usuario']; ?>">
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="form-group">
									<label for="cliente_email" class="bmd-label-floating">Email</label>
									<input type="email" class="form-control" name="cliente_email_up" id="cliente_email" maxlength="70" value="<?php echo $campos['cliente_email']; ?>">
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
									<select class="form-control" name="cliente_rol_up">
										<option value="Socio">Cliente</option>
									</select>
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