<?php 
session_start();
Page::timer();

?>
<ul id='dropdown1' class='dropdown-content dropstyle'>
    <li><a href='perfil.php'>Editar perfil</a></li>
    <li class='divider'></li>
    <li><a href='compras.php'>Compras realizadas</a></li>
    <li class='divider'></li>
    <li><a href='modificar_clave.php'>Cambiar contraseña</a></li>
    <li class='divider'></li>
    <li><a href='logout.php'>Cerrar Sesion</a></li>
</ul>

<ul id='dropdown12' class='dropdown-content dropstyle'>
    <li><a href='perfil.php'>Editar perfil</a></li>
    <li class='divider'></li>
    <li><a href='compras.php'>Compras realizadas</a></li>
    <li class='divider'></li>
    <li><a href='modificar_clave.php'>Cambiar contraseña</a></li>
    <li class='divider'></li>
    <li><a href='logout.php'>Cerrar Sesion</a></li>
</ul>

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
                    //valida si hay alguna sesion iniciada
                    if (isset($_SESSION['nombre_cliente'])){
                        //muestra la foto de perfil del cliente
                        print("
                        <li><a class='foto-perfil dropdown-button' data-activates='dropdown1'><img src='data:image/*;base64,".$_SESSION['foto_cliente']."' class='circle' width='48' height='48'></a></li>");
                    } else {
                        print("<li><a href='sesion.php'>Iniciar sesión</a></li>");
                    }
                    ?>
                    
                </ul>
            
            </div>
        </div>
    </nav>
    
</div>

<ul class="side-nav" id="mobile-menu">
    <li><a href="index.php">Inicio</a></li>
    <li><a href="producto.php">Catálogo de autos</a></li>
    <li><a href="informacion.php">Nuestra empresa</a></li>
    <li><a href="contacto.php">Contáctenos</a></li>
    <li><a href="pregunta.php">Preguntas frecuentes</a></li>
    <?php
    if (isset($_SESSION['nombre_cliente'])){
        print("<li class='active'><a class='dropdown-button' data-activates='dropdown12'>".$_SESSION['nombre_cliente']."</a></li>");
    } else {
        print("<li><a href='sesion.php'>Iniciar sesión</a></li>");
    }
    ?>
    
</ul>

    