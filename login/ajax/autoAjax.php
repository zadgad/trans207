<?php
    $peticionAjax=true;
    require_once "../config/APP.php";

    if(isset($_POST['auto_dni_reg']) || isset($_POST['auto_id_del']) || isset($_POST['auto_id_up'])){

        /*--------- Instancia al controlador ---------*/
        require_once "../controladores/autoControlador.php";
        $ins_auto = new autoControlador();


        /*--------- Agregar un auto ---------*/
        if(isset($_POST['auto_dni_reg']) && isset($_POST['auto_nombre_reg'])){
            echo $ins_auto->agregar_auto_controlador();
        }
    
          /*--------- Eliminar un auto ---------*/
        if(isset($_POST['auto_id_del'])){
            echo $ins_auto->eliminar_auto_controlador();
        }
         /*--------- Actualizar un auto ---------*/
        if (isset($_POST['auto_id_up'])) {
             echo $ins_auto->actualizar_auto_controlador();
        }

    }else{
        session_start(['name'=>'SPM']);
        session_unset();
        session_destroy();
        header("Location: ".SERVERURL."login/");
        exit();
    }