<?php
session_start();
require_once ('../Libs/conexion.php');
require_once ('../Libs/funciones.php');
?>
<?php
         if(isset($_SESSION["iIdUsuario"]))
            {
                $iIdUsuario=$_SESSION["iIdUsuario"];     
                $iIdProducto=$_GET["iIdProducto"];  
                $fPrecio=$_GET["fPrecio"];

                $sql1="SELECT  CASE iIdUsuario WHEN ? THEN 1 ELSE 0 END AS Existe FROM carritoscompra WHERE iIdUsuario= ".$iIdUsuario;
                $carritos=prepare_select($conexion,$sql1,[$iIdUsuario]);
                $fila=$carritos->fetch_assoc();//que te devuelve un array asociativo con el nombre del campo
                $bool=$fila['Existe']; 
                
                if($bool==0)
                  {
                         $e=array($iIdUsuario,"En Curso");
                         $sql="insert into carritoscompra(iIdUsuario,dUltimaFecha,Estado) values(?,NOW(),?)";
                         $dato=prepare_query($conexion,$sql,$e);
                             
                    }
                 else
                     {
                        $sql="update carritoscompra set dUltimaFecha=NOW() where iIdUsuario=?";
                         $dato=prepare_query($conexion,$sql,[$iIdUsuario]);        
                    }  
                    //recupero idcarrito compra la cual esta en curso
                             $sql2="SELECT  iIdCarritoCompra AS idcarrito from carritoscompra where iIdUsuario=?";
                             $cmd=prepare_select($conexion,$sql2,[$iIdUsuario]);
                             $filas=$cmd->fetch_assoc();//que te devuelve un array asociativo con el nombre del campo
                             $iIdCarritoCompra=$filas['idcarrito'];
                            
                           
                            if($dato)
                                {  
                                $cant=$_GET['Cantidad'];
                                    $c=array($iIdProducto,$cant,$fPrecio,$iIdCarritoCompra);
                                    $sql1="insert into det_carrito(IdProducto,Cantidad,Precio,idCarritoCompra) values(?,?,?,?)";
                                    $cmd=prepare_query($conexion,$sql1,$c);
                                    if($cmd){
                                    header("location: ../styles/index.php?idcarrito=".$iIdCarritoCompra);
                                    }
                                    else{echo "algo fallo";}
                                }
                            else
                                {
                                    echo "error".$sql."-".$carritos->error;
                                }
                        
                         
            }
        else
        {
            header("location: ../Acceso/login.php");
        }
?>                    
