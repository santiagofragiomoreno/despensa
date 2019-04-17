<?php
if(isset($id_consulta)){
    //buscamos en la tabla productos, todos los productos de este usuario
    $succes  = array("mensaje" => "ok");
    $error  = array("mensaje" => "ko");
    
    //realizamos la consulta
    $consulta = "SELECT * FROM productos WHERE id_usuario='$id_consulta'";
    $productos = array();
    $contador = 0;
    $resultado = $conexion->query($consulta);
    if($resultado->num_rows>0){
        while ($fila = $resultado->fetch_assoc()){
            $productos[$contador]['id'] = $fila['id'];
            $productos[$contador]['codigo_producto'] = $fila['codigo_producto'];
            $productos[$contador]['nombre_producto'] = $fila['nombre_producto'];
            $productos[$contador]['id_usuario'] = $fila['id_usuario'];
            $productos[$contador]['peso'] = $fila['peso'];
            $contador++;
        }
    }
    if($productos != ''){
        echo json_encode($productos);
    }
    else{
        
        echo json_encode($error);
    }
}