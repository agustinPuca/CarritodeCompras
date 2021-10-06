<?php
session_start();
require_once ('../Libs/Header.php');
require_once ('../Libs/menucategoria.php');
?>
<?php
	
	$sql="select iIdProducto,sCodigo,sNombre,iStock,iStockMinimo,fPrecio,bEliminado from Productos".($_SESSION["isAdmin"]==0?" where bEliminado=0":"");
	$productos= prepare_select($conexion,$sql);
	$campos=$productos->fetch_fields(); //Devuelve un array de objetos que representan los campos de un conjunto de resultados

//var_dump($productos);
?>	
	<!--Tabla de Productos-->
		<div class="container-fluid">
				<div class="row text-center">
				<div>
					<a href="Create.php" class="btn btn-success btn-sm mb-2 ml-1 mt-4"> <i class="fas fa-cloud-upload-alt"></i>  Agregar</a>
				</div>
				<div class="table-responsive">	
				<table class="table table-striped">
						<thead>
							<?php foreach($campos as $campo){
									echo '<th>'.substr($campo->name,1).'</th>';//substr saco la primera letra
								}
								echo '<th>Acciones</th>';
							?>
						</thead>
						<tbody>
							<?php 
									foreach($productos as $fila)
								{
										echo '<tr>';
										foreach($campos as $campo)
										{
											echo '<td>'.$fila[$campo->name].'</td>';							
										}
									echo '<td><div class="d-flex flex-row">
											<div class="p-1"><a href="update.php?iIdProducto='.$fila["iIdProducto"].'"class="btn btn-primary btn-sm"><i class="far fa-edit"></i></a></div> ';
												if($fila["bEliminado"]==0)
													{
														echo '<div class="p-1"><a href="delete.php?iIdProducto='.$fila["iIdProducto"].'"class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a></div>'; 
													}
												else
													{
														echo '<div class="p-1"><a href="recuperar.php?iIdProducto='.$fila["iIdProducto"].'"class="btn btn-warning btn-sm"><i class="fas fa-trash-restore-alt"></i></a></div>';
													}
											echo '<div class="p-1"><a href="imagen.php?iIdProducto='.$fila["iIdProducto"].'&iIdImagen='.$fila["iIdImagen"].'"class="btn btn-secondary btn-sm"><i class="far fa-image"></i></a></div> 
									 </div> </td> </tr>';
								}
							?>	
						</tbody>
						
								
						
					</table>
					<div>
				</div>
		</div>
									
	<!--Pie de Pagina-->
	<?php require_once ('../Libs/Footer.php'); ?>