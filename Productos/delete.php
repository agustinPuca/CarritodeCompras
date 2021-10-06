<?php
session_start();
 require_once ('../Libs/header.php');
?>
<?php
        if(!empty($_GET))
            {
                $iIdProducto=$_GET["iIdProducto"];
                //$sql="delete from Productos where iIdProducto=?";
                $sql="update productos set bEliminado=1 where iIdProducto=?";//Eliminado Logico
                $cmd=prepare_query($conexion,$sql,[$iIdProducto]);
                if($cmd)
                    {
                        echo '<script type="text/javascript">alert("Producto Eliminado Correctamente")</script>';
                        header("location: index.php");
                    }
                else
                    {
                        echo "error".$sql."-".$cmd->error;
                    }
            }
?>
<?php require_once('../Libs/footer.php');?>