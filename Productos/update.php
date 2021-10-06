<?php
session_start();
 require_once ('../Libs/header.php');
?>
<head>
			<!-- css-->
			<link rel="stylesheet" type="text/css" href="Css/Create.css">
</head>
<?php
    if(!empty($_GET["iIdProducto"]))
        {
            $producto= $_GET["iIdProducto"];
            $sql="select * from productos where iIdProducto=?";
            $datos=prepare_select($conexion,$sql,[$producto]);
            if($datos->num_rows>0)
                {
                    $fila=$datos->fetch_assoc();
                }
        }
    else{
            if(!empty($_POST)) //dicha función comprueba si una variable está definida o no en el script de PHP que se está ejecutando
                {
                    $producto=$_POST["iIdProducto"];
                    $codigo    		 =$_POST["Codigo"];
                    $nombre			 =$_POST["Nombre"];
                    $descripcion	 =$conexion->real_escape_string($_POST["Descripcion"]);
                    $Caracteristicas	 = $conexion->real_escape_string($_POST["Caracteristicas"]);
                    $precio			 =$_POST["Precio"];
                    $stock	 		 =$_POST["Stock"];
                    $stockminimo     =$_POST["Stockminimo"];
                    
                    $campos=array($codigo,$nombre,$descripcion,$Caracteristicas,$precio,$stock,$stockminimo,$producto);
                    $ncampos=count($campos);
                    $sql="update productos set sCodigo=?,sNombre=?,sDescripcion=?,caracteristicas=?,fPrecio=?,iStock=?,iStockMinimo=? where iIdProducto=?";
                    
                    $cmd=prepare_query($conexion,$sql,$campos);
                    
                    if($cmd)
                        { header('location: index.php'); }
                    else
                        { $msg ='No se Guardo Error:'.$sql.'</br>'.$cmd->error; }
                }	
        }
?>
<div class="modal-dialog text-center" >
		<div  class= "col-sm-10 main-section ">
			<?php
					if(!empty($msg))
						{
							echo $msg;
						}
					else
						{
							echo '';
						}
			
			?>
<div  class="modal-content">			
                <h1 class = "AgProducto">Agregar Producto</h1>
                <form class="form-row col-12" id="updateform" role="form" action="update.php" method="POST">
						<input type="hidden" name="iIdProducto" id="iIdProducto" value=<?php echo $fila["iIdProducto"];?>>
                        <div  class = "form-group col-3" id = "user-group">
                                <h6 class="text-left"> Codigo</h6>
									<input type="number" class = " form-control "  name="Codigo" value=<?php echo $fila["sCodigo"];?> />
                            </div>	
                            
							<div  class = "form-group col-5" id = "user-group">
                                <h6 class="text-left"> Nombre</h6>
									<input type="text" class = " form-control "  name="Nombre" value=<?php echo $fila["sNombre"];?> />
                            </div>	
                            <div  class = "form-group col-4" id = "user-group">
                                <h6 class="text-left"> Precio</h6>
								<input type="number" class = " form-control " name="Precio" value=<?php echo $fila["fPrecio"];?> />
                            </div>
							<div  class = "form-group col-6" id = "user-group">
                                <h6 class="text-left"> Descripcion</h6>
									<textarea rows="4" class = " form-control "  name="Descripcion" ><?php echo $fila["sDescripcion"];?></textarea>
                            </div>	
                            
                            <div   class = "form-group col-6" id = "user-group">
                                <h6 for="Caracteristica" class="text-left"> Caracteristicas</h6>
									<textarea rows="4" cols="100" class = "form-control"  name="Caracteristicas" ><?php echo $fila["Caracteristicas"];?> </textarea>
                            </div>

							<div  class = "form-group col-6" id = "user-group">
                                <h6 class="text-left"> Stock</h6>
								<input type="number" class = " form-control " name="Stock" value=<?php echo $fila["iStock"];?> />
                            </div>
                            
							<div  class = "form-group col-6" id = "user-group">
                                <h6 class="text-left"> Stock Minimo</h6>
								<input type="number" class = " form-control "  name="Stockminimo" value=<?php echo $fila["iStockMinimo"];?> />
							</div>
								<button type="submit" class = " btn btn-primary mx-auto " name="btnAceptar" id="btnAceptar" value="Guardar"> <i class="fas fa-cloud-upload-alt"></i>   Cargar  </button>
						<br>
						<a class="mx-auto" href="index.php" >Volver a la Lista de Productos</a>
                    </form>      
			</div>
    	</div>	
	</div>
<?php require_once('../Libs/footer.php');?>