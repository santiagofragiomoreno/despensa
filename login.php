<?php
/*
 * formulario para el login de clientes dado de altas previamente
 * esta vista envia los campos de email
 * y password a comprueba_login.php
 */
?>

<form action="http://localhost/despensa/comprueba_login" method="POST">
    <p> email </p>
	<input type ="text" name="email">
	<p> password </p>
	<input type ="text" name="contrasena">
	<button type="submit">ENVIAR</button>
</form>
<p></p>
<form action="http://localhost/proyecto/APP/registro">
	<button type="submit">REGISTARSE</button>
</form>