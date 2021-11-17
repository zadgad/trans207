<?php
    $peticionAjax=true;
    require_once "../config/APP.php";

    if(isset($_POST['cliente_ci_reg']) || isset($_POST['cliente_id_del']) || isset($_POST['cliente_id_up'])||isset($_POST['vehiculo_add'])){

        /*--------- Instancia al controlador ---------*/
        require_once "../controladores/clienteControlador.php";
        $ins_cliente = new clienteControlador();


        /*--------- Agregar un cliente ---------*/
        if(isset($_POST['cliente_ci_reg']) && isset($_POST['cliente_nombre_reg'])){
            echo $ins_cliente->agregar_cliente_controlador();
        }
    
          /*--------- Eliminar un cliente ---------*/
        if(isset($_POST['cliente_id_del'])){
            echo $ins_cliente->eliminar_cliente_controlador();
        }
         /*--------- Actualizar un cliente ---------*/
        if (isset($_POST['cliente_id_up'])) {
             echo $ins_cliente->actualizar_cliente_controlador();
        }
        if (isset($_POST['vehiculo_add'])||isset($_POST['cliente_add'])) {
            echo $ins_cliente->add_cliente_controlador();
            var_dump($_POST);
        }

    }else{
        session_start(['name'=>'SPM']);
        session_unset();
        session_destroy();
        header("Location: ".SERVERURL."login/");
        exit();
    }