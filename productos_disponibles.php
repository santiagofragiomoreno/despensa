<?php
/*
 * archivo donde llegamos con --- /productos/id de usuario ----
 * y nos vamos a API/index para desde alli hacer la busqueda en la
 * base de datos y traer los productos en un JSON para poder mostrarlos
 */
if(isset($_SESSION['id_usuario'])){
    $hay_productos = false;
    //mandamos la info a la API
    $argumentos = array( "url"        => RUTA_API."productos_disponibles/".$_SESSION['id_usuario']."/".token(),
        "metodo"     => "POST",
        "argumentos" => array( "email"       => "",
                               "contrasena"  => "")
    );
    $productos_disponibles = conexion($argumentos);
    // decodificamos el json que nos develve la llamada a productos_usuario
    //lo recogemos en un array
    $productos_disponibles = json_decode($productos_disponibles,true);
    if($productos_disponibles != null){
        $hay_productos = true;
    }
    else{
        redirect(DIRECTORIO_BASE."home");
    }
}
echo "estamos en productos con el id de usuario: ".$_SESSION['id_usuario'];
?>
<html>
<head>
</head>
<body>

<p>Producto:</p>
	<ul>
		<?php if($hay_productos){?>
			<?php for($i=0;$i<count($productos_disponibles);$i++){?>
			<li>
			<hr>
				<p> <b>nombre:</b> <?php echo $productos_disponibles[$i]['nombre'];?></p>
				<p> <b>codigo:</b> <?php echo $productos_disponibles[$i]['codigo'];?></p>
				<p> <b>peso: </b>  <?php echo $productos_disponibles[$i]['peso_producto'];?> Kg</p>
			</li>
			<?php }?>
		<?php }?>
	</ul>
	<p>
		<a href="<?php echo DIRECTORIO_BASE."home"?>">Atrás</a>
	</p>
</body>
</html>
