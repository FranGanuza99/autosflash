<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <!--Import Google Icon Font-->
        <link href="../css/icons.css" rel="stylesheet">
        <title>Formulario de registro</title>
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="../css/icon.css"  media="screen,projection"/>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <!--  archivos css-->
        <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection"/>
        <link type="text/css" rel="stylesheet" href="css/mystyle-sheet.css" media="screen,projection"/>
    </head>
    <body>
        <!---->
        
        
        <!--Aqui se muestra el menu-->
        <?php
        include("inc/menu.php");
        ?>
        
        <!--Aqui comienza la pagina-->
        <div class="container">
            <!--primera fila-->
            <div class="row">
                <!--columna del form-->
                <div class="col s12 m8 offset-m2">
                    <br>
                    <div class="card-panel">
                        <h3 class="center-txt">Registro de usuarios</h3>
                        <br>
                        
                        <!--inicio del form de registro-->
                        <!--nombre-->
                        <form action="">
                          <div class="input-field col s12">
                            <i class="material-icons prefix">account_circle</i>
                            <input type="text" id="first_name" class="validate">
                            <label for="first_name">Nombre</label>
                          </div>
                          <!--email-->
                          <div class="input-field col s12">
                            <i class="material-icons prefix">email</i>
                            <input type="email" id="email" class="validate">
                            <label for="email" data-error="wrong" data-success="right">Correo electrónico</label>
                          </div>
                          <!--contra-->
                          <div class="input-field col s6">
                            <i class="material-icons prefix">vpn_key</i>
                            <input id="password" type="password" class="validate">
                            <label for="password">Contraseña</label>
                          </div>
                          <!--contra2-->
                          <div class="input-field col s6">
                            <i class="material-icons prefix">replay</i>
                            <input id="password" type="password" class="validate">
                            <label for="password">Confirmar contraseña</label>
                          </div>
                          <!--telefono-->
                          <div class="input-field col s12">
                            <i class="material-icons prefix">phone</i>
                            <input id="icon_telephone" type="tel" class="validate">
                            <label for="icon_telephone">Telephone</label>
                          </div>
                        </form>
                        <!--botones del form-->
                        <div class="center">
                            <div class="center-sesion2">
                                <a href="#" class="waves-effect waves-light btn-large green">Registrarme</a>
                                <a href="#" class="waves-effect waves-light btn-large red">Cancelar</a>
                            </div>
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