<?php
      
      require_once "mainModel.php";

      class autoModelo extends mainModel{

            /*--------- Modelo agregar auto ---------*/
            protected static function agregar_auto_modelo($datos){
                  $sql=mainModel::conectar()->prepare("INSERT INTO vehiculo(auto_id,auto_placa,auto_chasis,auto_color,auto_modelo,auto_marca) VALUES(:auto_id,:auto_placa,:auto_chasis,:auto_color,:auto_modelo,:auto_marca)");
                  $sql->bindParam(":auto_id",null);
                  $sql->bindParam(":auto_placa",$datos['auto_placa']);
                  $sql->bindParam(":auto_chasis",$datos['auto_chasis']);
                  $sql->bindParam(":auto_color",$datos['auto_color']);
                  $sql->bindParam(":auto_modelo",$datos['auto_modelo']);
                  $sql->bindParam(":auto_marca",$datos['auto_marca']);
                  $sql->execute();

                  return $sql;

            }
             /*--------- Modelo eliminar auto ---------*/
             protected static function eliminar_auto_modelo($id){
                  $sql=mainModel::conectar()->prepare("DELETE FROM vehiculo WHERE auto_id=:auto_id");

                  $sql->bindParam(":auto_id",$id);
                  $sql->execute();

                  return $sql;

             }
             /*Modelo datos auto*/
             protected static function datos_auto_modelo($tipo,$id){
                        if ($tipo=="Unico"){
                              $sql=mainModel::conectar()->prepare("SELECT * FROM vehiculo WHERE auto_id=:auto_id");
                               $sql->bindParam(":auto_id",$id);
                                  
                                }
                        elseif ($tipo=="Conteo"){
                              $sql=mainModel::conectar()->prepare("SELECT auto_id FROM vehiculo WHERE auto_id!='1'");
                                }
                              $sql->execute();
                              return $sql;

             }
             /*Modelo actualizar auto*/

             protected static function actualizar_auto_modelo($datos){
                    $sql=mainModel::conectar()->prepare("UPDATE vehiculo SET  auto_placa=:auto_placa,auto_chasis=:auto_chasis,auto_color=:auto_color,auto_modelo=:auto_modelo,auto_marca=:auto_marca WHERE auto_id=:auto_id");

                        $sql->bindParam(":auto_id",$datos['auto_id']);
                        $sql->bindParam(":auto_placa",$datos['auto_placa']);
                        $sql->bindParam(":auto_chasis",$datos['auto_chasis']);
                        $sql->bindParam(":auto_color",$datos['auto_color']);
                        $sql->bindParam(":auto_modelo",$datos['auto_modelo']);
                        $sql->bindParam(":auto_marca",$datos['auto_marca']);
                        $sql->execute();
                         return $sql;

             }

      }