<?php
if(isset($_POST['email']) && isset($_POST['contrasena'])){
    //mandamos la info a la API
    $argumentos = array( "url"        => RUTA_API."inserta_registro/".token(),
                         "metodo"     => "POST",
                         "argumentos" => array( "email"       => $_POST['email'],
                                                "contrasena"  => $_POST['contrasena'],
                                                "nombre"      => $_POST['nombre'],
                                                "apellidos"   => $_POST['apellidos'],
                                                "telefono"    => $_POST['telefono'])
    );
    $usuario = conexion($argumentos);
    // decodificamos el json que nos develve la llamada a realiza_registro
    //lo recogemos en un objeto
    $usuario = json_decode($usuario,false);
    //si el registro es correcto nos vamos al login
    if($usuario->resultado == 'ok'){
        redirect(DIRECTORIO_BASE."login");
    }
    else{
        redirect(DIRECTORIO_BASE."registro");
    }
}