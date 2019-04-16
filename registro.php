<?php
/*
 * pagina del formulario de registro de clientes
 * de aqui nos vamos a realiza_registro.php
 */
?>
<form action="<?php echo $directorio_base."realiza_registro"?>" method="POST">
    <p> email </p>
	<input type ="text" name="email">
	<p> password </p>
	<input type ="text" name="contrasena">
	 <p> nombre </p>
	<input type ="text" name="nombre">
	<p> apellidos </p>
	<input type ="text" name="apellidos">
	<p> telefono </p>
	<input type ="text" name="telefono">
	<button type="submit">ENVIAR</button>
</form>
