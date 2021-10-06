<?php
session_start();
require_once ('../Libs/Header.php');
?>
<?php
        if(!empty($_GET["iIdCategoria"]))
				{
					$iIdCategoria=$_GET["iIdCategoria"];
                }
        else
                {
                    if(!empty($_POST)) //dicha función comprueba si una variable está definida o no en el script de PHP que se está ejecutando
                            {
                                $iIdCategoria=$_POST["iIdCategoria"];
                                $sql="insert into Producto_Categoria (iIdCategoria,iIdProducto) values(?,?)";
                                foreach($_POST['ids'] as $iid)
                                    {
                                        $cmd= prepare_query($conexion,$sql,[$iIdCategoria,$iid]);
                                    }
                            }	
                }
        $sql="select iIdProducto,sNombre,fPrecio from Productos where bEliminado=0";
        $productos= prepare_select($conexion,$sql);
        $campos=$productos->fetch_fields();
?>
    <form class="col-12" id="prodcatform" action="productos.php" method="POST">
    <input type="hidden" name="iIdCategoria" value="<?php echo $iIdCategoria;?>">
    <div class="container-fluid">
				<div class="row text-center">
				
				<div class="table-responsive">	
				<table class="table table-striped">
						<thead>
                            <th>Seleccion</th>
                                
                                    
                                
							<?php foreach($campos as $campo){
									echo '<th>'.substr($campo->name,1).'</th>';//substr saco la primera letra
								}
							?>
						</thead>
						<tbody>
                            <?php 
                            
									foreach($productos as $fila)
                                            {
                                                    echo '<tr>';
                                                echo '<td> <input type="checkbox" name="ids[]" value="'.$fila['iIdProducto'].'"></td>';
                                                    foreach($campos as $campo)
                                                    {
                                                        echo '<td>'.$fila[$campo->name].'</td>';							
                                                    }
                                                    echo'</tr>';
                                            }
							?>	
						</tbody>
						
								
						
					</table>
					<div>
				</div>
        </div>
        <button type="submit" class = "btn btn-primary" name="btnAceptar" id="btnAceptar" value="Guardar"> <i class="fas fa-cloud-upload-alt"></i>   Guardar  </button>
    </form>
<?php require_once ('../Libs/Footer.php'); ?>