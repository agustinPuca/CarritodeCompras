<?php
session_start();
require_once('../Libs/conexion.php');
require_once('../Libs/funciones.php');
require_once('../Libs/head.html');
	require_once('../Libs/Barralogo.php');
?>
<div class=" container col-11 my-5">
        <h3 class="text-dark ">Domicilio de Envio</h3>
    <div class="">
                <div class="tarjetas card  col-7 "   >
                    <div class="row no-gutters  ">
                          <div class="totalobj col-7 ml-5 my-2 ">
                            <h2 class=" card-title text-info ml-5 my-2">Total:</h2>
                           </div>
                          <div class="totalobj col-2 ml-3 my-2">
                              <a href="../Compras/index.php" type="submit"   id="editar"    class="btn btn-primary my-2 col-7 ml-5">Editar</a>  
                          </div>
                       </div>
                 </div>
                 <div class="tarjetas card  col-3 "   >
                    <div class="row no-gutters  ">
                          <div class="totalobj col-7 ml-5 my-2 ">
                            <h2 class=" card-title text-info ml-5 my-2">Total:</h2>
                           </div>
                          <div class="totalobj col-2 ml-3 my-2">
                              <a href="../Compras/index.php" type="submit"   id="editar"    class="btn btn-primary my-2 col-7 ml-5">Editar</a>  
                          </div>
                       </div>
                 </div>
    </div>
</div>