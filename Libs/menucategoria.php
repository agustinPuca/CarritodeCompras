<?php
        $sql="select * from Categorias " ;
        $categorias=prepare_select($conexion,$sql);
         
?>
<head>
        <style>
            .men{
              background:linear-gradient(#17a2b8,#007bff);
              
            }
            .cat a:hover {
                                background-color: #343a40;
                                
                             }
        </style>
</head>
<nav class="men navbar navbar-expand-lg navbar-light  p-0">
<div class="container col-11 ">
 <a class="navbar-brand" href="#"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse " id="navbarNavDropdown">
    <ul class="navbar-nav">
    <?php 
    foreach($categorias as $categoria) 
                    {?>
            <li class=" cat nav-item active">
                <a class="nav-link text-white" href="../Styles/index.php?iIdCategoria=<?php echo $categoria["iIdCategoria"];?>" >
                <?php echo $categoria["sNombre"]?></a>
                
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
                </div>
                
            </li>
    <?php }?>
    </ul>
  </div>
  
                            <div class="collapse navbar-collapse justify-content-between " id="navbarNav">
                                              
                                        <ul class="navbar-nav ml-auto">
                                                <?php if(!isset($_SESSION["iIdUsuario"])){?>
                                                  <li class="nav-item"><a class="nav-link text-white " href="../Acceso/Createusuario.php"><!--<i class="fas fa-user-plus mr-1" ></i>--><strong>Creá tu Cuenta</strong></a></li>
                                                    <li class="nav-item"><a class="nav-link text-white " href="../Acceso/login.php"><!--<i class="fas fa-user-circle mr-1"></i>--><strong>Iniciar Sesion </strong> </a></li>
                                                    
							
							
                                                <?php } else { ?>        
                                                        <li class="nav-item dropdown mr-auto   ">
                                                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" >
                                                                <i class="fas fa-user-circle mr-1 "></i><strong><?php echo $_SESSION["sLogin"];?></strong></a>
                                                                
                                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">                            
                                                                <a class="dropdown-item" href="#">Mis Datos</a>
                                                                <a class="dropdown-item" href="../Productos/index.php">Productos</a>
                                                                <a class="dropdown-item" href="#"></a>
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item" href="../Acceso/logout.php"><i class="fas fa-sign-out-alt"></i>Cerrar Sesion  </a>
                                                            </div>
                                                        </li>
                                                        <li class="nav-item dropdown  text-white m-2 "><i class="fas fa-bell mr-1" color="white"></i><li>
                                                      
                                                        
                                                 <?php } ?>
                                        </ul>
                                    </div>
                                  </div>
</div>
</nav>

