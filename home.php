<?php
if(isset($_SESSION['id_usuario']) && $_SESSION['nombre_usuario'] != ''){
    $login = true;
}
else{
    redirect($directorio_base."login");
    session_destroy();
}
//echo "bienvenido usuario con id : ".$_SESSION['nombre_usuario'];
?>
<html>
<head>
</head>
<body>
<?php if($login){?>
<p> Bienvenido usuario : <?php echo $_SESSION['nombre_usuario'];?></p>
<form action="<?php echo $directorio_base."login"?>" method="POST">
	<input type="hidden" name="usuario" value="<?php echo $_SESSION['nombre_usuario'];?>">
	<button type="submit" value="envio_datos">LOGOUT</button>
</form>
<?php }?>
</body>
</html>