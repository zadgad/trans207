<?php

if ($peticionAjax) {
    require_once "../modelos/ventaModelo.php";
} else {
    require_once "./modelos/ventaModelo.php";

}

class ventaControlador extends ventaModelo
{

    /*--------- Controlador agregar venta ---------*/
    public function agregar_venta_controlador()
    {
        $venta_tipo       = mainModel::limpiar_cadena($_POST['venta_tipo_reg']);
        $venta_monto    = mainModel::limpiar_cadena($_POST['venta_monto_reg']);
        $venta_cantidad  = mainModel::limpiar_cadena($_POST['venta_cantidad_reg']);
        $venta_descuento  = mainModel::limpiar_cadena($_POST['venta_descuento_reg']);
        $venta_total = mainModel::limpiar_cadena($_POST['venta_total_reg']);

        /*== comprobar campos vacios ==*/
        if ($venta_tipo == "" || $venta_monto == "" || $venta_cantidad == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "No has llenado todos los campos que son obligatorios",
                "Tipo"   => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /*== Verificando integridad de los datos ==*/
        if (mainModel::verificar_datos("[0-9-]{10,20}", $venta_tipo)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "El DNI no coincide con el formato solicitado",
                "Tipo"   => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}", $venta_monto)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "El NOMBRE no coincide con el formato solicitado",
                "Tipo"   => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}", $venta_cantidad)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "El APELLIDO no coincide con el formato solicitado",
                "Tipo"   => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if ($telefono != "") {
            if (mainModel::verificar_datos("[0-9()+]{8,20}",$venta_descuento)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "El TELEFONO no coincide con el formato solicitado",
                    "Tipo"   => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }

        if ($venta_total != "") {
            if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}", $venta_total)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "La DIRECCION no coincide con el formato solicitado",
                    "Tipo"   => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }

        if (mainModel::verificar_datos("[a-zA-Z0-9]{1,35}", $venta)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "El NOMBRE DE venta no coincide con el formato solicitado",
                "Tipo"   => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /*coprobando privilegio*/
        if ($privilegio < 1 || $privilegio > 3) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "El privilegio seleccionado no es valido",
                "Tipo"   => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $datos_venta_reg = [
            "venta_tipo"        => $venta_tipo,
            "venta_monto"     => $venta_monto,
            "venta_cantidad"   => $venta_cantidad,
            "venta_descuento"   =>$venta_descuento,
            "venta_total"  => $venta_total,
        ];
        $agregar_venta = ventaModelo::agregar_venta_modelo($datos_venta_reg);
        if ($agregar_venta->rowCount() == 1) {
            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "venta registrado",
                "Texto"  => "Los datos del venta han sido registrado con exito",
                "Tipo"   => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "No hemos podido registrar el venta",
                "Tipo"   => "error"
            ];

        }
         echo json_encode($alerta);

    } /*fin de controlador*/

