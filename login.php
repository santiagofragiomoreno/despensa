<?php
/*
 * formulario para el login de clientes dado de altas previamente
 * esta vista envia los campos de email
 * y password a comprueba_login.php
 */
$directorio_base = "http://www.miwebdepruebas.es/despensa/";
if(isset($_POST['usuario'])){
    if(session_destroy()){
        $_SESSION['nombre_usuario']="sesion destruida";
        
    }
}
?>

<form action="<?php echo $directorio_base."comprueba_login"?>" method="POST">
    <p> email </p>
	<input type ="text" name="email">
	<p> password </p>
	<input type ="text" name="contrasena">
	<button type="submit">ENVIAR</button>
</form>
<p></p>
<form action="<?php echo $directorio_base."registro"?>">
	<button type="submit">REGISTARSE</button>
</form>