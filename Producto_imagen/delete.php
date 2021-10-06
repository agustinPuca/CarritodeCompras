<?php
session_start();
 require_once ('../Libs/header.php');
?>
<?php
        if(!empty($_GET["iIdProducto_Imagen"]))
            {
                $iIdProducto_Imagen=$_GET["iIdProducto_Imagen"];
                $iIdImagen=$_GET["iIdImagen"];
                $iIdProducto=$_GET["iIdProducto"];
               var_dump($iIdProducto);
                $sql="update Producto_Imagen set bEliminado=1 where iIdProducto_Imagen=?";
                $cmd=prepare_query($conexion,$sql,[$iIdProducto_Imagen]);
                if($cmd)
                    {
                        $sql="update Imagenes set bEliminado=1 where iIdImagen=?";
                        $cmd=prepare_query($conexion,$sql,[$iIdImagen]);
                        
                    }
                header("location: ../Productos/Imagen.php?iIdProducto=$iIdProducto");
            }
?>
<?php require_once('../Libs/footer.php');?>