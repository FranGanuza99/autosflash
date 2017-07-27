<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <!--Import Google Icon Font-->
        <link href="../css/icons.css" rel="stylesheet">
        <title>Cambiar contraseña</title>
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
        //Se elanzan archivos necesarios
        require("../lib/page.php");

        //validar sesion
        if(isset($_SESSION['nombre_cliente'])){
            header('location: index.php');
        }

        //calculo de fecha
        $fecha = getdate();
        $registro = $fecha['year'].'-'.$fecha['mon'].'-'.$fecha['mday'];

        if (isset($_SESSION['id_cliente']) && isset($_SESSION['verifiacion']))
        {
            if ($_SESSION['verifiacion'] == 1)
            {
                //valida si el post esta vacio y enlaza las variables con el campo
                if(!empty($_POST))
                {
                    $_POST = validator::validateForm($_POST);
                    $clave1 = $_POST['clave1'];
                    $clave2 = $_POST['clave2'];
                    try 
                    {
                        //validacion de clave
                        if($clave1 != "" && $clave2 != "")
                        {
                            if($clave1 == $clave2)
                            {
                                if (preg_match("/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$@#%&]).*$/", $clave1))
                                {
                                    $sql = "SELECT * FROM clientes WHERE clientes.codigo_cliente = ?";
                                    $params = array($_SESSION['id_cliente']);
                                    $data = Database::getRow($sql, $params);
                                    $correo = $data['correo_cliente'];
                                    if ($correo != $clave1){
                                        //ingreso de datos de cliente
                                        $clave = password_hash($clave1, PASSWORD_DEFAULT);
                                        //actializa un registro existente
                                        $sql = "UPDATE clientes SET contrasenia = ?, fecha_clave = ? WHERE codigo_cliente = ?";
                                        $params = array($clave, $registro, $_SESSION['id_cliente']);
                                        if(Database::executeRow($sql, $params))
                                        {
                                            if ($data != null){
                                                $_SESSION['id_cliente'] = $data['codigo_cliente'];
                                                $_SESSION['nombre_cliente'] = $data['nombre_cliente']." ".$data['apellido_cliente'];
                                                $_SESSION['foto_cliente'] = $data['foto'];
                                                Page::showMessage(1, "Contraseña actualizada correctamente", "index.php");
                                            }
                                            else 
                                            {
                                                throw new Exception("Ocurrio un erro de seguridad.");
                                            }
                                        }
                                    } 
                                    else 
                                    {
                                        throw new Exception("La contraseña no debe coincidir con el correo.");
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
            } else {
                header("location: recuperar2.php");
            }
        }

        ?>
        
        <!--Aqui comienza la pagina-->
        <div class="container">
            <!--primera fila-->
            <div class="row">
                <!--columna del login-->
                <div class="col s12 m6 offset-m3">
                    <br>
                    <div class="card-panel">
                        <h3 class="center-txt">Cambiar contraseña</h3>
                        <br>
                        <!--Inicio del formulario-->
                        <form  method='post' autocomplete='off'>
                            <div class="input-field col s12">
                                <input id="clave1" name="clave1" type="password" class="validate" required/>
                                <label for="clave1">Contraseña:</label>
                            </div>
                            <div class="input-field col s12">
                                <input id="clave2" name="clave2" type="password" class="validate" required/>
                                <label for="clave2">Confirmar contraseña:</label>
                            </div>
                            <!--botones-->
                            <div class="center">
                                <button type='submit' class='btn waves-effect'>Guardar</button>
                                <button type='submit' class='btn waves-effect'>Cancelar</button>
                            </div>
                        </form>
                        <br>
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