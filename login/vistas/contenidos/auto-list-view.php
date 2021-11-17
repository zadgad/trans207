<?php 
if ($_SESSION['privilegio_spm']!=1) {
	echo $lc->forzar_cierre_sesion_controlador();
	exit();
}
 ?>
<div class="full-box page-header">
	<h3 class="text-left">
		<i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE AUTOS
	</h3>
	<p class="text-justify">
		
	</p>
</div>

<div class="container-fluid">
	<ul class="full-box list-unstyled page-nav-tabs">
		<li>
			<a href="<?php echo SERVERURL; ?>auto-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO AUTO</a>
		</li>
		<li>
			<a class="active" href="<?php echo SERVERURL; ?>auto-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE AUTOSS</a>
		</li>
		<li>
			<a href="<?php echo SERVERURL; ?>auto-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR AUTO</a>
		</li>
	</ul>	
</div>

<div class="container-fluid">
<?php 
require_once "./controladores/autoControlador.php";
$ins_auto=new autoControlador();
echo $ins_auto->paginador_auto_controlador($pagina[1],15,$_SESSION['privilegio_spm'],$_SESSION['id_spm'],$pagina[0],"");
 ?>
</div>