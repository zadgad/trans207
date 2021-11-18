<?php 
if ($_SESSION['privilegio_spm']!=1) {
	echo $lc->forzar_cierre_sesion_controlador();
	exit();
}
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
			<a href="<?php echo SERVERURL; ?>venta-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE VENTAS}S</a>
		</li>
		<li>
			<a href="<?php echo SERVERURL; ?>venta-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR VENTA</a>
		</li>
	</ul>	
</div>

<div class="container-fluid">
<?php 
require_once "./controladores/clienteControlador.php";
$ins_cliente=new clienteControlador();
 ?>
	<form  class="form-neon FormularioAjax"action="<?php echo SERVERURL; ?>ajax/ventaAjax.php" method="POST" data-form="save" autocomplete="off">
		<fieldset>
			<legend><i class="far fa-address-card"></i> &nbsp; Detalle de Venta</legend>
			<div class="container-fluid">
				<div class="row">
					
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="venta_tipo" class="bmd-label-floating">Comprador</label>

							<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\-]{1,255}" class="form-control" list="chofer_add" name="chofer_add_reg" id="venta_tipo" maxlength="255" required="" >
							<datalist id="chofer_add">
										<?php
										$option ='<option value="0">selecionar chofer..</option>';
										$ins_chofer=new clienteControlador();
										$chofer =$ins_chofer->getChofer2();
										$ins_cliente=new clienteControlador();
										$cliente =$ins_cliente->getCliente();
										 foreach ($cliente as $key => $row) {
											$option .='<option value="'.$row["cliente_ci"].'">'.$row["cliente_nombre"].'</option>';
										}
										foreach ($chofer as $key => $row) {
											$option .='<option value="'.$row["chofer_ci"].'">'.$row["chofer_nombre"].'</option>';
										}
										echo $option;
										 ?>
									</datalist>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="venta_tipo" class="bmd-label-floating">Codigo venta</label>
							<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\-]{1,255}" class="form-control" name="venta_codigo_reg" id="venta_tipo" maxlength="255" required="">
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="venta_tipo" class="bmd-label-floating">Tipo venta</label>
							<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\-]{1,255}" class="form-control" name="venta_tipo_reg" id="venta_tipo" maxlength="255" required="">
						</div>
					</div>
					
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="venta_monto" class="bmd-label-floating">Monto</label>
						
							<select class="form-control" name="venta_monto_reg" id="venta_monto">
    <option value="">--Please choose an option--</option>
    <option value="70">Compra de Hoja 217</option>
    <option value="50">Compra de Hoja 207</option>

</select>				
							<!-- <input type="number" pattern="[0-9()+]" class="form-control" name="venta_monto_reg" id="venta_monto"  > -->
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="venta_cantidad" class="bmd-label-floating">Cantidad</label>
							<input type="number" pattern="[0-9()+]" class="form-control" name="venta_cantidad_reg" id="venta_cantidad" >
						</div>g
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="venta_descuento" class="bmd-label-floating">Descuento</label>
							<input type="number" pattern="[0-9()+]" class="form-control" name="venta_descuento_reg" id="venta_descuento" >
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