<?php

if ($peticionAjax) {
    require_once "../modelos/autoModelo.php";
} else {
    require_once "./modelos/autoModelo.php";

}

class autoControlador extends autoModelo
{

    /*--------- Controlador agregar auto ---------*/
    public function agregar_auto_controlador()
    {
        $auto_placa       = mainModel::limpiar_cadena($_POST['auto_placa_reg']);
        $auto_chasis    = mainModel::limpiar_cadena($_POST['auto_chasis_reg']);
        $auto_color  = mainModel::limpiar_cadena($_POST['auto_color_reg']);
        $auto_modelo  = mainModel::limpiar_cadena($_POST['auto_modelo_reg']);
        $auto_marca = mainModel::limpiar_cadena($_POST['auto_marca_reg']);

        /*== comprobar campos vacios ==*/
        if ($auto_placa == "" || $auto_chasis == "" || $auto_color == "" || $auto_modelo == "" || $auto_marca == "") {
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
        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{3,15}", $auto_placa)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "El Placa no coincide con el formato solicitado",
                "Tipo"   => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{3,255}", $auto_chasis)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "El chasis no coincide con el formato solicitado",
                "Tipo"   => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{3,35}", $auto_color)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "El color no coincide con el formato solicitado",
                "Tipo"   => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if ($auto_modelo != "") {
            if (mainModel::verificar_datos("[0-9()+]{4,20}", $auto_modelo)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "El modelo no coincide con el formato solicitado",
                    "Tipo"   => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }

        if (mainModel::verificar_datos("[a-zA-Z0-9]{1,35}", $auto_marca)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "El marca de auto no coincide con el formato solicitado",
                "Tipo"   => "error"
            ];
            echo json_encode($alerta);
            exit();
        }


        /*== Comprobando placa ===*/
        $check_dni = mainModel::ejecutar_consulta_simple("SELECT auto_placa FROM vehiculo WHERE auto_placa='$auto_placa'");
        if ($check_dni->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "El vehiculo con placa ingresado ya se encuentra registrado en el sistema",
                "Tipo"   => "error"
            ];

            echo json_encode($alerta);
            exit();

        }
        /*== Comprobando auto ===*/
        $check_auto = mainModel::ejecutar_consulta_simple("SELECT auto_chasis FROM vehiculo WHERE auto_chasis='$auto_chasis'");
        if ($check_auto->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "El chasis de auto ingresado ya se encuentra registrado en el sistema",
                "Tipo"   => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $datos_auto_reg = [
            "auto_placa"        => $auto_placa,
            "auto_chasis"     => $auto_chasis,
            "auto_color"   => $auto_color,
            "auto_modelo"   => $auto_modelo,
            "auto_marca"  => $auto_marca
        ];
        $agregar_auto = autoModelo::agregar_auto_modelo($datos_auto_reg);
        if ($agregar_auto->rowCount() == 1) {
            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "auto registrado",
                "Texto"  => "Los datos del auto han sido registrado con exito",
                "Tipo"   => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "No hemos podido registrar el auto",
                "Tipo"   => "error"
            ];

        }
         echo json_encode($alerta);

    } /*fin de controlador*/

