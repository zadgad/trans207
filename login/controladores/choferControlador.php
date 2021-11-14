<?php

if ($peticionAjax) {
    require_once "../modelos/choferModelo.php";
} else {
    require_once "./modelos/choferModelo.php";

}

class choferControlador extends choferModelo
{

    /*--------- Controlador agregar chofer ---------*/
    public function agregar_chofer_controlador()
    {
        $dni       = mainModel::limpiar_cadena($_POST['chofer_dni_reg']);
        $nombre    = mainModel::limpiar_cadena($_POST['chofer_nombre_reg']);
        $apellido  = mainModel::limpiar_cadena($_POST['chofer_apellido_reg']);
        $telefono  = mainModel::limpiar_cadena($_POST['chofer_telefono_reg']);
        $direccion = mainModel::limpiar_cadena($_POST['chofer_direccion_reg']);

        $chofer = mainModel::limpiar_cadena($_POST['chofer_chofer_reg']);
        $email   = mainModel::limpiar_cadena($_POST['chofer_email_reg']);
        $clave1  = mainModel::limpiar_cadena($_POST['chofer_clave_1_reg']);
        $clave2  = mainModel::limpiar_cadena($_POST['chofer_clave_2_reg']);

        $privilegio = mainModel::limpiar_cadena($_POST['chofer_privilegio_reg']);

        /*== comprobar campos vacios ==*/
        if ($dni == "" || $nombre == "" || $apellido == "" || $chofer == "" || $clave1 == "" || $clave2 == "") {
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

        if (mainModel::verificar_datos("[a-zA-Z0-9]{1,35}", $chofer)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "El NOMBRE DE chofer no coincide con el formato solicitado",
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
        $check_dni = mainModel::ejecutar_consulta_simple("SELECT chofer_dni FROM chofer WHERE chofer_dni='$dni'");
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
        /*== Comprobando chofer ===*/
        $check_user = mainModel::ejecutar_consulta_simple("SELECT chofer_chofer FROM chofer WHERE chofer_chofer='$chofer'");
        if ($check_user->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "El Nombre de chofer ingresado ya se encuentra registrado en el sistema",
                "Tipo"   => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        /*== Comprobando email ===*/

        if ($email != "") {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                $check_email = mainModel::ejecutar_consulta_simple("SELECT chofer_email FROM chofer WHERE chofer_email='$email'");
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

        $datos_chofer_reg = [
            "DNI"        => $dni,
            "Nombre"     => $nombre,
            "Apellido"   => $apellido,
            "Telefono"   => $telefono,
            "Direccion"  => $direccion,
            "Email"      => $email,
            "chofer"    => $chofer,
            "Clave"      => $clave,
            "Estado"     => "Activa",
            "Privilegio" => $privilegio
        ];
        $agregar_chofer = choferModelo::agregar_chofer_modelo($datos_chofer_reg);
        if ($agregar_chofer->rowCount() == 1) {
            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "chofer registrado",
                "Texto"  => "Los datos del chofer han sido registrado con exito",
                "Tipo"   => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "No hemos podido registrar el chofer",
                "Tipo"   => "error"
            ];

        }
         echo json_encode($alerta);

    } /*fin de controlador*/

    /*--------- Controlador paginar chofer ---------*/
    public function paginador_chofer_controlador($pagina,$registros,$privilegio,$id,$url,$busqueda)
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
        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM chofer WHERE ((chofer_id!='$id' AND chofer_id!='1') AND (chofer_dni LIKE '%$busqueda%' OR chofer_nombre LIKE '%$busqueda%' OR chofer_apellido LIKE '%$busqueda%' OR chofer_telefono LIKE '%$busqueda%' OR chofer_email LIKE '%$busqueda%'  OR chofer_chofer LIKE '%$busqueda%')) ORDER BY chofer_nombre ASC LIMIT $inicio,$registros";
          
      }
      else{
       $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM chofer WHERE chofer_id!='$id' AND chofer_id!='1' ORDER BY chofer_nombre ASC LIMIT $inicio,$registros";
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
                        <th>chofer</th>
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
                        <td>'.$rows['chofer_dni'].'</td>
                        <td>'.$rows['chofer_nombre'].' '.$rows['chofer_apellido'].'</td>
                        <td>'.$rows['chofer_telefono'].'</td>
                        <td>'.$rows['chofer_chofer'].'</td>
                        <td>'.$rows['chofer_email'].'</td>
                        <td>
                            <a href="'.SERVERURL.'user-update/'.mainModel::encryption($rows['chofer_id']).'/" class="btn btn-success">
                                    <i class="fas fa-sync-alt"></i> 
                            </a>
                        </td>
                        <td>
                        <form class="FormularioAjax" action="'.SERVERURL.'ajax/choferAjax.php" method="POST" data-form="delete" autocomplete="off">

                            <input type="hidden" name="chofer_id_del" value="'.mainModel::encryption($rows['chofer_id']).'">

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
                 $tabla.='<p class="text-right"> Mostrando chofer '.$reg_inicio.' al '.$reg_final.' de un total de '.$total.'</p>';
                $tabla.=mainModel::paginador_tablas($pagina,$Npaginas,$url,7);
            }
        return $tabla;
    }/*fin de controlador*/

    /*--------- Controlador eliminar chofer ---------*/
    public function eliminar_chofer_controlador()
    {
        /*Recibiendo el id del chofer*/
         
         $id=mainModel::decryption($_POST['chofer_id_del']);
         $id=mainModel::limpiar_cadena($id);

         /*comprobando el chofer*/
         if ($id==1) { 
            $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "No podemos eliminar el chofer principal del sistema",
                    "Tipo"   => "error"
                ];
                echo json_encode($alerta);
                 exit();
             
         }
         /*Comprrobando el chofer en BD*/

         $check_chofer=mainModel::ejecutar_consulta_simple("SELECT chofer_id FROM chofer WHERE chofer_id='$id'");

         if ($check_chofer->rowCount()<=0) {
             $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "El chofer que intenta eliminar no existe en el sistema",
                    "Tipo"   => "error"
                ];
                echo json_encode($alerta);
                 exit();
             
         }
             /*Comprrobando los prestamos*/

