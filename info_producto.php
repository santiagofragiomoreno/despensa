<?php
//session_start();
/*
 * pagina donde mostramos todo el consumo
 * relacionado con un producto y su usuario
 */
if(isset($ruta[1]) && isset($ruta[2])){
    //mandamos la info a la API
    $argumentos = array( "url"        => RUTA_API."consumo_producto/".$ruta[1]."/".token(),
                         "metodo"     => "POST",
                         "argumentos" => array( "id_producto"       => $ruta[2],
                                                "usuario"           => $ruta[1]),
    );
    $consumo = conexion($argumentos);
    // decodificamos el json que nos develve la llamada a productos_usuario
    //lo recogemos en un array
    $consumo = json_decode($consumo,true);
    if($consumo != null){
        $hay_productos = true;
        $array_fecha = explode("-", $consumo[6]['fecha_consumo']);
        $dia = explode(" ", $array_fecha[2]);
        //calculamos el consumo total de un producto de todo un dia
        //a traves de la API
        //mandamos la info a la API
        $argumentos = array( "url"        => RUTA_API."consumo_dia/".$ruta[1]."/".token(),
                             "metodo"     => "POST",
                             "argumentos" => array( "id_producto"       => $ruta[2],
                                                    "usuario"           => $ruta[1]),
                                                    "dia"               => $dia,
        );
        $consumo_dia = conexion($argumentos);
    }
    else{
        redirect(DIRECTORIO_BASE."login");
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
				<p> fecha: <?php echo $consumo[$i]['fecha_consumo'];?></p>
				<p> consumo: 
				<?php if($consumo[$i]['consumo_producto'] < 0){?>
				<p style="color:red"><?php echo $consumo[$i]['consumo_producto'];?> g.</p>
				<?php }else{?>
				<p style="color:green">+<?php  echo $consumo[$i]['consumo_producto'];?> g.</p>
				<?php }?>
				<hr style="margin-left: 0px; width:75%"/>
			</li>
			<?php $consumo_total_dia?>
			<?php }?>
		<?php }?>
</ul>
<div class="container">
	<p>TOTAL CONSUMIDO EN EL DIA <?php echo $dia[0];?></p>
</div>
	<p>
		<a href="<?php echo DIRECTORIO_BASE."home"?>">Atras</a>
	</p>
</body>
</html>