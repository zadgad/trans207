<?php 
if ($_SESSION['privilegio_spm']!=1) {
	echo $lc->forzar_cierre_sesion_controlador();
	exit();
}
 ?>
<div class="full-box page-header">
	<h3 class="text-left">
		<i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE CHOFERES
	</h3>
	<p class="text-justify">
		
	</p>
</div>

<div class="container-fluid">
	<ul class="full-box list-unstyled page-nav-tabs">
		<li>
			<a href="<?php echo SERVERURL; ?>chofer-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO CHOFER</a>
		</li>
		<li>
			<a class="active" href="<?php echo SERVERURL; ?>chofer-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE CHOFERES</a>
		</li>
		<li>
			<a href="<?php echo SERVERURL; ?>chofer-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR CHOFER</a>
		</li>
	</ul>	
</div>

<div class="container-fluid">
	<p>
		<button type="button" id="export" class="btn btn-raised btn-warning"><i class="far fa-file"></i> &nbsp; EXPORTAR PDF</button>
	</p>
<?php 
require_once "./controladores/choferControlador.php";
$ins_chofer=new choferControlador();
echo $ins_chofer->paginador_chofer_controlador($pagina[1],15,$_SESSION['privilegio_spm'],$_SESSION['id_spm'],$pagina[0],"");
 ?>
</div>