    /*--------- Controlador paginar venta ---------*/
    public function paginador_venta_controlador($pagina,$registros,$privilegio,$id,$url,$busqueda)
    {
      $pagina=mainModel::limpiar_cadena($pagina);
      $registros=mainModel::limpiar_cadena($registros);
      $privilegio=mainModel::limpiar_cadena($privilegio);
      $id=mainModel::limpiar_cadena($id);  

      $url=mainModel::limpiar_cadena($url); 
      $url=SERVERURL.$url."/";

      $busqueda=mainModel::limpiar_cadena($busqueda); 
      $tabla="";

      $pagina= (isset($pagina) && $pagina>0) ?(int) $pagina : 1;
      $inicio= ($pagina>0) ? (($pagina*$registros)-$registros) : 0;

      if (isset($busqueda) && $busqueda!="") {
        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM venta WHERE ((venta_id!='$id') AND (venta_tipo LIKE '%$busqueda%' OR venta_monto LIKE '%$busqueda%' OR venta_cantidad LIKE '%$busqueda%' OR venta_descuento LIKE '%$busqueda%' OR venta_total LIKE '%$busqueda%')) ORDER BY venta_monto ASC LIMIT $inicio,$registros";
          
      }
      else{
       $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM venta WHERE venta_id!='$id' ORDER BY venta_monto ASC LIMIT $inicio,$registros";
      }


        $conexion=mainModel::conectar();

        $datos= $conexion->query( $consulta);
        $datos=$datos->fetchAll();
        $total=$conexion->query("SELECT FOUND_ROWS()");
        $total=(int) $total->fetchColumn();
        $Npaginas=ceil($total/$registros);
    

        $tabla.='<div class="table-responsive">
            <table class="table table-dark table-sm">
                <thead>
                    <tr class="text-center roboto-medium">
                        <th>#</th>
                        <th>TIPO</th>
                        <th>MONTO</th>
                        <th>CANTIDAD</th>
                        <th>DESCUENTO</th>
                        <th>TOTAL</th>
                        <th>ACTUALIZAR</th>
                        <th>ELIMINAR</th>
                    </tr>
                </thead>
                <tbody>';
             if ($total>=1 && $pagina<=$Npaginas) {
                 $contador=$inicio+1;
                 $reg_inicio=$inicio+1;
                 foreach ($datos as $rows){
                   $tabla.='<tr class="text-center" >
                        <td>'.$contador.'</td>
                        <td>'.$rows['venta_dni'].'</td>
                        <td>'.$rows['venta_monto'].' '.$rows['venta_cantidad'].'</td>
                        <td>'.$rows['venta_descuento'].'</td>
                        <td>'.$rows['venta_venta'].'</td>
                        <td>'.$rows['venta_total'].'</td>
                        <td>
                            <a href="'.SERVERURL.'user-update/'.mainModel::encryption($rows['venta_id']).'/" class="btn btn-success">
                                    <i class="fas fa-sync-alt"></i> 
                            </a>
                        </td>
                        <td>
                        <form class="FormularioAjax" action="'.SERVERURL.'ajax/ventaAjax.php" method="POST" data-form="delete" autocomplete="off">

                            <input type="hidden" name="venta_id_del" value="'.mainModel::encryption($rows['venta_id']).'">

                            <button type="submit" class="btn btn-warning">
                                    <i class="far fa-trash-alt"></i>
                            </button>
                        </form>
                        </td>
                    </tr>';
                    $contador++;
                 }
                 $reg_final=$contador - 1;
             }else{
                if ($total>=1) {
                    $tabla.='<tr class="text-center" ><td colspan="9">
                  <a href="'.$url.'" class="btn btn-raised btn-success btn-sm"> Haga clic aca para recargar el listado</a></td></tr>';
                }
                else{
                  $tabla.='<tr class="text-center" ><td colspan="9">No hay registros en el sistema</td></tr>';
                }
              
             }
                           
            $tabla.='</tbody></table></div>';

            if ($total>=1 && $pagina<=$Npaginas) {
                 $tabla.='<p class="text-right"> Mostrando venta '.$reg_inicio.' al '.$reg_final.' de un total de '.$total.'</p>';
                $tabla.=mainModel::paginador_tablas($pagina,$Npaginas,$url,7);
            }
        return $tabla;
    }/*fin de controlador*/

    /*--------- Controlador eliminar venta ---------*/
    public function eliminar_venta_controlador()
    {
        /*Recibiendo el id del venta*/
         
         $id=mainModel::decryption($_POST['venta_id_del']);
         $id=mainModel::limpiar_cadena($id);

         /*comprobando el venta*/
         if ($id==1) { 
            $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "No podemos eliminar el venta principal del sistema",
                    "Tipo"   => "error"
                ];
                echo json_encode($alerta);
                 exit();
             
         }
         /*Comprrobando el venta en BD*/

         $check_venta=mainModel::ejecutar_consulta_simple("SELECT venta_id FROM venta WHERE venta_id='$id'");

