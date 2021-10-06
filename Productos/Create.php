<?php
session_start();
require_once ('../Libs/header.php');
date_default_timezone_set("America/Buenos_Aires");
?>
	<head>
			<!-- css-->
			<link rel="stylesheet" type="text/css" href="Css/Create.css">
	</head>

<?php
if(!empty($_POST)) //dicha función comprueba si una variable está definida o no en el script de PHP que se está ejecutando
	{
		$codigo    		 =$_POST["Codigo"];
		$nombre			 =$_POST["Nombre"];
		$descripcion	 = $conexion->real_escape_string($_POST["Descripcion"]);
		$Caracteristicas	 = $conexion->real_escape_string($_POST["Caracteristicas"]);
		$precio	 		 =$_POST["Precio"];
		$stock	 		 =$_POST["Stock"];
		$stockminimo     =$_POST["Stockminimo"];
		
		$campos=array($codigo,$nombre,$descripcion,$Caracteristicas,$precio,$stock,$stockminimo);
		$sql="insert into productos(sCodigo,sNombre,sDescripcion,Caracteristicas,fPrecio,iStock,iStockMinimo,dFecha,bPublicado,bEliminado) values(?,?,?,?,?,?,?,NOW(),1,0)";
		
		$datos=prepare_query($conexion,$sql,$campos);
	
		if($datos)
			{
			header('location: index.php');
			}
		else
			{
			$msg ='No se Guardo Error:'.$sql.'</br>'.$cmd->error;	
			}
	}	
	
?>
			<?php
					if(!empty($msg))
						{
							echo '<p>'.$msg.'</p>';
						}
			?>

			<div class="modal-dialog text-center" >
		<div  class= "col-sm-12 main-section ">
			<div  class="modal-content">
					<div  class = "col-12 user-img">
						<!--<img  src = "https://www.flaticon.es/premium-icon/icons/svg/2229/2229604.svg" />-->
					</div>			
                <h1 class = "AgProducto">Agregar Producto</h1>
					<form class="form-row col-12 " id="createform" role="form" action="Create.php" method="POST">
						
							<div  class = "form-group col-3" id = "user-group">
                                <h6 for="Codigo" class="text-left"> Codigo</h6>
										<input type="text" class = "form-control "  name="Codigo" id="Codigo">
							</div>	
                            
							<div  class = "form-group col-5" id = "user-group">
								<h6 for="Nombre" class="text-left"> Nombre</h6>
									<input type="text" class = "form-control"  name="Nombre" id="Nombre">
                            </div>	
                            
							<div  class = "form-group col-4" id = "user-group">
                                <h6 class="text-left"> Precio</h6>
								<input type="number"  class = "form-control " name="Precio"  />
							</div>

							<div   class = "form-group col-6" id = "user-group">
                                <h6 for="Descripcion" class="text-left"> Descripcion</h6>
									<textarea rows="4" cols="100" class = "form-control"  name="Descripcion" > </textarea>
                            </div>	
							
							<div   class = "form-group col-6" id = "user-group">
                                <h6 for="Caracteristica" class="text-left"> Caracteristicas</h6>
									<textarea rows="4" cols="100" class = "form-control"  name="Caracteristicas" > </textarea>
                            </div>

							
							<div  class = "form-group col-6" id = "user-group">
                                <h6 for="Stock" class="text-left"> Stock</h6>
								<input type="number" class = "form-control " name="Stock" id="Stock">
                            </div>
                            
							<div  class = "form-group col-6" id = "user-group">
                                <h6 for="Stockminimo" class="text-left"> Stock Minimo</h6>
								<input type="number" class = "form-control "  name="Stockminimo" id="Stockminimo">
							</div>
								<button type="submit" class = "btn btn-primary mx-auto" name="btnAceptar" id="btnAceptar" value="Guardar"> <i class="fas fa-cloud-upload-alt"></i>   Cargar  </button>
						<br>
						<a href="index.php" class = " mx-auto">Volver a la Lista de Productos</a>
                    </form> 
			</div>
    	</div>	
	</div>
<?php require_once('../Libs/footer.php')?>