    /*--------- Controlador paginar auto ---------*/
    public function paginador_auto_controlador($pagina,$registros,$privilegio,$id,$url,$busqueda)
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
        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM vehiculo WHERE ((auto_id!='$id') AND (auto_placa LIKE '%$busqueda%' OR auto_chasis LIKE '%$busqueda%' OR auto_color LIKE '%$busqueda%' OR auto_modelo LIKE '%$busqueda%' OR auto_marca LIKE '%$busqueda%')) ORDER BY auto_placa ASC LIMIT $inicio,$registros";
          
      }
      else{
       $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM vehiculo WHERE auto_id!='$id'  ORDER BY auto_placa ASC LIMIT $inicio,$registros";
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
                        <th>PLACA</th>
                        <th>CHASIS</th>
                        <th>COLOR</th>
                        <th>MODELO</th>
                        <th>MARCA</th>
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
                        <td>'.$rows['auto_placa'].'</td>
                        <td>'.$rows['auto_chasis'].'</td>
                        <td>'.$rows['auto_color'].'</td>
                        <td>'.$rows['auto_modelo'].'</td>
                        <td>'.$rows['auto_marca'].'</td>
                        <td>
                            <a href="'.SERVERURL.'auto-update/'.mainModel::encryption($rows['auto_id']).'/" class="btn btn-success">
                                    <i class="fas fa-sync-alt"></i> 
                            </a>
                        </td>
                        <td>
                        <form class="FormularioAjax" action="'.SERVERURL.'ajax/autoAjax.php" method="POST" data-form="delete" autocomplete="off">

                            <input type="hidden" name="auto_id_del" value="'.mainModel::encryption($rows['auto_id']).'">

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
                 $tabla.='<p class="text-right"> Mostrando auto '.$reg_inicio.' al '.$reg_final.' de un total de '.$total.'</p>';
                $tabla.=mainModel::paginador_tablas($pagina,$Npaginas,$url,7);
            }
        return $tabla;
    }/*fin de controlador*/

    /*--------- Controlador eliminar auto ---------*/
    public function eliminar_auto_controlador()
    {
        /*Recibiendo el id del auto*/
         
         $id=mainModel::decryption($_POST['auto_id_del']);
         $id=mainModel::limpiar_cadena($id);

         /*comprobando el auto*/
         if ($id==1) { 
            $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "No podemos eliminar el auto principal del sistema",
                    "Tipo"   => "error"
                ];
                echo json_encode($alerta);
                 exit();
             
         }
         /*Comprrobando el auto en BD*/

         $check_auto=mainModel::ejecutar_consulta_simple("SELECT auto_id FROM vehiculo WHERE auto_id='$id'");

         if ($check_auto->rowCount()<=0) {
             $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "El auto que intenta eliminar no existe en el sistema",
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

         $eliminar_auto=autoModelo::eliminar_auto_modelo($id);
         if ($eliminar_auto->rowCount() == 1) 
         {
              $alerta = [
                    "Alerta" => "recargar",
                    "Titulo" => "auto eliminado",
                    "Texto"  => "El auto ha sido eliminado del sistema exitosamente",
                    "Tipo"   => "success"
                ];
         }
         else
         {
            $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "No hemos podido eliminar el auto, por favor intente nuevamente",
                    "Tipo"   => "error"
                ];
         }
          echo json_encode($alerta);
          
        }/*fin de controlador*/  
         /*Controlodar datos auto*/
    public function datos_auto_controlador($tipo,$id){
            $tipo =mainModel::limpiar_cadena($tipo);

            $id=mainModel::decryption($id);
            $id=mainModel::limpiar_cadena($id);
            return autoModelo::datos_auto_modelo($tipo,$id);


     
     }/*fin de controlador*/ 

      /*Controlador actualizar auto*/

    public function actualizar_auto_controlador(){
            //recibiendo id
            $id=mainModel::decryption($_POST['auto_id_up']);
            $id=mainModel::limpiar_cadena($id);

            //Comprobar el auto en la BD

            $check_auto=mainModel::ejecutar_consulta_simple("SELECT * FROM vehiculo WHERE auto_id='$id'");
                if ( $check_auto->rowCount()<=0) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ocurrió un error inesperado",
                        "Texto"  => "No hemos encontrado el auto en el sistema",
                        "Tipo"   => "error"
                    ];
                    echo json_encode($alerta);
                     exit();
                }else{
                     $campos=$check_auto->fetch();
                     
                }

                /**/
                $auto_placa=mainModel::limpiar_cadena($_POST['auto_placa_up']);
                $auto_chasis=mainModel::limpiar_cadena($_POST['auto_chasis_up']);
                $auto_color=mainModel::limpiar_cadena($_POST['auto_color_up']);
                $auto_modelo=mainModel::limpiar_cadena($_POST['auto_modelo_up']);
                $auto_marca=mainModel::limpiar_cadena($_POST['auto_marca_up']);
               

                   /*== comprobar campos vacios ==*/
                   if ($auto_placa == "" || $auto_chasis == "" || $auto_color == "" || $auto_modelo == "" || $auto_marca == "") {
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
        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}", $auto_placa)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "El Placa no coincide con el formato solicitado",
                "Tipo"   => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,255}", $auto_chasis)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "El chasis no coincide con el formato solicitado",
                "Tipo"   => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{3,35}", $auto_color)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "El color no coincide con el formato solicitado",
                "Tipo"   => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if ($auto_modelo != "") {
            if (mainModel::verificar_datos("[0-9()+]{4,5}", $auto_modelo)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "El modelo no coincide con el formato solicitado",
                    "Tipo"   => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }

        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{3,35}", $auto_marca)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "El marca de auto no coincide con el formato solicitado",
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

            $datos_auto_up=[
                "auto_placa"  => $auto_placa,
                "auto_chasis" => $auto_chasis,
                "auto_color"  => $auto_color,
                "auto_modelo" => $auto_modelo,
                "auto_marca"  => $auto_marca,
                "auto_id"=>$id
                               ];
                if(autoModelo::actualizar_auto_modelo($datos_auto_up)){
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
