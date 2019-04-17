<?php
/*
 * devolvemos todos los productos disponible de la base de datos 
 * para cualquier usuario
*/
if(isset($id_consulta)){
    //buscamos en la tabla productos, todos los productos 
    $succes  = array("mensaje" => "ok");
    $error  = array("mensaje" => "ko");
    
    //realizamos la consulta
    $consulta = "SELECT * FROM listado_productos";
    $productos_disponibles = array();
    $contador = 0;
    $resultado = $conexion->query($consulta);
    if($resultado->num_rows>0){
        while ($fila = $resultado->fetch_assoc()){
            $productos_disponibles[$contador]['id_producto'] = $fila['id_producto'];
            $productos_disponibles[$contador]['codigo'] = $fila['codigo'];
            $productos_disponibles[$contador]['nombre'] = $fila['nombre'];
            $productos_disponibles[$contador]['peso_producto'] = $fila['peso_producto'];
            $contador++;
        }
    }
    if($productos_disponibles != ''){
        echo json_encode($productos_disponibles);
    }
    else{
        
        echo json_encode($error);
    }
}