<?php
/*
 * archivo donde llegamos con --- /productos/id de usuario ----
 * y nos vamos a API/index para desde alli hacer la busqueda en la
 * base de datos y traer los productos en un JSON para poder mostrarlos
 */
if(isset($_SESSION['id_usuario'])){
    $hay_productos = false;
    //mandamos la info a la API
    $argumentos = array( "url"        => $ruta_api."productos_usuario/".$_SESSION['id_usuario']."/".token(),
        "metodo"     => "POST",
        "argumentos" => array( "email"       => "",
                               "contrasena"  => "")
    );
    $productos = conexion($argumentos);
    // decodificamos el json que nos develve la llamada a productos_usuario
    //lo recogemos en un array
    $productos = json_decode($productos,true);
    if($productos != null){
        $hay_productos = true;
    }
    else{
        redirect($directorio_base."home");
    }
}
echo "estamos en productos con el id de usuario: ".$_SESSION['id_usuario'];
?>
<html>
<head>
</head>
<body>

	<ul>
		<?php if($hay_productos){?>
			<?php for($i=0;$i<count($productos);$i++){?>
			<li>
				<p>Producto:</p>
				<p> nombre: <?php echo $productos[$i]['nombre_producto'];?></p>
				<p> codigo: <?php echo $productos[$i]['codigo_producto'];?></p>
				<p> peso: <?php echo $productos[$i]['peso'];?></p>
			</li>
			<form action="<?php echo DIRECTORIO_BASE."info_producto/".$_SESSION['id_usuario']."/".$productos[$i]['id'];?>" method="POST">
				<button type="submit" value="info_producto">ver consumo</button> 
			</form>
			<?php }?>
		<?php }?>
	</ul>
	<p>
		<a href="<?php echo $directorio_base."home"?>">Atrás</a>
	</p>
</body>
</html>