<?php 

  session_start(['name'=>'SPM']);
  require_once"../config/APP.php";
/*https://mega.nz/folder/sSAQQBrD#rS8gHwYmJ8o2ID_bWjgFFw*/
if(isset($_POST['busqueda_inicial']) || isset($_POST['eliminar_busqueda']) || 
  isset($_POST['fecha_inicio']) || isset($_POST['fecha_final']))
  { 
        $data_url = [
         "usuario"=>"user-search",
         
         "prestamo"=>"reservation-search"

        ];


    if(isset($_POST['modulo']))
    {
        $modulo=$_POST['modulo'];

        if(!isset($data_url[$modulo]))
        {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto"  => "No podemos continuar con la busqueda a un error",
                    "Tipo"   => "error"
                    ];
                  echo json_encode($alerta);
                  exit();

        }
     } else
     {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto"  => "No podemos continuar con la busqueda a un error de configuracion",
                "Tipo"   => "error"
                ];
            echo json_encode($alerta);
            exit();
    }
      

      if($modulo=="prestamo")
        {
           $fecha_inicio="fecha_inicio_".$modulo;
           $fecha_final="fecha_final_".$modulo;

             //Iniciar busqueda
            if(isset($_POST['fecha_inicio']) || isset($_POST['fecha_final']))
              {
                if($_POST['fecha_inicio']=="" || $_POST['fecha_final']="")
                {
  
                      $alerta = [
                          "Alerta" => "simple",
                          "Titulo" => "Ocurrió un error inesperado",
                          "Texto"  => "Por favor introduce una fecha de inicio y una fecha final",
                          "Tipo"   => "error"
                      ];
                      echo json_encode($alerta);
                      exit();
                 }
                    $_SESSION[$fecha_inicio]= $_POST['fecha_inicio'];
                    $_SESSION[$fecha_final]= $_POST['fecha_final'];

             }

             //Eliminar busqueda
               if(isset($_POST['eliminar_busqueda'])){
                 unset($_SESSION[$fecha_inicio]);
                 unset($_SESSION[$fecha_final]);
               }

        }
          else{
                 $name_var="busqueda_".$modulo;
                  //iniciar busqueda
                 if(isset($_POST['busqueda_inicial'])){
                   if($_POST['busqueda_inicial']==""){
                           $alerta = [
                                "Alerta" => "simple",
                                "Titulo" => "Ocurrió un error inesperado",
                                "Texto"  => "Por favor introduce un termino de busqueda para empezar",
                                "Tipo"   => "error"
                              ];
                            echo json_encode($alerta);
                            exit();
                        }
                          $_SESSION[$name_var]=$_POST['busqueda_inicial'];
                    }

                   //eliminar busqueda
                    if(isset($_POST['eliminar_busqueda'])){
                        unset($_SESSION[$name_var]);

                    }

                }
            
                 //Redireccionar
                  $url=$data_url[$modulo];

                  $alerta=[

                          "Alerta"=> "redireccionar",
                          "URL"=> SERVERURL.$url."/"

                         ];
                      echo json_encode($alerta);
}
    
      else
      {
        session_unset();
        session_destroy();
        header("Location: ".SERVERURL."login/");
        exit();

         }