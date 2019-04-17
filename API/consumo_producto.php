<?php
/*
 * pagina para consultar el consumo de un determinado producto
 * de un determinado usuario
*/
if(isset($id_consulta) && isset($_POST['id_producto'])){
    //buscamos en la tabla productos, todos los productos de este usuario
    $success  = array("mensaje" => "ok");
    $error  = array("mensaje" => "ko");
    
    //realizamos la consulta
    $consulta = "SELECT * FROM consumo_productos WHERE id_usuario ='1' AND id_producto = '2'";
    $consumo = array();
    $contador = 0;
    $resultado = $conexion->query($consulta);
    if($resultado->num_rows>0){
        while ($fila = $resultado->fetch_assoc()){
            $consumo[$contador]['id_consumo'] = $fila['id_consumo'];
            $consumo[$contador]['id_producto'] = $fila['id_producto'];
            $consumo[$contador]['id_usuario'] = $fila['id_usuario'];
            $consumo[$contador]['fecha_consumo'] = $fila['fecha_consumo'];
            $consumo[$contador]['fecha_producto'] = $fila['fecha_producto'];
            $contador++;
        }
    }
    if($consumo != ''){
        echo json_encode($consumo);
    }
    else{
        
        echo json_encode($error);
    }
}