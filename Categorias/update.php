<?php
session_start();
 require_once ('../Libs/header.php');
?>
<?php
    if(!empty($_GET["iIdCategoria"]))
        {
            $categoria= $_GET["iIdCategoria"];
            $sql="select * from categorias where iIdCategoria=?";
            $datos=prepare_select($conexion,$sql,[$categoria]);
            if($datos->num_rows>0)
                {
                    $fila=$datos->fetch_assoc();
                }
        }
    else{
            if(!empty($_POST)) //dicha función comprueba si una variable está definida o no en el script de PHP que se está ejecutando
                {
                    $categoria=$_POST["iIdCategoria"];
                    $nombre			 =$_POST["Nombre"];
                    $descripcion	 =$conexion->real_escape_string($_POST["Descripcion"]);
                    
                    $campos=array($nombre,$descripcion,$categoria);
                    $ncampos=count($campos);
                    $sql="update categorias set sNombre=?,sDescripcion=? where iIdCategoria=?";
                    
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
            
            <div class="modal-dialog text-center" >
		<div  class= "col-sm-12 main-section ">
			<div  class="modal-content">
					<div  class = "col-12 user-img">
						<!--<img  src = "https://www.flaticon.es/premium-icon/icons/svg/2229/2229604.svg" />-->
					</div>			
                <h1 class = "AgCategoria">Editar Categoria</h1>
					<form class="col-12" id="loginform" role="form" action="update.php" method="POST">
                    <input type="hidden" name="iIdCategoria" id="iIdCategoria" value=<?php echo $fila["iIdCategoria"];?>>
							
                            
							<div  class = "form-group" id = "user-group">
								<h6 for="Nombre" class="text-left"> Nombre</h6>
									<input type="text" class = "form-control"  name="Nombre" id="Nombre" value=<?php echo $fila["sNombre"];?>>
                            </div>	
                            
							<div   class = "form-group" id = "user-group">
                                <h6 for="Descripcion" class="text-left"> Descripcion</h6>
									<textarea  class = "form-control"  name="Descripcion"  ><?php echo $fila["sDescripcion"];?> </textarea>
                            </div>	
							
								<button type="submit" class = "btn btn-primary" name="btnAceptar" id="btnAceptar" value="Guardar"> <i class="fas fa-cloud-upload-alt"></i>   Cargar  </button>
						<br>
						<a href="index.php" >Volver a la Lista de Categorias</a>
                    </form> 
			</div>
    	</div>	
	</div>
<?php require_once('../Libs/footer.php')?>