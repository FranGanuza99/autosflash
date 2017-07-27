<?php
ob_start();
require("../lib/page.php");
Page::header("Iniciar sesión");

if (isset($_SESSION['nombre_usuario'])){
    header("location: index.php");
} 

//consulta los usuarios
$sql = "SELECT * FROM usuarios";
$data = Database::getRows($sql, null);
if($data == null)
{
    header("location: register.php");
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
                            if (preg_match("/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$@#%&]).*$/", $clave1))
                            {
                                $fecha = getdate();
                                $actual = $fecha['year'].'-'.$fecha['mon'].'-'.$fecha['mday'];
                                $clave = password_hash($clave1, PASSWORD_DEFAULT);
                                $sql = "SELECT * FROM cargos_usuarios, usuarios WHERE usuarios.codigo_cargo = cargos_usuarios.codigo_cargo AND usuarios.codigo_usuario = ?";
                                $params = array($_SESSION['id_usuario']);
                                $data = Database::getRow($sql, $params);
                                $alias = $data['usuario'];
                                if ($alias != $clave1)
                                {
                                    $sql = "UPDATE usuarios SET contrasenia_usuario = ?, fecha_clave = ? WHERE codigo_usuario = ?";
                                    $params = array($clave, $actual, $_SESSION['id_usuario']);
                                    if (Database::executeRow($sql, $params)){
                                        $_SESSION['cargo'] = $data['cargo_usuario'];
                                        $_SESSION['id_usuario'] = $data['codigo_usuario'];
                                        $_SESSION['nombre_usuario'] = $data['nombre_usuario']." ".$data['apellido_usuario'];
                                        $_SESSION['foto_usuario'] = $data['url_foto'];
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
    } else {
        Page::showMessage(2, "Pagina no encontrada", "login.php");
    }
    
} else { 

    //valida si el post esta vacio
    if(!empty($_POST))
    {
        $_POST = validator::validateForm($_POST);
        $alias = $_POST['alias'];
        $clave = $_POST['clave'];
        try
        {
            if($alias != "" && $clave != "")
            {
                //Consulta los registros de usuario
                $sql = "SELECT * FROM cargos_usuarios, usuarios WHERE usuarios.codigo_cargo = cargos_usuarios.codigo_cargo AND usuarios.usuario = ?";
                $params = array($alias);
                $data = Database::getRow($sql, $params);
                if($data != null)
                {
                    if ($data['estado_usuario'] == 1) 
                    {
                        $hash = $data['contrasenia_usuario'];
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
                                //Llenando variables de sesion
                                $_SESSION['cargo'] = $data['cargo_usuario'];
                                $_SESSION['id_usuario'] = $data['codigo_usuario'];
                                $_SESSION['nombre_usuario'] = $data['nombre_usuario']." ".$data['apellido_usuario'];
                                $_SESSION['foto_usuario'] = $data['url_foto'];
                                header("location: index.php");
                            } 
                            else if ($dias >= 90)
                            {  
                                $_SESSION['id_usuario'] = $data['codigo_usuario'];
                                Page::showMessage(2, "Su contraseña ha expirado, haga clic en Aceptar para cambiarla.", "login.php?id=1");
                            }
                        }
                        else 
                        {
                            throw new Exception("La clave ingresada es incorrecta");
                        }
                    }
                    else 
                    {
                        throw new Exception("El usuario se encuentra inactivo");
                    }
                }
                else
                {
                    throw new Exception("El alias ingresado no existe");
                }
            }
            else
            {
                throw new Exception("Debe ingresar un alias y una clave");
            }
        }
        catch (Exception $error)
        {
            Page::showMessage(2, $error->getMessage(), null);
        }
    } 
}

?>
        
<!--primera fila-->
<div class="row">
    <!--columna del login-->
    <div class="col s12 m6 offset-m3">
        <br>
        <div class="card-panel">
        <?php 
        if (isset($_SESSION['id_usuario']) && !empty($_GET['id'])) { 
            print("
            <h3 class='center-align'>Cambiar contraseña</h3>
            <br>
            <!--Inicio del formulario-->
            <form autocomplete='off' method='post'>
                <div class='row'>
                    <div class='input-field col s12'>
                        <i class='material-icons prefix'>security</i>
                        <input id='clave1' type='password' name='clave1' class='validate' required/>
                        <label for='clave1'>Contraseña</label>
                    </div>
                    <div class='input-field col s12'>
                        <i class='material-icons prefix'>security</i>
                        <input id='clave2' type='password' name='clave2' class='validate' required/>
                        <label for='clave2'>Confirmar contraseña</label>
                    </div>
                </div>
                <!--botones-->
                <div class='row'>
                    <div class='center'>
                        <div class='center-sesion'>
                            <button class='btn waves-effect waves-light green' type='submit' name='action'>Iniciar Sesión
                                <i class='material-icons left'>send</i>
                            </button>

                        </div>
                    </div>
                </div>
            </form>
            <br>
            ");
        } else {
            print("
            <h3 class='center-align'>Iniciar Sesión</h3>
            <br>
            <!--Inicio del formulario-->
            <form autocomplete='off' method='post'>
                <div class='row'>
                    <div class='input-field col s12'>
                        <i class='material-icons prefix'>person_pin</i>
                        <input id='alias' type='text' name='alias' class='validate' required/>
                        <label for='alias'>Usuario</label>
                    </div>
                    <div class='input-field col s12'>
                        <i class='material-icons prefix'>security</i>
                        <input id='clave' type='password' name='clave' class='validate' required/>
                        <label for='clave'>Contraseña</label>
                    </div>
                </div>
                <!--botones-->
                <div class='row'>
                    <div class='center'>
                        <div class='center-sesion'>
                            <button class='btn waves-effect waves-light green' type='submit' name='action'>Iniciar Sesión
                                <i class='material-icons left'>send</i>
                            </button>
                            <h6>¿Olvidaste tu contraseña?
                            <a href='recuperar1.php' class='waves-effect waves-light '>Haz clic aqui</a></h6>
                        </div>
                    </div>
                </div>
            </form>
            <br>
            ");
        } 
            ?>
        </div>
    </div>
</div>

<!--Aqui se muestra el pie de pagina-->

<?php
Page::footer();
?>
        