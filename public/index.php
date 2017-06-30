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
            <h4 class="center-align">Autos destacados</h4>
            <?php
              ob_start();
              //se llama la conexion a la base de datos
              require("../lib/database.php");
              require("../lib/zebra.php");
              //se consultan los productos a mostrar
              $sql = "SELECT vehiculos.codigo_vehiculo,nombre_vehiculo, descripcion_vehiculo, url_foto, precio_vehiculo FROM vehiculos, fotos_vehiculos,tipos_fotos WHERE fotos_vehiculos.codigo_vehiculo = vehiculos.codigo_vehiculo AND fotos_vehiculos.codigo_tipo_foto=1 AND tipos_fotos.codigo_tipo_foto= 1 AND  vehiculos.estado_vehiculo =1";
              $data = Database::getRows($sql, null);

              //obtenemos el numero de filas y cantidad maxima
              $num_registros = count($data); 
              $resul_x_pagina = 3; 

              //instanciando la clase y enviando parametros
              $paginacion = new Zebra_Pagination(); 
              $paginacion->records($num_registros); 
              $paginacion->records_per_page($resul_x_pagina);

              //Consulta utilizando limit
              $consulta = $sql.' LIMIT '.(($paginacion->get_page() - 1) * $resul_x_pagina). ',' .$resul_x_pagina;
              //ejecuta la consulta
              $params = null;
              $data = Database::getRows($consulta, $params);

              if($data != null)
              {
                //se carga la data en las tarjetas
                foreach ($data as $row) 
                {
                  print("
                    <div class='card hoverable col s12 m6 l4 fijo2'>
                      <div class='card-image waves-effect waves-block waves-light'>
                        <img class='activator fijo' src='data:image/*;base64,$row[url_foto]'>
                      </div>
                      <div class='card-content'>
                        <span class='card-title activator grey-text text-darken-4'>$row[nombre_vehiculo]<i class='material-icons right'>more_vert</i></span>
                        <p><a href='descripcion.php?id=".$row['codigo_vehiculo']."'><i class='material-icons left'>loupe</i>Seleccionar</a></p>
                      </div>
                      <div class='card-reveal'>
                        <span class='card-title grey-text text-darken-4'>$row[nombre_vehiculo]<i class='material-icons right'>close</i></span>
                        <p>$row[descripcion_vehiculo]</p>
                        <p>Precio (US$) $row[precio_vehiculo]</p>
                      </div>
                    </div>
                  ");
                }
                
              }
              else
              {
                print("<div class='card-panel yellow'><i class='material-icons left'>warning</i>No hay registros disponibles en este momento.</div>");
              }
              ?>
              
          </div>
          <?php
          $paginacion->render();
          ?>
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
                  <div class="">
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