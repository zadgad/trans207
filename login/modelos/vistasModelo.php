<?php


class vistasModelo{
/*------Modelo obtener vistas-----------*/
protected static function obtener_vistas_modelo($vistas){
$listaBlanca=["home","company"
,"user-list","user-new","user-search","user-update"
,"cliente-list","cliente-new","cliente-search","cliente-update"
,"chofer-list","chofer-new","chofer-search","chofer-update"
,"auto-list","auto-new","auto-search","auto-update"
,"venta-list","venta-new","venta-search","venta-update","reporte-search"];
if(in_array($vistas,$listaBlanca)){
if (is_file("./vistas/contenidos/".$vistas."-view.php")) {
	$contenido="./vistas/contenidos/".$vistas."-view.php";
	}
	else
		{
		$contenido="404";
		}
	}
	elseif ($vistas=="login" || $vistas=="index") 
		{
			$contenido="login";

		}
	else
		{
			$contenido="404";
		}
     return $contenido;
	}
	}

