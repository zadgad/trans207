<?php
      
      require_once "mainModel.php";

      class clienteModelo extends mainModel{

            /*--------- Modelo agregar cliente ---------*/
            protected static function agregar_cliente_modelo($datos){
                  $sql=mainModel::conectar()->prepare("INSERT INTO cliente(cliente_dni,cliente_nombre,cliente_apellido,cliente_telefono,cliente_direccion,cliente_email,cliente_cliente,cliente_clave,cliente_estado,cliente_privilegio) VALUES(:DNI,:Nombre,:Apellido,:Telefono,:Direccion,:Email,:cliente,:Clave,:Estado,:Privilegio)");

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
                    $sql=mainModel::conectar()->prepare("UPDATE cliente SET cliente_dni=:DNI,cliente_nombre=:Nombre,cliente_apellido=:Apellido,cliente_telefono=:Telefono,cliente_direccion=:Direccion,cliente_email=:Email,cliente_cliente=:cliente,cliente_clave=:Clave,cliente_estado=:Estado,cliente_privilegio=:Privilegio WHERE cliente_id=:ID");

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
                        $sql->bindParam(":ID",$datos['ID']);
                        $sql->execute();
                         return $sql;

             }

      }