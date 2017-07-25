<?php
//metodos para abrir y cerrar una sesion
session_start();
unset($_SESSION['cargo'], $_SESSION['id_usuario'], $_SESSION['nombre_usuario'], $_SESSION['foto_usuario'], $_SESSION['verifiacion_usuario']);  
header("location: ../main/login.php");
?>