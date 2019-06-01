<?php
//GENERAMOS UN TOKEN PARA PODER ENTRAR EN LA API
//funcion para generar tokens
function token(){
    return (mt_rand(10,10000)*7)+6;
}

$token = token();

$directorio_base = "http://localhost/despensa/API/";

?>
<form action="<?php echo $directorio_base; ?>producto_in/<?php echo $token;?>" method="POST">
    <p>codigo de producto</p>
	<input type="text" name="codigo_producto">
    <p>numero de usuario</p>
    <input type="text" name="usuario">
    <p>peso</p>
    <input type="text" name="peso">
    <button type="submit">enviar</button>
</form>