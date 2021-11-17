<?php 
if ($_SESSION['privilegio_spm']!=1) {
	echo $lc->forzar_cierre_sesion_controlador();
	exit();
}
 ?>
<div class="full-box page-header">
	<h3 class="text-left">
		<i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE clienteS
	</h3>
	<p class="text-justify">
		
	</p>
</div>

<div class="container-fluid">
	<ul class="full-box list-unstyled page-nav-tabs">
		<li>
			<a href="<?php echo SERVERURL; ?>cliente-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO cliente</a>
		</li>
		<li>
			<a class="active" href="<?php echo SERVERURL; ?>cliente-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE clienteS</a>
		</li>
		<li>
			<a href="<?php echo SERVERURL; ?>cliente-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR cliente</a>
		</li>
	</ul>	
</div>

<div class="container-fluid">
<?php 
require_once "./controladores/clienteControlador.php";
$ins_cliente=new clienteControlador();
echo $ins_cliente->paginador_cliente_controlador($pagina[1],15,$_SESSION['privilegio_spm'],$_SESSION['id_spm'],$pagina[0],"");
 ?>
</div>
<div class="modal fade" id="vehiculoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Vehiculos</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
		<form class="form-neon FormularioAjax"action="<?php echo SERVERURL; ?>ajax/clienteAjax.php" method="POST" data-form="save" autocomplete="off">
        	<div class="modal-body">
					  <div class="row">
						  <input type="hidden" name="cliente_add" id="cliente_add" style="display:none;">
							<div class="col-6">
								<label for="">Asignar vehiculo</label>
								<div class="form-group">
									<select class="form-control" name="vehiculo_add">
										<?php
										$option ='<option value="">selecionar vehiculo..</option>';
										$ins_vehiculo=new clienteControlador();
										$vehiculo =$ins_vehiculo->getVehiculo();
										 foreach ($vehiculo as $key => $row) {
											$option .='<option value="'.$row["auto_id"].'">'.$row["auto_placa"].'</option>';
										}
										echo $option;
										 ?>
									</select>
								</div>
							</div>
							<div class="col-6">
								<label for="">Asignar Chofer</label>
								<div class="form-group">
									<select class="form-control" name="chofer_add">
										<?php
										$option ='<option value="">selecionar chofer..</option>';
										$ins_chofer=new clienteControlador();
										$chofer =$ins_chofer->getchofer();
										 foreach ($chofer as $key => $row) {
											$option .='<option value="'.$row["chofer_id"].'">'.$row["chofer_ci"].'</option>';
										}
										echo $option;
										 ?>
									</select>
								</div>
							</div>
						</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
				<button class="btn btn-primary" type="submit" >ASIGNAR</button>
			</div>
		</form>
		</div>
	</div>
</div>