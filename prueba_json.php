<?php
$elementos = array();
$elementos['id']=1;
$elementos['nombre']="hola";
$elementos['apellido']="que tal";
$elementos['contrasena']=23;

print_r($elementos);
$hola = json_encode($elementos);
print_r(gettype($hola));
echo "\n";
print_r($hola);
$adios = json_decode($hola,false);
echo("......");
print_r(gettype($adios));
echo("......");
print_r($adios);

?>