<?php
//metodos para abrir y cerrar una sesion
session_start();
session_destroy();
header("location: ../main/login.php");
?>