<?php
session_start();
 require_once ('../Libs/header.php');
?>
<?php
        if(!empty($_GET))
            {
                $idDet_Carrito=$_GET["idDet_Carrito"];
                $sql="delete from det_carrito where idDet_Carrito=?";
                $cmd=prepare_query($conexion,$sql,[$idDet_Carrito]);
                if($cmd)
                    {
                        echo '<script type="text/javascript">alert("Producto Anulado Correctamente")</script>';
                        header("location: det_carrito.php");
                    }
                else
                    {
                        echo "error".$sql."-".$cmd->error;
                    }
            }
?>
<?php require_once('../Libs/footer.php');?>