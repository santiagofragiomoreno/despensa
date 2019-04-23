<?php
/*
 * pagina para consultar el consumo de un determinado producto
 * de un determinado usuario
*/
if(isset($url[1]) && isset($_POST['id_producto'])){
    //buscamos en la tabla productos, todos los productos de este usuario
    $success  = array("mensaje" => "ok");
    $error  = array("mensaje" => "ko");
    
    //realizamos la consulta
    $consulta = "SELECT * FROM consumo_productos WHERE id_usuario ='.$url[1].' AND id_producto = '".$_POST['id_producto']."'";
    $consumo = array();
    $contador = 0;
    $resultado = $conexion->query($consulta);
    if($resultado->num_rows>0){
        while ($fila = $resultado->fetch_assoc()){
            $consumo[$contador]['id_consumo'] = $fila['id_consumo'];
            $consumo[$contador]['id_producto'] = $fila['id_producto'];
            $consumo[$contador]['id_usuario'] = $fila['id_usuario'];
            $consumo[$contador]['fecha_consumo'] = $fila['fecha_consumo'];
            $consumo[$contador]['consumo_producto'] = $fila['consumo_producto'];
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