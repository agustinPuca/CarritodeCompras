<?php
session_start();
require_once ('../Libs/header.php');
date_default_timezone_set("America/Buenos_Aires");
?>
<?php
if(!empty($_POST)) //dicha función comprueba si una variable está definida o no en el script de PHP que se está ejecutando
	{
		$nombre			 =$_POST["Nombre"];
		$descripcion	 = $conexion->real_escape_string($_POST["Descripcion"]);
		
		$campos=array($nombre,$descripcion);
		$ncampos=count($campos);
		$sql="insert into categorias(sNombre,sDescripcion,dFechaAlta) values(?,?,NOW())";
		
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
                <h1 class = "AgProducto">Agregar Categoria</h1>
					<form class="col-12" id="loginform" role="form" action="Create.php" method="POST">
						
							
                            
							<div  class = "form-group" id = "user-group">
								<h6 for="Nombre" class="text-left"> Nombre</h6>
									<input type="text" class = "form-control"  name="Nombre" id="Nombre">
                            </div>	
                            
							<div   class = "form-group" id = "user-group">
                                <h6 for="Descripcion" class="text-left"> Descripcion</h6>
									<textarea rows="4" cols="100" class = "form-control"  name="Descripcion" > </textarea>
                            </div>	
							
								<button type="submit" class = "btn btn-primary" name="btnAceptar" id="btnAceptar" value="Guardar"> <i class="fas fa-cloud-upload-alt"></i>   Cargar  </button>
						<br>
						<a href="index.php" >Volver a la Lista de Categorias</a>
                    </form> 
			</div>
    	</div>	
	</div>
<?php require_once('../Libs/footer.php')?>