<?php
//----------------------------------------------
session_start();
include "functions.php";
const DIRECTORIO_BASE = "http://www.miwebdepruebas.es/";
const RUTA_API = "http://www.miwebdepruebas.es/API/";
//convertimos la ruta introducida en el navegador 
//a un array de tantos elemento como esten separados por / en la URL
$ruta = explode("/",$_SERVER['REQUEST_URI']);
$profundidad_directorios = 1;
$directorio_base = "http://www.miwebdepruebas.es/";
$ruta_api = "http://www.miwebdepruebas.es/API/";
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
                    $pagina = 2;
                }
                else{
                    redirect($directorio_base."login");
                }
            }
            else{
                redirect($directorio_base."login");
            }
            break;
        case "home":
            $pagina = 1;
            break;
        
        case "registro":
            $pagina = 3;
            break;
        
        case "realiza_registro":
            $pagina = 4;
            break;
            
        case "productos":
            $pagina = 5;
            break;
            
        case "productos_disponibles":
            $pagina = 6;
            break;
        
        case "info_producto":
            if(isset($ruta[1]) && isset($ruta[2])){
                $pagina = 7;
            }
            else{
                redirect($directorio_base."login");
            }
            break;
        case "comprueba_codigo":
            $pagina = 8;
            break;
        default:
            //preguntamos si no existe el usuario.....le mandamos al login otra vez
          
                redirect($directorio_base."login");
            
            break;
    }
}
include 'header.php';
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
    case 3:
        include "registro.php";
        break;
    case 4:
        include "realiza_registro.php";
        break;
    case 5:
        include "productos.php";
        break;
    case 6:
        include "productos_disponibles.php";
        break;
    case 7:
        include "info_producto.php";
        break;
    case 8:
        include "comprueba_codigo.php";
        break;
}
include 'footer.php';
?>