<?php 
if ($_SESSION['privilegio_spm']!=1) {
	echo $lc->forzar_cierre_sesion_controlador();
	exit();
}
require_once "./controladores/clienteControlador.php";
$instancia=new clienteControlador();
 ?>
<div class="full-box page-header">
	<h3 class="text-left">
		<i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO VENTA
	</h3>
	<p class="text-justify">
		Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit nostrum rerum animi natus beatae ex. Culpa blanditiis tempore amet alias placeat, obcaecati quaerat ullam, sunt est, odio aut veniam ratione.
	</p>
</div>

<div class="container-fluid">
	<ul class="full-box list-unstyled page-nav-tabs">
		<li>
			<a class="active" href="<?php echo SERVERURL; ?>venta-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO VENTA</a>
		</li>
		<li>
			<a href="<?php echo SERVERURL; ?>venta-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE VENTASS</a>
		</li>
		<li>
			<a href="<?php echo SERVERURL; ?>venta-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR VWNTA</a>
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
							<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\-]{1,255}" class="form-control" name="venta_tipo_reg" id="venta_tipo" maxlength="255" required="">
						</div>
					</div>
					
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="venta_monto" class="bmd-label-floating">Monto</label>
						
						
							<input type="number" pattern="[0-9()+]" class="form-control" name="venta_monto_reg" id="venta_monto"  >
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="venta_cantidad" class="bmd-label-floating">Cantidad</label>
							<input type="number" pattern="[0-9()+]" class="form-control" name="venta_cantidad_reg" id="venta_cantidad" >
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="venta_descuento" class="bmd-label-floating">Descuento</label>
							<input type="number" pattern="[0-9()+]" class="form-control" name="venta_descuento_reg" id="venta_descuento" >
						</div>
					</div>
					<div class="col-6">
								<label for="">Asignar vehiculo</label>
								<div class="form-group">
									<select class="form-control" name="vehiculo_add">
										<?php
										$option2 ='<option value="">selecionar vehiculo..</option>';
									
										$vehiculo =$instancia->getVehiculo();
										 foreach ($vehiculo as $key => $row2) {
											$option2 .='<option value="'.$row2["auto_id"].'">'.$row2["auto_placa"].'</option>';
										}
										echo $option2;
										 ?>
									</select>
								</div>
							</div>
							<div class="col-6">
								<label for="">Asignar Chofer</label>
								<div class="form-group">
									<select class="form-control" name="chofer_add">
										<?php
										$option3 ='<option value="">selecionar chofer..</option>';
									
										$chofer =$instancia->getchofer();
										 foreach ($chofer as $key => $row3) {
											$option3 .='<option value="'.$row3["chofer_id"].'">'.$row3["chofer_ci"].'</option>';
										}
										echo $option3;
										 ?>
									</select>
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="form-group">
									<label for="cliente_cliente_id" class="bmd-label-floating">Cliente Propietario</label>
									<select class="form-control" name="cliente_cliente_id_reg" id="cliente_cliente_id" >
										    <option value="">--Seleccionar cliente--</option>
										    <?php
											$option ='<option value="">selecionar vehiculo..</option>';
										
											$cliente =$instancia->getCliente();
											foreach ($cliente as $key => $row) {
												$option .='<option value="'.$row["cliente_id"].'">'.$row["cliente_ci"].'</option>';
											}
											echo $option;
											?>
										</select>
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