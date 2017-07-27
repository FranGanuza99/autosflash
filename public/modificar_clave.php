<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <!--Import Google Icon Font-->
        <link href="../css/icons.css" rel="stylesheet">
        <title>Modificar contraseña</title>
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
        
        <?php
        //Aqui se muestra el menu
        include("inc/menu.php");
        //Enlaza los archivos necesarios
        
        require("../lib/page.php");
        ob_start();
        //calculo de fecha
        if(isset($_SESSION['id_cliente'])) 
        {
            
            $id = $_SESSION['id_cliente'];
            
            //realiza la consulta y llena las variavles con los datos de la consulta
            $sql = "SELECT * FROM clientes WHERE codigo_cliente = ?";
            $params = array($id);
            $data = Database::getRow($sql, $params);
            $hash = $data['contrasenia'];
            $correo = $data['correo_cliente'];
            
        }
        else{
             Page::showMessage(2, "Inicie sesion", "sesion.php");
        }
        
        //calculo de fecha
        $fecha = getdate();
        $registro = $fecha['year'].'-'.$fecha['mon'].'-'.$fecha['mday'];

        //valida si post esta vacio y asigna variables a los campos
        if(!empty($_POST))
        {
            $_POST = Validator::validateForm($_POST);
            $clave_antigua = $_POST['clave_antigua'];
            $clave1 = $_POST['clave1'];
            $clave2 = $_POST['clave2'];
            try 
            {
                //validacion de clave
                if($clave1 != "" && $clave2 != "")
                {
                    if($clave1 == $clave2)
                    {
                        if (preg_match("/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$@#%&.]).*$/", $clave1))
                        {
                            //Actualiza junto con la contraseña
                            if(password_verify($clave_antigua, $hash)) 
                            {
                                if ($clave_antigua == $clave1)
                                {
                                    throw new Exception("La nueva contraseña es la misma que la anterior");
                                } 
                                else 
                                {
                                    if ($correo != $clave1){
                                        //ingreso de datos de cliente
                                        $clave = password_hash($clave1, PASSWORD_DEFAULT);
                                        //actializa un registro existente
                                        $sql = "UPDATE clientes SET contrasenia = ?, fecha_clave = ? WHERE codigo_cliente = ?";
                                        $params = array($clave, $registro, $id);
                                        if(Database::executeRow($sql, $params))
                                        {
                                            Page::showMessage(1, "Operación satisfactoria", "index.php");
                                        }
                                    } 
                                    else {
                                        throw new Exception("La contraseña debe ser diferente al correo");
                                    }
                                }
                            } 
                            else 
                            {
                                throw new Exception("La contraseña antigua no es correcta");
                            }
                        }
                        else 
                        {
                            throw new Exception("El formato de contraseña incorrecto. La contraseña debe contener por lo menos un número y un caracter especial (Ejemplo: Abcdef1#)");
                        }
                    }
                    else
                    {
                        throw new Exception("Las contraseñas no coinciden");
                    }
                }
                else {
                    throw new Exception("Debe ingresar ambas contraseñas");
                }
                                        
            }
            catch (Exception $error)
            {
                Page::showMessage(2, $error->getMessage(), null);
            }

        }

        ?>
        
        <!--Aqui comienza la pagina-->
        <div class="container">
            <!--primera fila-->
            
                <!--columna del form-->
                <div class="col s12 m12 ">
                    <br>
                    <div class="card-panel">
                        <h3 class="center-txt">Modificar contraseña</h3>
                        <br>
                        
                        <!--inicio del form de registro-->
                        <!--nombre-->
                        <form method='post' enctype='multipart/form-data' autocomplete='off'>
                            <div class="row">
                                <h5>Contraseña antigua</h5>
                                <!--contra-->
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">vpn_key</i>
                                    <input id="clave_antigua" type="password" name="clave_antigua" class="validate"  />
                                    <label for="clave_antigua">Contraseña</label>
                                </div>
                            </div>
                            <div class="row">
                                <h5>Contraseña nueva</h5>
                                <!--contra-->
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">vpn_key</i>
                                    <input id="clave1" type="password" name="clave1" class="validate"  />
                                    <label for="clave1">Contraseña</label>
                                </div>
                                <!--contra2-->
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">replay</i>
                                    <input id="clave2" type="password" name="clave2" class="validate" />
                                    <label for="clave2">Confirmar contraseña</label>
                                </div>

                            </div>
                            <!--botones del form--> 
                            <div class='row center-align'>
                                <button type='submit' class='btn waves-effect'>Actualizar</button>
                                <a href='index.php' class="waves-effect waves-light btn grey">Cancelar</a>
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