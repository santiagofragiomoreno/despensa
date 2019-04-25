<?php
?>
<html>
	<head>
	</head>
	<body>
	<h1>BIENVENIDO AL BACKEND DE MIWEBDEPRUEBAS</h1>
	<form action="<?php echo RUTA_BACKEND."comprueba_login"?>" method="POST">
    <p> email </p>
	<input type ="text" name="email">
	<p> password </p>
	<input type ="text" name="contrasena">
	<button type="submit">ENVIAR</button>
</form>
	</body>
</html>