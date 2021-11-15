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
cliente_rol)");

                  $sql->bindParam(":DNI",$datos['DNI']);
                  $sql->bindParam(":Nombre",$datos['Nombre']);
                  $sql->bindParam(":Apellido",$datos['Apellido']);
                  $sql->bindParam(":Telefono",$datos['Telefono']);
                  $sql->bindParam(":Direccion",$datos['Direccion']);
                  $sql->bindParam(":Email",$datos['Email']);
                  $sql->bindParam(":cliente",$datos['cliente']);
                  $sql->bindParam(":Clave",$datos['Clave']);
                  $sql->bindParam(":Estado",$datos['Estado']);
                  $sql->bindParam(":Privilegio",$datos['Privilegio']);
                  $sql->execute();

                  return $sql;

            }
             /*--------- Modelo eliminar cliente ---------*/
             protected static function eliminar_cliente_modelo($id){
                  $sql=mainModel::conectar()->prepare("DELETE FROM cliente WHERE cliente_id=:ID");

                  $sql->bindParam(":ID",$id);
                  $sql->execute();

                  return $sql;

             }
             /*Modelo datos cliente*/
             protected static function datos_cliente_modelo($tipo,$id){
                        if ($tipo=="Unico"){
                              $sql=mainModel::conectar()->prepare("SELECT * FROM cliente WHERE cliente_id=:ID");
                               $sql->bindParam(":ID",$id);
                                  
                                }
                        elseif ($tipo=="Conteo"){
                              $sql=mainModel::conectar()->prepare("SELECT cliente_id FROM cliente WHERE cliente_id!='1'");
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

                        $sql->bindParam(":cliente_id",$datos['cliente_id']);
                        $sql->bindParam(":cliente_nombre",$datos['cliente_nombre']);
                        $sql->bindParam(":Apellido",$datos['Apellido']);
                        $sql->bindParam(":Telefono",$datos['Telefono']);
                        $sql->bindParam(":Direccion",$datos['Direccion']);
                        $sql->bindParam(":Email",$datos['Email']);
                        $sql->bindParam(":cliente",$datos['cliente']);
                        $sql->bindParam(":Clave",$datos['Clave']);
                        $sql->bindParam(":Estado",$datos['Estado']);
                        $sql->bindParam(":Privilegio",$datos['Privilegio']);
                        $sql->bindParam(":ID",$datos['ID']);
                        $sql->execute();
                         return $sql;

             }

      }