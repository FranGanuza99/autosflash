<?php 
session_start();
?>
<div class="navbar-fixed">
    <nav>
    <div class="nav-wrapper blue" >
        <div class="container">
        <a href="index.php" class="brand-logo"><img class="logo" src="img/logo/logo.png"></a>
        <a href="#" data-activates="mobile-menu" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
            <li><a href="producto.php">Catálogo de autos</a></li>
            <li><a href="informacion.php">Nuestra empresa</a></li>
            <li><a href="contacto.php">Contáctenos</a></li>
            <li><a href="pregunta.php">Preguntas frecuentes</a></li>
            <?php
            if (isset($_SESSION['nombre_usuario'])){
                print("
                

                <li><a data-activates='dropdown1'><img src='data:image/*;base64,".$_SESSION['foto_perfil']."' class='circle' width='55' height='55'></a></li>");
            } else {
                print("<li><a href='sesion.php'>Iniciar sesión</a></li>");
            }
            ?>
            
        </ul>
        
        </div>
    </div>
    </nav>
    
    <ul id='dropdown1' class='dropdown-content'>
        <li><a href='#!'>one</a></li>
        <li><a href='#!'>two</a></li>
        <li class='divider'></li>
        <li><a href='#!'>three</a></li>
    </ul>
</div>

<ul class="side-nav" id="mobile-menu">
    <li><a href="index.php">Inicio</a></li>
    <li><a href="producto.php">Catálogo de autos</a></li>
    <li><a href="informacion.php">Nuestra empresa</a></li>
    <li><a href="contacto.php">Contáctenos</a></li>
    <li><a href="pregunta.php">Preguntas frecuentes</a></li>
    <li><a href="sesion.php">Iniciar sesión</a></li>
</ul>