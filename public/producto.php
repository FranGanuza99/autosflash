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
        <script src="../js/code/highcharts.js"></script>
        <script src="../js/code/highcharts-3d.js"></script>
        <script src="../js/code/modules/exporting.js"></script>
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
            <ul class="tabs ">
              <li class="tab col s3 "><a style="color:red" class="active " href="#carros">Carros</a></li>
              <li class="tab col s3"><a style="color:red" href="#suv">SUVs y Crossovers</a></li>
              <li class="tab col s3"><a style="color:red" href="#camion">Camiones y Furgonetas</a></li>
              <li class="tab col s3"><a style="color:red"href="#hibrido">Híbridos y Electricos</a></li>
            </ul>
            <br>
          </div>
                        
          <!--a cada pestaña se le asigna un id  para luego desplazarse en los submenus-->
          <div id="carros" class="col s12">

           <form method='post'>
              <div class='row'>
                <div class='input-field col s6 m4'>
                  <i class='material-icons prefix'>search</i>
                  <input id='buscar' type='text' name='buscar'/>
                  <label for='buscar'>Buscar</label>
                </div>
                <div class='input-field col s6 m4'>
                  <button type='submit' class='btn waves-effect green'><i class='material-icons'>check_circle</i></button> 	
                </div>
              </div>
            </form>
            <div class='row'>

            <?php
            ob_start();
            //se llama la conexion a la base de datos
            require("../lib/database.php");
            require("../lib/zebra.php");
            //se consultan los productos a mostrar
  
              
            if(!empty($_POST))
            {
                $search=trim($_POST['buscar']);
                $sql = "SELECT vehiculos.codigo_vehiculo,nombre_vehiculo, descripcion_vehiculo, url_foto, precio_vehiculo FROM vehiculos, fotos_vehiculos,tipos_fotos WHERE fotos_vehiculos.codigo_vehiculo = vehiculos.codigo_vehiculo AND fotos_vehiculos.codigo_tipo_foto=1 AND tipos_fotos.codigo_tipo_foto= 1 AND vehiculos.codigo_tipo_vehiculo = 1 AND vehiculos.estado_vehiculo =1 AND nombre_vehiculo LIKE ?";
                $params = array("%$search%");       
            }
            else
            {
                $sql = "SELECT vehiculos.codigo_vehiculo,nombre_vehiculo, descripcion_vehiculo, url_foto, precio_vehiculo FROM vehiculos, fotos_vehiculos,tipos_fotos WHERE fotos_vehiculos.codigo_vehiculo = vehiculos.codigo_vehiculo AND fotos_vehiculos.codigo_tipo_foto=1 AND tipos_fotos.codigo_tipo_foto= 1 AND vehiculos.codigo_tipo_vehiculo = 1 AND vehiculos.estado_vehiculo =1";
                $params=null;
            }

            $data = Database::getRows($sql, $params);
            //obtenemos el numero de filas y cantidad maxima
            $num_registros = count($data); 
            $resul_x_pagina = 9; 

            //instanciando la clase y enviando parametros
            $paginacion = new Zebra_Pagination(); 
            $paginacion->records($num_registros); 
            $paginacion->records_per_page($resul_x_pagina);

            //Consulta utilizando limit
            $consulta = $sql.' LIMIT '.(($paginacion->get_page() - 1) * $resul_x_pagina). ',' .$resul_x_pagina;
            //ejecuta la consulta
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

          </div><!-- Fin de row -->
          <?php
          $paginacion->render();

          // grafico sobre ventas de productos -->
          $sql = "SELECT nombre_vehiculo, cantidad_disponible FROM vehiculos WHERE codigo_tipo_vehiculo = ?";
          $params = array(1);
          $data = Database::getRowsNum($sql, $params);
          ?>
          <div id="tipo1" style=""></div>
          <script type="text/javascript">

          // declaracion del grafico
          Highcharts.chart('tipo1', {
              // especificacion del tipo de grafico
              chart: {
                  type: 'column'
              },
              title: {
                  text: 'Cantidad disponible por auto'
              },
              xAxis: {
                  //recorriendo valores de tipo texto e imprendolos
                  categories: [
                      <?php
                          foreach($data as $row){
                              print("'".$row[0]."',");
                          }
                      ?>
                  ],
                  crosshair: true
              },
              // valores a tomar en el eje Y 
              yAxis: {
                  min: 0,
                  title: {
                      text: 'Cantidad de reservas'
                  }
              },
              //muestrando los valores del punto y el nombre de la serie
              tooltip: {
                  headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                  pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                      '<td style="padding:0"><b>{point.y:.1f} reservas</b></td></tr>',
                  footerFormat: '</table>',
                  shared: true,
                  useHTML: true
              },
              //configuración para cada tipo de serie.
              plotOptions: {
                  column: {
                      pointPadding: 0.2,
                      borderWidth: 0
                  }
              },
              //especificando las series y los datos de cada una
              series: [{
                  name: 'Reservas',
                  color: '#F7A35C',
                  data: [
                      <?php 
                          foreach ($data as $row){
                              print($row[1].",");
                          }
                      ?>
                  ]

              }]
          });
          </script>

        <!--se inicia con el siguiente submenu-->
        </div>
        <div id="suv" class="col s12">
            
          <form method='post'>
            <div class='row'>
              <div class='input-field col s6 m4'>
                <i class='material-icons prefix'>search</i>
                <input id='buscar' type='text' name='buscar'/>
                <label for='buscar'>Buscar</label>
              </div>
              <div class='input-field col s6 m4'>
                <button type='submit' class='btn waves-effect green'><i class='material-icons'>check_circle</i></button> 	
              </div>
            </div>
          </form>
          <div class='row'>
          <?php
          ob_start();
          //se consultan los productos a mostrar
  
              
          if(!empty($_POST))
          {
            $search=trim($_POST['buscar']);
            $sql = "SELECT vehiculos.codigo_vehiculo,nombre_vehiculo, descripcion_vehiculo, url_foto, precio_vehiculo FROM vehiculos, fotos_vehiculos,tipos_fotos WHERE fotos_vehiculos.codigo_vehiculo = vehiculos.codigo_vehiculo AND fotos_vehiculos.codigo_tipo_foto=1 AND tipos_fotos.codigo_tipo_foto= 1 AND vehiculos.codigo_tipo_vehiculo = 2 AND vehiculos.estado_vehiculo =1 AND nombre_vehiculo LIKE ?";
            $params = array("%$search%");       
          }
          else
          {
            $sql = "SELECT vehiculos.codigo_vehiculo,nombre_vehiculo, descripcion_vehiculo, url_foto, precio_vehiculo FROM vehiculos, fotos_vehiculos,tipos_fotos WHERE fotos_vehiculos.codigo_vehiculo = vehiculos.codigo_vehiculo AND fotos_vehiculos.codigo_tipo_foto=1 AND tipos_fotos.codigo_tipo_foto= 1 AND vehiculos.codigo_tipo_vehiculo = 2 AND vehiculos.estado_vehiculo =1";
            $params=null;
          }
          $data = Database::getRows($sql, $params);

          //obtenemos el numero de filas y cantidad maxima
          $num_registros = count($data); 
          $resul_x_pagina = 9; 

          //instanciando la clase y enviando parametros
          $paginacion = new Zebra_Pagination(); 
          $paginacion->records($num_registros); 
          $paginacion->records_per_page($resul_x_pagina);

          //Consulta utilizando limit
          $consulta = $sql.' LIMIT '.(($paginacion->get_page() - 1) * $resul_x_pagina). ',' .$resul_x_pagina;
          //ejecuta la consulta
          $data = Database::getRows($consulta, $params);

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
          <?php
          $paginacion->render();

          // grafico sobre ventas de productos -->
          $sql = "SELECT nombre_vehiculo, cantidad_disponible FROM vehiculos WHERE codigo_tipo_vehiculo = ?";
          $params = array(2);
          $data = Database::getRowsNum($sql, $params);
          ?>
          <div id="tipo2" style=""></div>
          <script type="text/javascript">

          // declaracion del grafico
          Highcharts.chart('tipo2', {
              // especificacion del tipo de grafico
              chart: {
                  type: 'column'
              },
              title: {
                  text: 'Cantidad disponible por auto'
              },
              xAxis: {
                  //recorriendo valores de tipo texto e imprendolos
                  categories: [
                      <?php
                          foreach($data as $row){
                              print("'".$row[0]."',");
                          }
                      ?>
                  ],
                  crosshair: true
              },
              // valores a tomar en el eje Y 
              yAxis: {
                  min: 0,
                  title: {
                      text: 'Cantidad de reservas'
                  }
              },
              //muestrando los valores del punto y el nombre de la serie
              tooltip: {
                  headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                  pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                      '<td style="padding:0"><b>{point.y:.1f} reservas</b></td></tr>',
                  footerFormat: '</table>',
                  shared: true,
                  useHTML: true
              },
              //configuración para cada tipo de serie.
              plotOptions: {
                  column: {
                      pointPadding: 0.2,
                      borderWidth: 0
                  }
              },
              //especificando las series y los datos de cada una
              series: [{
                  name: 'Reservas',
                  color: '#F7A35C',
                  data: [
                      <?php 
                          foreach ($data as $row){
                              print($row[1].",");
                          }
                      ?>
                  ]

              }]
          });
          </script>
        </div>
        <!--Se inicia el siguiente submenu-->
        <div id="camion" class="col s12">
        <form method='post'>
          <div class='row'>
            <div class='input-field col s6 m4'>
              <i class='material-icons prefix'>search</i>
              <input id='buscar' type='text' name='buscar'/>
              <label for='buscar'>Buscar</label>
            </div>
            <div class='input-field col s6 m4'>
              <button type='submit' class='btn waves-effect green'><i class='material-icons'>check_circle</i></button> 	
            </div>
          </div>
        </form>

        <div class='row'>
        <?php
        ob_start();
        //se consultan los productos a mostrar    
        if(!empty($_POST))
        {
          $search=trim($_POST['buscar']);
          $sql = "SELECT vehiculos.codigo_vehiculo,nombre_vehiculo, descripcion_vehiculo, url_foto, precio_vehiculo FROM vehiculos, fotos_vehiculos,tipos_fotos WHERE fotos_vehiculos.codigo_vehiculo = vehiculos.codigo_vehiculo AND fotos_vehiculos.codigo_tipo_foto=1 AND tipos_fotos.codigo_tipo_foto= 1 AND vehiculos.codigo_tipo_vehiculo = 3 AND vehiculos.estado_vehiculo =1 AND nombre_vehiculo LIKE ?";
          $params = array("%$search%");       
        }
        else
        {
          $sql = "SELECT vehiculos.codigo_vehiculo,nombre_vehiculo, descripcion_vehiculo, url_foto, precio_vehiculo FROM vehiculos, fotos_vehiculos,tipos_fotos WHERE fotos_vehiculos.codigo_vehiculo = vehiculos.codigo_vehiculo AND fotos_vehiculos.codigo_tipo_foto=1 AND tipos_fotos.codigo_tipo_foto= 1 AND vehiculos.codigo_tipo_vehiculo = 3 AND vehiculos.estado_vehiculo =1";
          $params=null;
        }
        $data = Database::getRows($sql, $params);

        //obtenemos el numero de filas y cantidad maxima
        $num_registros = count($data); 
        $resul_x_pagina = 9; 

        //instanciando la clase y enviando parametros
        $paginacion = new Zebra_Pagination(); 
        $paginacion->records($num_registros); 
        $paginacion->records_per_page($resul_x_pagina);

        //Consulta utilizando limit
        $consulta = $sql.' LIMIT '.(($paginacion->get_page() - 1) * $resul_x_pagina). ',' .$resul_x_pagina;
        //ejecuta la consulta
        $data = Database::getRows($consulta, $params);

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
      <?php
      $paginacion->render();
      // grafico sobre ventas de productos -->
          $sql = "SELECT nombre_vehiculo, cantidad_disponible FROM vehiculos WHERE codigo_tipo_vehiculo = ?";
          $params = array(3);
          $data = Database::getRowsNum($sql, $params);
          ?>
          <div id="tipo3" style=""></div>
          <script type="text/javascript">

          // declaracion del grafico
          Highcharts.chart('tipo3', {
              // especificacion del tipo de grafico
              chart: {
                  type: 'column'
              },
              title: {
                  text: 'Cantidad disponible por auto'
              },
              xAxis: {
                  //recorriendo valores de tipo texto e imprendolos
                  categories: [
                      <?php
                          foreach($data as $row){
                              print("'".$row[0]."',");
                          }
                      ?>
                  ],
                  crosshair: true
              },
              // valores a tomar en el eje Y 
              yAxis: {
                  min: 0,
                  title: {
                      text: 'Cantidad de reservas'
                  }
              },
              //muestrando los valores del punto y el nombre de la serie
              tooltip: {
                  headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                  pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                      '<td style="padding:0"><b>{point.y:.1f} reservas</b></td></tr>',
                  footerFormat: '</table>',
                  shared: true,
                  useHTML: true
              },
              //configuración para cada tipo de serie.
              plotOptions: {
                  column: {
                      pointPadding: 0.2,
                      borderWidth: 0
                  }
              },
              //especificando las series y los datos de cada una
              series: [{
                  name: 'Reservas',
                  color: '#F7A35C',
                  data: [
                      <?php 
                          foreach ($data as $row){
                              print($row[1].",");
                          }
                      ?>
                  ]

              }]
          });
          </script>
    </div>
  
    <div id="hibrido" class="col s12">
            
      <form method='post'>
        <div class='row'>
          <div class='input-field col s6 m4'>
            <i class='material-icons prefix'>search</i>
            <input id='buscar' type='text' name='buscar'/>
            <label for='buscar'>Buscar</label>
          </div>
          <div class='input-field col s6 m4'>
            <button type='submit' class='btn waves-effect green'><i class='material-icons'>check_circle</i></button> 	
          </div>
        </div>
      </form>

      <div class='row'>
      <?php
      ob_start();
      //se llama la conexion a la base de datos
      //se consultan los productos a mostrar
    
            
      if(!empty($_POST))
      {
        $search=trim($_POST['buscar']);
        $sql = "SELECT vehiculos.codigo_vehiculo,nombre_vehiculo, descripcion_vehiculo, url_foto, precio_vehiculo FROM vehiculos, fotos_vehiculos,tipos_fotos WHERE fotos_vehiculos.codigo_vehiculo = vehiculos.codigo_vehiculo AND fotos_vehiculos.codigo_tipo_foto=1 AND tipos_fotos.codigo_tipo_foto= 1 AND vehiculos.codigo_tipo_vehiculo = 4 AND vehiculos.estado_vehiculo =1 AND nombre_vehiculo LIKE ?";
        $params = array("%$search%");       
      }
      else
      {
        $sql = "SELECT vehiculos.codigo_vehiculo,nombre_vehiculo, descripcion_vehiculo, url_foto, precio_vehiculo FROM vehiculos, fotos_vehiculos,tipos_fotos WHERE fotos_vehiculos.codigo_vehiculo = vehiculos.codigo_vehiculo AND fotos_vehiculos.codigo_tipo_foto=1 AND tipos_fotos.codigo_tipo_foto= 1 AND vehiculos.codigo_tipo_vehiculo = 4 AND vehiculos.estado_vehiculo =1";
        $params=null;
      }
      $data = Database::getRows($sql, $params);

      //obtenemos el numero de filas y cantidad maxima
      $num_registros = count($data); 
      $resul_x_pagina = 9; 

      //instanciando la clase y enviando parametros
      $paginacion = new Zebra_Pagination(); 
      $paginacion->records($num_registros); 
      $paginacion->records_per_page($resul_x_pagina);

      //Consulta utilizando limit
      $consulta = $sql.' LIMIT '.(($paginacion->get_page() - 1) * $resul_x_pagina). ',' .$resul_x_pagina;
      //ejecuta la consulta
      $data = Database::getRows($consulta, $params);

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
      
      <?php
      $paginacion->render();
      // grafico sobre ventas de productos -->
          $sql = "SELECT nombre_vehiculo, cantidad_disponible FROM vehiculos WHERE codigo_tipo_vehiculo = ?";
          $params = array(4);
          $data = Database::getRowsNum($sql, $params);
          ?>
          <div id="tipo4" style=""></div>
          <script type="text/javascript">

          // declaracion del grafico
          Highcharts.chart('tipo4', {
              // especificacion del tipo de grafico
              chart: {
                  type: 'column'
              },
              title: {
                  text: 'Cantidad disponible por auto'
              },
              xAxis: {
                  //recorriendo valores de tipo texto e imprendolos
                  categories: [
                      <?php
                          foreach($data as $row){
                              print("'".$row[0]."',");
                          }
                      ?>
                  ],
                  crosshair: true
              },
              // valores a tomar en el eje Y 
              yAxis: {
                  min: 0,
                  title: {
                      text: 'Cantidad de reservas'
                  }
              },
              //muestrando los valores del punto y el nombre de la serie
              tooltip: {
                  headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                  pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                      '<td style="padding:0"><b>{point.y:.1f} reservas</b></td></tr>',
                  footerFormat: '</table>',
                  shared: true,
                  useHTML: true
              },
              //configuración para cada tipo de serie.
              plotOptions: {
                  column: {
                      pointPadding: 0.2,
                      borderWidth: 0
                  }
              },
              //especificando las series y los datos de cada una
              series: [{
                  name: 'Reservas',
                  color: '#F7A35C',
                  data: [
                      <?php 
                          foreach ($data as $row){
                              print($row[1].",");
                          }
                      ?>
                  ]

              }]
          });
          </script>

    </div>
  </div>
</div>

<!--Aqui se muestra el pie de pagina-->
<?php
include("inc/footer.php");
?>
</body>
</html>