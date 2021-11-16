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
        $chofer_ci       = mainModel::limpiar_cadena($_POST['chofer_ci_reg']);
        $chofer_nombre    = mainModel::limpiar_cadena($_POST['chofer_nombre_reg']);
        $chofer_apellidos  = mainModel::limpiar_cadena($_POST['chofer_apellidos_reg']);
        $chofer_usuario  = mainModel::limpiar_cadena($_POST['chofer_usuario_reg']);
        $chofer_telefono = mainModel::limpiar_cadena($_POST['chofer_telefono_reg']);

        $chofer_nacimiento = mainModel::limpiar_cadena($_POST['chofer_nacimiento_reg']);
        $chofer_categoria   = mainModel::limpiar_cadena($_POST['chofer_categoria_reg']);
        $chofer_admincion  = mainModel::limpiar_cadena($_POST['chofer_admincion_reg']);
        $chofer_monto  = mainModel::limpiar_cadena($_POST['chofer_monto_reg']);

        $chofer_email = mainModel::limpiar_cadena($_POST['chofer_email_reg']);
        $chofer_rol = mainModel::limpiar_cadena($_POST['chofer_rol_reg']);

        /*== comprobar campos vacios ==*/
        if ($chofer_ci == "" || $chofer_nombre == "" || $chofer_apellidos == "" || $chofer_usuario == "" || $chofer_telefono == "" || $chofer_nacimiento == ""|| $chofer_categoria == ""|| $chofer_admincion == ""|| $chofer_monto == ""|| $chofer_email == ""|| $chofer_rol == "") {
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
        if (mainModel::verificar_datos("[0-9-]{7,20}", $chofer_ci)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "El chofer_ci no coincide con el formato solicitado",
                "Tipo"   => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}", $chofer_nombre)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "El NOMBRE no coincide con el formato solicitado",
                "Tipo"   => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}", $chofer_apellidos)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "El APELLIDO no coincide con el formato solicitado",
                "Tipo"   => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}", $chofer_usuario)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "El APELLIDO no coincide con el formato solicitado",
                "Tipo"   => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if ($chofer_telefono != "") {
            if (mainModel::verificar_datos("[0-9()+]{8,20}", $chofer_telefono)) {
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

        if ($chofer_categoria != "") {
            if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}", $chofer_categoria)) {
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
        if ($chofer_nacimiento != "") {
            if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}", $chofer_nacimiento)) {
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
        if ($chofer_admincion != "") {
            if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}", $chofer_admincion)) {
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
        if ($chofer_monto != "") {
            if (mainModel::verificar_datos("[0-9()+]{1,50}", $chofer_monto)) {
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

        if ($chofer_email != "") {
            if (filter_var($chofer_email, FILTER_VALIDATE_EMAIL)) {

                $check_email = mainModel::ejecutar_consulta_simple("SELECT chofer_email FROM chofer WHERE chofer_email='$chofer_email'");
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
        if ($chofer_rol != "") {
            if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}", $chofer_rol)) {
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
       

        $datos_chofer_reg = [
            "chofer_ci"        => $chofer_ci,
            "chofer_nombre"     => $chofer_nombre,
            "chofer_apellidos"   => $chofer_apellidos,
            "chofer_usuario"   => $chofer_usuario,
            "chofer_telefono"  => $chofer_telefono,
            "chofer_nacimiento"      => $chofer_nacimiento,
            "chofer_categoria"    => $chofer_categoria,
            "chofer_admincion"      => $chofer_admincion,
            "chofer_monto"     => $chofer_monto,
            "chofer_email" => $chofer_email,
            "chofer_rol" => $chofer_rol
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
        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM chofer WHERE ((chofer_ci LIKE '%$busqueda%' OR chofer_nombre LIKE '%$busqueda%' OR chofer_apellidos LIKE '%$busqueda%' OR chofer_telefono LIKE '%$busqueda%' OR chofer_email LIKE '%$busqueda%'  OR chofer_usuario LIKE '%$busqueda%')) ORDER BY chofer_nombre ASC LIMIT $inicio,$registros";
          
      }
      else{
       $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM chofer  ORDER BY chofer_nombre ASC LIMIT $inicio,$registros";
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
                        <th>chofer</th>
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
                        <td>'.$rows['chofer_ci'].'</td>
                        <td>'.$rows['chofer_nombre'].' '.$rows['chofer_apellidos'].'</td>
                        <td>'.$rows['chofer_telefono'].'</td>
                        <td>'.$rows['chofer_usuario'].'</td>
                        <td>'.$rows['chofer_email'].'</td>
                        <td><a class="dropdown-item" href="#" data-id="'.mainModel::encryption($rows['chofer_id']).'" data-toggle="modal" data-target="#vehiculoModal">
                        <i class="fas fa-bus fa-sm fa-fw mr-2 text-gray-400"></i>
                        Mis Vehiculos
                         </a></td>
                        <td>
                            <a href="'.SERVERURL.'chofer-update/'.mainModel::encryption($rows['chofer_id']).'/" class="btn btn-success">
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

            $check_chofer=mainModel::ejecutar_consulta_simple("SELECT * FROM chofer WHERE chofer_id='$id'");
                if ( $check_chofer->rowCount()<=0) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ocurrió un error inesperado",
                        "Texto"  => "No hemos encontrado el chofer en ele sistema",
                        "Tipo"   => "error"
                    ];
                    echo json_encode($alerta);
                     exit();
                }else{
                     $campos=$check_chofer->fetch();
                     
                }

                /**/
                $chofer_ci       = mainModel::limpiar_cadena($_POST['chofer_ci_up']);
        $chofer_nombre    = mainModel::limpiar_cadena($_POST['chofer_nombre_up']);
        $chofer_apellidos  = mainModel::limpiar_cadena($_POST['chofer_apellidos_up']);
        $chofer_usuario  = mainModel::limpiar_cadena($_POST['chofer_usuario_up']);
        $chofer_telefono = mainModel::limpiar_cadena($_POST['chofer_telefono_up']);

        $chofer_nacimiento = mainModel::limpiar_cadena($_POST['chofer_nacimiento_up']);
        $chofer_categoria   = mainModel::limpiar_cadena($_POST['chofer_categoria_up']);
        $chofer_admincion  = mainModel::limpiar_cadena($_POST['chofer_admincion_up']);
        $chofer_monto  = mainModel::limpiar_cadena($_POST['chofer_monto_up']);

        $chofer_email = mainModel::limpiar_cadena($_POST['chofer_email_up']);
        $chofer_rol = mainModel::limpiar_cadena($_POST['chofer_rol_up']);

            /*== comprobar campos vacios ==*/
            if ($chofer_ci == "" || $chofer_nombre == "" || $chofer_apellidos == "" || $chofer_usuario == "" || $chofer_telefono == "" || $chofer_nacimiento == ""|| $chofer_categoria == ""|| $chofer_admincion == ""|| $chofer_monto == ""|| $chofer_email == ""|| $chofer_rol == "") {
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
        if (mainModel::verificar_datos("[0-9-]{7,20}", $chofer_ci)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "El chofer_ci no coincide con el formato solicitado",
                "Tipo"   => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}", $chofer_nombre)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "El NOMBRE no coincide con el formato solicitado",
                "Tipo"   => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}", $chofer_apellidos)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "El APELLIDO no coincide con el formato solicitado",
                "Tipo"   => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}", $chofer_usuario)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "El APELLIDO no coincide con el formato solicitado",
                "Tipo"   => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if ($chofer_telefono != "") {
            if (mainModel::verificar_datos("[0-9()+]{8,20}", $chofer_telefono)) {
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

        if ($chofer_categoria != "") {
            if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}", $chofer_categoria)) {
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
        if ($chofer_nacimiento != "") {
            if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}", $chofer_nacimiento)) {
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
        if ($chofer_admincion != "") {
            if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}", $chofer_admincion)) {
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
        if ($chofer_monto != "") {
            if (mainModel::verificar_datos("[0-9()+]{1,50}", $chofer_monto)) {
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

        if ($chofer_email != "") {
            if (filter_var($chofer_email, FILTER_VALIDATE_EMAIL)) {

                $check_email = mainModel::ejecutar_consulta_simple("SELECT chofer_email FROM chofer WHERE chofer_id!=$id  AND chofer_email='$chofer_email'");
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
        if ($chofer_rol != "") {
            if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}", $chofer_rol)) {
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

            $datos_chofer_up=[
                            "chofer_ci"        => $chofer_ci,
                            "chofer_nombre"     => $chofer_nombre,
                            "chofer_apellidos"   => $chofer_apellidos,
                            "chofer_usuario"   => $chofer_usuario,
                            "chofer_telefono"  => $chofer_telefono,
                            "chofer_nacimiento"      => $chofer_nacimiento,
                            "chofer_categoria"    => $chofer_categoria,
                            "chofer_admincion"      => $chofer_admincion,
                            "chofer_monto"     => $chofer_monto,
                            "chofer_email" => $chofer_email,
                            "chofer_rol" => $chofer_rol,
                            "chofer_id"=>$id
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
                }

         /*fin de controlador*/ 
}
