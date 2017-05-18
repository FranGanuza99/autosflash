<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <!--Import Google Icon Font-->
        <link href="../css/icons.css" rel="stylesheet">
        <title>Productos</title>
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
        <br>
        <br>
        <br>
        <!--se crea una tab la cual lo que hace es hacer como un submenu en el cual se encuentran clasificados los automoviles-->
        <div class="row">
          <div class="col s12">
            <ul class="tabs">
              <li class="tab col s3 "><a class="active " href="#carros">Carros</a></li>
              <li class="tab col s3"><a href="#suv">SUVs y Crossovers</a></li>
              <li class="tab col s3"><a href="#camion">Camiones y Furgonetas</a></li>
              <li class="tab col s3"><a href="#hibrido">Híbridos y Electricos</a></li>
            </ul>
            <br>
          </div>
          <!--a cada pestaña se le asigna un id  para luego desplazarse en los submenus-->
          <div id="carros" class="col s12">
             <img class="responsive-img" src="img/autos/logos/ford.png" width="220" height="150">
           
             <div class='row'>
              <?php
              ob_start();
              //se llama la conexion a la base de datos
              require("../lib/database.php");
              //se consultan los productos a mostrar
              $sql = "SELECT vehiculos.codigo_vehiculo,nombre_vehiculo, descripcion_vehiculo, url_foto, precio_vehiculo FROM vehiculos, fotos_vehiculos,tipos_fotos WHERE fotos_vehiculos.codigo_vehiculo = vehiculos.codigo_vehiculo AND fotos_vehiculos.codigo_tipo_foto=1 AND tipos_fotos.codigo_tipo_foto= 1 AND vehiculos.codigo_tipo_vehiculo = 1 AND vehiculos.estado_vehiculo =1";
              $data = Database::getRows($sql, null);
              if($data != null)
              {
                //se carga la data en las tarjetas
                foreach ($data as $row) 
                {
                  print("
                    <div class='card hoverable col s12 m6 l4'>
                      <div class='card-image waves-effect waves-block waves-light'>
                        <img class='activator' src='data:image/*;base64,$row[url_foto]'>
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
              </div><!-- Fin de row -->

           
    <!--se inicia con el siguiente submenu-->
          </div>
          <div id="suv" class="col s12">
              <img class="responsive-img" src="img/autos/logos/ford.png" width="220" height="150">
            
             <div class='row'>
              <?php
              //se inica la conexion de nuevo pero en esta consulta verifica otro tipo de vehiculo
              ob_start();
              $sql = "SELECT vehiculos.codigo_vehiculo,nombre_vehiculo, descripcion_vehiculo, url_foto, precio_vehiculo FROM vehiculos, fotos_vehiculos,tipos_fotos WHERE fotos_vehiculos.codigo_vehiculo = vehiculos.codigo_vehiculo AND fotos_vehiculos.codigo_tipo_foto=1 AND tipos_fotos.codigo_tipo_foto= 1 AND vehiculos.codigo_tipo_vehiculo = 2 AND vehiculos.estado_vehiculo =1";
              $data = Database::getRows($sql, null);
              if($data != null)
              {
                foreach ($data as $row) 
                {
                  print("
                    <div class='card hoverable col s12 m6 l4'>
                      <div class='card-image waves-effect waves-block waves-light'>
                        <img class='activator' src='data:image/*;base64,$row[url_foto]'>
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
              </div><!-- Fin de row -->

          </div>
          <!--Se inicia el siguiente submenu-->
          <div id="camion" class="col s12">
          <img class="responsive-img" src="img/autos/logos/ford.png" width="220" height="150">
          <div class='row'>
              <?php
              ob_start();
               //se inica la conexion de nuevo pero en esta consulta verifica otro tipo de vehiculo
              $sql = "SELECT vehiculos.codigo_vehiculo,nombre_vehiculo, descripcion_vehiculo, url_foto, precio_vehiculo FROM vehiculos, fotos_vehiculos,tipos_fotos WHERE fotos_vehiculos.codigo_vehiculo = vehiculos.codigo_vehiculo AND fotos_vehiculos.codigo_tipo_foto=1 AND tipos_fotos.codigo_tipo_foto= 1 AND vehiculos.codigo_tipo_vehiculo = 3 AND vehiculos.estado_vehiculo =1";
              $data = Database::getRows($sql, null);
              if($data != null)
              {
                foreach ($data as $row) 
                {
                  print("
                    <div class='card hoverable col s12 m6 l4'>
                      <div class='card-image waves-effect waves-block waves-light'>
                        <img class='activator' src='data:image/*;base64,$row[url_foto]'>
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
              </div><!-- Fin de row -->
          </div>
          <div id="hibrido" class="col s12">
          
          <img class="responsive-img" src="img/autos/logos/ford.png" width="220" height="150">
          <div class='row'>
              <?php
              ob_start();
               //se inica la conexion de nuevo pero en esta consulta verifica otro tipo de vehiculo
              $sql = "SELECT vehiculos.codigo_vehiculo,nombre_vehiculo, descripcion_vehiculo, url_foto, precio_vehiculo FROM vehiculos, fotos_vehiculos,tipos_fotos WHERE fotos_vehiculos.codigo_vehiculo = vehiculos.codigo_vehiculo AND fotos_vehiculos.codigo_tipo_foto=1 AND tipos_fotos.codigo_tipo_foto= 1 AND vehiculos.codigo_tipo_vehiculo = 4 AND vehiculos.estado_vehiculo =1";
              $data = Database::getRows($sql, null);
              if($data != null)
              {
                foreach ($data as $row) 
                {
                  print("
                    <div class='card hoverable col s12 m6 l4'>
                      <div class='card-image waves-effect waves-block waves-light'>
                        <img class='activator' src='data:image/*;base64,$row[url_foto]'>
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
              </div><!-- Fin de row -->
          </div>
        </div>
   </div>
        <!--Aqui se muestra el pie de pagina-->
        <?php
        include("inc/footer.php");
        ?>
    </body>
</html>