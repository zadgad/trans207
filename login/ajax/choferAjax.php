<?php
    $peticionAjax=true;
    require_once "../config/APP.php";

    if(isset($_POST['chofer_dni_reg']) || isset($_POST['chofer_id_del']) || isset($_POST['chofer_id_up'])){

        /*--------- Instancia al controlador ---------*/
        require_once "../controladores/choferControlador.php";
        $ins_chofer = new choferControlador();


        /*--------- Agregar un chofer ---------*/
        if(isset($_POST['chofer_dni_reg']) && isset($_POST['chofer_nombre_reg'])){
            echo $ins_chofer->agregar_chofer_controlador();
        }
    
          /*--------- Eliminar un chofer ---------*/
        if(isset($_POST['chofer_id_del'])){
            echo $ins_chofer->eliminar_chofer_controlador();
        }
         /*--------- Actualizar un chofer ---------*/
        if (isset($_POST['chofer_id_up'])) {
             echo $ins_chofer->actualizar_chofer_controlador();
        }

    }else{
        session_start(['name'=>'SPM']);
        session_unset();
        session_destroy();
        header("Location: ".SERVERURL."login/");
        exit();
    }