         if ($check_venta->rowCount()<=0) {
             $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "El venta que intenta eliminar no existe en el sistema",
                    "Tipo"   => "error"
                ];
                echo json_encode($alerta);
                 exit();
             
         }
           
         /*comprobando privilegios*/

         session_start(['name'=>'SPM']);

         if ($_SESSION['privilegio_spm']!=1) {
             $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "No tienes los permisos necesario para realizar esta operacion",
                    "Tipo"   => "error"
                ];
                echo json_encode($alerta);
                 exit();

         }

         $eliminar_venta=ventaModelo::eliminar_venta_modelo($id);
         if ($eliminar_venta->rowCount() == 1) 
         {
              $alerta = [
                    "Alerta" => "recargar",
                    "Titulo" => "venta eliminado",
                    "Texto"  => "El venta ha sido eliminado del sistema exitosamente",
                    "Tipo"   => "success"
                ];
         }
         else
         {
            $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "No hemos podido eliminar el venta, por favor intente nuevamente",
                    "Tipo"   => "error"
                ];
         }
          echo json_encode($alerta);
          
        }/*fin de controlador*/  
         /*Controlodar datos venta*/
    public function datos_venta_controlador($tipo,$id){
            $tipo =mainModel::limpiar_cadena($tipo);

            $id=mainModel::decryption($id);
            $id=mainModel::limpiar_cadena($id);
            return ventaModelo::datos_venta_modelo($tipo,$id);


     
     }/*fin de controlador*/ 

      /*Controlador actualizar venta*/

    public function actualizar_venta_controlador(){
            //recibiendo id
            $id=mainModel::decryption($_POST['venta_id_up']);
            $id=mainModel::limpiar_cadena($id);

            //Comprobar el venta en la BD

            $check_user=mainModel::ejecutar_consulta_simple("SELECT * FROM venta WHERE venta_id='$id'");
                if ( $check_user->rowCount()<=0) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ocurrió un error inesperado",
                        "Texto"  => "No hemos encontrado el venta en ele sistema",
                        "Tipo"   => "error"
                    ];
                    echo json_encode($alerta);
                     exit();
                }else{
                     $campos=$check_user->fetch();
                     
                }

                /**/
                $venta_tipo=mainModel::limpiar_cadena($_POST['venta_dni_up']);
                $venta_monto=mainModel::limpiar_cadena($_POST['venta_monto_up']);
                $venta_cantidad=mainModel::limpiar_cadena($_POST['venta_cantidad_up']);
               $venta_descuento=mainModel::limpiar_cadena($_POST['venta_descuento_up']);
                $venta_total=mainModel::limpiar_cadena($_POST['venta_total_up']);
               
                if (isset($_POST['venta_privilegio_up']))
                {
                $privilegio=mainModel::limpiar_cadena($_POST['venta_privilegio_up']);
                }
                else {
                    $privilegio=$campos['venta_privilegio'];
                } 

                 
                 $admin_venta=mainModel::limpiar_cadena($_POST['venta_admin']); 
                 $admin_clave=mainModel::limpiar_cadena($_POST['clave_admin']); 
                 $tipo_cuenta=mainModel::limpiar_cadena($_POST['tipo_cuenta']);

                   /*== comprobar campos vacios ==*/
                    if ($venta_tipo == "" || $venta_monto == "" || $venta_cantidad == "" || $venta == "" || $admin_venta == "") {
                        $alerta = [
                            "Alerta" => "simple",
                            "Titulo" => "Ocurrió un error inesperado",
                            "Texto"  => "No has llenado todos los campos que son obligatorios",
                            "Tipo"   => "error"
                        ];
                        echo json_encode($alerta);
                        exit();
                    }

              /*== Verificando integridad de los datos ==*/
            if (mainModel::verificar_datos("[0-9-]{10,20}", $venta_tipo)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "El DNI no coincide con el formato solicitado",
                    "Tipo"   => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}", $venta_monto)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "El NOMBRE no coincide con el formato solicitado",
                    "Tipo"   => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}", $venta_cantidad)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "El APELLIDO no coincide con el formato solicitado",
                    "Tipo"   => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if ($telefono != "") {
                if (mainModel::verificar_datos("[0-9()+]{8,20}",$venta_descuento)) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ocurrió un error inesperado",
                        "Texto"  => "El TELEFONO no coincide con el formato solicitado",
                        "Tipo"   => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }

            if ($venta_total != "") {
                if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}", $venta_total)) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ocurrió un error inesperado",
                        "Texto"  => "La DIRECCION no coincide con el formato solicitado",
                        "Tipo"   => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }
             if ($privilegio <1 || $privilegio>3) {
                 $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "El privilegio no corresponde a un valor valido",
                    "Tipo"   => "error"
                ];
                echo json_encode($alerta);
                exit();
             }
               
          /*COMPROBANDO LAS CREDIDENCIALES PARA ACTUALIZACION DATOS*/
         session_start(['name'=>'SPM']);
            if($_SESSION['privilegio_spm']!=1){
                $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ocurrió un error inesperado",
                        "Texto"  => "No tienes los permisos necesarios para actualizar esta operacion",
                        "Tipo"   => "error"
                    ];
                    echo json_encode($alerta);
                    exit();

            }
            /*Preparandos datos para  enviarlos al modelo*/

            $datos_venta_up=["venta_tipo"=>$venta_tipo,
                               "venta_monto"=>$venta_monto,
                               "venta_cantidad"=>$venta_cantidad,
                               "venta_descuento"=>$venta_descuento,
                               "venta_total"=>$venta_total,
                               "venta_id"=>$id
                               ];
                if(ventaModelo::actualizar_venta_modelo($datos_venta_up)){
                  $alerta = [
                    "Alerta"  => "recargar",
                    "Titulo" => "Datos actualizados",
                    "Texto"  => "Los datos han sido actualizados con exito",
                    "Tipo"   => "success"
                    ];
                    }else{
                      $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ocurrió un error inesperado",
                        "Texto"  => "No hemos podido actualizar los datos, por favor intenta nuevamente",
                        "Tipo"   => "error"
                    ];
                    }
                    echo json_encode($alerta);


      }/*fin de controlador*/ 
}
