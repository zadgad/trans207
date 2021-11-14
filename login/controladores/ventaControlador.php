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
        $dni       = mainModel::limpiar_cadena($_POST['venta_dni_reg']);
        $nombre    = mainModel::limpiar_cadena($_POST['venta_nombre_reg']);
        $apellido  = mainModel::limpiar_cadena($_POST['venta_apellido_reg']);
        $telefono  = mainModel::limpiar_cadena($_POST['venta_telefono_reg']);
        $direccion = mainModel::limpiar_cadena($_POST['venta_direccion_reg']);

        $venta = mainModel::limpiar_cadena($_POST['venta_venta_reg']);
        $email   = mainModel::limpiar_cadena($_POST['venta_email_reg']);
        $clave1  = mainModel::limpiar_cadena($_POST['venta_clave_1_reg']);
        $clave2  = mainModel::limpiar_cadena($_POST['venta_clave_2_reg']);

        $privilegio = mainModel::limpiar_cadena($_POST['venta_privilegio_reg']);

        /*== comprobar campos vacios ==*/
        if ($dni == "" || $nombre == "" || $apellido == "" || $venta == "" || $clave1 == "" || $clave2 == "") {
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
        $check_dni = mainModel::ejecutar_consulta_simple("SELECT venta_dni FROM venta WHERE venta_dni='$dni'");
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
        /*== Comprobando venta ===*/
        $check_user = mainModel::ejecutar_consulta_simple("SELECT venta_venta FROM venta WHERE venta_venta='$venta'");
        if ($check_user->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "El Nombre de venta ingresado ya se encuentra registrado en el sistema",
                "Tipo"   => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        /*== Comprobando email ===*/

        if ($email != "") {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                $check_email = mainModel::ejecutar_consulta_simple("SELECT venta_email FROM venta WHERE venta_email='$email'");
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

        $datos_venta_reg = [
            "DNI"        => $dni,
            "Nombre"     => $nombre,
            "Apellido"   => $apellido,
            "Telefono"   => $telefono,
            "Direccion"  => $direccion,
            "Email"      => $email,
            "venta"    => $venta,
            "Clave"      => $clave,
            "Estado"     => "Activa",
            "Privilegio" => $privilegio
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
        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM venta WHERE ((venta_id!='$id' AND venta_id!='1') AND (venta_dni LIKE '%$busqueda%' OR venta_nombre LIKE '%$busqueda%' OR venta_apellido LIKE '%$busqueda%' OR venta_telefono LIKE '%$busqueda%' OR venta_email LIKE '%$busqueda%'  OR venta_venta LIKE '%$busqueda%')) ORDER BY venta_nombre ASC LIMIT $inicio,$registros";
          
      }
      else{
       $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM venta WHERE venta_id!='$id' AND venta_id!='1' ORDER BY venta_nombre ASC LIMIT $inicio,$registros";
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
                        <th>venta</th>
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
                        <td>'.$rows['venta_dni'].'</td>
                        <td>'.$rows['venta_nombre'].' '.$rows['venta_apellido'].'</td>
                        <td>'.$rows['venta_telefono'].'</td>
                        <td>'.$rows['venta_venta'].'</td>
                        <td>'.$rows['venta_email'].'</td>
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
             /*Comprrobando los prestamos*/

         $check_prestamos=mainModel::ejecutar_consulta_simple("SELECT venta_id FROM prestamo WHERE venta_id='$id' LIMIT 1");

         if ($check_prestamos->rowCount()>0) {
             $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "No podemos eliminar este venta debido a que tiene prestamos asociados, recomendamos deshabilitar el venta si ya no sera utilizado",
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
                $dni=mainModel::limpiar_cadena($_POST['venta_dni_up']);
                $nombre=mainModel::limpiar_cadena($_POST['venta_nombre_up']);
                $apellido=mainModel::limpiar_cadena($_POST['venta_apellido_up']);
                $telefono=mainModel::limpiar_cadena($_POST['venta_telefono_up']);
                $direccion=mainModel::limpiar_cadena($_POST['venta_direccion_up']);
                $venta=mainModel::limpiar_cadena($_POST['venta_venta_up']);
                $email=mainModel::limpiar_cadena($_POST['venta_email_up']);
                
                if (isset($_POST['venta_estado_up']))
                {
                $estado=mainModel::limpiar_cadena($_POST['venta_estado_up']);
                }
                else {
                    $estado=$campos['venta_estado'];
                } 

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
                    if ($dni == "" || $nombre == "" || $apellido == "" || $venta == "" || $admin_venta == "" || $admin_clave == "") {
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


            if (mainModel::verificar_datos("[a-zA-Z0-9]{1,35}", $admin_venta)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "El NOMBRE DE venta no coincide con el formato solicitado",
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
                if ($dni!=$campos['venta_dni']) {
                    
                
                $check_dni = mainModel::ejecutar_consulta_simple("SELECT venta_dni FROM venta WHERE venta_dni='$dni'");
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
                /*== Comprobando venta ===*/
                if($venta!=$campos['venta_venta']){

                $check_user = mainModel::ejecutar_consulta_simple("SELECT venta_venta FROM venta WHERE venta_venta='$venta'");
                if ($check_user->rowCount() > 0) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ocurrió un error inesperado",
                        "Texto"  => "El Nombre de venta ingresado ya se encuentra registrado en el sistema",
                        "Tipo"   => "error"
                    ];
                    echo json_encode($alerta);
                    exit();

                 }
                }
                /*== Comprobando Email ===*/
                if ($email!=$campos['venta_email'] && $email!=""){
                    if(filter_var($email,FILTER_VALIDATE_EMAIL)){
                        $check_email = mainModel::ejecutar_consulta_simple("SELECT venta_email FROM venta WHERE venta_email='$email'");
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
           if ($_POST['venta_clave_nueva_1']!= "" || $_POST['venta_clave_nueva_2']!= "") {
               if($_POST['venta_clave_nueva_1']!=$_POST['venta_clave_nueva_2']){
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
               if(mainModel::verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$_POST['venta_clave_nueva_1']) || mainModel::verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$_POST['venta_clave_nueva_2'])){
                $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ocurrió un error inesperado",
                        "Texto"  => "Las nuevas claves no coinciden  con el formato solicitado",
                        "Tipo"   => "error"
                    ];
                    echo json_encode($alerta);
                    exit();

               }
               $clave=mainModel::encryption($_POST['venta_clave_nueva_1']);
               }
           }
           else{
            $clave=$campos['venta_clave'];

           }
          /*COMPROBANDO LAS CREDIDENCIALES PARA ACTUALIZACION DATOS*/
           if($tipo_cuenta=="Propia")
           {
               $check_cuenta = mainModel::ejecutar_consulta_simple("SELECT venta_id FROM venta WHERE venta_venta='$admin_venta' AND venta_clave='$admin_clave' AND venta_id='$id'");
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
            $check_cuenta =mainModel::ejecutar_consulta_simple("SELECT venta_id FROM venta WHERE venta_venta='$admin_venta' AND venta_clave='$admin_clave'");
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

            $datos_venta_up=["DNI"=>$dni,
                               "Nombre"=>$nombre,
                               "Apellido"=>$apellido,
                               "Telefono"=>$telefono,
                               "Direccion"=>$direccion,
                               "Email"=>$email,
                               "venta"=>$venta,
                               "Clave"=>$clave,
                               "Estado"=>$estado,
                               "Privilegio"=>$privilegio,
                               "ID"=>$id
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
