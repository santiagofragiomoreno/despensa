<?php
//----------------------------------------------
include "functions.php";
//convertimos la ruta introducida en el navegador 
//a un array de tantos elemento como esten separados por / en la URL
$ruta = explode("/",$_SERVER['REQUEST_URI']);
$profundidad_directorios = 2;
$directorio_base = "http://localhost/despensa/";
$ruta_api = "http://localhost/despensa/API";
for($i=0;$i<$profundidad_directorios;$i++){
    array_shift($ruta);
}
//----------------------------------------------
$pagina = 0;
//si existe $ruta[0]....hacemos un switch para ver donde quiere ir la persona
if(isset($ruta[0])){
    //determinamos a donde le mandamos
    switch ($ruta[0]){
        case "login":
            //si venimos con un email y una contraseña le debemos mandar a comprueba_login.php
            //que lo definiremos con pagina = 2 (ir al switch del final del codigo
            if(isset($_POST['email']) && isset($_POST['contrasena'])){
                $pagina = 2;
            }
            else{
                $pagina = 0;
            }
         break;
        case "comprueba_login":
            //si venimos con un email y una contraseña
            if(isset($_POST['email']) && isset($_POST['contrasena'])){
                if(($_POST['email'] != '') && ($_POST['contrasena'] != '')){
                    $pagina = 8;
                }
                else{
                    redirect($directorio_base."login");
                }
            }
            else{
                redirect($directorio_base."login");
            }
            break;
        
        default:
            //preguntamos si no existe el usuario.....le mandamos al login otra vez
          
                redirect($directorio_base."login");
            
            break;
    }
}
switch($pagina){
    case 0:
        include "login.php";
        break;
    case 1:
        include "home.php";
        break;
    case 2:
        include "comprueba_login.php";
        break;
   
}
?>