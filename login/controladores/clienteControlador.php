<?php

if ($peticionAjax) {
    require_once "../modelos/clienteModelo.php";
} else {
    require_once "./modelos/clienteModelo.php";

}

class clienteControlador extends clienteModelo
{

    /*--------- Controlador agregar cliente ---------*/
    public function agregar_cliente_controlador()
    {
        $cliente_ci       = mainModel::limpiar_cadena($_POST['cliente_ci_reg']);
        $cliente_nombre    = mainModel::limpiar_cadena($_POST['cliente_nombre_reg']);
        $cliente_apellidos  = mainModel::limpiar_cadena($_POST['cliente_apellidos_reg']);
        $cliente_usuario  = mainModel::limpiar_cadena($_POST['cliente_usuario_reg']);
        $cliente_telefono = mainModel::limpiar_cadena($_POST['cliente_telefono_reg']);

        $cliente_nacimiento = mainModel::limpiar_cadena($_POST['cliente_nacimiento_reg']);
        $cliente_categoria   = mainModel::limpiar_cadena($_POST['cliente_categoria_reg']);
        $cliente_admicion  = mainModel::limpiar_cadena($_POST['cliente_admicion_reg']);
        $cliente_monto  = mainModel::limpiar_cadena($_POST['cliente_monto_reg']);

        $cliente_email = mainModel::limpiar_cadena($_POST['cliente_email_reg']);
        $cliente_rol = mainModel::limpiar_cadena($_POST['cliente_rol_reg']);

        /*== comprobar campos vacios ==*/
        if ($cliente_ci == "" || $cliente_nombre == "" || $cliente_apellidos == "" || $cliente_usuario == "" || $cliente_telefono == "" || $cliente_nacimiento == ""|| $cliente_categoria == ""|| $cliente_admicion == ""|| $cliente_monto == ""|| $cliente_email == ""|| $cliente_rol == "") {
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
        if (mainModel::verificar_datos("[0-9-]{7,20}", $cliente_ci)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "El cliente_ci no coincide con el formato solicitado",
                "Tipo"   => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}", $cliente_nombre)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "El NOMBRE no coincide con el formato solicitado",
                "Tipo"   => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}", $cliente_apellidos)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "El APELLIDO no coincide con el formato solicitado",
                "Tipo"   => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}", $cliente_usuario)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "El APELLIDO no coincide con el formato solicitado",
                "Tipo"   => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if ($cliente_telefono != "") {
            if (mainModel::verificar_datos("[0-9()+]{8,20}", $cliente_telefono)) {
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

        if ($cliente_categoria != "") {
            if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}", $cliente_categoria)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "La lic. categ no coincide con el formato solicitado",
                    "Tipo"   => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        if ($cliente_nacimiento != "") {
            if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}", $cliente_nacimiento)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "La fecha nac. no coincide con el formato solicitado",
                    "Tipo"   => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        if ($cliente_admicion != "") {
            if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}", $cliente_admicion)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "La admision no coincide con el formato solicitado",
                    "Tipo"   => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        if ($cliente_monto != "") {
            if (mainModel::verificar_datos("[0-9()+]{1,50}", $cliente_monto)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "El monto no coincide con el formato solicitado",
                    "Tipo"   => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        /*== Comprobando email ===*/

        if ($cliente_email != "") {
            if (filter_var($cliente_email, FILTER_VALIDATE_EMAIL)) {

                $check_email = mainModel::ejecutar_consulta_simple("SELECT cliente_email FROM cliente WHERE cliente_email='$cliente_email'");
                if ($check_email->rowCount() > 0) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ocurrió un error inesperado",
                        "Texto"  => "El email ingresado ya se encuentra registrado en el sistema",
                        "Tipo"   => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "Ha ingresado un correo no valido",
                    "Tipo"   => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        if ($cliente_rol != "") {
            if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}", $cliente_rol)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "La fecha nac. no coincide con el formato solicitado",
                    "Tipo"   => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
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
       

        $datos_cliente_reg = [
            "cliente_ci"        => $cliente_ci,
            "cliente_nombre"     => $cliente_nombre,
            "cliente_apellidos"   => $cliente_apellidos,
            "cliente_usuario"   => $cliente_usuario,
            "cliente_telefono"  => $cliente_telefono,
            "cliente_nacimiento"      => $cliente_nacimiento,
            "cliente_categoria"    => $cliente_categoria,
            "cliente_admicion"      => $cliente_admicion,
            "cliente_monto"     => $cliente_monto,
            "cliente_email" => $cliente_email,
            "cliente_rol" => $cliente_rol
        ];
        $agregar_cliente = clienteModelo::agregar_cliente_modelo($datos_cliente_reg);
        if ($agregar_cliente->rowCount() == 1) {
            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "cliente registrado",
                "Texto"  => "Los datos del cliente han sido registrado con exito",
                "Tipo"   => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "No hemos podido registrar el cliente",
                "Tipo"   => "error"
            ];

        }
         echo json_encode($alerta);

    } /*fin de controlador*/

    /*--------- Controlador paginar cliente ---------*/
    public function paginador_cliente_controlador($pagina,$registros,$privilegio,$id,$url,$busqueda)
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
        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM cliente WHERE ((cliente_ci LIKE '%$busqueda%' OR cliente_nombre LIKE '%$busqueda%' OR cliente_apellidos LIKE '%$busqueda%' OR cliente_telefono LIKE '%$busqueda%' OR cliente_email LIKE '%$busqueda%'  OR cliente_usuario LIKE '%$busqueda%')) ORDER BY cliente_nombre ASC LIMIT $inicio,$registros";
          
      }
      else{
       $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM cliente  ORDER BY cliente_nombre ASC LIMIT $inicio,$registros";
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
                        <th>C.I.</th>
                        <th>NOMBRE</th>
                        <th>TELÉFONO</th>
                        <th>CLIENTE</th>
                        <th>EMAIL</th>
                        <th>VEHICULOS</th>
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
                        <td>'.$rows['cliente_ci'].'</td>
                        <td>'.$rows['cliente_nombre'].' '.$rows['cliente_apellidos'].'</td>
                        <td>'.$rows['cliente_telefono'].'</td>
                        <td>'.$rows['cliente_usuario'].'</td>
                        <td>'.$rows['cliente_email'].'</td>
                        <td><a class="dropdown-item vehiculoCliente" href="#" data-id="'.mainModel::encryption($rows['cliente_id']).'" data-toggle="modal" data-target="#vehiculoModal">
                        <i class="fas fa-bus fa-sm fa-fw mr-2 text-gray-400"></i>
                        Mis Vehiculos
                         </a></td>
                        <td>
                            <a href="'.SERVERURL.'cliente-update/'.mainModel::encryption($rows['cliente_id']).'/" class="btn btn-success">
                                    <i class="fas fa-sync-alt"></i> 
                            </a>
                        </td>
                        <td>
                        <form class="FormularioAjax" action="'.SERVERURL.'ajax/clienteAjax.php" method="POST" data-form="delete" autocomplete="off">

                            <input type="hidden" name="cliente_id_del" value="'.mainModel::encryption($rows['cliente_id']).'">

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
                 $tabla.='<p class="text-right"> Mostrando cliente '.$reg_inicio.' al '.$reg_final.' de un total de '.$total.'</p>';
                $tabla.=mainModel::paginador_tablas($pagina,$Npaginas,$url,7);
            }
        return $tabla;
    }/*fin de controlador*/

    /*--------- Controlador eliminar cliente ---------*/
    public function eliminar_cliente_controlador()
    {
        /*Recibiendo el id del cliente*/
         
         $id=mainModel::decryption($_POST['cliente_id_del']);
         $id=mainModel::limpiar_cadena($id);

         /*comprobando el cliente*/
         if ($id==1) { 
            $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "No podemos eliminar el cliente principal del sistema",
                    "Tipo"   => "error"
                ];
                echo json_encode($alerta);
                 exit();
             
         }
         /*Comprrobando el cliente en BD*/

         $check_cliente=mainModel::ejecutar_consulta_simple("SELECT cliente_id FROM cliente WHERE cliente_id='$id'");

         if ($check_cliente->rowCount()<=0) {
             $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "El cliente que intenta eliminar no existe en el sistema",
                    "Tipo"   => "error"
                ];
                echo json_encode($alerta);
                 exit();
             
         }
             /*Comprrobando los prestamos*/

         $check_prestamos=mainModel::ejecutar_consulta_simple("SELECT cliente_id FROM prestamo WHERE cliente_id='$id' LIMIT 1");

         if ($check_prestamos->rowCount()>0) {
             $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "No podemos eliminar este cliente debido a que tiene prestamos asociados, recomendamos deshabilitar el cliente si ya no sera utilizado",
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

         $eliminar_cliente=clienteModelo::eliminar_cliente_modelo($id);
         if ($eliminar_cliente->rowCount() == 1) 
         {
              $alerta = [
                    "Alerta" => "recargar",
                    "Titulo" => "cliente eliminado",
                    "Texto"  => "El cliente ha sido eliminado del sistema exitosamente",
                    "Tipo"   => "success"
                ];
         }
         else
         {
            $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "No hemos podido eliminar el cliente, por favor intente nuevamente",
                    "Tipo"   => "error"
                ];
         }
          echo json_encode($alerta);
          
        }/*fin de controlador*/  
         /*Controlodar datos cliente*/
    public function datos_cliente_controlador($tipo,$id){
            $tipo =mainModel::limpiar_cadena($tipo);

            $id=mainModel::decryption($id);
            $id=mainModel::limpiar_cadena($id);
            return clienteModelo::datos_cliente_modelo($tipo,$id);


     
     }/*fin de controlador*/ 

