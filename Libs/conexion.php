<?php
   require_once ('config.php');

$conexion= new mysqli($servidornombre,$nombredeusuario,$claveusuario,$basededatos,$puerto);

if($conexion->connect_error)
{
    echo "Conexion.fallida= " . $conexion->connect_error;
}
else
{
    //echo "(---conexion exitosa a la base de datos---)";
}
?>