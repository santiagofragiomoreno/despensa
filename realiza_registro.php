<?php
if(isset($_POST['email']) && isset($_POST['contrasena'])){
    //mandamos la info a la API
    $argumentos = array( "url"        => $ruta_api."inserta_registro/".token(),
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
    if($usuario->resultado == 'ok'){
        redirect($directorio_base."login");
    }
    else{
        redirect($directorio_base."registro");
    }
}