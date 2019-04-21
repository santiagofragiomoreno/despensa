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
    //primero miramos si ya hay peso de ese producto metido
    //recuperamos el peso que haya de ese producto
    $consulta = "SELECT peso FROM productos WHERE codigo_producto = ".$_POST['codigo_producto']." AND id_usuario = ".$_POST['usuario'];
    $resultado_consulta = $conexion->query($consulta);//nos devuelve un objeto
    $contador = 0;
    $peso = array();
    if($resultado_consulta->num_rows>0){
        while ($fila = $resultado_consulta->fetch_assoc()){
            //$estudiantes[$contador]["id"]       = $fila["id"];
            $peso[$contador]["peso"]   = $fila["peso"];
            $contador++;
        }
    }
    // si hubiera un producto igual introducido ya en la despensa ya habria un peso > 0
    if($peso[0]["peso"] > 0){
        $peso[0]["peso"] = $peso[0]["peso"] + $_POST['peso'];
        $consulta = "UPDATE productos SET peso = ".$peso[0]["peso"] ." WHERE id_usuario = ".$_POST['usuario']." AND codigo_producto = ".$_POST['codigo_producto'];
        $resultado_consulta = $conexion->query($consulta);//nos devuelve un objeto
        if($resultado_consulta){
            //recuperamos el id del producto del usuario para guardar el consumo
            $consulta = "SELECT id FROM productos WHERE codigo_producto = ".$_POST['codigo_producto']." AND id_usuario = ".$_POST['usuario'];
            $id_producto = $conexion->query($consulta);
            $contador = 0;
            $id = array();
            if($id_producto->num_rows>0){
                while ($fila = $id_producto->fetch_assoc()){
                    //$estudiantes[$contador]["id"]       = $fila["id"];
                    $id[$contador]["id"]   = $fila["id"];
                    $contador++;
                }
            }
            $consulta = "INSERT INTO consumo_productos (id_producto,id_usuario,consumo_producto) VALUES ('".$id[0]["id"]."','".$_POST['usuario']."','".$_POST['peso']."')";
            if($conexion->query($consulta) === true){
                $update = 1;
            }
        }
        else{
            $update = 0;
        }
    }
    // si el producto lo tenemos a 0 gramos
    elseif($peso[0]["peso"] == 0){
        $peso[0]["peso"] = $_POST['peso'];
        $consulta = "UPDATE productos SET peso = ".$peso[0]["peso"] ." WHERE id_usuario = ".$_POST['usuario']." AND codigo_producto = ".$_POST['codigo_producto'];
        $resultado_consulta = $conexion->query($consulta);//nos devuelve un objeto
        if($resultado_consulta){
            //recuperamos el id del producto del usuario para guardar el consumo
            $consulta = "SELECT id FROM productos WHERE codigo_producto = ".$_POST['codigo_producto']." AND id_usuario = ".$_POST['usuario'];
            $id_producto = $conexion->query($consulta);
            $contador = 0;
            $id = array();
            if($id_producto->num_rows>0){
                while ($fila = $id_producto->fetch_assoc()){
                    //$estudiantes[$contador]["id"]       = $fila["id"];
                    $id[$contador]["id"]   = $fila["id"];
                    $contador++;
                }
            }
            $consulta = "INSERT INTO consumo_productos (id_producto,id_usuario,consumo_producto) VALUES ('".$id[0]["id"]."','".$_POST['usuario']."','".$_POST['peso']."')";
            if($conexion->query($consulta) === true){
                $update = 1;
            }
        }
        else{
            $update = 0;
        }
    }
    //si por lo que fuese su hubiera quedado un valor negativo
    else{
        $peso[0]["peso"] = 0;
        $peso[0]["peso"] = $peso[0]["peso"] + $_POST['peso'];
        $consulta = "UPDATE productos SET peso = ".$peso[0]["peso"] ." WHERE id_usuario = ".$_POST['usuario']." AND codigo_producto = ".$_POST['codigo_producto'];
        $resultado_consulta = $conexion->query($consulta);//nos devuelve un objeto
        if($resultado_consulta){
            //recuperamos el id del producto del usuario para guardar el consumo
            $consulta = "SELECT id FROM productos WHERE codigo_producto = ".$_POST['codigo_producto']." AND id_usuario = ".$_POST['usuario'];
            $id_producto = $conexion->query($consulta);
            $contador = 0;
            $id = array();
            if($id_producto->num_rows>0){
                while ($fila = $id_producto->fetch_assoc()){
                    //$estudiantes[$contador]["id"]       = $fila["id"];
                    $id[$contador]["id"]   = $fila["id"];
                    $contador++;
                }
            }
            $consulta = "INSERT INTO consumo_productos (id_producto,id_usuario,consumo_producto) VALUES ('".$id[0]["id"]."','".$_POST['usuario']."','".$_POST['peso']."')";
            if($conexion->query($consulta) === true){
                $update = 1;
            }
        }
        else{
            $update = 0;
        }
    }
    echo $update;
}
else{
    echo $update = 0;
}