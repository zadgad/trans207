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
		<i class="fas fa-sync fa-spin"></i> &nbsp; ACTUALIZAR CHOFER
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
			<a href="<?php echo SERVERURL; ?>user-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO CHOFER</a>
		</li>
		<li>
			<a href="<?php echo SERVERURL; ?>user-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE CHOFERS</a>
		</li>
		<li>
			<a href="<?php echo SERVERURL; ?>user-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR CHOFER</a>
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
									<label for="chofer_ci" class="bmd-label-floating">C.I.</label>
									<input type="text" pattern="[0-9-]{7,20}" class="form-control" name="chofer_ci_up" id="chofer_ci" maxlength="20" required="">
								</div>
							</div>
							
							<div class="col-12 col-md-4">
								<div class="form-group">
									<label for="chofer_nombre" class="bmd-label-floating">Nombres</label>
									<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" class="form-control" name="chofer_nombre_up" id="chofer_nombre" maxlength="35" >
								</div>
							</div>
							<div class="col-12 col-md-4">
								<div class="form-group">
									<label for="chofer_apellidos" class="bmd-label-floating">Apellidos</label>
									<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" class="form-control" name="chofer_apellidos_up" id="chofer_apellidos" maxlength="35">
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="form-group">
									<label for="chofer_telefono" class="bmd-label-floating">Teléfono</label>
									<input type="text" pattern="[0-9()+]{8,20}" class="form-control" name="chofer_telefono_up" id="chofer_telefono" maxlength="20">
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="form-group">
									<label for="chofer_categoria" class="bmd-label-floating">Categoria Licencia Conducir</label>
									<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}" class="form-control" name="chofer_categoria_up" id="chofer_categoria" maxlength="190">
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="form-group">
									<label for="chofer_nacimiento" class="bmd-label-floating">Fecha Nac.</label>
									<input type="date" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}" class="form-control" name="chofer_nacimiento_up" id="chofer_nacimiento" maxlength="20">
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="form-group">
									<label for="chofer_admincion" class="bmd-label-floating">Fecha de Afiliación</label>
									<input type="date" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}" class="form-control" name="chofer_admincion_up" id="chofer_admincion" maxlength="190" value="">
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="form-group">
									<label for="chofer_monto" class="bmd-label-floating">Monto de Afiliación</label>
									<input type="number" pattern="[0-9()+]{8,20}" class="form-control" name="chofer_monto_up" id="chofer_monto" maxlength="20">
								</div>
							</div>
						</div>
					</div>
				</fieldset>

					<fieldset>
					<legend><i class="fas fa-user-lock"></i> &nbsp; Información de la cuenta</legend>
					<div class="container-fluid">
						<div class="row">
							<div class="col-12 col-md-6">
								<div class="form-group">
									<label for="chofer_usuario" class="bmd-label-floating">Nombre de Chofer</label>
									<input type="text" pattern="[a-zA-Z0-9]{1,35}" class="form-control" name="chofer_usuario_up" id="chofer_usuario" maxlength="35">
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="form-group">
									<label for="chofer_email" class="bmd-label-floating">Email</label>
									<input type="email" class="form-control" name="chofer_email_up" id="chofer_email" maxlength="70">
								</div>
							</div>
					</div>
				</fieldset>
		<br><br><br>
		<fieldset>
		
		</fieldset><fieldset>
					<legend><i class="fas fa-medal"></i> &nbsp; Nivel de privilegio</legend>
					<div class="container-fluid">
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<select class="form-control" name="chofer_rol_up">
										<option value="Socio">Chofer</option>
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