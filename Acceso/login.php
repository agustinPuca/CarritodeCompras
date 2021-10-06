<?php 
session_start();
require_once('../Libs/conexion.php');
require_once('../Libs/funciones.php');
require_once('../Libs/head.html');
	require_once('../Libs/Barralogo.php');
?>
<?php
	if(isset($_SESSION["iIdUsuario"]))//Comprobar si una variable está definida
		{
			header("location: ../Styles/index.php");
		}
	if(!empty($_POST))//dicha función comprueba si una variable está definida o no en el script de PHP que se está ejecutando
		{
			//variable del form html
				$usuario=$conexion->real_escape_string($_POST["txtusuario"]);
				$contraseña=$conexion->real_escape_string($_POST["txtcontraseña"]);	
			$sql="select * from usuarios where slogin=?";
			$datos= prepare_select($conexion,$sql,[$usuario]);
				if($datos->num_rows>0)//rows:Obtiene el número de filas de un resultado
					{
					$fila=$datos->fetch_assoc();//fect_array: Obtiene una fila de resultados como un array asociativo, numérico, o ambos
						if($contraseña==$fila["sClave"])
							{
								$_SESSION['iIdUsuario']=$fila['iIdUsuario'];
								$_SESSION['sLogin']=$fila['sLogin'];
								$_SESSION['isAdmin']=1;
								$_SESSION['sNombre']=$fila['sNombre'];
								$_SESSION['sApellido']=$fila['sApellido'];
								header("location: ../productos/index.php");
							 }
						else
							{$msg="Contraseña Incorrecta"; }
					}
				else
					{ $msg= "Usuario Incorrecto"; }
		}
?>
	
	<head>
			<!-- css-->
			<link rel="stylesheet" type="text/css" href="Css/Estilologin.css">
	</head>

	<div class="modal-dialog text-center" >
		<div  class= "col-sm-8 main-section ">
			<div  class="modal-content">
					<div  class = "col-12 user-img">
						<img  src = "../Imagenes/Login.png" />
					<h2>Bienvenido.!</h2></div>
					
					<form class="col-12" id="loginform" action="login.php" method="POST">
						<div  class = "form-group" id = "user-group">
								<input type="text"  class = " form-control " placeholder = " Nombre de usuario " name="txtusuario" />
						</div>
						<div class = "form-group" id = "contraseña-group">
								<input type="password" class = " form-control " placeholder = " Contraseña "name="txtcontraseña" />
						</div>
							
								<button  type = "submit "class = " btn btn-primary " > <i  class = " fas fa-sign-in-alt " > </i >  Ingresar </button >
					</form>

					<?php if(!empty($msg)):?>
							<div class="alert alert-danger" role="alert">
								<?php echo $msg;?>
							</div> 
					<?php endif;?>

						<div  class = " col-12 forgot " >
                   		 	<a  href = "#"> Recordar contraseña </a >
						</div >
						<div  class = " col-12 forgot" >
							<a href="Createusuario.php">Crear Cuenta</a>
						</div>	
			</div>
		</div>	
	</div>

	<?require_once ('../Libs/footer.php');?>	