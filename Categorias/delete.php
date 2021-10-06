<?php
session_start();
 require_once ('../Libs/header.php');
?>
<?php
        if(!empty($_GET))
            {
                $iIdCategoria=$_GET["iIdCategoria"];
                $sql="delete from producto_Categoria where iIdCategoria=?";
                $cmd=prepare_query($conexion,$sql,[ $iIdCategoria]);
                if($cmd)
                    {
                        header("location: index.php");
                    }
                else
                    {
                        echo "error".$sql."-".$cmd->error;
                    }
            }
?>
<?php require_once('../Libs/footer.php');?>