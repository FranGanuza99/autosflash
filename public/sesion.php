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
    </head>
    <body>

        <!--Aqui se muestra el menu-->
        <?php
        include("inc/menu.php");
        ?>

        <?php
        require("../lib/database.php");
        require("../lib/validator.php");

        if(!empty($_POST))
        {
            $_POST = validator::validateForm($_POST);
            $correo = $_POST['correo'];
            $clave = $_POST['clave'];
            try
            {
                if($correo != "" && $clave != "")
                {
                    $sql = "SELECT * FROM clientes WHERE clientes.correo_cliente = ?";
                    $params = array($correo);
                    $data = Database::getRow($sql, $params);
                    if($data != null)
                    {
                        $hash = $data['contrasenia'];
                        if(password_verify($clave, $hash)) 
                        {
                            //Ponerlos tambien en perfil
                            $_SESSION['id_usuario'] = $data['codigo_cliente'];
                            $_SESSION['nombre_usuario'] = $data['nombre_cliente']." ".$data['apellido_cliente'];
                            $_SESSION['foto_perfil'] = $data['foto'];
                            header("location: index.php");
                        }
                        else 
                        {
                            throw new Exception("La clave ingresada es incorrecta");
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
                //Page::showMessage(2, $error->getMessage(), null);
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
                        <h3 class="center-txt">Iniciar Sesión</h3>
                        <br>
                        <div class="center">
                            <img src = "img/sesion/usuario.png" width="200px">
                        </div>
                        <!--Inicio del formulario-->
                        <form  method='post'>
                            <div class="input-field col s12">
                                <input type="email" id="correo" name="correo" class="validate" required/>
                                <label for="correo" data-error="wrong" data-success="right">Correo eléctronico:</label>
                            </div>
                            <div class="input-field col s12">
                                <input id="clave" name="clave" type="password" class="validate" required/>
                                <label for="clave">Contraseña:</label>
                            </div>
                            
                        
                            <!--botones-->
                            <div class="center">
                                <button type='submit' class='btn waves-effect'>Iniciar Sesion</button>
                                <button type='submit' class='btn waves-effect'>Cancelar</button>
                            </div>
                        </form>
                        <br>
                        <!--redireccion al registro-->
                        <div class="center">
                            <h6>¿No tienes una cuenta? Registrate aquí</h6>
                            <a href="registro.php" class="waves-effect waves-light btn">Registrarse</a>
                        </div>
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