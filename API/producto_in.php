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
    //actualizamos el peso del producto
    $consulta = "UPDATE productos SET peso = ".$_POST['peso']." WHERE id_usuario =".$_POST['usuario']." AND codigo_producto =".$_POST['codigo_producto'];
    if($conexion->query($consulta) === true ){
        echo $update = 1;
        //recuperamos el id del producto del usuario
        $consulta = "SELECT id FROM productos WHERE codigo_producto = ".$_POST['codigo_producto']." AND id_usuario = ".$_POST['usuario'];
        $id_producto = $conexion->query($consulta);
        $contador = 0;
        $id = array();
        $ok = 0;
        if($id_producto->num_rows>0){
            while ($fila = $id_producto->fetch_assoc()){
                //$estudiantes[$contador]["id"]       = $fila["id"];
                $id[$contador]["id"]   = $fila["id"];
                $contador++;
            }
        }
        $fecha_consumo = date("d-m-Y");
        $consulta = "INSERT INTO consumo_productos (id_producto,id_usuario,consumo_producto) VALUES ('".$id[0]["id"]."','".$_POST['usuario']."','".$_POST['peso']."')";
        if($conexion->query($consulta) === true){
            $ok = 1;
        }
    }
    else{
        echo $update = 0;
    }
}
else{
    echo $update = 0;
}