         $check_prestamos=mainModel::ejecutar_consulta_simple("SELECT chofer_id FROM prestamo WHERE chofer_id='$id' LIMIT 1");

         if ($check_prestamos->rowCount()>0) {
             $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "No podemos eliminar este chofer debido a que tiene prestamos asociados, recomendamos deshabilitar el chofer si ya no sera utilizado",
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

         $eliminar_chofer=choferModelo::eliminar_chofer_modelo($id);
         if ($eliminar_chofer->rowCount() == 1) 
         {
              $alerta = [
                    "Alerta" => "recargar",
                    "Titulo" => "chofer eliminado",
                    "Texto"  => "El chofer ha sido eliminado del sistema exitosamente",
                    "Tipo"   => "success"
                ];
         }
         else
         {
            $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "No hemos podido eliminar el chofer, por favor intente nuevamente",
                    "Tipo"   => "error"
                ];
         }
          echo json_encode($alerta);
          
        }/*fin de controlador*/  
         /*Controlodar datos chofer*/
    public function datos_chofer_controlador($tipo,$id){
            $tipo =mainModel::limpiar_cadena($tipo);

            $id=mainModel::decryption($id);
            $id=mainModel::limpiar_cadena($id);
            return choferModelo::datos_chofer_modelo($tipo,$id);


     
     }/*fin de controlador*/ 

      /*Controlador actualizar chofer*/

    public function actualizar_chofer_controlador(){
            //recibiendo id
            $id=mainModel::decryption($_POST['chofer_id_up']);
            $id=mainModel::limpiar_cadena($id);

            //Comprobar el chofer en la BD

            $check_user=mainModel::ejecutar_consulta_simple("SELECT * FROM chofer WHERE chofer_id='$id'");
                if ( $check_user->rowCount()<=0) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ocurrió un error inesperado",
                        "Texto"  => "No hemos encontrado el chofer en ele sistema",
                        "Tipo"   => "error"
                    ];
                    echo json_encode($alerta);
                     exit();
                }else{
                     $campos=$check_user->fetch();
                     
                }

                /**/
                $dni=mainModel::limpiar_cadena($_POST['chofer_dni_up']);
                $nombre=mainModel::limpiar_cadena($_POST['chofer_nombre_up']);
                $apellido=mainModel::limpiar_cadena($_POST['chofer_apellido_up']);
                $telefono=mainModel::limpiar_cadena($_POST['chofer_telefono_up']);
                $direccion=mainModel::limpiar_cadena($_POST['chofer_direccion_up']);
                $chofer=mainModel::limpiar_cadena($_POST['chofer_chofer_up']);
                $email=mainModel::limpiar_cadena($_POST['chofer_email_up']);
                
                if (isset($_POST['chofer_estado_up']))
                {
                $estado=mainModel::limpiar_cadena($_POST['chofer_estado_up']);
                }
                else {
                    $estado=$campos['chofer_estado'];
                } 

                if (isset($_POST['chofer_privilegio_up']))
                {
                $privilegio=mainModel::limpiar_cadena($_POST['chofer_privilegio_up']);
                }
                else {
                    $privilegio=$campos['chofer_privilegio'];
                } 

                 
                 $admin_chofer=mainModel::limpiar_cadena($_POST['chofer_admin']); 
                 $admin_clave=mainModel::limpiar_cadena($_POST['clave_admin']); 
                 $tipo_cuenta=mainModel::limpiar_cadena($_POST['tipo_cuenta']);

                   /*== comprobar campos vacios ==*/
                    if ($dni == "" || $nombre == "" || $apellido == "" || $chofer == "" || $admin_chofer == "" || $admin_clave == "") {
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

            if (mainModel::verificar_datos("[a-zA-Z0-9]{1,35}", $chofer)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "El NOMBRE DE chofer no coincide con el formato solicitado",
                    "Tipo"   => "error"
                ];
                echo json_encode($alerta);
                exit();
            }


            if (mainModel::verificar_datos("[a-zA-Z0-9]{1,35}", $admin_chofer)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "El NOMBRE DE chofer no coincide con el formato solicitado",
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
                if ($dni!=$campos['chofer_dni']) {
                    
                
                $check_dni = mainModel::ejecutar_consulta_simple("SELECT chofer_dni FROM chofer WHERE chofer_dni='$dni'");
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
                /*== Comprobando chofer ===*/
                if($chofer!=$campos['chofer_chofer']){

                $check_user = mainModel::ejecutar_consulta_simple("SELECT chofer_chofer FROM chofer WHERE chofer_chofer='$chofer'");
                if ($check_user->rowCount() > 0) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ocurrió un error inesperado",
                        "Texto"  => "El Nombre de chofer ingresado ya se encuentra registrado en el sistema",
                        "Tipo"   => "error"
                    ];
                    echo json_encode($alerta);
                    exit();

                 }
                }
                /*== Comprobando Email ===*/
                if ($email!=$campos['chofer_email'] && $email!=""){
                    if(filter_var($email,FILTER_VALIDATE_EMAIL)){
                        $check_email = mainModel::ejecutar_consulta_simple("SELECT chofer_email FROM chofer WHERE chofer_email='$email'");
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
           if ($_POST['chofer_clave_nueva_1']!= "" || $_POST['chofer_clave_nueva_2']!= "") {
               if($_POST['chofer_clave_nueva_1']!=$_POST['chofer_clave_nueva_2']){
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
               if(mainModel::verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$_POST['chofer_clave_nueva_1']) || mainModel::verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$_POST['chofer_clave_nueva_2'])){
                $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ocurrió un error inesperado",
                        "Texto"  => "Las nuevas claves no coinciden  con el formato solicitado",
                        "Tipo"   => "error"
                    ];
                    echo json_encode($alerta);
                    exit();

               }
               $clave=mainModel::encryption($_POST['chofer_clave_nueva_1']);
               }
           }
           else{
            $clave=$campos['chofer_clave'];

           }
          /*COMPROBANDO LAS CREDIDENCIALES PARA ACTUALIZACION DATOS*/
           if($tipo_cuenta=="Propia")
           {
               $check_cuenta = mainModel::ejecutar_consulta_simple("SELECT chofer_id FROM chofer WHERE chofer_chofer='$admin_chofer' AND chofer_clave='$admin_clave' AND chofer_id='$id'");
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
            $check_cuenta =mainModel::ejecutar_consulta_simple("SELECT chofer_id FROM chofer WHERE chofer_chofer='$admin_chofer' AND chofer_clave='$admin_clave'");
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

            $datos_chofer_up=["DNI"=>$dni,
                               "Nombre"=>$nombre,
                               "Apellido"=>$apellido,
                               "Telefono"=>$telefono,
                               "Direccion"=>$direccion,
                               "Email"=>$email,
                               "chofer"=>$chofer,
                               "Clave"=>$clave,
                               "Estado"=>$estado,
                               "Privilegio"=>$privilegio,
                               "ID"=>$id
                               ];
                if(choferModelo::actualizar_chofer_modelo($datos_chofer_up)){
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
