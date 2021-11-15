<?php 
if ($_SESSION['privilegio_spm']!=1) {
	echo $lc->forzar_cierre_sesion_controlador();
	exit();
}
 ?>
<div class="full-box page-header">
	<h3 class="text-left">
		<i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO venta
	</h3>
	<p class="text-justify">
		Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit nostrum rerum animi natus beatae ex. Culpa blanditiis tempore amet alias placeat, obcaecati quaerat ullam, sunt est, odio aut veniam ratione.
	</p>
</div>

<div class="container-fluid">
	<ul class="full-box list-unstyled page-nav-tabs">
		<li>
			<a class="active" href="<?php echo SERVERURL; ?>venta-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO venta</a>
		</li>
		<li>
			<a href="<?php echo SERVERURL; ?>venta-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE ventaS</a>
		</li>
		<li>
			<a href="<?php echo SERVERURL; ?>venta-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR venta</a>
		</li>
	</ul>	
</div>

<div class="container-fluid">
	<form  class="form-neon FormularioAjax"action="<?php echo SERVERURL; ?>ajax/ventaAjax.php" method="POST" data-form="save" autocomplete="off">
		<fieldset>
			<legend><i class="far fa-address-card"></i> &nbsp; Información personal</legend>
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="venta_tipo" class="bmd-label-floating">Tipo venta</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" class="form-control" name="venta_tipo_reg" id="venta_tipo" maxlength="20" required="">
						</div>
					</div>
					
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="venta_monto" class="bmd-label-floating">Monto</label>
							<input type="text" pattern="[0-9()+]{1,20}" class="form-control" name="venta_monto_reg" id="venta_monto" maxlength="35" >
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="venta_cantidad" class="bmd-label-floating">Cantidad</label>
							<input type="text" pattern="[0-9()+]{1,20}" class="form-control" name="venta_cantidad_reg" id="venta_cantidad" maxlength="35">
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="venta_descuento" class="bmd-label-floating">Descuento</label>
							<input type="text" pattern="[0-9()+]{1,20}" class="form-control" name="venta_descuento_reg" id="venta_descuento" maxlength="20">
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="venta_total" class="bmd-label-floating">Total</label>
							<input type="text" pattern="[0-9()+]{1,20}" class="form-control" name="venta_total_reg" id="venta_total" maxlength="190">
						</div>
					</div>
				</div>
			</div>
		</fieldset>
		<br><br><br>
		<p class="text-center" style="margin-top: 40px;">
			<button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
			&nbsp; &nbsp;
			<button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
		</p>
	</form>
</div>