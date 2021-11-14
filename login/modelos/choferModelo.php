<?php
      
      require_once "mainModel.php";

      class choferModelo extends mainModel{

            /*--------- Modelo agregar chofer ---------*/
            protected static function agregar_chofer_modelo($datos){
                  $sql=mainModel::conectar()->prepare("INSERT INTO chofer(chofer_dni,chofer_nombre,chofer_apellido,chofer_telefono,chofer_direccion,chofer_email,chofer_chofer,chofer_clave,chofer_estado,chofer_privilegio) VALUES(:DNI,:Nombre,:Apellido,:Telefono,:Direccion,:Email,:chofer,:Clave,:Estado,:Privilegio)");

                  $sql->bindParam(":DNI",$datos['DNI']);
                  $sql->bindParam(":Nombre",$datos['Nombre']);
                  $sql->bindParam(":Apellido",$datos['Apellido']);
                  $sql->bindParam(":Telefono",$datos['Telefono']);
                  $sql->bindParam(":Direccion",$datos['Direccion']);
                  $sql->bindParam(":Email",$datos['Email']);
                  $sql->bindParam(":chofer",$datos['chofer']);
                  $sql->bindParam(":Clave",$datos['Clave']);
                  $sql->bindParam(":Estado",$datos['Estado']);
                  $sql->bindParam(":Privilegio",$datos['Privilegio']);
                  $sql->execute();

                  return $sql;

            }
             /*--------- Modelo eliminar chofer ---------*/
             protected static function eliminar_chofer_modelo($id){
                  $sql=mainModel::conectar()->prepare("DELETE FROM chofer WHERE chofer_id=:ID");

                  $sql->bindParam(":ID",$id);
                  $sql->execute();

                  return $sql;

             }
             /*Modelo datos chofer*/
             protected static function datos_chofer_modelo($tipo,$id){
                        if ($tipo=="Unico"){
                              $sql=mainModel::conectar()->prepare("SELECT * FROM chofer WHERE chofer_id=:ID");
                               $sql->bindParam(":ID",$id);
                                  
                                }
                        elseif ($tipo=="Conteo"){
                              $sql=mainModel::conectar()->prepare("SELECT chofer_id FROM chofer WHERE chofer_id!='1'");
                                }
                              $sql->execute();
                              return $sql;

             }
             /*Modelo actualizar chofer*/

             protected static function actualizar_chofer_modelo($datos){
                    $sql=mainModel::conectar()->prepare("UPDATE chofer SET chofer_dni=:DNI,chofer_nombre=:Nombre,chofer_apellido=:Apellido,chofer_telefono=:Telefono,chofer_direccion=:Direccion,chofer_email=:Email,chofer_chofer=:chofer,chofer_clave=:Clave,chofer_estado=:Estado,chofer_privilegio=:Privilegio WHERE chofer_id=:ID");

                        $sql->bindParam(":DNI",$datos['DNI']);
                        $sql->bindParam(":Nombre",$datos['Nombre']);
                        $sql->bindParam(":Apellido",$datos['Apellido']);
                        $sql->bindParam(":Telefono",$datos['Telefono']);
                        $sql->bindParam(":Direccion",$datos['Direccion']);
                        $sql->bindParam(":Email",$datos['Email']);
                        $sql->bindParam(":chofer",$datos['chofer']);
                        $sql->bindParam(":Clave",$datos['Clave']);
                        $sql->bindParam(":Estado",$datos['Estado']);
                        $sql->bindParam(":Privilegio",$datos['Privilegio']);
                        $sql->bindParam(":ID",$datos['ID']);
                        $sql->execute();
                         return $sql;

             }

      }