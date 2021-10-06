<?php
session_start();
require_once ('../Libs/Header.php');
?>
<?php
$sql="select * from categorias  ";
$categorias= prepare_select($conexion,$sql);
$campos=$categorias->fetch_fields(); //Devuelve un array de objetos que representan los campos de un conjunto de resultados

//var_dump($productos);
?>	
	<!--Tabla de Productos-->
		<div class="container-fluid">
				<div class="row text-center">
				<div>
					<a href="Create.php" class="btn btn-success btn-sm mb-2 ml-1 mt-4"> <i class="fas fa-cloud-upload-alt"></i>  Agregar</a>
				</div>	
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
									foreach($categorias as $fila)
								{
										echo '<tr>';
										foreach($campos as $campo)
										{
											echo '<td>'.$fila[$campo->name].'</td>';							
										}
									echo '<td><div class="d-flex flex-row-center">
									<div class="p-1"><a href="update.php?iIdCategoria='.$fila["iIdCategoria"].'"class="btn btn-primary btn-sm"><i class="far fa-edit"></i></a></div> 
									<div class="p-1"><a href="delete.php?iIdCategoria='.$fila["iIdCategoria"].'"class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a></div>  
									<div class="p-1"><a href="productos.php?iIdCategoria='.$fila["iIdCategoria"].'"class="btn btn-secondary btn-sm"><i class="fas fa-file-medical"></i></a></div> 
									 </div> </td> </tr>';
								}
							?>	
						</tbody>
						
								
						
					</table>
				</div>
		</div>
									
	<!--Pie de Pagina-->
	<?php require_once ('../Libs/Footer.php'); ?>