<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <!--Import Google Icon Font-->
        <link href="../css/icons.css" rel="stylesheet">
        <title>Contactos</title>
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
            <!--panel interno-->
            <div class="card-panel">
                <h3 class="center-txt">Contáctanos</h3>
                <br>
                <!--inicia la primer fila-->
                <div class="row">
                    <!--primer columna-->
                    <div class="col s12 m6">
                        <h5>Ubicación:</h5>
                        <h6>Avenida Aguilares #218, Centro Urbano Libertad.</h6>
                        <h6>San Salvador, El Salvador</h6>
                        <h6>Tel: (503) 2234-6000</h6>
                        <h6>Fax: (503) 2234-6085</h6>
                        <br>
                        <h5>Siguienos en:</h5>
                        <p>  
                            <img src="img/contactos/lo1.png "/>           
                            <img src="img/contactos/lo2.png "/>        
                            <img src="img/contactos/lo3.png "/>      
                            <img src="img/contactos/lo4.png " /> 
                            
                        </p>
                    </div>
                    <!--segunda columna-->
                    <div class="col s12 m6">
                        <h5>Comunícate con nosotros</h5>
                        <!--comienza el form-->
                        <!--nombre-->
                        <form action="">
                            <div class="input-field col s12 l6">
                                <input type="text" id="first_name" class="validate">
                                <label for="first_name">Nombre:</label>
                            </div>
                            <!--apellido-->
                            <div class="input-field col s12 l6">
                                <input type="text" id="last_name" class="validate">
                                <label for="last_name">Apellido:</label>
                            </div>
                            <!--correo-->
                            <div class="input-field col s12">
                                <input type="email" id="email" class="validate">
                                <label for="email" data-error="wrong" data-success="right">Correo electrónico</label>
                            </div>
                            <!--mensaje-->
                            <div class="input-field col s12">
                                <textarea id="textarea1" class="materialize-textarea"></textarea>
                                <label for="textarea1">Mensaje</label>
                            </div>
                            <br>
                            <br>
                            <!--botones-->
                            <div class="center">
                                <a href="#" class="waves-effect waves-light btn green">Enviar</a>
                                <a href="#" class="waves-effect waves-light btn red">Cancelar</a>
                            </div>
                        </form>               
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