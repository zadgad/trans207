<?php 
if ($_SESSION['privilegio_spm']!=1) {
	echo $lc->forzar_cierre_sesion_controlador();
	exit();
}
require_once "./controladores/clienteControlador.php";
 ?>
<div class="full-box page-header">
	<h3 class="text-left">
		<i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR reporte
	</h3>
	<p class="text-justify">
	</p>
</div>

<div class="container-fluid">
	<ul class="full-box list-unstyled page-nav-tabs">
		
	</ul>	
</div>
<?php 
if((!isset($_SESSION['busqueda_reporte']) && empty($_SESSION['busqueda_reporte']))||(!isset($_SESSION['fecha_inicio_reporte']) && !isset($_SESSION['fecha_final_reporte'])))
{
	
 ?>

<div class="container-fluid">
	<form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/buscadorAjax.php" method="POST" data-form="default" autocomplete="off">
		<input type="hidden" name="modulo" value="reporte">
		<div class="container-fluid">
			<div class="row justify-content-md-center">
				<div class="col-12 col-md-6">
					<div class="form-group">
						<label for="inputSearch" class="bmd-label-floating">¿Qué reporte estas buscando?</label>
						<input type="text" class="form-control" name="busqueda_inicial" list="inputSearch">
						<datalist id="inputSearch">
										<?php
										$option ='<option value="0">selecionar chofer..</option>';
										$ins_chofer=new clienteControlador();
										$chofer =$ins_chofer->getChofer();
										foreach ($chofer as $key => $row) {
											$option .='<option value="'.$row["chofer_ci"].'">Chof:'.$row["chofer_nombre"].'</option>';
										}
										echo $option;
										 ?>
							</datalist>
					</div>
					<div class="form-group">
						<label for="fecha_inicio" class="bmd-label-floating">Fecha final</label>
						<input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio"  value="<?php echo date('Y-m-d') ?>">
					</div>
					<div class="form-group">
						<label for="fecha_final" class="bmd-label-floating">Fecha inicio</label>
						<input type="date" class="form-control" name="fecha_final" id="fecha_final" value="<?php echo date('Y-m-d') ?>">
					</div>
				</div>
				<div class="col-12">
					<p class="text-center" style="margin-top: 40px;">
						<button type="submit" class="btn btn-raised btn-info"><i class="fas fa-search"></i> &nbsp; BUSCAR</button>
					</p>
				</div>
			</div>
		</div>
	</form>
</div>
<?php 
}
else
{  
?>

<div class="container-fluid">
	<form class=" FormularioAjax" action="<?php echo SERVERURL; ?>ajax/buscadorAjax.php" method="POST" data-form="search" autocomplete="off">
		<input type="hidden" name="modulo" value="reporte">
		<input type="hidden" name="eliminar_busqueda" value="eliminar">
		<div class="container-fluid">
			<div class="row justify-content-md-center">
				<div class="col-12 col-md-6">
					<p class="text-center" style="font-size: 20px;">
						Resultados de la busqueda <strong>“<?php echo $_SESSION['busqueda_reporte']; ?>”</strong>
					</p>
				</div>
				<div class="col-12">
					<p class="text-center" style="margin-top: 20px;">
						<button type="submit" class="btn btn-raised btn-danger"><i class="far fa-trash-alt"></i> &nbsp; ELIMINAR BÚSQUEDA</button>
						<button type="button" id="export" class="btn btn-raised btn-warning"><i class="far fa-file"></i> &nbsp; EXPORTAR PDF</button>
					</p>
				</div>
			</div>
		</div>
	</form>
</div>


<div class="container-fluid">
	<?php 
	require_once "./controladores/ventaControlador.php";
	$ins_venta=new ventaControlador();
	echo $ins_venta->reportVenta($_SESSION['privilegio_spm'],$_SESSION['id_spm'],$_SESSION['busqueda_reporte'],$_SESSION['fecha_inicio_reporte'],$_SESSION['fecha_final_reporte']);//$pagina[1],15,$_SESSION['privilegio_spm'],$_SESSION['id_spm'],$pagina[0],$_SESSION['busqueda_venta']);
 ?>
</div>
<?php } ?>