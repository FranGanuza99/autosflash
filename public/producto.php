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
              <li class="tab col s3"><a href="#test4">Híbridos y Electricos</a></li>
            </ul>
            <br>
          </div>
          <!--a cada pestaña se le asigna un id  para luego desplazarse en los submenus-->
          <div id="carros" class="col s12">
             <img class="responsive-img" src="img/autos/logos/ford.png" width="220" height="150">
            <div class="row">
              <div class="col s12 m6 l4">
              <!--En las tarjetas se va colacando la descripcion del vehiculo-->
                  <div class="card">
                    <div class="card-image waves-effect waves-block waves-light">
                      <img class="activator" src="img/autos/ford_fiesta/img1.jpg">
                    </div>
                    <div class="card-content">
                      <span class="card-title activator grey-text text-darken-4">Ford Fiesta 2017<i class="material-icons right">more_vert</i></span>
                      <p><a href="descripcion.php">Más información</a></p>
                    </div>
                    <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4">Ford Fiesta 2017<i class="material-icons right">close</i></span>
                 <p>Diversión. Eso es lo que sientes cuando conduces un Fiesta. Su manejo ágil y mayor potencia significan que puedes contar con un vehículo con respuesta. Combínalo con conectividad inteligente a través de SYNC® 327 y la comodidad de asientos delanteros tapizados en cuero con calefacción disponibles. Luego, añade una gran potencia, para que toda la diversión esté en el viaje.</p>
              </div>
            </div>
            <!--En las tarjetas se va colacando la descripcion del vehiculo-->
            <div class="card">
               <div class="card-image waves-effect waves-block waves-light">
                      <img class="activator" src="img/autos/ford_c-max/img1.jpg">
                    </div>
                    <div class="card-content">
                      <span class="card-title activator grey-text text-darken-4">Ford C-MAX 2017<i class="material-icons right">more_vert</i></span>
                      <p><a href="#">Más información</a></p>
                    </div>
                    <div class="card-reveal">
                      <span class="card-title grey-text text-darken-4">Ford C-MAX 2017<i class="material-icons right">close</i></span>
                      <p>El C-MAX Energi Plug-In Hybrid te da la opción de enchufarlo o no para cargarlo. C-MAX Energi combina una batería de iones de litio y un motor eléctrico con otro de gasolina. La posibilidad de enchufarlo te permite cargar el vehículo por completo en aproximadamente 2.5 horas*, usando la opción de carga de 240 voltios para el hogar disponible, o durante la noche, con un práctico cable estándar de 120 voltios. El modo EV te permite elegir solo eléctrico, solo gasolina o una combinación de ambos.</p>
                  </div>
                </div>
              </div>
              <div class="col s12 m6 l4">
              <!--En las tarjetas se va colacando la descripcion del vehiculo-->
                  <div class="card">
                  <div class="card-image waves-effect waves-block waves-light">
                    <img class="activator" src="img/autos/ford_focus/img1.jpg">
                  </div>
                  <div class="card-content">
                    <span class="card-title activator grey-text text-darken-4">Ford Focus<i class="material-icons right">more_vert</i></span>
                    <p><a href="#">Más información</a></p>
                  </div>
                  <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4">Ford Focus<i class="material-icons right">close</i></span>
                    <p>La tecnología del Focus te mantiene informado y conectado. La asistencia activa para estacionar disponible10 te permite estacionar en paralelo manos libres y el Sistema de Detección de Marcha Atrás10 te alerta cuando hay objetos detrás de ti. También ofrece la tecnología activada por voz SYNC® 327 disponible para mantenerte conectado. Y la cámara de marcha atrás y MyKey® vienen estándar. Este es el tipo de características que inspira una sensación de confianza cuando conduces el Ford Focus 2017.</p>
                  </div>
                </div>
                <!--En las tarjetas se va colacando la descripcion del vehiculo-->
                 <div class="card">
                    <div class="card-image waves-effect waves-block waves-light">
                      <img class="activator" src="img/autos/ford_mustang/img1.jpg">
                    </div>
                    <div class="card-content">
                      <span class="card-title activator grey-text text-darken-4">Ford Mustang 2017<i class="material-icons right">more_vert</i></span>
                      <p><a href="#">Más información</a></p>
                    </div>
                    <div class="card-reveal">
                      <span class="card-title grey-text text-darken-4">Ford Mustang 2017<i class="material-icons right">close</i></span>
                      <p>justa tu cinturón. Cada motor produce al menos 300 caballos de fuerza. El motor V6 de 3.7L ofrece hasta 300 c.f. y 280 lb-pie de torsión, es estándar en el modelo V6 Fastback. El motor EcoBoost® de 2.3L produce 310 c.f.* y 320 lb-pie de torsión*, es estándar en los modelos EcoBoost® y EcoBoost Premium. El motor V8 de 5.0L produce 435 c.f.* y 400 lb-pie. de torsión,* es estándar en los modelos GT y GT Premium. Y el motor V8 de 5.2L produce 526 c.f. y 429 lb-pie de torsión, es estándar en el Shelby GT350®.</p>
                  </div>
                </div>
              </div>
              <div class="col s12 m6 l4">
              <!--En las tarjetas se va colacando la descripcion del vehiculo-->
                  <div class="card">
                  <div class="card-image waves-effect waves-block waves-light">
                    <img class="activator" src="img/autos/ford_fusion/img1.jpg">
                  </div>
                  <div class="card-content">
                    <span class="card-title activator grey-text text-darken-4">Ford Fusion<i class="material-icons right">more_vert</i></span>
                    <p><a href="#">Más información</a></p>
                  </div>
                  <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4">Ford Fusion<i class="material-icons right">close</i></span>
                    <p>Los motores EcoBoost disponibles combinan tres tecnologías diferentes: turbocargador, inyección directa y sincronización variable e independiente del árbol de levas doble (Ti-VCT), diseñados para optimizar el desempeño. Nuevo para 2017: La Tecnología de Encendido-Apagado Automático ahora viene estándar con el motor EcoBoost 1.5L. La Tecnología de Encendido-Apagado Automático puede ayudar a reducir el consumo de combustible y a reducir las emisiones mientras conduces en la ciudad. También incluye prácticas paletas de cambio montadas en el volante. Otra novedad para 2017: El potente motor EcoBoost V6 2.7L para el Fusion V6 Sport.</p>
                  </div>
                </div>
                <!--En las tarjetas se va colacando la descripcion del vehiculo-->
                 <div class="card">
                    <div class="card-image waves-effect waves-block waves-light">
                      <img class="activator" src="img/autos/ford_taurus/img1.jpg">
                    </div>
                    <div class="card-content">
                      <span class="card-title activator grey-text text-darken-4">Ford Taurus 2017<i class="material-icons right">more_vert</i></span>
                      <p><a href="#">Más información</a></p>
                    </div>
                    <div class="card-reveal">
                      <span class="card-title grey-text text-darken-4">Ford Taurus 2017<i class="material-icons right">close</i></span>
                      <p>Cuando manejas un Taurus, tus sentidos están agudizados. El interior está fabricado por expertos, los controles están a un solo toque del dedo y el tren motriz es sumamente responsivo. Es un auto diseñado para respetar tu confort y responder a tus necesidades.</p>
                  </div>
                </div>
              </div>
            </div>
    <!--se inicia con el siguiente submenu-->
          </div>
          <div id="suv" class="col s12">
              <img class="responsive-img" src="img/autos/logos/ford.png" width="220" height="150">
            <div class="row">
              <div class="col s12 m6 l4">
              <!--En las tarjetas se va colacando la descripcion del vehiculo-->
                  <div class="card">
                    <div class="card-image waves-effect waves-block waves-light">
                      <img class="activator" src="img/suv/ford_escape/img1.jpg">
                    </div>
                    <div class="card-content">
                      <span class="card-title activator grey-text text-darken-4">Ford Escape 2017<i class="material-icons right">more_vert</i></span>
                      <p><a href="#">This is a link</a></p>
                    </div>
                    <div class="card-reveal">
                      <span class="card-title grey-text text-darken-4">Ford Escape 2017<i class="material-icons right">close</i></span>
                      <p>Here is some more information about this product that is only revealed once clicked on.</p>
                  </div>
                </div>
                <!--En las tarjetas se va colacando la descripcion del vehiculo-->
                 <div class="card">
                    <div class="card-image waves-effect waves-block waves-light">
                      <img class="activator" src="img/suv/ford_transit/img1.jpg">
                    </div>
                    <div class="card-content">
                      <span class="card-title activator grey-text text-darken-4">Ford Transit Connect 2017<i class="material-icons right">more_vert</i></span>
                      <p><a href="#">This is a link</a></p>
                    </div>
                    <div class="card-reveal">
                      <span class="card-title grey-text text-darken-4">Ford Transit Connect 2017<i class="material-icons right">close</i></span>
                      <p>Here is some more information about this product that is only revealed once clicked on.</p>
                  </div>
                </div>
              </div>
              <div class="col s12 m6 l4">
              <!--En las tarjetas se va colacando la descripcion del vehiculo-->
                  <div class="card">
                  <div class="card-image waves-effect waves-block waves-light">
                    <img class="activator" src="img/suv/ford_edge/img1.jpg">
                  </div>
                  <div class="card-content">
                    <span class="card-title activator grey-text text-darken-4">Ford Edge<i class="material-icons right">more_vert</i></span>
                    <p><a href="#">This is a link</a></p>
                  </div>
                  <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4">Ford Edge<i class="material-icons right">close</i></span>
                    <p>Here is some more information about this product that is only revealed once clicked on.</p>
                  </div>
                </div>
                <!--En las tarjetas se va colacando la descripcion del vehiculo-->
                 <div class="card">
                    <div class="card-image waves-effect waves-block waves-light">
                      <img class="activator" src="img/suv/ford_flex/img1.jpg">
                    </div>
                    <div class="card-content">
                      <span class="card-title activator grey-text text-darken-4">Ford Flex 2017<i class="material-icons right">more_vert</i></span>
                      <p><a href="#">This is a link</a></p>
                    </div>
                    <div class="card-reveal">
                      <span class="card-title grey-text text-darken-4">Ford Flex 2017<i class="material-icons right">close</i></span>
                      <p>Here is some more information about this product that is only revealed once clicked on.</p>
                  </div>
                </div>
              </div>
              <div class="col s12 m6 l4">
              <!--En las tarjetas se va colacando la descripcion del vehiculo-->
                  <div class="card">
                  <div class="card-image waves-effect waves-block waves-light">
                    <img class="activator" src="img/suv/ford_explorer/img1.jpg">
                  </div>
                  <div class="card-content">
                    <span class="card-title activator grey-text text-darken-4">Ford Explorer<i class="material-icons right">more_vert</i></span>
                    <p><a href="#">This is a link</a></p>
                  </div>
                  <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4">Ford Explorer<i class="material-icons right">close</i></span>
                    <p>Here is some more information about this product that is only revealed once clicked on.</p>
                  </div>
                </div>
                <!--En las tarjetas se va colacando la descripcion del vehiculo-->
                 <div class="card">
                    <div class="card-image waves-effect waves-block waves-light">
                      <img class="activator" src="img/suv/ford_expedition/img1.jpg">
                    </div>
                    <div class="card-content">
                      <span class="card-title activator grey-text text-darken-4">Ford Expedition 2017<i class="material-icons right">more_vert</i></span>
                      <p><a href="#">This is a link</a></p>
                    </div>
                    <div class="card-reveal">
                      <span class="card-title grey-text text-darken-4">Ford Expedition 2017<i class="material-icons right">close</i></span>
                      <p>Here is some more information about this product that is only revealed once clicked on.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--Se inicia el siguiente submenu-->
          <div id="camion" class="col s12">
          <img class="responsive-img" src="img/autos/logos/ford.png" width="220" height="150">
            <div class="row">
              <div class="col s12 m6 l4">
              <!--En las tarjetas se va colacando la descripcion del vehiculo-->
                  <div class="card">
                    <div class="card-image waves-effect waves-block waves-light">
                      <img class="activator" src="img/camiones/ford_connect/img1.jpg">
                    </div>
                    <div class="card-content">
                      <span class="card-title activator grey-text text-darken-4">Ford Transit Connect 2017<i class="material-icons right">more_vert</i></span>
                      <p><a href="#">This is a link</a></p>
                    </div>
                    <div class="card-reveal">
                      <span class="card-title grey-text text-darken-4">Ford Transit Connect 2017<i class="material-icons right">close</i></span>
                      <p>Here is some more information about this product that is only revealed once clicked on.</p>
                  </div>
                </div>
                <!--En las tarjetas se va colacando la descripcion del vehiculo-->
                 <div class="card">
                    <div class="card-image waves-effect waves-block waves-light">
                      <img class="activator" src="img/camiones/ford_f-150/img1.jpg">
                    </div>
                    <div class="card-content">
                      <span class="card-title activator grey-text text-darken-4">Ford F-150 2017<i class="material-icons right">more_vert</i></span>
                      <p><a href="#">This is a link</a></p>
                    </div>
                    <div class="card-reveal">
                      <span class="card-title grey-text text-darken-4">Ford F-150 2017<i class="material-icons right">close</i></span>
                      <p>Here is some more information about this product that is only revealed once clicked on.</p>
                  </div>
                </div>
              </div>
              <div class="col s12 m6 l4">
              <!--En las tarjetas se va colacando la descripcion del vehiculo-->
                  <div class="card">
                  <div class="card-image waves-effect waves-block waves-light">
                    <img class="activator" src="img/camiones/ford_transit/img1.jpg">
                  </div>
                  <div class="card-content">
                    <span class="card-title activator grey-text text-darken-4">Ford Transit 2017<i class="material-icons right">more_vert</i></span>
                    <p><a href="#">This is a link</a></p>
                  </div>
                  <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4">Ford Transit 2017<i class="material-icons right">close</i></span>
                    <p>Here is some more information about this product that is only revealed once clicked on.</p>
                  </div>
                </div>
              </div>
              <div class="col s12 m6 l4">
              <!--En las tarjetas se va colacando la descripcion del vehiculo-->
                  <div class="card">
                  <div class="card-image waves-effect waves-block waves-light">
                    <img class="activator" src="img/camiones/ford_superduty/img1.jpg">
                  </div>
                  <div class="card-content">
                    <span class="card-title activator grey-text text-darken-4">Ford Superduty<i class="material-icons right">more_vert</i></span>
                    <p><a href="#">This is a link</a></p>
                  </div>
                  <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4">Ford Superduty<i class="material-icons right">close</i></span>
                    <p>Here is some more information about this product that is only revealed once clicked on.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="test4" class="col s12">Test 4</div>
        </div>
   </div>
        <!--Aqui se muestra el pie de pagina-->
        <?php
        include("inc/footer.php");
        ?>
    </body>
</html>