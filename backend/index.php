<?php
/*
 * index.php del backend de la aplicacion.
 * El backend esta destinado a la administracion (panel de control)
 */
//----------------------------------------------
include "backend/functions.php";
const RUTA_BACKEND = "http://www.miwebdepruebas.es/BACKEND/";
const RUTA_API_BACKEND = "http://www.miwebdepruebas.es/BACKEND/API/";
//convertimos la ruta introducida en el navegador 
//a un array de tantos elemento como esten separados por / en la URL
$ruta = explode("/",$_SERVER['REQUEST_URI']);
$profundidad_directorios = 2;
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
            //si venimos con un email y una contraseña le debemos mandar a comprueba_login_backend.php
            //que lo definiremos con pagina = 2 (ir al switch del final del codigo
            if(isset($_POST['email']) && isset($_POST['contrasena'])){
                $pagina = 1;
            }
            else{
                //si no le volvemos a mandar al login
                $pagina = 0;
            }
         break;
         default:
            //preguntamos si no existe el usuario.....le mandamos al login otra vez
             redirect(RUTA_BACKEND."backend_login");
            break;
    }
}
switch($pagina){
    case 0:
        include "backend_login.php";
        break;
    case 1:
        include "comprueba_login_backend.php";
}
?>