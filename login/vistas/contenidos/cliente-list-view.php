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
        <div class="modal-body">
					  <div class="row">
							<div class="col-6">
								<label for="">Asignar vehiculo</label>
								<div class="form-group">
									<select class="form-control" name="vehiculo_add">
										<option value="1">Vehiculo</option>
										<option value="2">Vehiculo2</option>
										<option value="3">Vehiculo3</option>
										<option value="4">Vehiculo4</option>
									</select>
								</div>
							</div>
							<div class="col-6">
								<label for="">Asignar Chofer</label>
								<div class="form-group">
									<select class="form-control" name="chofer_add">
										<option value="1">Chofer 1</option>
										<option value="2">Chofer 2</option>
										<option value="3">Chofer 3</option>
										<option value="4">Chofer 4</option>
									</select>
								</div>
							</div>
						</div>
		</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <button class="btn btn-primary vehicleCli" type="button" data-dismiss="modal" >Salir</button>
  
        </div>
      </div>
    </div>
  </div>