<?php
session_start();
require_once ('../Libs/conexion.php');
require_once ('../Libs/funciones.php');
$cantidad   =$_POST["Cantidad"];
$iIdproducto=$_POST["idProducto"];
$subtotal   =$_POST["subtotal"];
$idcarrito  =$_POST["idCarrito"];
echo $cantidad;
//subtotal
$sql="update det_carrito set Cantidad=?,subtotal=? where idproducto=? and IdCarritoCompra=".$idcarrito;
$cmd=prepare_query($conexion,$sql,[$cantidad,$subtotal,$iIdproducto]);
//sacando total a partir de los subtotal
$sql1="select SUM(subtotal) as sumtotal from det_carrito where IdCarritoCompra=".$idcarrito;//as sumtotal es el alias que le doy a la columna con el resultado de mi consulta
$cmd1=prepare_select($conexion,$sql1);
$fila=$cmd1->fetch_assoc();//que te devuelve un array asociativo con el nombre del campo

$total=$fila['sumtotal']; 
//Este es el valor que calcule en la consulta
$sql2="update carritoscompra set total=? where  iIdCarritoCompra=".$idcarrito;
$cmd3=prepare_query($conexion,$sql2,[$total]);

?>