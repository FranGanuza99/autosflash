<?php
//metodos para abrir y cerrar una sesion
session_start();
unset($_SESSION['id_cliente'], $_SESSION['nombre_cliente'], $_SESSION['foto_cliente'], $_SESSION['verifiacion']); 
header("location: ../index.php");
?>