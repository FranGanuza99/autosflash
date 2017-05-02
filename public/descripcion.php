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
        <div class="container">
            
            <div class="slider">
              <ul class="slides">
                <li>
                  <img src="img/sliders/ford/img1.png" alt=""> <!-- random image -->
                  <div class="caption center-align">
                    <h3>This is our big Tagline!</h3>
                    <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
                  </div>
                </li>
                <li>
                  <img src="img/sliders/ford/img2.png" alt=""> <!-- random image -->
                  <div class="caption left-align">
                    <h3>Left Aligned Caption</h3>
                    <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
                  </div>
                </li>
                <li>
                  <img src="img/sliders/ford/img3.png" alt=""> <!-- random image -->
                  <div class="caption right-align">
                    <h3>Right Aligned Caption</h3>
                    <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
                  </div>
                </li>
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
                    <h5>Monto a Cancelar $13,600</h5>
                    <!--Se crea un formulario para la compra del vehiculo-->
                     <div class="row">
                      <form class="col s12">
                        <div class="row">
                          <div class="input-field col s6">
                            <input placeholder="Primer Nombre" id="first_name" type="text" class="validate">
                            <label for="first_name">Nombres Completos</label>
                          </div>
                          <div class="input-field col s6">
                            <input id="last_name" type="text" class="validate">
                            <label for="last_name">Segundo Nombre</label>
                          </div>
                           <div class="input-field col s6">
                          <input placeholder="Primer Apellido" id="first_name" type="text" class="validate">
                            <label for="first_name">Apellidos Completos</label>
                          </div>
                          <div class="input-field col s6">
                            <input id="last_name" type="text" class="validate">
                            <label for="last_name">Segundo Apellido</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <input id="password" type="password" class="validate">
                            <label for="password">Contraseña</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <input id="email" type="email" class="validate">
                            <label for="email">Email</label>
                          </div>
                        </div>
                         <div class="row">
                          <div class="input-field col s12">
                            <input id="password" type="password" class="validate">
                            <label for="password">Numero de tarjeta</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <input id="password" type="password" class="validate">
                            <label for="password">Numero de Ping</label>
                          </div>
                        </div>
                        <p>Plazo del credito</p>
                        <p>
                          <input name="group1" type="radio" id="test1" />
                          <label for="test1">18 Meses</label>
                        </p>
                        <p>
                          <input name="group1" type="radio" id="test2" />
                          <label for="test2">24 Meses</label>
                        </p>
                        <p>
                          <input class="with-gap" name="group1" type="radio" id="test3"  />
                          <label for="test3">36 Meses</label>
                        </p>
                      </form>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Comprar</a>
                  </div>
                </div>
                <div class="center-align">
                <h3>FORD FIESTA</h3>
                </div>
                <h5>PRECIO:</h5>
                <h4>Desde $13,600</h4>
                <h5>Modelo:</h5>
                <!--Se crea un combobox para mostrar las versiones de los vehiculos-->
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
                  </div>
                </div>
                <div class="col s5 pull-s7"> 
                <img class="responsive-img" src="img/autos/ford_fiesta/img2.jpg">
                </div>
              </div>
                <h4>Divertido. Por Diseño.</h4>
                <p>Diversión. Eso es lo que sientes cuando conduces un Fiesta. Su manejo ágil y mayor potencia significan que puedes contar con un vehículo con respuesta. Combínalo con conectividad inteligente a través de SYNC® 327 y la comodidad de asientos delanteros tapizados en cuero con calefacción disponibles. Luego, añade una gran potencia, para que toda la diversión esté en el viaje.</p>
              <img class="responsive-img" src="img/autos/ford_fiesta/img3.jpeg">
              <hr size="2">
              <br>
              <h4>Personalizar Fiesta</h4>
              <p>Deja que el Fiesta refleje tu actitud elegante y deportiva. El Paquete de Apariencia SE incluye sistema de entretenimiento y comunicaciones de reconocimiento de voz mejorado SYNC® 3, Radio SiriusXM®, alerón trasero disponible, ruedas de aluminio pintado en Sparkle Silver de 16”, perilla de la palanca de cambios forrada de cuero (con transmisión automática) y mucho más.</p>
              <img class="responsive-img" src="img/autos/ford_fiesta/img4.jpeg">
              <h4>SYNC® 3 con SYNC AppLink®</h4>
              <hr size="2">
              <br>
              <p>Hardware inteligente. Software inteligente. Diseño inteligente.
                SYNC® 3 es nuestra tecnología sensible activada por voz y fácil de usar. Descubre las rápidas reacciones del sistema a tus comandos de voz coloquiales. Experimenta la pantalla táctil con una impresionante respuesta, similar a la de un smartphone. También encontrarás una elegante interfaz fácil de usar que te ayudará a contectarte y controlar tu smartphone. Localiza tus restaurantes favoritos con simple entrada de destino a través de la navegación opcional. SYNC 3 es rápido, inteligente y fácil de usar.</p>
              <img class="responsive-img" src="img/autos/ford_fiesta/img5.jpeg">
              <br>
              <hr size="2">
              <br>
              <!--Se crea un formulario de comentarios y calificacion-->
              <h5>Escribenos un comentario:</h5>
              <div class="row">
                <form class="col s12">
                  <div class="row">
                    <div class="input-field col s6">
                      <i class="material-icons prefix">mode_edit</i>
                      <textarea id="icon_prefix2" class="materialize-textarea"></textarea>
                      <label for="icon_prefix2">Comentario</label>
                    </div>
                  </div>
                </form>
                <div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments#configurator" data-numposts="5"></div>
              </div>
              <!--Se utiliza los radiobutoms para mostrar el rango de la calificacion-->
              <p>Calificacion</p>
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
              <br>
              <!--En una tabla se muestran los comentarios de las personas-->
              <table>
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
              <p>Calificacion Promedio: 4.5</p>
              </div>
              <div id="especificaciones" class="col s12">
              <h3>Especificaciones</h3>
               <ul class="collapsible" data-collapsible="accordion">
               <!--Mediante listas se muestran las especificaciones del vehiculo ademas de collapsibles-->
                  <li>
                    <div class="collapsible-header"><i class="material-icons"></i>Potencia y Manejo</div>
                    <div class="collapsible-body">
                    <h5>Potencia</h5>
                    <ul>
                      <li> -Motor Ti-VCT I-4 de 1.6L</li>
                      <li> -Transmisión manual de cinco velocidades</li>
                    </ul>
                    <h5>Opcional</h5>
                    <ul>
                       <li>-Transmisión Automática PowerShift de 6 Velocidades con SelectShift</li>
                    </ul>
                    <br>
                    <hr size="2">
                    <h5>Manejo</h5>
                    <ul>
                      <li> -Dirección Eléctrica Asistida (EPAS)</li>
                      <li> -Sistema Electrónico de Distribución de la Fuerza de Frenado (EBD)</li>
                      <li> -Sistema de Frenos Antibloqueo (ABS) en las Cuatro Ruedas</li>
                      <li> -Frenos de disco delantero/tambor trasero</li>
                      <li> -Tracción delantera (FWD)</li>
                      <li> -Asistencia de Arranque en Pendiente</li>
                      <li> -Suspensión delantera independiente MacPherson</li>
                      <li> -Suspensión trasera con barra de torsión</li>
                      <li> -Torque Vectoring Control</li>
                    </ul>
                    <br>
                    <hr size="2">
                    <h5>Ruedas y Neumáticos</h5>
                    <ul>
                      <li> -Ruedas de Acero de 15” con Tapas Pintadas en Silver</li>
                      <li> -Rueda de Repuesto de Acero (Mini)</li>
                      <li> -Neumáticos p/ todas las estaciones c/ lateral negro P185/60R15</li>
                    </ul>
                    </div> 
                  </li>
                  <li>
                    <div class="collapsible-header"><i class="material-icons"></i>Caracteristicas Interiores</div>
                    <div class="collapsible-body">
                    <h5>Asientos</h5>
                    <ul>
                      <li> -Asiento con ajuste manual en 4 direcciones para el pasajero delantero</li>
                      <li> -Asiento Trasero con Separación 60/40</li>
                      <li> -Asiento con ajuste manual en 6 direcciones para el conductor</li>
                      <li> -Asientos Delanteros Individuales de Tela con Refuerzos</li>
                      <li> -Apoyacabezas delanteros ajustables en 2 direcciones</li>
                    </ul>
                    <br>
                    <hr size="2">
                    <h5>Sistemas Entretenimiento</h5>
                    <ul>
                      <li> -Estéreo AM/FM/Para Un CD/Capacidad para MP3</li>
                      <li> -SYNC® con SYNC Applink®</li>
                    </ul>
                    <br>
                    <hr size="2">
                    <h5>Comodidad y Conveniencia</h5>
                    <ul>
                      <li> -Tomacorrientes auxiliar delantero de 12 voltios</li>
                      <li> -Adaptador Auxiliar para Entrada de Sonido</li>
                      <li> -Tapetes delanteros alfombrados</li>
                      <li> -Luz de techo central c/ luces de lectura</li>
                      <li> -Espejo retrovisor día/noche</li>
                      <li> -Viseras para conductor y pasajero delantero con espejos cubiertos</li>
                      <li> -Apoyo para pie izquierdo del conductor</li>
                      <li> -Consola delantera central en el piso con dos portavasos delanteros y uno trasero y soporte para teléfono celular</li>
                      <li> -Compartimientos, portavasos e inserciones de tela suave en puertas delanteras</li>
                      <li> -Bolsillo para mapas en el respaldo del asiento del pasajero delantero</li>
                      <li> -Iluminación del grupo de instrumentos Ice Blue®</li>
                      <li> -Guantera y cajuela iluminadas</li>
                      <li> -Limpiaparabrisas delanteros intermitentes con función antigoteo</li>
                      <li> -Aire acondicionado manual con accionamiento electrónico</li>
                      <li> -Volante inclinable/telescópico manual</li>
                    </ul>
                    </div>
                  </li>
                  <li>
                    <div class="collapsible-header"><i class="material-icons"></i>Caracteristicas Exteriores</div>
                    <div class="collapsible-body">
                    <h5>Apariencia</h5>
                    <ul>
                      <li> -Pintura negra</li>
                      <li> -Parrilla superior con barras y bordes cromados</li>
                      <li> -Parrilla inferior Carbon Black</li>
                      <li> -Manijas del Color de la Carrocería</li>
                      <li> -Defensas delanteras y traseras del color de la carrocería</li>
                      <li> -Sistema de Llenado de Combustible sin Tapón Easy Fuel</li>
                      <li> -Faros delanteros halógenos con biseles negros</li>
                      <li> -Faros delanteros halógenos de cuatro haces de caja doble, faros delanteros brillantes con bisel negro y detalles cromados</li>
                      <li> -Espejos Eléctricos del Color de la Carrocería con Espejos de Punto Ciego Integrados</li>
                    </ul>
                    <br>
                    <hr size="2">
                    <h5>Ventanas y Vidrios</h5>
                    <ul>
                      <li> -Parabrisas laminado acústico</li>
                      <li> -Vidrios solares polarizados</li>
                    </ul>                   
                    </div>
                  </li>
                </ul>
        
              </div>
              <div id="galeria" class="col s12">
              <!--Se crea un galeria de fotos-->
               <h5>Galería</h5>
        <!--mediante la herramienta collapsible se muestra de forma organizada los albumes de fotos, adicionalmente se encuentan divididos por las columnas imaginarias-->
        <ul class="collapsible popout" data-collapsible="accordion">
            <li>
                <div class="collapsible-header">Galeria del exterior</div>
                <div class="collapsible-body"><span>
         <div class="row">
             <!--se inicia la organizacion de las fotos-->
            <div class="col s12 m6 l3">
                <img class="materialboxed" width="260" src="img/autos/ford_fiesta/img1.jpg">
                <br>
                <img class="materialboxed" width="260" src="img/autos/ford_fiesta/img2.jpg">
                <br>
                <img class="materialboxed" width="260" src="img/autos/ford_fiesta/img3.jpg">
                <br>
                <img class="materialboxed" width="260" src="img/autos/ford_fiesta/img4.jpg">
                <br>
                <img class="materialboxed" width="260" src="img/autos/ford_fiesta/img5.jpg">         
           </div>
            <div class="col s12 m6 l3">
            <br>
                <img class="materialboxed" width="260" src="img/autos/ford_fiesta/img6.jpg">
                <br>
                <img class="materialboxed" width="260" src="img/autos/ford_fiesta/img7.jpg">
                <br>
                <img class="materialboxed" width="260" src="img/autos/ford_fiesta/img8.jpg">
                <br>
                <img class="materialboxed" width="260" src="img/autos/ford_fiesta/img9.jpg">
                <br>
                <img class="materialboxed" width="260" src="img/autos/ford_fiesta/img10.jpg">            
           </div>
            <div class="col s12 m6 l3">
            <img class="materialboxed" width="260" src="img/autos/ford_fiesta/img11.jpg">
                <br>
                <img class="materialboxed" width="260" src="img/autos/ford_fiesta/img12.jpg">
                <br>
                <img class="materialboxed" width="260" src="img/autos/ford_fiesta/img13.jpg">
                <br>
                <img class="materialboxed" width="260" src="img/autos/ford_fiesta/img14.jpg">
                <br>
                <img class="materialboxed" width="260" src="img/autos/ford_fiesta/img15.jpg">              
           </div>
            <div class="col s12 m6 l3">
              <img class="materialboxed" width="260" src="img/autos/ford_fiesta/img16.jpg">
                <br>
                <img class="materialboxed" width="260" src="img/autos/ford_fiesta/img17.jpg">
                <br>
                <img class="materialboxed" width="260" src="img/autos/ford_fiesta/img18.jpg">
                <br>
                <img class="materialboxed" width="260" src="img/autos/ford_fiesta/img19.jpg">
                <br>
                <img class="materialboxed" width="260" src="img/autos/ford_fiesta/img20.jpg">
            </div>
        </div>     
          </span></div>
            </li>
            <li>
                <div class="collapsible-header">Galeria del interior</div>
                <div class="collapsible-body"><span>
           <div class="row">
           <div class="col s12 m6 l3">
                <img class="materialboxed" width="260" src="img/autos/ford_fiesta/img21.jpg">
                <br>
                <img class="materialboxed" width="260" src="img/autos/ford_fiesta/img22.jpg">
                <br>
                <img class="materialboxed" width="260" src="img/autos/ford_fiesta/img23.jpg">            
           </div>
            <div class="col s12 m6 l3">
            <br>
                <img class="materialboxed" width="260" src="img/autos/ford_fiesta/img24.jpg">
                <br>
                <img class="materialboxed" width="260" src="img/autos/ford_fiesta/img25.jpg">
                <br>
                <img class="materialboxed" width="260" src="img/autos/ford_fiesta/img26.jpg">        
           </div>
            <div class="col s12 m6 l3">
            <img class="materialboxed" width="260" src="img/autos/ford_fiesta/img27.jpg">
                <br>
                <img class="materialboxed" width="260" src="img/autos/ford_fiesta/img28.jpg">
                <br>
                <img class="materialboxed" width="260" src="img/autos/ford_fiesta/img29.jpg">
            
           </div>
            <div class="col s12 m6 l3">
              <img class="materialboxed" width="260" src="img/autos/ford_fiesta/img30.jpg">
                <br>
                <img class="materialboxed" width="260" src="img/autos/ford_fiesta/img31.jpg">
                <br>
                <img class="materialboxed" width="260" src="img/autos/ford_fiesta/img32.jpg">       
            </div>
          </div>     
          </span></div>
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