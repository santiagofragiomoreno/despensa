<?php
///////// conexion BBDD ////////
$conexion = new mysqli('localhost','u823703154_despe','santiago87','u823703154_despe');
$conexion->set_charset('utf8');
//comprobamos si no hay errores en la conexion
if($conexion->connect_error){
    die ($conexion->connect_error);
    echo "Error en la conexion con la Base de Datos";
}
/////// chequeamos la url ////////
/*podemos venir con----> despensa/API/comprueba_codigo/ (parametros que le mandamos desde la RASPBERRY)
 ----> despensa/API/in/ (parametros que le mandamos desde la RASPBERRY)
 ----> despensa/API/out/ (parametros que le mandamos desde la RASPBERRY)
 ----> o desde cualquier otra url de la APP (perfil,productos,etc)
 */
//obtenemos la url y la separamos en un array
$url = explode("/",$_SERVER['REQUEST_URI']);
$profundidad_directorios = 2;
$msg  = array("error" => "Acceso Denegado");
for($i=0;$i<$profundidad_directorios;$i++){
    array_shift($url);
}
//print_r($url);

//preguntamos si el TOKEN es valido
//$ruta[count($ruta)-1] --- siempre recogerá el ultimo valor del array $ruta (que en este caso sera el token)
//le añadimos un ---> is_numeric(), para asegurarnos que el token no lleva letras añadidas
$token = (is_numeric($url[count($url)-1]))?intval($url[count($url)-1]):0;//funcion que genera el valor entero de lo que le metamos
$msg = array("error" => "Acceso Denegado");
//comprobacion del token para tener acceso a la API
if(($token-6)%7 == 0){
    if(count($url) == 2){ //venimos sin id
        switch ($url[0]){
            case 'comprueba_login':
                include "comprueba_login.php"; //nos vamos a comprueba_login
                break;
            case 'inserta_registro':
                include "inserta_registro.php"; //nos vamos a comprueba_login
                break;
            case 'comprueba_codigo':
                //venimos de la Raspberry y comprobamos los campos que nos manda
                if(isset($_POST['codigo_producto']) && isset($_POST['usuario'])){
                    include "comprueba_codigo.php";
                }
                break;
            case 'producto_in':
                //cuando introducimos un producto en el armario
                if(isset($_POST['codigo_producto']) && isset($_POST['peso']) && isset($_POST['usuario'])){
                    include "producto_in.php";
                }
                break;
            case 'producto_out':
                //cuando sacamos un producto en el armario
                if(isset($_POST['codigo_producto']) && isset($_POST['peso']) && isset($_POST['usuario'])){
                    include "producto_out.php";
                }
                break;
            /*
            case 'out':
                include "out.php";
                break;
            case 'alta_producto':
                include "alta_producto.php";
                break;
            case 'registro':
                include "registro.php";
                break;*/
            default:
                echo "error";
                break;
        }
    }
    //si en la ruta tenemos --- accion/id/token, comprobamos si el id es valido
    else if(count($url) == 3){
        //comprobamos si el id que nos viene en la url es realmente un id numerico------> accion/id/token
        if(is_numeric($url[1])){
            $id_consulta = $url[1];
            switch ($url[0]){
                case 'productos_usuario':
                    //el id lo tenemos en $id_consulta
                    include "productos_usuario.php";
                    break;
                case 'productos_disponibles':
                    //el id lo tenemos en $id_consulta
                    include "productos_disponibles.php";
                    break;
                case 'consumo_producto':
                    //el id lo tenemos en $id_consulta
                    include "consumo_producto.php";
                    break;
                 /*
                case 'ponencias':
                    include "ponencias.php";
                    break;
                case 'asistentes':
                    include "asistentes.php";
                    break;
                case 'preguntas':
                    include "preguntas.php";
                    break;
                default:
                    echo json_encode($msg);
                    break;*/
            }
        }
        else{
            echo json_encode($msg);
        }
    }else {
        echo json_encode($msg);
    }
}
//--------------- cerramos conexion -------------
$conexion->close();

?>