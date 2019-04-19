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

<?php if($login){?>
<p> Bienvenido usuario : <?php echo $_SESSION['nombre_usuario'];?></p>
<form action="<?php echo DIRECTORIO_BASE."login"?>" method="POST">
	<input type="hidden" name="usuario" value="<?php echo $_SESSION['nombre_usuario'];?>">
	<button type="submit" value="envio_datos">LOGOUT</button>
</form>
<?php }?>
<p>
<a href="<?php echo DIRECTORIO_BASE."perfil"?>">Perfil</a>
</p>
<p>
<a href="<?php echo DIRECTORIO_BASE."productos/".$_SESSION['id_usuario']?>">MIS Productos</a>
</p>
<p>
<a href="<?php echo DIRECTORIO_BASE."productos_disponibles/".$_SESSION['id_usuario']?>">Productos DISPONIBLES</a>
</p>
<p>
<a href="<?php echo DIRECTORIO_BASE."contacto"?>">Contacto</a>
</p>
<p>
<a href="<?php echo DIRECTORIO_BASE."aviso_legal"?>">Aviso Legal</a>
</p>
