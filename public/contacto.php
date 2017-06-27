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
        <link type="text/css" rel="stylesheet" href="../css/sweetalert2.min.css" media="screen,projection"/>
        <script type="text/javascript" src="../js/sweetalert2.min.js"></script>
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
                    <?php

                    require("../lib/page.php");
                    if(!empty($_POST))
                    {
                        $_POST = Validator::validateForm($_POST);
                        $nombre = $_POST['nombre'];
                        $apellido = $_POST['apellido'];
                        $correo = $_POST['correo'];
                        $mensaje = $_POST['mensaje'];
                    
                        //calculo de fecha
                        $fecha = getdate();
                        $registro = $fecha['year'].'-'.$fecha['mon'].'-'.$fecha['mday'];

                        try 
                        {
                            //validacion de campos
                            if($nombre != "" && $apellido != "")
                            {
                                if($correo != "")
                                {
                                    if($mensaje != "")
                                    {
                                        
                                        $sql = "INSERT INTO contactos(nombre_contacto, apellido_contacto, correo_contacto, mensaje, fecha) VALUES(?, ?, ?, ?, ?)";
                                        $params = array($nombre, $apellido, $correo, $mensaje, $registro);
                                        if(Database::executeRow($sql, $params))
					                    {
                                            Page::showMessage(1, "Mensaje enviado correctamente", "index.php");
                                        } 
                                    }
                                    else
                                    {
                                        throw new Exception("Debe ingresar su mensaje");
                                    }
                                }
                                else
                                {
                                    throw new Exception("Debe ingresar el correo electronico");
                                }
                            }
                            else
                            {
                                throw new Exception("Debe ingresar el nombre y apellido");
                            }
                        }
                        catch (Exception $error)
                        {
                            Page::showMessage(2, $error->getMessage(), null);
                        }
                    } else {
                        $nombre = "";
                        $apellido = "";
                        $correo = "";
                        $mensaje = "";
                    }

                    ?>
                    <div class="col s12 m6">
                        <h5>Comunícate con nosotros</h5>
                        <!--comienza el form-->
                        <!--nombre-->
                        <form method="post">
                            <div class='input-field col s12 m6'>
                                <i class='material-icons prefix'>note_add</i>
                                <input id='nombre' type='text' name='nombre' class='validate' value='<?php print($nombre); ?>' required/>
                                <label for='nombre'>Nombre</label>
                            </div>
                            <div class='input-field col s12 m6'>
                                <i class='material-icons prefix'>description</i>
                                <input id='apellido' type='text' name='apellido' class='validate' value='<?php print($apellido); ?>' required/>
                                <label for='apellido'>Apellido</label>
                            </div>
                            <div class='input-field col s12 m12'>
                                <i class='material-icons prefix'>description</i>
                                <input id='correo' type='email' name='correo' pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" class='validate' value='<?php print($correo); ?>' required/>
                                <label for='correo'>Correo</label>
                            </div>
                            <div class='input-field col s12 m12'>
                                <i class='material-icons prefix'>note_add</i>
                                <textarea id="mensaje" class="materialize-textarea" name='mensaje' class='validate' value='<?php print($mensaje); ?>' required></textarea>
                                <label for='mensaje'>Mensaje</label>
                            </div>
                            <br>
                            <br>
                            <!--botones-->
                            <div class='row center-align'>
                                <a href='index.php' class='btn waves-effect grey'><i class='material-icons right'>cancel</i>Cancelar</a>
                                <button type='submit' class='btn waves-effect blue'><i class="material-icons right">send</i>Enviar</button>
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