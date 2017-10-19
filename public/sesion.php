<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <!--Import Google Icon Font-->
        <link href="../css/icons.css" rel="stylesheet">
        <title>Iniciar Sesión</title>
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
        ob_start();
        //Aqui se muestra el menu
        include("inc/menu.php");
        //Se elanzan archivos necesarios
        require("../lib/page.php");
        

        //validar inicio de sesion
        if(isset($_SESSION['nombre_cliente'])){
            header('location: index.php');
        }

        if (isset($_SESSION['id_usuario']) && !empty($_GET['id'])) 
        {
            if ($_GET['id'] == 1)
            {
                if(!empty($_POST))
                {
                    $_POST = validator::validateForm($_POST);
                    $clave1 = $_POST['clave1'];
                    $clave2 = $_POST['clave2'];
                    try
                    {
                        if($clave1 != "")
                        {
                            if($clave2 != "")
                            {
                                if($clave1 == $clave2)
                                {
                                    if (preg_match("/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$@#%&.]).*$/", $clave1))
                                    {
                                        $sql = "SELECT * FROM clientes WHERE clientes.codigo_cliente = ?";
                                        $params = array($_SESSION['id_cliente']);
                                        $data = Database::getRow($sql, $params);
                                        $correo = $data['correo_cliente'];
                                        if ($correo != $clave1){
                                            $fecha = getdate();
                                            $actual = $fecha['year'].'-'.$fecha['mon'].'-'.$fecha['mday'];
                                            $clave = password_hash($clave1, PASSWORD_DEFAULT);
                                            $sql = "UPDATE clientes SET contrasenia = ?, fecha_clave = ? WHERE codigo_cliente = ?";
                                            $params = array($clave, $actual, $_SESSION['id_cliente']);
                                            if (Database::executeRow($sql, $params)){
                                            
                                                //Asigna el valor a las variables de sesion
                                                $_SESSION['id_cliente'] = $data['codigo_cliente'];
                                                $_SESSION['nombre_cliente'] = $data['nombre_cliente']." ".$data['apellido_cliente'];
                                                $_SESSION['foto_cliente'] = $data['foto'];
                                                Page::showMessage(1, "Operación satisfactoria", "index.php"); 
                                            }
                                        } 
                                        else 
                                        {
                                            throw new Exception("La contraseña no se puede procesar, intente ingresando una diferente.");
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
                            else
                            {
                                throw new Exception("Ingrese nuevamente su nueva contraseña en el campo 'Confirmar contraseña'");
                            }
                        }
                        else
                        {
                            throw new Exception("Ingrese su nueva contraseña");
                        }
                    }
                    catch (Exception $error)
                    {
                        Page::showMessage(2, $error->getMessage(), null);
                    }
                }
            }
            else 
            {
                Page::showMessage(2, "Pagina no encontrada", "login.php");
            }
        } 
        else 
        {
            //valida si el post esta vacio y enlaza las variables con el campo
            if(!empty($_POST))
            {
                $_POST = validator::validateForm($_POST);
                $correo = $_POST['correo'];
                $clave = $_POST['clave'];
                $registro = date("Y-m-d");
                try
                {
                    //valida campos
                    if($correo != "" && $clave != "")
                    {
                        //consulta al cliente ingresado
                        $sql = "SELECT * FROM clientes WHERE clientes.correo_cliente = ?";
                        $params = array($correo);
                        $data = Database::getRow($sql, $params);
                        if($data != null)
                        {
                            if ($data['estado_cliente'] == 1)
                            {
                                if ($data['fecha_bloqueo'] == null)
                                {

                                    $hash = $data['contrasenia'];
                                    if(password_verify($clave, $hash)) 
                                    {
                                        $fecha = $data['fecha_clave'];

                                        $fecha_actual = getdate();
                                        $now = $fecha_actual['year'].'-'.$fecha_actual['mon'].'-'.$fecha_actual['mday'];

                                        $datetime1 = new DateTime($fecha);
                                        $datetime2 = new DateTime($now);
                                        $interval = $datetime1->diff($datetime2);
                                        $dias = $interval->format('%a');

                                        if ($dias >= 0 && $dias <= 89)
                                        {
                                            //Asigna el valor a las variables de sesion
                                            $_SESSION['id_cliente'] = $data['codigo_cliente'];
                                            $_SESSION['nombre_cliente'] = $data['nombre_cliente']." ".$data['apellido_cliente'];
                                            $_SESSION['foto_cliente'] = $data['foto'];
                                            header("location: index.php");
                                        } 
                                        else if ($dias >= 90)
                                        {  
                                            $_SESSION['id_cliente'] = $data['codigo_cliente'];
                                            Page::showMessage(2, "Su contraseña ha expirado, haga clic en Aceptar para cambiarla.", "sesion.php?id=1");
                                        }
                                    }
                                    else 
                                    {
                                        
                                        $sql = "SELECT intento FROM clientes WHERE clientes.correo_cliente = ?";
                                        $params = array($correo);
                                        $data = Database::getRow($sql, $params);
                                        $intento= $data['intento'];
                                        if($intento == 0)
                                        {
                                            $sql = "UPDATE clientes SET intento = 1 WHERE clientes.correo_cliente = ?";
                                            $params = array($correo);
                                            Database::executeRow($sql, $params);
                                            throw new Exception("La clave ingresada es incorrecta, intento fallido 1");
                                        }
                                        else if($intento == 1)
                                        {
                                            $sql = "UPDATE clientes SET intento = 2 WHERE clientes.correo_cliente = ?";
                                            $params = array($correo);
                                            Database::executeRow($sql, $params);
                                            throw new Exception("La clave ingresada es incorrecta, intento fallido 2");
                                        }
                                        else if($intento == 2)
                                        {
                                            $sql = "UPDATE clientes SET intento = 3 WHERE clientes.correo_cliente = ?";
                                            $params = array($correo);
                                            Database::executeRow($sql, $params);
                                            $sql = "UPDATE clientes SET fecha_bloqueo = ? WHERE clientes.correo_cliente = ?";
                                            $params = array($registro, $correo);
                                            Database::executeRow($sql, $params);
                                            throw new Exception("Intento fallido 3, Su cuenta ha sido bloqueada por 24 horas, intente dentro de unas horas");
                                        }
                                    }
                                }    
                                else 
                                {
                                    $fecha_base = $data['fecha_bloqueo'];
                                    $datetime1= new DateTime($registro);
                                    $datetime2= new DateTime($fecha_base);
                                    $interval = $datetime1->diff($datetime2) ;
                                    $resultado=$interval->format('%a');
                                    if($resultado >=1)
                                    {
                                        Page::showMessage(2, "Su cuenta sigue bloquedad porfavor intente mas tarde", null);
                                    }
                                    else
                                    {
                                        $sql = "UPDATE clientes SET intento = 0 WHERE clientes.correo_cliente = ?";
                                        $params = array($correo);
                                        Database::executeRow($sql, $params);
                                        $sql = "UPDATE clientes SET fecha_bloqueo = NULL WHERE clientes.correo_cliente = ?";
                                        $params = array($correo);
                                        Database::executeRow($sql, $params);
                                        $hash = $data['contrasenia'];
                                        if(password_verify($clave, $hash)) 
                                        {
                                            //Asigna el valor a las variables de sesion
                                            $_SESSION['id_cliente'] = $data['codigo_cliente'];
                                            $_SESSION['nombre_cliente'] = $data['nombre_cliente']." ".$data['apellido_cliente'];
                                            $_SESSION['foto_cliente'] = $data['foto'];
                                            header("location: index.php");
                                        }
                                        else 
                                        {
                                            $sql = "SELECT intento FROM clientes WHERE clientes.correo_cliente = ?";
                                            $params = array($correo);
                                            $data = Database::getRow($sql, $params);
                                            $intento= $data['intento'];
                                            if($intento == 0)
                                            {
                                                $sql = "UPDATE clientes SET intento = 1 WHERE clientes.correo_cliente = ?";
                                                $params = array($correo);
                                                Database::executeRow($sql, $params);
                                                throw new Exception("La clave ingresada es incorrecta, intento fallido 1");
                                            }
                                            else if($intento == 1)
                                            {
                                                $sql = "UPDATE clientes SET intento = 2 WHERE clientes.correo_cliente = ?";
                                                $params = array($correo);
                                                Database::executeRow($sql, $params);
                                                throw new Exception("La clave ingresada es incorrecta, intento fallido 2");
                                            }
                                            else if($intento == 2)
                                            {
                                                $sql = "UPDATE clientes SET intento = 3 WHERE clientes.correo_cliente = ?";
                                                $params = array($correo);
                                                Database::executeRow($sql, $params);
                                                $sql = "UPDATE clientes SET fecha_bloqueo = ? WHERE clientes.correo_cliente = ?";
                                                $params = array($nuevafecha, $correo);
                                                Database::executeRow($sql, $params);
                                                throw new Exception("Intento fallido 3, Su cuenta ha sido bloqueada por 24 horas, intente dentro de unas horas");
                                            }
                                        }
                                    }    
                                } 
                            } 
                            else 
                            {
                                throw new Exception("El cliente se encuentra en estado inactivo");
                            }
                        }
                        else
                        {
                            throw new Exception("El correo ingresado no existe");
                        }
                    }
                    else
                    {
                        throw new Exception("Debe ingresar un correo y una clave");
                    }
                }
                catch (Exception $error)
                {
                    Page::showMessage(2, $error->getMessage(), null);
                }
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
                        
                        <!--Inicio del formulario-->
                        <?php 
                        if (isset($_SESSION['id_usuario']) && !empty($_GET['id'])) 
                        {
                            print("
                                <h3 class='center-txt'>Cambiar contraseña</h3>
                                <br>
                                <form  method='post' autocomplete='off'>
                                    <div class='input-field col s12'>
                                        <input id='clave1' name='clave1' type='password' class='validate' required/>
                                        <label for='clave1'>Contraseña:</label>
                                    </div>
                                    <div class='input-field col s12'>
                                        <input id='clave2' name='clave2' type='password' class='validate' required/>
                                        <label for='clave2'>Confirmar contraseña:</label>
                                    </div>
                                    
                                
                                    <!--botones-->
                                    <div class='center'>
                                        <button type='submit' class='btn waves-effect'>Cambiar contraseña</button>
                                        <button type='submit' class='btn waves-effect'>Cancelar</button>
                                    </div>
                                    <br>
                                </form>
                            ");
                        }
                        else 
                        {
                            print("
                                <h3 class='center-txt'>Iniciar Sesión</h3>
                                <br>
                                <div class='center'>
                                    <img src = 'img/sesion/usuario.png' width='200px'>
                                </div>
                                <form  method='post' autocomplete='off'>
                                    <div class='input-field col s12'>
                                        <input type='email' id='correo' name='correo' class='validate' required/>
                                        <label for='correo'>Correo eléctronico:</label>
                                    </div>
                                    <div class='input-field col s12'>
                                        <input id='clave' name='clave' type='password' class='validate' required/>
                                        <label for='clave'>Contraseña:</label>
                                    </div>
                                    
                                
                                    <!--botones-->
                                    <div class='row'>
                                        <div class='center'>
                                            <button type='submit' class='btn waves-effect'>Iniciar Sesion</button>
                                            <button href='../index.php' class='btn waves-effect'>Cancelar</button>
                                            <h6>¿Olvidaste tu contraseña?
                                        <a href='recuperar1.php' class='waves-effect waves-light '>Haz clic aqui</a></h6>
                                        </div>
                                    </div>
                                    <br>
                                </form>

                                <div class='center'>
                                    <h6>¿No tienes una cuenta? Registrate aquí</h6>
                                    <a href='registro.php' class='waves-effect waves-light btn'>Registrarse</a>
                                </div>
                            ");
                        }
                        ?>
                        
                        
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