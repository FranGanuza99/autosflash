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

        <!--Aqui cominza la pagina-->
        <div class="container">
            <!--panel principal-->
            <div class="card-panel">
                <!--titulo-->
                <h4>Preguntas frecuentes</h4>
                <!--comienza el collapsible-->
                <ul class="collapsible popout" data-collapsible="accordion">
                  <!--1-->
                  <li>
                    <div class="active collapsible-header">¿Cómo comprar?</div>
                    <div class="collapsible-body">
                        <ol>
                            <li>1. Utilice los filtros para buscar el producto que mas se adecue a sus gustos</li>
                            <li>2. Seleccione el producto y revise las especificaciones.</li>
                            <li>3. De clic en comprar y siga los pasos para realizar la transacción</li>
                        </ol>
                    </div>
                  </li>

                  <!--2-->
                  <li>
                    <div class="collapsible-header">¿Cómo contactarnos?</div>
                    <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
                  </li>

                  <!--3-->
                  <li>
                    <div class="collapsible-header">¿Cual es el proceso de entrega?</div>
                    <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
                  </li>

                  <!--4-->
                  <li>
                    <div class="collapsible-header">¿Que debo hacer si mi auto llega a fallar ?</div>
                    <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
                  </li>
                </ul>
                
            </div>
        </div>
      

      
      <!--Aqui se muestra el pie de pagina-->
      <?php
      include("inc/footer.php");
      ?>
        

  </body>
</html>