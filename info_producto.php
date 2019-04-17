<?php
/*
 * pagina donde mostramos todo el consumo
 * relacionado con un producto y su usuario
 */
if(isset($ruta[1]) && isset($ruta[2])){
    $hay_consumo = false;
    //mandamos la info a la API
    $argumentos = array( "url"        => $ruta_api."consumo_producto/".$_SESSION['id_usuario']."/".token(),
                         "metodo"     => "POST",
                         "argumentos" => array( "id_producto"       => $ruta[2],
                                                "contrasena"        => "")
    );
    $consumo = conexion($argumentos);
    // decodificamos el json que nos develve la llamada a productos_usuario
    //lo recogemos en un array
    $consumo = json_decode($consumo,true);
    if($consumo != null){
        $hay_productos = true;
    }
    else{
        redirect($directorio_base."home");
    }
}
?>
<html>
<head>
</head>
<body>

<ul>
<?php if($hay_productos){?>
			<?php for($i=0;$i<count($consumo);$i++){?>
			<li>
				<p>Producto:</p>
				
				<p> fecha consumo: <?php echo $consumo[$i]['fecha_consumo'];?></p>
				<p> consumo: <?php echo $consumo[$i]['consumo_producto'];?></p>
			</li>
			
			<?php }?>
		<?php }?>
	</ul>
	<p>
		<a href="<?php echo $directorio_base."home"?>">Atrás</a>
	</p>
</body>
</html>