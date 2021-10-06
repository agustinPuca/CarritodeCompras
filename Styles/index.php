<?php
session_start();
require_once ('../Libs/Header.php');
 require_once ('../Libs/menucategoria.php');
?>
<head>
    <style type="text/css">
    .card:hover {
        opacity: .85;
    box-shadow: 0px 0px 15px #848484;
			}
            .state, .state-full { cursor: pointer; }
                .state-full { display: none; }
                
    </style>
</head>
      <div class="container col-11">
        <div class="row row-cols-1 my-4 row-cols-md-5  ">              
<?php
        if(!empty($_GET["iIdCategoria"]))
            {
                $iIdCategoria=$_GET["iIdCategoria"];
                  $sql="select p.*,i.sNombreArchivo,i.sPath from Productos p inner join Producto_Imagen pi on p.iIdProducto=pi.iIdProducto inner join Imagenes i on pi.iIdImagen=i.iIdImagen  where  p.bEliminado=0 and i.bEliminado=0 and pi.iIdImagenPrincipal=true";
                  $productos=prepare_select($conexion,$sql,[$iIdCategoria]);
            }
        else{
            $sql="select p.*,i.sNombreArchivo,i.sPath from Productos p inner join Producto_Imagen pi on p.iIdProducto=pi.iIdProducto  inner join Imagenes i on pi.iIdImagen=i.iIdImagen where  p.bEliminado=0 and i.bEliminado=0 and pi.iIdImagenPrincipal=true";
            $productos=prepare_select($conexion,$sql);
            }
            //recupero idcarritocompra teniendo en cuenta el id del usuario actual en la pag
            if(isset($_SESSION["iIdUsuario"])){
                    $iIdUsuario=$_SESSION["iIdUsuario"];
                    $sql2="select iIdCarritoCompra from CarritosCompra where iIdUsuario=".$iIdUsuario;              
                    $cmd=prepare_select($conexion,$sql2);  
                    $id=$cmd->fetch_assoc();
                }
            if(!empty($_POST))
                {

                }
            foreach($productos as $producto)
                    { ;?>
                    <div class="state"><!--div para marcar desde donde puedo pasar el mouse -->
                    <div class="col mb-4   ">
                                <div class="card h-100 ">
                                        <a class="rest " href="../Productos/detprod.php?iIdProducto=<?php echo $producto["iIdProducto"];?>" type="button"> 
                                            <img src="/PROGRAMACION3/Imagenes/<?php echo $producto['sNombreArchivo'];?>" class="card-img-top mx-auto"   alt="Card image cap" style="width:80%;height:180px;  display:block">
                                        </a>     
                                                <h5 class="card-title mx-auto"><?php echo $producto['sNombre'];?></h5>
                                                <!--ocultar descripcion cuando el mouse no este sobre-->
                                                        <div class="mx-3">
                                                             <p class="card-text d-none d-lg-block " ><span class="state-full"><?php echo $producto['sDescripcion'];?></span></p>
                                                        </div>
                                            <div class="card-footer ">
                                                <h4 id="precio">$<?php echo $producto['fPrecio'];?></h4>
                                                   
                                                <!--consulto a la bd si existe tal producto -->
                                                    <div class="input-group mx-2 ">
                                                                <?php 
                                                                        //recupero el id de la consulta anteriro de carritoscompra
                                                                        $idcarrito=$id["iIdCarritoCompra"];
                                                                        $idProducto=$producto["iIdProducto"];
                                                                        //consulto en la bd si tal producto existe en la tabla det carrito donde el idcarritoscompra es del usuario actual
                                                                        $sql="SELECT  CASE IdProducto WHEN ? THEN 1 ELSE 0 END AS Existe FROM det_carrito WHERE  idCarritoCompra=? and IdProducto=".$idProducto;              
                                                                        $carritos=prepare_select($conexion,$sql,[$idProducto,$idcarrito]);  
                                                                        $fila=$carritos->fetch_assoc();//que te devuelve un array asociativo con el nombre del campo
                                                                        $bool=$fila['Existe'];
                                                                    
                                                                            if($bool==0){?>
                                                                                  <input type="number" min="1" class ="form-control " id="cantyidprod" name="<?php echo $producto["iIdProducto"];?>"  >
                                                                                  <div class="input-group-prepared ml-2 "> 
                                                                                        <a href="../Carrito/Agregar.php?iIdProducto=<?php echo $producto["iIdProducto"].'&fPrecio='.$producto["fPrecio"];?>" type="submit"   id="añadir"    class="btn btn-dark  "><i class="fas fa-cart-plus mr-1"></i>Añadir</a>  
                                                                                       <!--<button type="submit"   id="añadir"    onclick="valores()" class="btn btn-dark  "><i class="fas fa-cart-plus mr-1"></i>Añadir</button>  -->

                                                                                    </div>
                                                                        <?php    } 
                                                                            else{?>
                                                                                  <div class="input-group-prepared mx-3 " style="color:blue;">
                                                                                      <a href="../Carrito/det_carrito.php" type="submit"   id="añadir" style="visibility:visible; display:block;"  class="btn btn-danger  "><i class="fas fa-cart-plus mr-1"></i>Ver Carrito</a>                                                                  
                                                                                  </div>
                                                                                  <?php }?>
                                                          
                                                    </div>
                                            </div>
                                </div>
                    </div> 
                </div>
             <?php } ?>                
                    
            </div> 

<!--Pie de Pagina-->
<?php require_once ('../Libs/Footer.php'); ?>
<script>
            //ocultar descripcion 
                $('.state').hover(function() {
            $('.state-full', $(this)).slideToggle(100, 'linear').display(100, 'linear');
            });
            //----------------------------

            function valores()
                    {
                        p=document.getElementById("precio");
                        idprodycant=document.getElementById("cantyidprod");
                        precio=parseInt(p.innerHTML);
                        cantidad=idprodycant.value;
                        idproducto=idprodycant.name;
                        alert(cantidad );
                        //llamada a AJAX
                        var xmlhttp = new XMLHttpRequest();
                              xmlhttp.onreadystatechange = function() 
                                {
                                  if (this.readyState != 4 || this.status != 200)
                                  {
                                  //indicaar echo de error
                                  }
                                };
                                xmlhttp.open("GET", "../Carrito/Agregar.php?iIdProducto="+ idproducto + "&fPrecio="+ precio +"&Cantidad="+cantidad);
                                xmlhttp.send();
                    }        
</script>