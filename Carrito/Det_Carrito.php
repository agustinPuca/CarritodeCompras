<?php
session_start(); 
  require_once ('../Libs/conexion.php');
  require_once ('../Libs/funciones.php');
  require_once ('../Libs/head.html');
?>
<head>
      <title>Carrito de Compra</title>
			<!-- css-->
			<link rel="stylesheet" type="text/css" href="Css/Det_carrito.css">
	</head>
    <?php 
      if(isset($_SESSION["iIdUsuario"]))
      {
              require_once ('../Libs/menu.php');
              require_once ('../Libs/menucategoria.php');
              $iIdUsuario=$_SESSION["iIdUsuario"];
                    $sql1="select c.*,dc.*,p.*,i.sNombreArchivo from carritoscompra c inner join det_carrito dc on c.iIdCarritocompra=dc.Idcarritocompra inner join productos p  on dc.IdProducto=p.iIdProducto inner join Producto_Imagen pi on p.iIdProducto=pi.iIdProducto inner join Imagenes i on pi.iIdImagen=i.iIdImagen where  pi.iIdImagenPrincipal=true and c.Estado='En Curso'and c.iIdUsuario=?";
                    $productos=prepare_select($conexion,$sql1,[$iIdUsuario]);
    ?>
<div class="container col-11">
    <!--TIULO--->
          <div class="titulo card mx-auto my-3 "  >
              <div class="row no-gutters mx-auto">
                      <div class="card-body ">
                          <h4 class="card-title text-info">Carrito de Compra</h4>
                      </div>
              </div>
          </div>
                    <?php $total=0;
                      foreach($productos as $producto){ 
                    ?>
                            <!--Div PRODUCTOS-->
                   <div class="tarjetas card  "  >
                        <div class="row no-gutters  ">
                                <div class="img">
                                  <!--imagen-->
                                    <a class="rest " href="../Productos/detprod.php?iIdProducto=<?php echo $producto["iIdProducto"];?>" type="button"> 
                                      <img src="../Imagenes/<?php echo $producto['sNombreArchivo'];?>"  class="card-img my-2 "  alt="...">
                                    </a>
                                </div>
                              <!--nombre y decripcion-->
                              <div class="obj  col-5 ml-2 my-4 ">
                                  <h5 class="card-title"><?php echo $producto["sNombre"];?></h5>
                                  <p class="card-text  d-none d-lg-block "><small class="text-muted"><?php echo $producto["sDescripcion"];?></small></p>
                              </div>

                              <div class="obj my-5 ">
                                  <a href="Delete.php?idDet_Carrito=<?php echo $producto["idDet_Carrito"]; ?>" class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"></i></a>
                              </div>

                              <div class="obj col-1 ml-5 my-5">
                                  <p><?php echo '$ '.$producto["Precio"];?> 
                                  <br>
                                  <small class="text-muted ml-3">C/U</small>
                                </p>
                                  
                              </div>
                              <div class="obj ml-4 col-1 my-5">
                                  <input type="number" min="1" class ="form-control form-control col-9" name="<?php echo $producto["iIdProducto"];?>" id="<?php echo $producto["IdCarritoCompra"];?>" value="<?php echo $producto["Cantidad"];?>" onblur="PrecioXCantidad(this);" >
                                  <small class="text-muted ">
                                      <?php echo $stock=$producto["iStock"];
                                          if($stock>1){
                                            echo ' Disponibles';
                                          }
                                          else{
                                            echo 'Ultimo Disponible';
                                          }
                                      ?>
                                  </small>
                               </div>
                              <!--precio-->
                              
                              <div class="input-group  col-2 ml-5 my-5 ">
                                <input type="hidden" name="nPrecioHidden" id="iPrecioHidden<?php echo $producto["iIdProducto"];?>" value = "<?php echo $producto["fPrecio"];?>"> 
                                <h4 class= "ml-5 "> <?php echo '$ ';?>
                                </h4> <h4 class= "ml-1 " name="nSubtotal" id="iSubtotal<?php echo $producto["iIdProducto"];?>" ><?php echo  $producto["Subtotal"];?></h4>
                              </div>
                              
                              
                        </div>
                  </div>
                          <input type="hidden"  id="hiddentotal" value="<?php echo $producto["total"];?>">
                              
                <?php } ?>
                    <!--Div TOTAL-->
                    <div class="tarjetas card  my-2 "   >
                    <div class="row no-gutters  ">
                          <div class="totalobj col-7 ml-5 my-2 ">
                            <h2 class=" card-title text-info ml-5 my-2">Total:</h2>
                           </div>
                          <div class="totalobj col-2 ml-4 my-2">
                              <h3 class= "precio ml-5 my-2 " id="total" ><?php echo '$ '.$producto["total"];?></h3>
                          </div>
                          <div class="totalobj col-2 ml-3 my-2">
                              <a href="../Compras/index.php" type="submit"   id="Compras"    class="btn btn-primary my-2 col-10 ml-5">Comprar</a>  
                          </div>
                       </div>
                    </div>
  </div>  
  <script type="text/javascript"> 
  
  //actualizar total en tiempo real desde la bd
              
                function PrecioXCantidad(str)
                      {
                        str1=str.value; 
                        if (str1 != '')
                          {     //defino el div con id iSubtotal con la variable Subtotal
                                subtotal= document.getElementById("iSubtotal" + str.name);
                                //en la variable subtotal defino precio x cantidad y lo muestro en el div i subtotal
                                subtotal.innerHTML=str1 * document.getElementById("iPrecioHidden"+str.name).value;
                                //el valor guardado en subtotal es un string el cual lo convierto en entero con la funsion ParseInt() y queda designado en la variable sub
                                sub=parseInt(subtotal.innerHTML);
                                //recupero idcarritocompra desde el id del input cantidad
                                idcarrito=str.id;
                                cantidad=str1;
                                idproducto=str.name;
                            //llamada a AJAX
                              var xmlhttp = new XMLHttpRequest();
                              xmlhttp.onreadystatechange = function() 
                                {
                                  if (this.readyState != 4 || this.status != 200)
                                  {
                                    document.getElementById("total").innerHTML=this.responseText;
                                  }
                                };
                                fd= new FormData();
                                fd.append('Cantidad',cantidad);
                                fd.append('subtotal',sub);
                                fd.append('idProducto',idproducto);
                                fd.append('idCarrito',idcarrito);
                                xmlhttp.open("POST", "Ajax.php", true);
                                xmlhttp.send(fd);
                                //refresca la pagina para obtener el total en tiempo real
                                //location.reload(true);
                          }
                        else
                            {
                            document.getElementById("iSubtotal" + str.name).innerHTML = 'Error';
                            }            
                      }   
  </script>
      <?php
      }
      else
          {
            header("location: ../Acceso/login.php"); 
          }
      ?>
  <?php require_once ('../Libs/Footer.php'); ?>