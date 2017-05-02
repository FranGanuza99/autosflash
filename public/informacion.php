<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <!--Import Google Icon Font-->
        <link href="../css/icons.css" rel="stylesheet">
        <title>Inicio</title>
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
        
            <!--primera imagen en parallax-->
            <div class="parallax-container">
                <div class="parallax"><img src="img/info-parallax/img01.jpg"></div>
            </div>

            <!--seccion de identidad-->
            <div class="section white">
                <div class="row container">
                    <h2 class="header">¿Quienes somos?</h2>
                    <p class="grey-text text-darken-3 lighten-3">Somos una empresa dedicada a la comercialización de vehículos y prestación de servicios post ventas, brindando soluciones a la medida de nuestros clientes. </p>
                    <p class="grey-text text-darken-3 lighten-3">Somos una empresa joven y competitiva que apuesta al trabajo en equipo para lograr la satisfacción de nuestros clientes, a quienes consideramos lo más importante.</p>
                    <p></p>
                    <h2 class="header">Lema de la empresa</h2>
                    <p class="grey-text text-darken-3 lighten-3">¿Buscas calidad a un buen precio? No busques más.</p>
                </div>
            </div>
            
            <!--segunda imagen en parallax-->
            <div class="parallax-container">
                <div class="parallax"><img src="img/info-parallax/img02.jpg"></div>
            </div>
            
            <!--seccion de mision y vison-->
            <div class="section white">
                <div class="row container">
                    <h2 class="header">Misión</h2>
                    <p class="grey-text text-darken-3 lighten-3">Somos una empresa dedicada a hacer del transporte una experiencia placentera y confiable, ofreciendo productos automotrices innovadores, de alta calidad, con precios competitivos, procesos eficientes, con el respaldo de marcas de prestigio mundial; para lograr exceder continuamente las expectativas de nuestros clientes, empleados y accionistas.</p>
                    <br>
                    <h2 class="header">Visión</h2>
                    <p class="grey-text text-darken-3 lighten-3">Ser la empresa líder en la comercialización de vehículos y prestación de servicios post ventas, brindando soluciones a la medida de nuestros clientes. Ser reconocida por la calidad humana y profesional de nuestra gente, tanto por clientes como por proveedores.</p>
                </div>
            </div>

            <!--tercer imagen en parallax-->
            <div class="parallax-container">
                <div class="parallax"><img src="img/info-parallax/img06.jpg"></div>
            </div>

            <!--seccion de valores-->
            <div class="section white">
                <div class="row container">
                    <h2 class="header">Valores</h2>
                    <!--listado de valores-->
                    <ul class="collection">
                        <li class="collection-item">Responsabilidad</li>
                        <li class="collection-item">Integrida</li>
                        <li class="collection-item">Vocación de Servicio</li>
                        <li class="collection-item">Respeto</li>
                        <li class="collection-item">Actitud Positiva</li>
                        <li class="collection-item">Compromiso</li>
                    </ul>
                    
                </div>
            </div>

            <!--cuarta imagen en parallax-->
            <div class="parallax-container">
                <div class="parallax"><img src="img/info-parallax/img05.jpg"></div>
            </div>

            <!--seccion de principios-->
            <div class="section white">
                <div class="row container">
                    <h2 class="header">Nuestros Principios</h2>
                    <ul class="collection">
                        <li class="collection-item">Orientación a la mejora continua de nuestros procesos.</li>
                        <li class="collection-item">Cumplir con los requisitos nacionales, internacionales y del Grupo Volkswagen en materia de: Calidad en los productos y servicios, prevención de la contaminación ambiental, seguridad y salud laboral.</li>
                        <li class="collection-item">Fomentar una actitud de excelencia en todos nuestros colaboradores y socios comerciales.</li>

                    </ul>
                </div>
            </div>
            
            <!--quinta imagen en parallax-->
            <div class="parallax-container">
                <div class="parallax"><img src="img/info-parallax/img07.jpg"></div>
            </div>


        </div>
        
        <!--Aqui se muestra el pie de pagina-->
        <?php
        include("inc/footer.php");
        ?>
        
    </body>
</html>