<?php
      
      require_once "mainModel.php";

      class ventaModelo extends mainModel{

            /*--------- Modelo agregar venta ---------*/
            //venta_id	venta_tipo	venta_monto	venta_cantidad	venta_descuento	venta_total	created_at	updated_at

            protected static function agregar_venta_modelo($datos){
                  $sql=mainModel::conectar()->prepare("INSERT INTO venta(venta_tipo,venta_monto	,venta_cantidad,	venta_descuento,	venta_total) VALUES(:venta_tipo,:venta_monto,:venta_cantidad,:venta_descuento,	:venta_total)");

                  $sql->bindParam(":venta_tipo",$datos['venta_tipo']);
                  $sql->bindParam(":venta_monto",$datos['venta_monto']);
                  $sql->bindParam(":venta_cantidad",$datos['venta_cantidad']);
                  $sql->bindParam(":venta_descuento",$datos['venta_descuento']);
                  $sql->bindParam(":venta_total",$datos['venta_total']);
                  $sql->execute();

                  return $sql;

            }
             /*--------- Modelo eliminar venta ---------*/
             protected static function eliminar_venta_modelo($id){
                  $sql=mainModel::conectar()->prepare("DELETE FROM venta WHERE venta_id=:venta_id");

                  $sql->bindParam(":venta_id",$id);
                  $sql->execute();

                  return $sql;

             }
             /*Modelo datos venta*/
             protected static function datos_venta_modelo($tipo,$id){
                        if ($tipo=="Unico"){
                              $sql=mainModel::conectar()->prepare("SELECT * FROM venta WHERE venta_id=:venta_id");
                               $sql->bindParam(":venta_id",$id);
                                  
                                }
                        elseif ($tipo=="Conteo"){
                              $sql=mainModel::conectar()->prepare("SELECT venta_id FROM venta ");
                                }
                              $sql->execute();
                              return $sql;

             }
             /*Modelo actualizar venta*/

             protected static function actualizar_venta_modelo($datos){
                    $sql=mainModel::conectar()->prepare("UPDATE venta SET venta_tipo=:venta_tipo,venta_monto=:venta_monto,venta_cantidad=:venta_cantidad,venta_descuento=:venta_descuento,venta_total=:venta_total WHERE venta_id=:venta_id");

                        $sql->bindParam(":venta_tipo",$datos['venta_tipo']);
                        $sql->bindParam(":venta_monto",$datos['venta_monto']);
                        $sql->bindParam(":venta_cantidad",$datos['venta_cantidad']);
                        $sql->bindParam(":venta_descuento",$datos['venta_descuento']);
                        $sql->bindParam(":venta_total",$datos['venta_total']);
                        $sql->bindParam(":venta_id",$datos['venta_id']);
                        $sql->execute();
                         return $sql;

             }

      }