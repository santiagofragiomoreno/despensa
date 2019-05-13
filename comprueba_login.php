<?php
//$ruta_api = "http://www.miwebdepruebas.es/API/";
if(isset($_POST['email']) && isset($_POST['contrasena'])){
    //mandamos la info a la API
    $argumentos = array( "url"        => RUTA_API."comprueba_login/".token(),
                         "metodo"     => "POST",
                         "argumentos" => array( "email"       => $_POST['email'],
                                                "contrasena"  => $_POST['contrasena'])
    );
    $usuario = conexion($argumentos);
    // decodificamos el json que nos develve la llamada a comprueba_login
    //lo recogemos en un objeto
    $usuario = json_decode($usuario,false);
    if($usuario != null){
        $_SESSION['id_usuario'] = $usuario->id;
        $_SESSION['email_usuario'] = $usuario->email;
        $_SESSION['nombre_usuario'] = $usuario->nombre;
        redirect(DIRECTORIO_BASE."menu");
    }
    else{
        redirect(DIRECTORIO_BASE."login");
    }
}