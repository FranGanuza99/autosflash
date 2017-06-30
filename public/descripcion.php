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
        <link type="text/css" rel="stylesheet" href="../css/sweetalert2.min.css" media="screen,projection"/>
        <script type="text/javascript" src="../js/sweetalert2.min.js"></script>
    </head>
    <body>
        <!--Aqui se muestra el menu-->
        <?php
        include("inc/menu.php");
        require("../lib/page.php");

        ob_start();
        if(isset($_POST['compra']))
        {
         
            $id_cliente = $_SESSION['id_cliente'];
            $vehiculo = $_GET['id'];
            $fecha = getdate();
            $registro = $fecha['year'].'-'.$fecha['mon'].'-'.$fecha['mday'];
        

            try 
            {
                //validacion de campos
                if($id_cliente != "")
                {
                    if($vehiculo != "")
                    {
                        if($registro != "")
                        {                    
                            $sql = "INSERT INTO reservaciones(codigo_cliente, codigo_vehiculo,fecha_reserva) VALUES(?, ?, ?)";
                            $params = array($id_cliente, $vehiculo, $registro);
                            if(Database::executeRow($sql, $params))
                            {
                                Page::showMessage(1, "Operación satisfactoria", "index.php");
                            }            
                        }
                        else
                        {
                            throw new Exception("Debe ingresar el cliente");
                        }
                    }
                    else
                    {
                        throw new Exception("Debe ingresar el vehiculo");
                    }
                }
                else
                {
                    throw new Exception("Debe ingresar la fecha");
                }
            }
            catch (Exception $error)
            {
                Page::showMessage(2, $error->getMessage(), null);
            }

        } else {
            //setea las variavles a null
            $id_cliente = null;
            $vehiculo = null;
            $registro = null;
        }
                




        ?>
        <?php
        //se inica la coneccion y se realiza una consulta con toda la informacion relaciona al id del vehiculo
              ob_start();
              
              $id = $_GET['id'];
              $data1 = null;
              $sql = "SELECT nombre_vehiculo, precio_vehiculo, descripcion_vehiculo, anio_vehiculo, potencia_vehiculo, manejo_vehiculo,rueda_vehiculo, comodida_vehiculo, apariencia_vehiculo, ventana_vehiculo, general1_vehiculo, general2_vehiculo, general3_vehiculo, foto_general1, foto_general2, foto_general3  FROM vehiculos WHERE codigo_vehiculo = ?";
              $params = array($id);
              $data = Database::getRows($sql, $params);
              if($data != null)
              {
                  foreach ($data as $row1) 
                  {     
                  }
              }
              else
              {
               throw new Exception("Vehiculo no encotrado");
              }
          ?>
        <!--Aqui comienza la pagina-->
        <div class="container">
        <div class="slider">
        <ul class="slides">
         <?php
              ob_start();
              //se inicia nuevamente la conexion pero se le cambia el nombre a la
              $sql2 = "SELECT fotos_vehiculos.url_foto FROM fotos_vehiculos,tipos_fotos WHERE  fotos_vehiculos.codigo_tipo_foto=3 AND tipos_fotos.codigo_tipo_foto= 3 AND fotos_vehiculos.codigo_vehiculo =?";
              $data2 = Database::getRows($sql2, $params);
              ?>
               <?php
               //se cargan las imagenes a partir de la variable data2
             if($data2 != null)
              {
                foreach ($data2 as $row) 
                {
                  print("
                    <li>
                        <img src='data:image/*;base64,$row[url_foto]'alt=''>
                    </li>
                  ");
                }
              }
              else
              {
                print("<div class='card-panel yellow'><i class='material-icons left'>warning</i>No hay registros disponibles en este momento.</div>");
              }
              ?>
              </ul>
            </div>
            <!--Mediante un tab se organiza un submenu para los detalles e imagenes de cada vehiculo-->
            <div class="row">
              <div class="col s12">
                <ul class="tabs tabs-fixed-width">
                  <li class="tab col s3"><a class="active" href="#resumen">Resumen</a></li>
                  <li class="tab col s3"><a href="#especificaciones">Especificaciones</a></li>
                  <li class="tab col s3"><a href="#galeria">Galeria</a></li>
                </ul>
              </div>
              <!--Se crea un div para el submenu-->
              <div id="resumen" class="col s12">
              <div class="row">
              <br>
              <br>
                <div class="col s7 push-s5">
                <div class="right-align">
                 <a  class="waves-effect waves-light btn-large" class="waves-effect waves-light btn" href="#modal1" ><i class="material-icons right">shopping_cart</i>COMPRAR</a>
                </div>
                <!--Se utilizara un modal para mostrar el formulario de compra-->
                <div id="modal1" class="modal">
                  <div class="modal-content">
                    <h4>Compra de Automovil</h4>
                    <?php print("<h5>Monto a Cancelar: $".$row1['precio_vehiculo']."</h5> ");
                   

                    if (isset($_SESSION['nombre_cliente'])){
                        
                        print("
                        <form method='post' enctype='multipart/form-data'>
                        <div class='card-panel yellow'><i class='material-icons left'>warning</i>¿ESTAS SEGURO DE HACER UNA RESERVA PARA LUEGO COMPRARLO? EN CASO DE SER SI, DEBES ACERCARTE A NUESTRA AGENCIA PARA FINALIZAR EL PROCESO</div>
                         <div class='row center-align'>
                            <button type='submit' class='btn waves-effect' name='compra'>Si, estoy seguro</button>
                         </div>
                         </form>   
                            ");
                            
                    } else {
                         print("<div class='card-panel yellow'><i class='material-icons left'>warning</i>Debes iniciar sesion primero</div>");
                    }
                    ?>
                  </div>
                  <div class="modal-footer">
                    <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
                  </div>
                </div>
                <div class="center-align">
                <?php print("<h4>".$row1['nombre_vehiculo']."</h4> ");?>
                </div>
                <h5>PRECIO:</h5>
                <?php print("<h4>Desde: $".$row1['precio_vehiculo']."</h4> ");?>
                <!-- 
                <h5>Modelo:</h5>
                <div class="input-field">
                  <select>
                    <option value="" disabled selected>Seleciona el modelo</option>
                    <option value="1">Fiesta S Sedan</option>
                    <option value="2">Fiesta S Hatch</option>
                    <option value="3">Fiesta SE Sedan</option>
                    <option value="4">Fiesta SE Hatch</option>
                    <option value="5">Fiesta Titanium Sedan</option>
                    <option value="6">Fiesta Titanium Hatch</option>
                    <option value="7">Fiesta ST</option>
                  </select>
                  <label>Materialize Select</label>
                  </div> -->
                </div>
        
                 <?php
              ob_start();
              //consulta foto perfil
              $sql3 = "SELECT fotos_vehiculos.url_foto FROM fotos_vehiculos,tipos_fotos WHERE  fotos_vehiculos.codigo_tipo_foto=1 AND tipos_fotos.codigo_tipo_foto= 1 AND fotos_vehiculos.codigo_vehiculo =?";
              $data3 = Database::getRows($sql3, $params);
              ?>
                <div class="col s5 pull-s7"> 

              <?php
              //se muestran los datos generelas del vehiculo y sus fotos
             if($data3 != null)
             {
                foreach ($data3 as $row) 
                {
                  print("
                    <div>
                        <img class='responsive-img'  src='data:image/*;base64,$row[url_foto]'>
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
              </div>
                <h4>Sabias que.</h4>
                <?php print("<p>".$row1['general1_vehiculo']."</p> ");?>
          
          <?php
            $sql = "SELECT nombre_vehiculo, precio_vehiculo, descripcion_vehiculo, anio_vehiculo, potencia_vehiculo, manejo_vehiculo,rueda_vehiculo, comodida_vehiculo, apariencia_vehiculo, ventana_vehiculo, general1_vehiculo, general2_vehiculo, general3_vehiculo, foto_general1, foto_general2, foto_general3  FROM vehiculos WHERE codigo_vehiculo = ?";
            $data1 = Database::getRows($sql, $params);
              if($data1 != null)
              {
                foreach ($data1 as $row1) 
                {
                  print("
                    <div class='col s12 m12'>
                        <img class='responsive-img' src='data:image/*;base64,$row1[foto_general1]'>
                    
                    </div>
                  ");
                }
              }
              else
              {
                print("<div class='card-panel yellow'><i class='material-icons left'>warning</i>No hay registros disponibles en este momento.</div>");
              }
            ?>
            <hr size="2">
            <br>
            <h4>Datos interesantes</h4>
            <?php print("<p>".$row1['general2_vehiculo']."</p> ");?>
            <?php
             if($data1 != null)
              {
                foreach ($data1 as $row1) 
                {
                  print("
                    <div class='col s12 m12'>
                        <img class='responsive-img' src='data:image/*;base64,$row1[foto_general2]' width='100%' height='20' >
                    
                    </div>
                  ");
                }
              }
              else
              {
                print("<div class='card-panel yellow'><i class='material-icons left'>warning</i>No hay registros disponibles en este momento.</div>");
              }
              ?>
              <h4>Es importante que conozcas todo</h4>
              <hr size="2">
              <br>
              <?php print("<p>".$row1['general3_vehiculo']."</p> ");?>
             <?php
             if($data1 != null)
              {
                foreach ($data1 as $row1) 
                {
                  print("
                    <div class='col s12 m12'>
                        <img class='responsive-img' src='data:image/*;base64,$row1[foto_general3]'>
                    
                    </div>
                  ");
                }
              }
              else
              {
                print("<div class='card-panel yellow'><i class='material-icons left'>warning</i>No hay registros disponibles en este momento.</div>");
              }
              ?>
              <br>
              <hr size="2">
              <br>
              <!--Se crea un formulario de comentarios y calificacion-->
              <?php 
                try {
                  if (isset($_SESSION['id_cliente'])){
                    $cliente = $_SESSION['id_cliente'];
                  } else {
                    $cliente = null;
                    throw new Exception("Debe de iniciar sesion primero");
                    header ("location: sesion.php");
                  }
                } catch (Exception $error){
                  
                }
                
                //calculo de fecha
                $fecha = getdate();
                $registro = $fecha['year'].'-'.$fecha['mon'].'-'.$fecha['mday'];
                if(isset($_POST['mensaje']))
                {
                  $_POST = Validator::validateForm($_POST);
                  $mensaje = $_POST['mensaje'];
                  try 
                  {
                      if ($cliente != "") 
                      {              
                        if ($mensaje != "") 
                        { 
                          $sql = "INSERT INTO comentarios(comentario, codigo_cliente, codigo_vehiculo, estado_comentario, fecha) VALUES(?, ?, ?, 1, ?)";
                          $params2 = array($mensaje, $cliente, $id, $registro);
                          Database::executeRow($sql, $params2);
                          $mensaje = null;
                          $cliente = null;
                          $registro = null;
                        }
                        else 
                        {
                          throw new Exception("Debe de escribir un comentario");
                        }
                      } 
                      else 
                      {
                        throw new Exception("Debe de iniciar sesion primero");
                        header ("location: sesion.php");
                      }
                  } catch (Exception $error) {

                  }
                  
                }

              ?>
              <h5>Escribenos un comentario:</h5>
              <div class="row">
                <form class="col s12" method='post'>
                  <div class="row">
                    <div class="input-field col s8 m6">
                      <i class="material-icons prefix">mode_edit</i>
                      <textarea id="icon_prefix2" name='mensaje' class="materialize-textarea"></textarea>
                      <label for="icon_prefix2">Comentario</label>
                    </div>
                    <div class="input-field col s4 m3">
                      <button type='submit' class='btn waves-effect'><i class="material-icons left">cloud</i>Enviar</button>
                    </div>
                  </div>
                </form>
                <!--<div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments#configurator" data-numposts="5"></div>-->
              </div>

              <div class='row'>
              <div class='col s12 m6'>
              <?php
              $sql6 = "SELECT * FROM clientes, comentarios WHERE  clientes.codigo_cliente = comentarios.codigo_cliente AND comentarios.codigo_vehiculo = ? ORDER BY codigo_comentario desc";
              $data6 = Database::getRows($sql6, $params);
              if($data6 != null)
             {
                foreach ($data6 as $row6) 
                {
                  print("
                      <div class='row card-panel'>
                        <div class='col s3 m3'>
                          <img id='profile' src='data:image/*;base64,".$row6['foto']."' alt='' class='circle responsive-img valign profile-image' width='70'>
                        </div> 
                        <div class='col s9 m9'>
                          <h6><b>".$row6['nombre_cliente']." ".$row6['apellido_cliente']."</b></h6><h6 class='grey-text'><FONT SIZE=2>".$row6['fecha']."</FONT></h6>
                          <p>".$row6['comentario']."</p> 
                        </div>
                      </div>
                  ");
                }
              }
              else
              {
                print("<div class='card-panel  grey lighten-2'><i class='material-icons left'>warning</i>No hay ningun comentario. Se el primero en opinar.</div>");
              }
              ?>
              
              </div>  
              </div>
              <!--Se utiliza los radiobutoms para mostrar el rango de la calificacion-->
              <!-- <p>Calificacion</p>
                <form action="#">
                <p>
                  <input name="group2" type="radio" id="test6" />
                  <label for="test6">1</label>
                </p>
                <p>
                  <input name="group2" type="radio" id="test7" />
                  <label for="test7">2</label>
                </p>
                <p>
                  <input class="with-gap" name="group2" type="radio" id="test8"  />
                  <label for="test8">3</label>
                </p>
               <p>
                  <input class="with-gap" name="group2" type="radio" id="test9"  />
                  <label for="test9">4</label>
                </p>
                <p>
                  <input class="with-gap" name="group2" type="radio" id="test10"  />
                  <label for="test10">5</label>
                </p>
              </form>
              <br>
              <a class="waves-effect waves-light btn"><i class="material-icons left">chat_bubble_outline</i>enviar</a>
              <br>-->
              <!--En una tabla se muestran los comentarios de las personas-->
              <!--<table>
                <thead>
                  <tr>
                      <th data-field="id">Nombre</th>
                      <th data-field="name">Comentario</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Alvin</td>
                    <td>Es un carro capaz de todo y muy durarero</td>
                  </tr>
                  <tr>
                    <td>Alan</td>
                    <td>Mi carro salio con una falla, quisiera saber donde lo puedo llevar para que me cubra la garantia</td>          
                  </tr>
                  <tr>
                    <td>Jonathan</td>
                    <td>Es un excelente servicio!!!!</td>                    
                  </tr>
                </tbody>
              </table>
              <p>Calificacion Promedio: 4.5</p>-->
              </div>
              <div id="especificaciones" class="col s12">
              <h3>Especificaciones</h3>
               <ul class="collapsible" data-collapsible="accordion">
               <!--se cargan los detalles del vehiculo mediante parrafos-->
                  <li>
                    <div class="collapsible-header"><i class="material-icons"></i>Potencia y Manejo</div>
                    <div class="collapsible-body">
                    <h5>Potencia</h5>
                    <?php print("<p>".$row1['potencia_vehiculo']."</p> ");?>
                    
                    <br>
                    <hr size="2">
                    <h5>Manejo</h5>
                    <?php print("<p>".$row1['manejo_vehiculo']."</p> ");?>
                    <br>
                    <hr size="2">
                    <h5>Ruedas y Neumáticos</h5>
                    <?php print("<p>".$row1['rueda_vehiculo']."</p> ");?>
                    </div> 
                  </li>
                  <li>
                    <div class="collapsible-header"><i class="material-icons"></i>Caracteristicas Interiores</div>
                    <div class="collapsible-body">
                    
                    <h5>Comodidad y Conveniencia</h5>
                   <?php print("<p>".$row1['comodida_vehiculo']."</p> ");?>
                    </div>
                  </li>
                  <li>
                    <div class="collapsible-header"><i class="material-icons"></i>Caracteristicas Exteriores</div>
                    <div class="collapsible-body">
                    <h5>Apariencia</h5>
                   <?php print("<p>".$row1['apariencia_vehiculo']."</p> ");?>
                    <br>
                    <hr size="2">
                    <h5>Ventanas y Vidrios</h5>
                    <?php print("<p>".$row1['ventana_vehiculo']."</p> ");?>                  
                    </div>
                  </li>
                </ul>
              </div>
              <div id="galeria" class="col s12">
              <!--Se crea un galeria de fotos-->
               <h5>Galería</h5>
              <!--se manda hacer un select y se inicia la conexion-->
              <?php
              ob_start();
              $sql = "SELECT fotos_vehiculos.url_foto FROM fotos_vehiculos,tipos_fotos WHERE  fotos_vehiculos.codigo_tipo_foto=2 AND tipos_fotos.codigo_tipo_foto= 2 AND fotos_vehiculos.codigo_vehiculo =?";
              $data = Database::getRows($sql, $params);
              ?>
                
              <!-- Fin de row -->
        <!--mediante la herramienta collapsible se muestra de forma organizada los albumes de fotos, adicionalmente se encuentan divididos por las columnas imaginarias-->
        <ul class="collapsible popout" data-collapsible="accordion">
            <li>
                <div class="collapsible-header">Galeria del exterior</div>
                <div class="collapsible-body"><span>
         <div class="row">
             <!--se inicia la organizacion de las fotos-->
            <?php
            //se corre data para mostrar todas las imagenes
             if($data != null)
              {
                foreach ($data as $row) 
                {
                  print("
                    <div class='col s12 m6 l3'>
                        <img class='materialboxed' width='150' height='150' src='data:image/*;base64,$row[url_foto]'>
                    
                    </div>
                  ");
                }
              }
              else
              {
                print("<div class='card-panel yellow'><i class='material-icons left'>warning</i>No hay registros disponibles en este momento.</div>");
              }
              ?>
         </li>
        </ul>
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