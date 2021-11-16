<?php
      
      require_once "mainModel.php";

      class clienteModelo extends mainModel{

            /*--------- Modelo agregar cliente ---------*/
            protected static function agregar_cliente_modelo($datos){
                  $sql=mainModel::conectar()->prepare("INSERT INTO cliente(
cliente_ci,
cliente_nombre,
cliente_apellidos,
cliente_usuario,
cliente_telefono,
cliente_nacimiento,
cliente_categoria,
cliente_admicion,
cliente_monto,
cliente_email,
cliente_rol) VALUES(
:cliente_ci,
:cliente_nombre,
:cliente_apellidos,
:cliente_usuario,
:cliente_telefono,
:cliente_nacimiento,
:cliente_categoria,
:cliente_admicion,
:cliente_monto,
:cliente_email,
:cliente_rol)");
                        $sql->bindParam(":cliente_ci",$datos['cliente_ci']);
                        $sql->bindParam(":cliente_nombre",$datos['cliente_nombre']);
                        $sql->bindParam(":cliente_apellidos",$datos['cliente_apellidos']);
                        $sql->bindParam(":cliente_usuario",$datos['cliente_usuario']);
                        $sql->bindParam(":cliente_telefono",$datos['cliente_telefono']);
                        $sql->bindParam(":cliente_nacimiento",$datos['cliente_nacimiento']);
                        $sql->bindParam(":cliente_categoria",$datos['cliente_categoria']);
                        $sql->bindParam(":cliente_admicion",$datos['cliente_admicion']);
                        $sql->bindParam(":cliente_monto",$datos['cliente_monto']);
                        $sql->bindParam(":cliente_email",$datos['cliente_email']);
                        $sql->bindParam(":cliente_rol",$datos['cliente_rol']);
                  $sql->execute();

                  return $sql;

            }
             /*--------- Modelo eliminar cliente ---------*/
             protected static function eliminar_cliente_modelo($id){
                  $sql=mainModel::conectar()->prepare("DELETE FROM cliente WHERE cliente_id=:cliente_id");

                  $sql->bindParam(":cliente_id",$id);
                  $sql->execute();

                  return $sql;

             }
             /*Modelo datos cliente*/
             protected static function datos_cliente_modelo($tipo,$id){
                        if ($tipo=="Unico"){
                              $sql=mainModel::conectar()->prepare("SELECT * FROM cliente WHERE cliente_id=:cliente_id");
                               $sql->bindParam(":cliente_id",$id);
                                  
                                }
                        elseif ($tipo=="Conteo"){
                              $sql=mainModel::conectar()->prepare("SELECT cliente_id FROM cliente ");
                                }
                              $sql->execute();
                              return $sql;

             }
             /*Modelo actualizar cliente*/

             protected static function actualizar_cliente_modelo($datos){
                    $sql=mainModel::conectar()->prepare("UPDATE cliente SET 
cliente_ci=:cliente_ci,
cliente_nombre=:cliente_nombre,
cliente_apellidos=:cliente_apellidos,
cliente_usuario=:cliente_usuario,
cliente_telefono=:cliente_telefono,
cliente_nacimiento=:cliente_nacimiento,
cliente_categoria=:cliente_categoria,
cliente_admicion=:cliente_admicion,
cliente_monto=:cliente_monto,
cliente_email=:cliente_email,
cliente_rol=:cliente_rol WHERE cliente_id=:cliente_id");
                        $sql->bindParam(":cliente_ci",$datos['cliente_ci']);
                        $sql->bindParam(":cliente_nombre",$datos['cliente_nombre']);
                        $sql->bindParam(":cliente_apellidos",$datos['cliente_apellidos']);
                        $sql->bindParam(":cliente_usuario",$datos['cliente_usuario']);
                        $sql->bindParam(":cliente_telefono",$datos['cliente_telefono']);
                        $sql->bindParam(":cliente_nacimiento",$datos['cliente_nacimiento']);
                        $sql->bindParam(":cliente_categoria",$datos['cliente_categoria']);
                        $sql->bindParam(":cliente_admicion",$datos['cliente_admicion']);
                        $sql->bindParam(":cliente_monto",$datos['cliente_monto']);
                        $sql->bindParam(":cliente_email",$datos['cliente_email']);
                        $sql->bindParam(":cliente_rol",$datos['cliente_rol']);
                        $sql->bindParam(":cliente_id",$datos['cliente_id']);
                        $sql->execute();
                         return $sql;

             }

      }