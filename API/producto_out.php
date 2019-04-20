<?php
///////// conexion BBDD ////////
$conexion = new mysqli('localhost','u823703154_despe','santiago87','u823703154_despe');
$conexion->set_charset('utf8');
//comprobamos si no hay errores en la conexion
if($conexion->connect_error){
    die ($conexion->connect_error);
    echo "Error en la conexion con la Base de Datos";
}
$update = 0;
//comprobamos si nos llegan los parametros de la RASPBERRY
if(isset($_POST['codigo_producto']) && isset($_POST['usuario']) && isset($_POST['peso'])){
    //primero selecionamos el peso que hay del producto en la BBDD
    $consulta = "SELECT peso FROM productos WHERE id_usuario =".$_POST['usuario']." AND codigo_producto =".$_POST['codigo_producto'];
    $peso = $conexion->query($consulta);
    $peso_producto = array();
    $contador = 0;
    if($peso->num_rows > 0){
        while ($fila = $peso->fetch_assoc()){
            $peso_producto[$contador]['peso'] = $fila['peso'];
            $contador++;
        }
    }
    //una vez que nos traemos el peso de la base dde datos, le restamos el que hemos sacado de 
    //la raspberry
    $peso_actualizado = $peso_producto[0]['peso'] - $_POST['peso'];
    //actualizamos el peso del producto
    $consulta = "UPDATE productos SET peso = ".$peso_actualizado." WHERE id_usuario =".$_POST['usuario']." AND codigo_producto =".$_POST['codigo_producto'];
    if($conexion->query($consulta) === true ){
        
        echo $update = 1;
    }
    else{
        echo $update = 0;
    }
}
else{
    echo $update = 0;
}