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
		<i class="fas fa-sync fa-spin"></i> &nbsp; ACTUALIZAR VENTA
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
			<a href="<?php echo SERVERURL; ?>venta-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO VENTA</a>
		</li>
		<li>
			<a href="<?php echo SERVERURL; ?>venta-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE VENTAS</a>
		</li>
		<li>
			<a href="<?php echo SERVERURL; ?>venta-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR VENTA</a>
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
							<label for="venta_tipo" class="bmd-label-floating">Tipo venta</label>
							<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}" class="form-control" name="venta_tipo_up" id="venta_tipo" maxlength="255" value="<?php echo $campos['venta_tipo']; ?>">
						</div>
					</div>
					
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="venta_monto" class="bmd-label-floating">Monto</label>
							<input type="number" pattern="[0-9()+]" class="form-control" name="venta_monto_up" id="venta_monto" value="<?php echo $campos['venta_monto']; ?>">
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="venta_cantidad" class="bmd-label-floating">Cantidad</label>
							<input type="number" pattern="[0-9()+]" class="form-control" name="venta_cantidad_up" id="venta_cantidad"  value="<?php echo $campos['venta_cantidad']; ?>">
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="venta_descuento" class="bmd-label-floating">Descuento</label>
							<input type="number" pattern="[0-9()+]" class="form-control" name="venta_descuento_up" id="venta_descuento" value="<?php echo $campos['venta_descuento']; ?>">
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="venta_total" class="bmd-label-floating">Total</label>
							<input type="number" pattern="[0-9()+]" class="form-control" name="venta_total_up" id="venta_total" value="<?php echo $campos['venta_total']; ?>">
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