<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <!--Import Google Icon Font-->
        <link href="../css/icons.css" rel="stylesheet">
        <title>Iniciar Sesión</title>
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="../css/icon.css"  media="screen,projection"/>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <!--  archivos css-->
        <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection"/>
        <link type="text/css" rel="stylesheet" href="css/mystyle-sheet.css" media="screen,projection"/>
    </head>
    <body>

        <!--Aqui se muestra el menu-->
        <?php
        include("inc/menu.php");
        ?>
        
        <!--Aqui comienza la pagina-->
        <div class="container">
            <!--primera fila-->
            <div class="row">
                <!--columna del login-->
                <div class="col s12 m6 offset-m3">
                    <br>
                    <div class="card-panel">
                        <h3 class="center-txt">Iniciar Sesión</h3>
                        <br>
                        <div class="center">
                            <img src = "img/sesion/usuario.png" width="200px">
                        </div>
                        <!--Inicio del formulario-->
                        <form action="">
                            <div class="input-field col s12">
                                <input type="email" id="email" class="validate">
                                <label for="email" data-error="wrong" data-success="right">Correo eléctronico:</label>
                            </div>
                            <div class="input-field col s12">
                                <input id="password" type="password" class="validate">
                                <label for="password">Contraseña:</label>
                            </div>
                            
                        </form>
                        <!--botones-->
                        <div class="center">
                            <div class="center-sesion">
                                <a href="#" class="waves-effect waves-light btn-large green">Iniciar Sesión</a>
                                <a href="#" class="waves-effect waves-light btn-large red">Cancelar</a>
                            </div>
                        </div>
                        <br>
                        <!--redireccion al registro-->
                        <div class="center">
                            <h6>¿No tienes una cuenta? Registrate aquí</h6>
                            <a href="registro.php" class="waves-effect waves-light btn">Registrarse</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!--Aqui se muestra el pie de pagina-->
        <?php
        include("inc/footer.php");
        ?>
        

    </body>
</html>