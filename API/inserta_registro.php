<?php
/*
 * insertamos al usuario en la base de datos
 */
$error = array("resultado" => "ko");
$success = array("resultado" => "ok");

if (isset($_POST['email']) && isset($_POST['contrasena'])){
    //hacemos el hash de la contrase�a
    $hash = hash('ripemd160', $_POST['contrasena']);
    $consulta = "INSERT INTO usuarios (nombre,apellidos,email,telefono,hash) VALUES ('".$_POST['nombre']."','".$_POST['apellidos']."','".$_POST['email']."','".$_POST['telefono']."','$hash')";
    if($conexion->query($consulta) === true){
        echo json_encode($success);
    }
    else{
        echo json_encode($error);
    }
   
}