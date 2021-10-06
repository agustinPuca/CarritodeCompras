<?php
session_start();
require_once ('../Libs/Header.php');
 require_once ('../Libs/menucategoria.php');
?>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.img {  
  display:block;
  margin-left: auto;
  margin-right: auto;
  
}

/* coloque ell contenedor de imagenes (necesario para colocar las flechas izq y der) */


/* Ocultar las imagenes por defecto */
.mySlides {
  display: none;
}

/* agregar un puntero cuando el mouse pase por las imagenes miniatura */
.cursor {
  cursor: pointer;
}

/* boton siguiente y anterior */
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 40%;
  width: auto;
  padding: px;
  margin-top: px;
  color: white;
  font-weight: bold;
  font-size: 50px;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

/* coloque el boton siguiente a la derecha */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

.card-block{
  Padding: 0px 55px;
} 
/* columnas una alado de la otra */
.column {
  float: left;
  width: 30%;
}

/* agregar un efecto de tranparencia a las imagenes q no estan seleccionadas */
.demo {
  opacity: 0.6;
}
.precio{
        color:rgb(0, 150, 255);
        font-size: 300%;
        text-align:right;   
}
.active,
.demo:hover {
  opacity: 1;
}
.embed-responsive .card-img-top {
    object-fit: cover;
}
</style>
</head>


    <div class="card mx-auto my-3 col-11 ">
      <div class="row  no-gutters">
<?php
        if(!empty($_GET["iIdProducto"]))
            {
                $iIdProducto=$_GET["iIdProducto"];
                  //$sql="select productos.*, imagenes.sNombreArchivo, imagenes.sPath from productos,producto_imagen,imagenes where productos.iIdProducto=producto_imagen.iIdProducto and producto_imagen.iIdImagen=imagenes.iIdImagen and  productos.bEliminado=0 and imagenes.bEliminado=0" ;
                  //$sql="select p.*,i.sNombreArchivo,i.sPath from Productos p inner join Producto_Imagen pi on p.iIdProducto=pi.iIdProducto inner join Imagenes i on pi.iIdImagen=i.iIdImagen inner join Producto_categoria pc on p.iIdProducto= pc.iIdProducto where pc.iIdCategoria=? and p.bEliminado=0 and i.bEliminado=0 ";
                  //$productos=prepare_select($conexion,$sql,[$iIdCategoria]);
                       
            }
     $sql="select p.*,i.sNombreArchivo,i.sPath from Productos p inner join Producto_Imagen pi on p.iIdProducto=pi.iIdProducto inner join Imagenes i on pi.iIdImagen=i.iIdImagen where  p.bEliminado=0 and i.bEliminado=0 and p.iIdProducto=".$iIdProducto;
                $productos=prepare_select($conexion,$sql);
  ?> 
          
            <div class="col-md-1">
                
                   <table >
                         <div class="row  "> 
                                <?php  $s=0; foreach($productos as $producto)
                                  { $s++;?>
                                          <tr>
                                            <div class="column">
                                              <td><img class="demo cursor d-none d-lg-block" src="../Imagenes/<?php echo $producto["sNombreArchivo"];?>" style="width:80px; " onclick="currentSlide(<?php echo $s;?>)" ></td>
                                            </div>
                                          </tr>
                              <?php }?>
                          </div> </table>
                                   
            </div>
            <div class="col-md-6 ">    
                    <?php  foreach($productos as $producto)
                    { ;?>
                              <div class="mySlides ">
                                <img class="img col-12 my-2"  src="../Imagenes/<?php echo $producto["sNombreArchivo"];?> "style="width:auto; height:450px;" > 
                              </div>
                      <?php } ?>
                  
          <a class="prev ml-6" onclick="plusSlides(-1)">❮</a>
                        <a class="next mr-6" onclick="plusSlides(1)">❯</a>
                       
            
          </div>
          
       
                 
                                <div class="col-md ">
                                    <div class="card-block  ">
                                        <h1 class="card-title ml-5 "><?php echo $producto['sNombre'];?></h1>
                                        <p class= "precio">$<?php echo $producto['fPrecio'];?></p>
                                        <?php
                                                if($producto['iStock']<=$producto['iStockminimo'])
                                                        {
                                                            echo "<p class='card-text  '>(Bajo Stock) </p>".$producto['iStockminimo'];
                                                        }
                                                else
                                                        {
                                                            echo "<p class='card-text ' style='text-align:right;'> (Stock Disponible)</p>";
                                                        }
                                        ?>
                                        <h3 class="card-text"  > Descripción</h5>
                                        <p class="card-text col-12"><?php echo $producto['sDescripcion'];?></p>
                                            <div class="input-group col-12 mx-auto">
                                                <h5 class="card-text  mr-2 " > Cantidad:</h5>
                                                  <input type="number" min="1" class ="form-control form-control-sm col-sm-2  "  name="iCantidad" >
                                                  <p class="card-text col-auto" ><font color="gray"><?php echo "(".$producto['iStock']." Disponible)";?></font></p>
                                            </div>
                                        </div>                                     
                                <div class="input-group col-12 my-4 ">
                                                    <div class="input-group-prepared col-6">
                                                        <a href="../Carrito/comprar.php" type="button" class="btn btn-info  btn-block  "><i class="fas fa-store mr-1"></i>Comprar </a>
                                                    </div>
                                                    <div class="input-group-prepared col-6">
                                                        <a href="../Carrito/agregar.php?iIdProducto=<?php echo $producto["iIdProducto"];?>" type="button" class="btn btn-dark   btn-block    "><i class="fas fa-cart-plus mr-1"></i>   Añadir   </a>
                                                    </div>
                                               
                                   </div>       
                                    
                                         
                        
            
      </div>
    </div>
  </div>
  <script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>
<?php require_once('../Libs/footer.php')?>
  