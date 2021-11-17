<?php
      
      require_once "mainModel.php";

      class choferModelo extends mainModel{

            /*--------- Modelo agregar chofer ---------*/
            protected static function agregar_chofer_modelo($datos){
                  $sql=mainModel::conectar()->prepare("INSERT INTO chofer(
                                                                        chofer_ci,
                                                                        chofer_nombre,
                                                                        chofer_apellidos,
                                                                        chofer_usuario,
                                                                        chofer_telefono,
                                                                        chofer_categoria,
                                                                        chofer_nacimiento,
                                                                        chofer_admincion,
                                                                        chofer_monto,
                                                                        chofer_email,
                                                                        chofer_rol,
                                                                        cliente_cliente_id) VALUE(
                                                                        :chofer_ci,
                                                                        :chofer_nombre,
                                                                        :chofer_apellidos,
                                                                        :chofer_usuario,
                                                                        :chofer_telefono,
                                                                        :chofer_categoria,
                                                                        :chofer_nacimiento,
                                                                        :chofer_admincion,
                                                                        :chofer_monto,
                                                                        :chofer_email,
                                                                        :chofer_rol,
                                                                        :cliente_cliente_id
                                                                        )");
                  $sql->bindParam(":chofer_ci",$datos['chofer_ci']);
                  $sql->bindParam(":chofer_nombre",$datos['chofer_nombre']);
                  $sql->bindParam(":chofer_apellidos",$datos['chofer_apellidos']);
                  $sql->bindParam(":chofer_usuario",$datos['chofer_usuario']);
                  $sql->bindParam(":chofer_telefono",$datos['chofer_telefono']);
                  $sql->bindParam(":chofer_categoria",$datos['chofer_categoria']);
                  $sql->bindParam(":chofer_nacimiento",$datos['chofer_nacimiento']);
                  $sql->bindParam(":chofer_admincion",$datos['chofer_admincion']);
                  $sql->bindParam(":chofer_monto",$datos['chofer_monto']);
                  $sql->bindParam(":chofer_email",$datos['chofer_email']);
                  $sql->bindParam(":chofer_rol",$datos['chofer_rol']);
                  $sql->bindParam(":cliente_cliente_id",$datos['cliente_cliente_id']);
                  $sql->execute();

                  return $sql;

            }
             /*--------- Modelo eliminar chofer ---------*/
             protected static function eliminar_chofer_modelo($id){
                  $sql=mainModel::conectar()->prepare("DELETE FROM chofer WHERE chofer_id=:chofer_id");

                  $sql->bindParam(":chofer_id",$id);
                  $sql->execute();

                  return $sql;

             }
             /*Modelo datos chofer*/
             protected static function datos_chofer_modelo($tipo,$id){
                        if ($tipo=="Unico"){
                              $sql=mainModel::conectar()->prepare("SELECT * FROM chofer WHERE chofer_id=:chofer_id");
                               $sql->bindParam(":chofer_id",$id);
                                  
                                }
                        elseif ($tipo=="Conteo"){
                              $sql=mainModel::conectar()->prepare("SELECT chofer_id FROM chofer");
                                }
                              $sql->execute();
                              return $sql;

             }
             /*Modelo actualizar chofer*/

             protected static function actualizar_chofer_modelo($datos){
                    $sql=mainModel::conectar()->prepare("UPDATE chofer SET 
                   chofer_ci=:chofer_ci,
                  chofer_nombre=:chofer_nombre,
                  chofer_apellidos=:chofer_apellidos,
                  chofer_usuario=:chofer_usuario,
                  chofer_telefono=:chofer_telefono,
                  chofer_categoria=:chofer_categoria,
                  chofer_nacimiento=:chofer_nacimiento,
                  chofer_admincion=:chofer_admincion,
                  chofer_monto=:chofer_monto,
                  chofer_email=:chofer_email,
                  chofer_rol=:chofer_rol,
                  cliente_cliente_id=:cliente_cliente_id WHERE chofer_id=:chofer_id");

                        $sql->bindParam(":chofer_ci",$datos['chofer_ci']);
                        $sql->bindParam(":chofer_nombre",$datos['chofer_nombre']);
                        $sql->bindParam(":chofer_apellidos",$datos['chofer_apellidos']);
                        $sql->bindParam(":chofer_usuario",$datos['chofer_usuario']);
                        $sql->bindParam(":chofer_telefono",$datos['chofer_telefono']);
                        $sql->bindParam(":chofer_categoria",$datos['chofer_categoria']);
                        $sql->bindParam(":chofer_nacimiento",$datos['chofer_nacimiento']);
                        $sql->bindParam(":chofer_admincion",$datos['chofer_admincion']);
                        $sql->bindParam(":chofer_monto",$datos['chofer_monto']);
                        $sql->bindParam(":chofer_email",$datos['chofer_email']);
                        $sql->bindParam(":chofer_rol",$datos['chofer_rol']);
                        $sql->bindParam(":chofer_id",$datos['chofer_id']);
                        $sql->bindParam(":cliente_cliente_id",$datos['cliente_cliente_id']);
                        $sql->execute();
                         return $sql;

             }

      }