<?php
    $peticionAjax=true;
    require_once "../config/APP.php";

    if(isset($_POST['venta_tipo_reg']) || isset($_POST['venta_id_del']) || isset($_POST['venta_id_up'])){

        /*--------- Instancia al controlador ---------*/
        require_once "../controladores/ventaControlador.php";
        $ins_venta = new ventaControlador();


        /*--------- Agregar un venta ---------*/
        if(isset($_POST['venta_tipo_reg']) && isset($_POST['venta_monto_reg'])){
            echo $ins_venta->agregar_venta_controlador();
        }
    
          /*--------- Eliminar un venta ---------*/
        if(isset($_POST['venta_id_del'])){
            echo $ins_venta->eliminar_venta_controlador();
        }
         /*--------- Actualizar un venta ---------*/
        if (isset($_POST['venta_id_up'])) {
             echo $ins_venta->actualizar_venta_controlador();
        }

    }else{
        session_start(['name'=>'SPM']);
        session_unset();
        session_destroy();
        header("Location: ".SERVERURL."login/");
        exit();
    }