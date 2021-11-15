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
		<i class="fas fa-sync fa-spin"></i> &nbsp; ACTUALIZAR auto
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
			<a href="<?php echo SERVERURL; ?>user-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO auto</a>
		</li>
		<li>
			<a href="<?php echo SERVERURL; ?>user-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE autoS</a>
		</li>
		<li>
			<a href="<?php echo SERVERURL; ?>user-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR auto</a>
		</li>
	</ul>	
</div>
<?php 
}
 ?>
<div class="container-fluid">
 <?php 
require_once "./controladores/autoControlador.php";
$ins_auto=new autoControlador();
$datos_auto=$ins_auto->datos_auto_controlador("Unico",$pagina[1]);

 if($datos_auto->rowCount()==1){

	$campos=$datos_auto->fetch();

    ?>
	<form  class="form-neon FormularioAjax"action="<?php echo SERVERURL; ?>ajax/autoAjax.php" method="POST" data-form="update" autocomplete="off">
		<input type="hidden" name="auto_id_up" value="<?php echo $pagina[1]; ?>">
		<fieldset>
			<legend><i class="far fa-address-card"></i> &nbsp; Información personal</legend>
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="auto_placa" class="bmd-label-floating">Placa</label>
							<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}" class="form-control" name="auto_placa_up" id="auto_placa" maxlength="255" value="<?php echo $campos['auto_placa']; ?>">
						</div>
					</div>
					
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="auto_chasis" class="bmd-label-floating">Chasis</label>
							<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}" class="form-control" name="auto_chasis_up" id="auto_chasis" maxlength="35" value="<?php echo $campos['auto_chasis']; ?>">
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="auto_color" class="bmd-label-floating">Color</label>
							<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}" class="form-control" name="auto_color_up" id="auto_color" maxlength="35" value="<?php echo $campos['auto_color']; ?>">
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="auto_modelo" class="bmd-label-floating">Modelo</label>
							<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}" class="form-control" name="auto_modelo_up" id="auto_modelo" maxlength="20" value="<?php echo $campos['auto_modelo']; ?>">
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="auto_marca" class="bmd-label-floating">Marca</label>
							<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}" class="form-control" name="auto_marca_up" id="auto_marca" maxlength="190" value="<?php echo $campos['auto_marca']; ?>">
						</div>
					</div>
				</div>
			</div>
		</fieldset>
		<br><br><br>
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