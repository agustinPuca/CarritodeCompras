<?php 
require_once('../Libs/conexion.php');
require_once('../Libs/funciones.php');
require_once('../Libs/head.html');
	require_once('../Libs/Barralogo.php');
?>
<?php
if(!empty($_POST["txtUsuario"]) && !empty($_POST["txtContraseña"]) && !empty($_POST["txtNombre"]) && !empty($_POST["txtApellido"]) && !empty($_POST["txtEmail"]) && !empty($_POST["txtDomicilio"]) && !empty($_POST["numDNI"]))//dicha función comprueba si una variable está definida o no en el script de PHP que se está ejecutando
	{
		$usuario     =$_POST["txtUsuario"];
		$contraseña  =$_POST["txtContraseña"];
		$nombre		 =$_POST["txtNombre"];
		$apellido	 =$_POST["txtApellido"];
		$email	 	 =$_POST["txtEmail"];
		$domicilio   =$_POST["txtDomicilio"];
		$dni		 =$_POST["numDNI"];
		
		$campos=array($usuario,$contraseña,$nombre,$apellido,$email,$domicilio,$dni);
		$ncampos=count($campos);
		$sql="insert into usuarios(sLogin,sClave,sNombre,sApellido,sEmail,sDomicilio,iDNI,dFechaAlta,bEliminado) values(?,?,?,?,?,?,?,NOW(),0)";
		
		$datos=prepare_query($conexion,$sql,$campos,'ssssssi');
		if($datos)
			{
			header("location: login.php");
			}
		else
			{
			$msg="Error al cagar Usuario:";	
			}
	}	
	else
			{
				//$msg="Ingresa Datos En Los Campos";
			}
?>
	<head>
			<!-- css-->
			<link rel="stylesheet" type="text/css" href="Css/Estilocreate.css">
	</head>
	<div class="modal-dialog text-center" >
		<div  class= "col-sm-14 main-section ">
			<div  class="modal-content">	
				<div  class = "col-12 user-img">
					<img  src = "../Imagenes/createus.png" />
				</div>	
				<?php if(!empty($msg)):?>
							<div class="alert alert-danger" role="alert">
								<?php echo $msg;?>
							</div> 
					<?php endif;?>
					<form class="form-row" id="loginform" action="createusuario.php" method="POST">
							<div  class = "form-group col-md-6" id = "user-group">
									<input type="text" class = " form-control " placeholder = " Nombre " name="txtNombre" id="txtNombre"/>
							</div>	
							<div  class = "form-group col-md-6 " id = "user-group">
								<input type="text" class = " form-control " placeholder = " Apellido " name="txtApellido" id="txtApellido"/>
							</div>
							<div  class = "form-group col-md-6" id = "user-group">
									<input type="text" class = " form-control " placeholder = " Nombre de Usuario " name="txtUsuario" id="txtUsuario"/>
							</div>	
							<div  class = "form-group col-md-6" id = "user-group">
									<input type="password" class = " form-control " placeholder = "Contraseña " name="txtContraseña" id="txtContraseña"/>
							</div>	
							
								<div  class = "form-group col-md-12" id = "user-group">
								<input type="text" class = " form-control " placeholder = " Email " name="txtEmail" id="txtEmail"/>
							</div>
								<div  class = "form-group col-md-8" id = "user-group">
								<input type="text" class = " form-control " placeholder = " Domicilio " name="txtDomicilio" id="txtDomicilio"/>
							</div>
								<div  class = "form-group col-md-4" id = "user-group">
								<input type="num" class = " form-control " placeholder = " DNI " name="numDNI" id="numDNI"/>
							</div>
							
								<button type="submit" class = " btn btn-primary mx-auto mb-3" name="btnAceptar" id="btnAceptar" value="Guardar"> <i class="fas fa-cloud-upload-alt"></i>   Cargar  </button>
							
						
					</form>
			</div>
	</div>	
</div>
</body>
</html>