      /*Controlador actualizar cliente*/

    public function actualizar_cliente_controlador(){
            //recibiendo id
            $id=mainModel::decryption($_POST['cliente_id_up']);
            $id=mainModel::limpiar_cadena($id);

            //Comprobar el cliente en la BD

            $check_cliente=mainModel::ejecutar_consulta_simple("SELECT * FROM cliente WHERE cliente_id='$id'");
                if ( $check_cliente->rowCount()<=0) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ocurrió un error inesperado",
                        "Texto"  => "No hemos encontrado el cliente en ele sistema",
                        "Tipo"   => "error"
                    ];
                    echo json_encode($alerta);
                     exit();
                }else{
                     $campos=$check_cliente->fetch();
                     
                }

                /**/
                $cliente_ci       = mainModel::limpiar_cadena($_POST['cliente_ci_up']);
        $cliente_nombre    = mainModel::limpiar_cadena($_POST['cliente_nombre_up']);
        $cliente_apellidos  = mainModel::limpiar_cadena($_POST['cliente_apellidos_up']);
        $cliente_usuario  = mainModel::limpiar_cadena($_POST['cliente_usuario_up']);
        $cliente_telefono = mainModel::limpiar_cadena($_POST['cliente_telefono_up']);

        $cliente_nacimiento = mainModel::limpiar_cadena($_POST['cliente_nacimiento_up']);
        $cliente_categoria   = mainModel::limpiar_cadena($_POST['cliente_categoria_up']);
        $cliente_admicion  = mainModel::limpiar_cadena($_POST['cliente_admicion_up']);
        $cliente_monto  = mainModel::limpiar_cadena($_POST['cliente_monto_up']);

        $cliente_email = mainModel::limpiar_cadena($_POST['cliente_email_up']);
        $cliente_rol = mainModel::limpiar_cadena($_POST['cliente_rol_up']);

            /*== comprobar campos vacios ==*/
            if ($cliente_ci == "" || $cliente_nombre == "" || $cliente_apellidos == "" || $cliente_usuario == "" || $cliente_telefono == "" || $cliente_nacimiento == ""|| $cliente_categoria == ""|| $cliente_admicion == ""|| $cliente_monto == ""|| $cliente_email == ""|| $cliente_rol == "") {
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
        if (mainModel::verificar_datos("[0-9-]{7,20}", $cliente_ci)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "El cliente_ci no coincide con el formato solicitado",
                "Tipo"   => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}", $cliente_nombre)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "El NOMBRE no coincide con el formato solicitado",
                "Tipo"   => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}", $cliente_apellidos)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "El APELLIDO no coincide con el formato solicitado",
                "Tipo"   => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}", $cliente_usuario)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "El APELLIDO no coincide con el formato solicitado",
                "Tipo"   => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if ($cliente_telefono != "") {
            if (mainModel::verificar_datos("[0-9()+]{8,20}", $cliente_telefono)) {
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

        if ($cliente_categoria != "") {
            if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}", $cliente_categoria)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "La lic. categ no coincide con el formato solicitado",
                    "Tipo"   => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        if ($cliente_nacimiento != "") {
            if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}", $cliente_nacimiento)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "La fecha nac. no coincide con el formato solicitado",
                    "Tipo"   => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        if ($cliente_admicion != "") {
            if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}", $cliente_admicion)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "La admision no coincide con el formato solicitado",
                    "Tipo"   => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        if ($cliente_monto != "") {
            if (mainModel::verificar_datos("[0-9()+]{1,50}", $cliente_monto)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "El monto no coincide con el formato solicitado",
                    "Tipo"   => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        /*== Comprobando email ===*/

        if ($cliente_email != "") {
            if (filter_var($cliente_email, FILTER_VALIDATE_EMAIL)) {

                $check_email = mainModel::ejecutar_consulta_simple("SELECT cliente_email FROM cliente WHERE cliente_id!=$id  AND cliente_email='$cliente_email'");
                if ($check_email->rowCount() > 0) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ocurrió un error inesperado",
                        "Texto"  => "El email ingresado ya se encuentra registrado en el sistema",
                        "Tipo"   => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "Ha ingresado un correo no valido",
                    "Tipo"   => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        if ($cliente_rol != "") {
            if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}", $cliente_rol)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "La fecha nac. no coincide con el formato solicitado",
                    "Tipo"   => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
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

            $datos_cliente_up=[
                            "cliente_ci"        => $cliente_ci,
                            "cliente_nombre"     => $cliente_nombre,
                            "cliente_apellidos"   => $cliente_apellidos,
                            "cliente_usuario"   => $cliente_usuario,
                            "cliente_telefono"  => $cliente_telefono,
                            "cliente_nacimiento"      => $cliente_nacimiento,
                            "cliente_categoria"    => $cliente_categoria,
                            "cliente_admicion"      => $cliente_admicion,
                            "cliente_monto"     => $cliente_monto,
                            "cliente_email" => $cliente_email,
                            "cliente_rol" => $cliente_rol,
                            "cliente_id"=>$id
                               ];
                if(clienteModelo::actualizar_cliente_modelo($datos_cliente_up)){
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
    public function add_cliente_controlador(){
           /*Preparandos datos para  enviarlos al modelo*/
            $id=mainModel::decryption($_POST['cliente_add']);
            $cliente_add    = mainModel::limpiar_cadena($id);
            $vehiculo_add  = mainModel::limpiar_cadena($_POST['vehiculo_add']);
            $chofer_add ="";
            if (isset($_POST['chofer_add'])) {
                $chofer_add = mainModel::limpiar_cadena($_POST['chofer_add']);
            }
            $datos_cliente_up=[
                            "cliente_add"        => $cliente_add,
                            "vehiculo_add"     => $vehiculo_add,
                             "chofer_add"     => $chofer_add
                               ];
            $alerta=[];
           if(clienteModelo::add_cliente_modelo($datos_cliente_up)){
                  $alerta = [
                    "Alerta"  => "recargar",
                    "Titulo" => "Datos asignados",
                    "Texto"  => "Los datos han sido asignados con exito",
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
         exit();
    }
    public function getCliente()
    {
        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM cliente  ORDER BY cliente_ci ASC";
        $conexion=mainModel::conectar();
        $datos= $conexion->query( $consulta);
        $datos=$datos->fetchAll();
        return $datos;
    }
    public function getVehiculo()
    {
        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM vehiculo    ORDER BY auto_placa ASC ";
        $conexion=mainModel::conectar();
        $datos= $conexion->query( $consulta);
        $datos=$datos->fetchAll();
        return $datos;
    }
    public function getChofer()
    {
        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM chofer WHERE cliente_cliente_id IS NULL  ORDER BY chofer_ci ASC";
        $conexion=mainModel::conectar();
        $datos= $conexion->query( $consulta);
        $datos=$datos->fetchAll();
        return $datos;
    }
    public function getventafecha(){
        // en esta consulta debes , mandar fechas y el ci del cliente
        $consulta="SELECT cliente_id, cliente_ci, cliente_nombre, venta_id, venta_tipo, venta_monto,venta_cantidad,venta_descuento,venta_total 
        FROM venta_cliente , cliente , venta 
        WHERE venta_cliente.venta_venta_id=venta.venta_id AND venta_cliente.cliente_cliente_id=cliente.cliente_id AND venta.created_at
         BETWEEN '2021-11-14' AND '2021-11-16'  AND  cliente.cliente_ci=8848787";
        $conexion=mainModel::conectar();
        $datos= $conexion->query( $consulta);
        $datos=$datos->fetchAll();
        return $datos;

    }
    public function getclienteauto(){
        // en esta consulta debes mandar el ci del cliente y remplazarlo

        $consulta="SELECT cliente_ci, cliente_nombre, auto_placa, auto_chasis
        FROM cliente c, cliente_vehiculo cv, vehiculo v
        WHERE c.cliente_id=cv.cliente_cliente_id AND cv.vehiculo_vehiculo_id=v.auto_id AND c.cliente_ci=78784878";
        $conexion=mainModel::conectar();
        $datos= $conexion->query( $consulta);
        $datos=$datos->fetchAll();
        return $datos;

    }
    public function getChofer2()
    {
        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM chofer  ORDER BY chofer_ci ASC";
        $conexion=mainModel::conectar();
        $datos= $conexion->query( $consulta);
        $datos=$datos->fetchAll();
        return $datos;
    }


}
