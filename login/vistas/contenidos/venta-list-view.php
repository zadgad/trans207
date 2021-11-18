<?php 
if ($_SESSION['privilegio_spm']!=1) {
	echo $lc->forzar_cierre_sesion_controlador();
	exit();
}
 ?>
<div class="full-box page-header">
	<h3 class="text-left">
		<i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE VENTAS
	</h3>
	<p class="text-justify">
		
	</p>
</div>

<div class="container-fluid">
	<ul class="full-box list-unstyled page-nav-tabs">
		<li>
			<a href="<?php echo SERVERURL; ?>venta-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO VENTA</a>
		</li>
		<li>
			<a class="active" href="<?php echo SERVERURL; ?>venta-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE VENTAS</a>
		</li>
		<li>
			<a href="<?php echo SERVERURL; ?>venta-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR VENTA</a>
		</li>
	</ul>	
</div>

<div class="container-fluid">
	<p>
		<button type="button" id="export" class="btn btn-raised btn-warning"><i class="far fa-file"></i> &nbsp; EXPORTAR PDF</button>
	</p>
<?php 
require_once "./controladores/ventaControlador.php";
$ins_venta=new ventaControlador();
echo $ins_venta->paginador_venta_controlador($pagina[1],15,$_SESSION['privilegio_spm'],$_SESSION['id_spm'],$pagina[0],"");
 ?>
</div>