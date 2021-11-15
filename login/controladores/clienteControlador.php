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
        $dni       = mainModel::limpiar_cadena($_POST['cliente_ci_reg']);
        $nombre    = mainModel::limpiar_cadena($_POST['cliente_nombre_reg']);
        $apellido  = mainModel::limpiar_cadena($_POST['cliente_apellido_reg']);
        $telefono  = mainModel::limpiar_cadena($_POST['cliente_telefono_reg']);
        $direccion = mainModel::limpiar_cadena($_POST['cliente_direccion_reg']);

        $cliente = mainModel::limpiar_cadena($_POST['cliente_cliente_reg']);
        $email   = mainModel::limpiar_cadena($_POST['cliente_email_reg']);
        $clave1  = mainModel::limpiar_cadena($_POST['cliente_clave_1_reg']);
        $clave2  = mainModel::limpiar_cadena($_POST['cliente_clave_2_reg']);

        $privilegio = mainModel::limpiar_cadena($_POST['cliente_privilegio_reg']);

        /*== comprobar campos vacios ==*/
        if ($dni == "" || $nombre == "" || $apellido == "" || $cliente == "" || $clave1 == "" || $clave2 == "") {
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
        if (mainModel::verificar_datos("[0-9-]{10,20}", $dni)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "El DNI no coincide con el formato solicitado",
                "Tipo"   => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}", $nombre)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "El NOMBRE no coincide con el formato solicitado",
                "Tipo"   => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}", $apellido)) {
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
            if (mainModel::verificar_datos("[0-9()+]{8,20}", $telefono)) {
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

        if ($direccion != "") {
            if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}", $direccion)) {
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

        if (mainModel::verificar_datos("[a-zA-Z0-9]{1,35}", $cliente)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "El NOMBRE DE cliente no coincide con el formato solicitado",
                "Tipo"   => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $clave1) || mainModel::verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $clave2)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "Las CLAVES no coinciden con el formato solicitado",
                "Tipo"   => "error"
            ];
            echo json_encode($alerta);
            exit();

        }

        /*== Comprobando DNI ===*/
        $check_dni = mainModel::ejecutar_consulta_simple("SELECT cliente_ci FROM cliente WHERE cliente_ci='$dni'");
        if ($check_dni->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "El DNI ingresado ya se encuentra registrado en el sistema",
                "Tipo"   => "error"
            ];

            echo json_encode($alerta);
            exit();

        }
        /*== Comprobando cliente ===*/
        $check_cliente = mainModel::ejecutar_consulta_simple("SELECT cliente_cliente FROM cliente WHERE cliente_cliente='$cliente'");
        if ($check_cliente->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "El Nombre de cliente ingresado ya se encuentra registrado en el sistema",
                "Tipo"   => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        /*== Comprobando email ===*/

        if ($email != "") {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                $check_email = mainModel::ejecutar_consulta_simple("SELECT cliente_email FROM cliente WHERE cliente_email='$email'");
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

        if ($clave1 != $clave2) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "Las claves que acaba de ingresar no coinciden",
                "Tipo"   => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $clave = mainModel::encryption($clave1);
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

        $datos_cliente_reg = [
            "DNI"        => $dni,
            "Nombre"     => $nombre,
            "Apellido"   => $apellido,
            "Telefono"   => $telefono,
            "Direccion"  => $direccion,
            "Email"      => $email,
            "cliente"    => $cliente,
            "Clave"      => $clave,
            "Estado"     => "Activa",
            "Privilegio" => $privilegio
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
        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM cliente WHERE ((cliente_id!='$id' AND cliente_id!='1') AND (cliente_ci LIKE '%$busqueda%' OR cliente_nombre LIKE '%$busqueda%' OR cliente_apellido LIKE '%$busqueda%' OR cliente_telefono LIKE '%$busqueda%' OR cliente_email LIKE '%$busqueda%'  OR cliente_cliente LIKE '%$busqueda%')) ORDER BY cliente_nombre ASC LIMIT $inicio,$registros";
          
      }
      else{
       $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM cliente WHERE cliente_id!='$id' AND cliente_id!='1' ORDER BY cliente_nombre ASC LIMIT $inicio,$registros";
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
                        <th>DNI</th>
                        <th>NOMBRE</th>
                        <th>TELÉFONO</th>
                        <th>cliente</th>
                        <th>EMAIL</th>
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
                        <td>'.$rows['cliente_nombre'].' '.$rows['cliente_apellido'].'</td>
                        <td>'.$rows['cliente_telefono'].'</td>
                        <td>'.$rows['cliente_cliente'].'</td>
                        <td>'.$rows['cliente_email'].'</td>
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
                $dni=mainModel::limpiar_cadena($_POST['cliente_ci_up']);
                $nombre=mainModel::limpiar_cadena($_POST['cliente_nombre_up']);
                $apellido=mainModel::limpiar_cadena($_POST['cliente_apellido_up']);
                $telefono=mainModel::limpiar_cadena($_POST['cliente_telefono_up']);
                $direccion=mainModel::limpiar_cadena($_POST['cliente_direccion_up']);
                $cliente=mainModel::limpiar_cadena($_POST['cliente_cliente_up']);
                $email=mainModel::limpiar_cadena($_POST['cliente_email_up']);
                
                if (isset($_POST['cliente_estado_up']))
                {
                $estado=mainModel::limpiar_cadena($_POST['cliente_estado_up']);
                }
                else {
                    $estado=$campos['cliente_estado'];
                } 

                if (isset($_POST['cliente_privilegio_up']))
                {
                $privilegio=mainModel::limpiar_cadena($_POST['cliente_privilegio_up']);
                }
                else {
                    $privilegio=$campos['cliente_privilegio'];
                } 

                 
                 $admin_cliente=mainModel::limpiar_cadena($_POST['cliente_admin']); 
                 $admin_clave=mainModel::limpiar_cadena($_POST['clave_admin']); 
                 $tipo_cuenta=mainModel::limpiar_cadena($_POST['tipo_cuenta']);

                   /*== comprobar campos vacios ==*/
                    if ($dni == "" || $nombre == "" || $apellido == "" || $cliente == "" || $admin_cliente == "" || $admin_clave == "") {
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
            if (mainModel::verificar_datos("[0-9-]{10,20}", $dni)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "El DNI no coincide con el formato solicitado",
                    "Tipo"   => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}", $nombre)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "El NOMBRE no coincide con el formato solicitado",
                    "Tipo"   => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}", $apellido)) {
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
                if (mainModel::verificar_datos("[0-9()+]{8,20}", $telefono)) {
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

            if ($direccion != "") {
                if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}", $direccion)) {
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

            if (mainModel::verificar_datos("[a-zA-Z0-9]{1,35}", $cliente)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "El NOMBRE DE cliente no coincide con el formato solicitado",
                    "Tipo"   => "error"
                ];
                echo json_encode($alerta);
                exit();
            }


            if (mainModel::verificar_datos("[a-zA-Z0-9]{1,35}", $admin_cliente)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "El NOMBRE DE cliente no coincide con el formato solicitado",
                    "Tipo"   => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
             

            if (mainModel::verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $admin_clave)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "Tu CLAVE no coincide con el formato solicitado",
                    "Tipo"   => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

             $admin_clave=mainModel::encryption($admin_clave);
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

             if ($estado!= "Activa" && $estado!= "Deshabilitado") {
                 $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "El estado de la cuenta no coincide con el formato solicitado",
                    "Tipo"   => "error"
                ];
                echo json_encode($alerta);
                exit();
             }
                      /*== Comprobando DNI ===*/
                if ($dni!=$campos['cliente_ci']) {
                    
                
                $check_dni = mainModel::ejecutar_consulta_simple("SELECT cliente_ci FROM cliente WHERE cliente_ci='$dni'");
                if ($check_dni->rowCount() > 0) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ocurrió un error inesperado",
                        "Texto"  => "El DNI ingresado ya se encuentra registrado en el sistema",
                        "Tipo"   => "error"
                    ];

                    echo json_encode($alerta);
                    exit();
                 }
                }
                /*== Comprobando cliente ===*/
                if($cliente!=$campos['cliente_cliente']){

                $check_cliente = mainModel::ejecutar_consulta_simple("SELECT cliente_cliente FROM cliente WHERE cliente_cliente='$cliente'");
                if ($check_cliente->rowCount() > 0) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ocurrió un error inesperado",
                        "Texto"  => "El Nombre de cliente ingresado ya se encuentra registrado en el sistema",
                        "Tipo"   => "error"
                    ];
                    echo json_encode($alerta);
                    exit();

                 }
                }
                /*== Comprobando Email ===*/
                if ($email!=$campos['cliente_email'] && $email!=""){
                    if(filter_var($email,FILTER_VALIDATE_EMAIL)){
                        $check_email = mainModel::ejecutar_consulta_simple("SELECT cliente_email FROM cliente WHERE cliente_email='$email'");
                        if ($check_email->rowCount()>0) {
                        $alerta = [
                            "Alerta" => "simple",
                            "Titulo" => "Ocurrió un error inesperado",
                            "Texto"  => "El nuevo email ingresado ya se encuentra registrado en el sistema",
                            "Tipo"   => "error"
                    ];
                    echo json_encode($alerta);
                    exit();

                    }
                    }else{
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

           /*--Comprobando claves*/
           if ($_POST['cliente_clave_nueva_1']!= "" || $_POST['cliente_clave_nueva_2']!= "") {
               if($_POST['cliente_clave_nueva_1']!=$_POST['cliente_clave_nueva_2']){
                $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ocurrió un error inesperado",
                        "Texto"  => "Las nuevas claves ingresadas no coinciden",
                        "Tipo"   => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
               }
               else{
               if(mainModel::verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$_POST['cliente_clave_nueva_1']) || mainModel::verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$_POST['cliente_clave_nueva_2'])){
                $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ocurrió un error inesperado",
                        "Texto"  => "Las nuevas claves no coinciden  con el formato solicitado",
                        "Tipo"   => "error"
                    ];
                    echo json_encode($alerta);
                    exit();

               }
               $clave=mainModel::encryption($_POST['cliente_clave_nueva_1']);
               }
           }
           else{
            $clave=$campos['cliente_clave'];

           }
          /*COMPROBANDO LAS CREDIDENCIALES PARA ACTUALIZACION DATOS*/
           if($tipo_cuenta=="Propia")
           {
               $check_cuenta = mainModel::ejecutar_consulta_simple("SELECT cliente_id FROM cliente WHERE cliente_cliente='$admin_cliente' AND cliente_clave='$admin_clave' AND cliente_id='$id'");
           }else
           {
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
            $check_cuenta =mainModel::ejecutar_consulta_simple("SELECT cliente_id FROM cliente WHERE cliente_cliente='$admin_cliente' AND cliente_clave='$admin_clave'");
           }

           if($check_cuenta->rowCount()<=0){
             $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ocurrió un error inesperado",
                        "Texto"  => "Nombre y Clave de administrador no validos",
                        "Tipo"   => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
           }
            /*Preparandos datos para  enviarlos al modelo*/

            $datos_cliente_up=["DNI"=>$dni,
                               "Nombre"=>$nombre,
                               "Apellido"=>$apellido,
                               "Telefono"=>$telefono,
                               "Direccion"=>$direccion,
                               "Email"=>$email,
                               "cliente"=>$cliente,
                               "Clave"=>$clave,
                               "Estado"=>$estado,
                               "Privilegio"=>$privilegio,
                               "ID"=>$id
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
}
