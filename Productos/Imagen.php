<?php
		session_start();
		require_once ('../Libs/header.php');
?>
<head>
			<!-- css-->
			<link rel="stylesheet" type="text/css" href="Css/imagen.css">
</head>
<?php

		if(!empty($_GET["iIdProducto"]))
				{
					$iIdProducto=$_GET["iIdProducto"];
				}
		else
			{
				if(!empty($_POST)) //dicha función comprueba si una variable está definida o no en el script de PHP que se está ejecutando
                {
                    $iIdProducto	 =$_POST["iIdProducto"];
					$iOrden			 =$_POST["txtiOrden"];
					$sNombreArchivo  =$_FILES["fileimagen"]["name"];
					$sTipoExtension  =$_FILES["fileimagen"]["type"];
					//moveel archivo de lugar temporal al destino, sistema
					$sPath			 =$_SERVER["DOCUMENT_ROOT"].'/PROGRAMACION3/Imagenes';

					move_uploaded_file($_FILES["fileimagen"]["tmp_name"],$sPath."/".$sNombreArchivo);//Con este comando subimos la imagen al servidor
					//insertar en la base
					$sql="insert into imagenes (sNombreArchivo,sTipoExtension,sPath,bEliminado) value(?,?,?,0)";
					$cmd= prepare_query($conexion,$sql,[$sNombreArchivo,$sTipoExtension,$sPath]);
					if($cmd)
						{ 
							$iIdImagen= $cmd->insert_id;
							$sql="insert into producto_imagen(iIdProducto,iIdImagen,iOrden,bEliminado) value(?,?,?,0)";
							$datos= prepare_query($conexion,$sql,[$iIdProducto,$iIdImagen,$iOrden]);
							//echo $iIdProducto.$iIdImagen.$iOrden;     
						}
				}
			}
					$sql="select pi.*,i.* from producto_imagen pi inner join imagenes i on pi.iIdImagen=i.iIdImagen where i.bEliminado=0 and iIdProducto=?";
					$imagenes=prepare_select($conexion,$sql,[$iIdProducto]);
			
	
	if (isset($_POST["nSubmitGrabar"]))//compruebo si hay valor en el ultimo formulario donde elijo imgprincipal
			{
			/// update todas las filas  del idproducto en curso  seteando a 1;
			$sql="update producto_imagen set iIdImagenPrincipal=0 where iIdProducto=?";
			$cmd=prepare_query($conexion,$sql,[$iIdProducto]);
			$valor=$_POST['imgp'];
			/// insert todas las filas de la tabla en pantalla seteando estado en 0;
			if($valor == true ){
										$sql1="update producto_imagen set iIdImagenPrincipal=1 where iIdProducto=? and iIdImagen=?";
										$cmd= prepare_query($conexion,$sql1,[$iIdProducto,$valor]);					
					}
		}	
?>

	<div class="modal-dialog text-center  " >
		<div  class= "col-sm-20 main-section ">
			<div  class="modal-content ">
					<div  class = "col-12 user-img">
						<img  src = "data:image/png;base64,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" />
					</div>
					<form class="col-12" id="imagenform" action="Imagen.php" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="iIdProducto" id="iIdProducto" value=<?php echo $iIdProducto ;?>>	
						
						<div  class = "form-group row" >
                           <label for="fileimagen" class="col-3"> Imagen </label>
                           <div class="col">
                                <input type="file"   name="fileimagen" id="fileimagen" />
                            </div>  
						</div>
						<div class = "form-group row" >
                            <label for="txtiOrden" class="col-3"> Orden </label>
                            <div class="col-5">
								<input type="number" class = " form-control " name="txtiOrden" id="txtiOrden"/>
                            </div>
                        </div>
								<button  type="submit" class ="btn btn-primary" > <i class="fas fa-cloud-upload-alt"></i>  Agregar Imagen </button >
							<div>
								<a href="index.php"> Volver a la lista de Productos </a>
							</div>
					</form>
			</div>
		</div>	
	</div>
	<div class="container-fluid">
				<div class="row text-center">	
				<table class="table table-striped">
						<thead>
							<th>Imagen</th>
							<th>Nombre</th>
							<th>Img.Principal</th>
							<th>Orden</th>
							<th>Acciones</th>
						</thead>
						<tbody>
							<form class="" id="imagenform" action="Imagen.php?iIdProducto=<?php echo $iIdProducto ;?>" method="POST" enctype="multipart/form-data">
								<?php
										if($imagenes->num_rows>0)
										{
											foreach($imagenes as $imagen)
												{
													echo '<tr>
																<td><a href="/PROGRAMACION3/Imagenes/'.$imagen["sNombreArchivo"].'"> <img src="/PROGRAMACION3/Imagenes/'.$imagen["sNombreArchivo"].'"alt="" width="35px" height="35px"></a> </td>
																<td>'.$imagen["sNombreArchivo"].'</td>
																<td><input type="radio"  name="imgp" id="myCheck" onclick="uncheckOthers(this.id)" value="'. $imagen['iIdImagen'].'" ></td>
																<td>'.$imagen["iOrden"].'</td>
																<td><a href="../Producto_imagen/delete.php?iIdProducto_Imagen='.$imagen["iIdProducto_Imagen"].'&iIdImagen='.$imagen["iIdImagen"].'&iIdProducto='.$imagen["iIdProducto"].'"class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a></td>  	 
															</tr>';
												}
										}
								?>	
									<input type="submit" id="iSubmitGrabar" name="nSubmitGrabar">
							</form>
						</tbody>
						
					</table>
						
				</div>
		</div>
	<?php require_once('../Libs/footer.php'); ?>
	
	<script>
				function uncheckOthers(id)
				{
					var elm=document.getElementsByTagName('input');
						for(var i =0; i<elm.length; i++)
						{
							if(elm.item(i).type=="radio" and  elm.item(i) !=id)
							{elm.item(i).checked=false;}
						}
				}
	</script>