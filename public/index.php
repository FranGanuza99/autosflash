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
  
      <div class="slider">
        <ul class="slides">
          <li>
            <img src="img/slider-index/img01.jpg" alt=""> <!-- random image -->
            <div class="caption center-align">
              <h3>¡Bienvenidos a Autos Flash!</h3>
            </div>
          </li>
          <li>
            <img src="img/slider-index/img02.jpg" alt=""> <!-- random image -->
            <div class="caption left-align">
              <h3>¿Buscas calidad?</h3>
              <h5 class="light grey-text text-lighten-3">Estas en el lugar correcto</h5>
            </div>
          </li>
          <li>
            <img src="img/slider-index/img03.jpg" alt=""> <!-- random image -->
            <div class="caption right-align">
            </div>
          </li>
        </ul>
      </div>

      <!--Aqui comienza la pagina-->
      <div class="container">

          <!--primera fila-->
          <div class= "row">
            <!--apartado de autos destacados-->
              <h4 class="center-align">Autos destacados</h4>
              <div class= "col s12 m4">
                  <!--1-->
                  <div class="card small">
                    <div class="card-image">
                      <!--imagen-->
                      <img src="img/autos/ford_c-max/img1.jpg" alt=""/>
                      <span class="card-title">Ford C-MAX 2017 </span>
                    </div>
                    <!--contenido de la carta-->
                    <div class="card-content">
                      <p>El C-MAX Energi Plug-In Hybrid te da la opción de enchufarlo o no para cargarlo...</p>
                    </div>
                    <div class="card-action">
                      <a href="#">Seguir leyendo...</a>
                    </div>
                  </div>
              </div>
              <!--2-->
              <div class= "col s12 m4">
                  <div class="card small">
                    <div class="card-image">
                      <!--imagen-->
                      <img src="img/autos/ford_fiesta/img1.jpg" alt=""/>
                      <span class="card-title">Ford Fiesta </span>
                    </div>
                    <!--contenido de la carta-->
                    <div class="card-content">
                      <p>Diversión. Eso es lo que sientes cuando conduces un Fiesta. Su manejo ágil y mayor potencia...</p>
                    </div>
                    <div class="card-action">
                      <a href="descripcion.php">Seguir leyendo...</a>
                    </div>
                  </div>
              </div>
              <!--3-->
              <div class= "col s12 m4">
                  <div class="card small">
                    <div class="card-image">
                      <!--imagen-->
                      <img src="img/autos/ford_fusion/img1.jpg" alt=""/>
                      <span class="card-title">Ford Fusion </span>
                    </div>
                    <!--contenido de la carta-->
                    <div class="card-content">
                      <p>Los motores EcoBoost disponibles combinan tres tecnologías diferentes: turbocargador...</p>
                    </div>
                    <div class="card-action">
                      <a href="#">Seguir leyendo...</a>
                    </div>
                  </div>
                  
              </div>
              <!--paginacion del apartado-->
              <ul class="pagination center">
                <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
                <li class="active blue"><a href="#!">1</a></li>
                <li class="waves-effect"><a href="#!">2</a></li>
                <li class="waves-effect"><a href="#!">3</a></li>
                <li class="waves-effect"><a href="#!">4</a></li>
                <li class="waves-effect"><a href="#!">5</a></li>
                <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
              </ul>
          </div>

          <!--segunda fila-->
          <div class= "row">
              <!--primera columna-->
              <div class= "col s12 m6">
                  <h4 class="center-align">Nuestra página en Facebook</h4>
                  <!--plugin-->
                  <div class="fb-page" data-href="https://www.facebook.com/facebook" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/facebook" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/facebook">Facebook</a></blockquote></div>
              </div>
              <!--segunda columna-->
              <div class= "col s12 m6">
                  <div class="card-panel">
                      <h4 class="center-align">Promociones</h4>
                      <img class="responsive-img materialboxed" width="100%" src="img/promociones/img06.jpg" >
                      <br>
                      <img class="responsive-img materialboxed" width="100%" src="img/promociones/img05.jpg" >
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