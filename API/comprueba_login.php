<?php
/*
 * comprobamos con la base de datos si realmente existe el usuario
 */
$error = array("resultado" => "ko");
$success = array("resultado" => "ok");

if (isset($_POST['email']) && isset($_POST['contrasena'])){
    //hacemos el hash de la contraseña
    $contrasena_formulario = hash('ripemd160', $_POST['contrasena']);
    //$contrasena_formulario = str_split($contrasena_formulario);
    $consulta = "SELECT * FROM usuarios WHERE email = '".$_POST['email']."'";
    $usuario = array();
    $contador = 0;
    $resultado = $conexion->query($consulta);
    if($resultado->num_rows>0){
        while ($fila = $resultado->fetch_assoc()){
            $usuario['id'] = $fila['id'];
            $usuario['nombre'] = $fila['nombre'];
            $usuario['apellidos'] = $fila['apellidos'];
            $usuario['email'] = $fila['email'];
            $usuario['telefono'] = $fila['telefono'];
            $usuario['hash'] = $fila['hash'];
        }
    }
    ////////////cerramos conexion //////////////////
    //$conexion->close();
    //convertimos lo devuelto de la base de datos a string para hacer la comparacion
    //$hash= implode($hash[0]);
    if($usuario != ''){
        echo json_encode($usuario);
    }
    else{
        
        echo json_encode($error);
    }
}