<?php
///////// conexion BBDD ////////
//movidilla para localhost o servidor

if($_SERVER['SERVER_NAME'] == "localhost"){
    $conexion = new mysqli('localhost','root','','proyecto');
    $conexion->set_charset('utf8');
}
else{
    $conexion = new mysqli('localhost','u823703154_despe','santiago87','u823703154_despe');
    $conexion->set_charset('utf8');
}
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
                //cogemos la fecha
                $consulta_fecha = "SELECT * FROM consumo_productos ORDER BY id_consumo DESC LIMIT 1";
                $fecha = $conexion->query($consulta_fecha);
                $contador = 0;
                if($fecha->num_rows>0){
                    $fecha = $fecha->fetch_assoc();
                    //separamos
                    $array_fecha = explode("-", $fecha['fecha_consumo']);
                    $anio = $array_fecha[0];
                    $mes = $array_fecha[1];
                    $posicion = count($array_fecha);
                    $array_hora = explode(" ", $array_fecha[$posicion-1]);
                    $dia = $array_hora[0];
                    $posicion2 = count($array_hora);
                    $array_minutos = explode(":", $array_hora[$posicion2-1]);
                    $hora = $array_minutos[0];
                    $minutos = $array_minutos[1];
                    $segundos = $array_minutos[2];
                    //guardamos la fecha y hora en cada uno de sus campos de la tabla
                    $consulta = "UPDATE consumo_productos SET anio ='$anio',mes ='$mes', dia ='$dia', hora ='$hora', minutos ='$minutos', segundos ='$segundos' WHERE id_consumo =".$fecha['id_consumo'];
                    if($conexion->query($consulta) === true){
                        $update = 1;
                    }
                } 
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
                //cogemos la fecha
                $consulta_fecha = "SELECT fecha_consumo FROM consumo_productos ORDER BY id_consumo DESC LIMIT 1";
                $fecha = $conexion->query($consulta_fecha);
                $contador = 0;
                if($fecha->num_rows>0){
                    $fecha = $fecha->fetch_assoc();
                    //separamos
                    $array_fecha = explode("-", $fecha['fecha_consumo']);
                    $anio = $array_fecha[0];
                    $mes = $array_fecha[1];
                    $posicion = count($array_fecha);
                    $array_hora = explode(" ", $array_fecha[$posicion-1]);
                    $dia = $array_hora[0];
                    $posicion2 = count($array_hora);
                    $array_minutos = explode(":", $array_hora[$posicion2-1]);
                    $hora = $array_minutos[0];
                    $minutos = $array_minutos[1];
                    $segundos = $array_minutos[2];
                    //guardamos la fecha y hora en cada uno de sus campos de la tabla
                    $consulta = "UPDATE consumo_productos SET anio ='$anio',mes ='$mes', dia ='$dia', hora ='$hora', minutos ='$minutos', segundos ='$segundos' WHERE id_consumo =".$fecha['id_consumo'];
                    if($conexion->query($consulta) === true){
                        $update = 1;
                    }
                    
                }
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