<?php
if(isset($_POST['email']) && isset($_POST['contrasena'])){
    //mandamos la info a la API
    $argumentos = array( "url"        => $ruta_api."comprueba_login/".token(),
                         "metodo"     => "POST",
                         "argumentos" => array( "email"       => $_POST['email'],
                                                "contrasena"  => $_POST['contrasena'])
    );
    $login = conexion($argumentos);
    // decodificamos el json que nos develve la llamada a comprueba_login
    //lo recogemos en un array
    print_r($login);
    $tipo = gettype($login);
    $login = json_decode($login);
    $tipo2 = gettype($login);
    print_r($login);
    if($login['resultado'] == 'ok'){
        redirect($directorio_base."login");
    }
    else{
        redirect($directorio_base."login");
    }
}