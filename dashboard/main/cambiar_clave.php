<?php
require("../lib/page.php");
Page::header("Cambiar contraseña");

//inicializo la variables
$sql = "SELECT * FROM usuarios WHERE codigo_usuario = ?";
$params = array($_SESSION['id_usuario']);
$data = Database::getRow($sql, $params);
$hash = $data['contrasenia_usuario'];

$fecha = getdate();
$actual = $fecha['year'].'-'.$fecha['mon'].'-'.$fecha['mday'];

//valida si post esta vacio
if(!empty($_POST)) {
    $_POST = Validator::validateForm($_POST);
    //emlaza la variable con el campo
    $clave_antigua = $_POST['clave_antigua'];
    $clave1 = $_POST['clave1'];
    $clave2 = $_POST['clave2'];
    try 
    {
        //validacion de contrasenas
        if ($clave_antigua != "")
        {
            if($clave1 != "")
            {
                if($clave2 != "")
                {
                    if($clave1 == $clave2)
                    {
                        if (preg_match("/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$@#%&]).*$/", $clave1))
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
                                    $sql = "SELECT * FROM cargos_usuarios, usuarios WHERE usuarios.codigo_cargo = cargos_usuarios.codigo_cargo AND usuarios.codigo_usuario = ?";
                                    $params = array($_SESSION['id_usuario']);
                                    $data = Database::getRow($sql, $params);
                                    $alias = $data['usuario'];
                                    if ($alias != $clave1)
                                    {
                                        $clave = password_hash($clave1, PASSWORD_DEFAULT);
                                        $sql = "UPDATE usuarios SET contrasenia_usuario = ?, fecha_clave = ? WHERE codigo_usuario = ?";
                                        $params = array($clave, $actual, $_SESSION['id_usuario']);
                                        if (Database::executeRow($sql, $params)){
                                            Page::showMessage(1, "Operación satisfactoria", "../index.php");
                                        }
                                    }
                                    else 
                                    {
                                        throw new Exception("La contraseña no se puede procesar, intente ingresando una diferente.");
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
        else 
        {
            throw new Exception("Debe escribir su contraseña antigua");
        }
    }
    catch (Exception $error)
    {
        Page::showMessage(2, $error->getMessage(), null);
    }
} 
?>
    <!--inicia el formulario-->
        <form method='post' enctype='multipart/form-data' autocomplete='off'>
            <div class='row'>
                <h5>Contraseña antigua</h5>
                <div class='input-field col s12 m6'>
                    <i class='material-icons prefix'>security</i>
                    <input id='clave_antigua' type='password' name='clave_antigua' class='validate'/>
                    <label for='clave_antigua'>Contraseña</label>
                </div>
            </div>
            <div class="row">
                <h5>Nueva contraseña</h5>
                <div class='input-field col s12 m6'>
                    <i class='material-icons prefix'>security</i>
                    <input id='clave1' type='password' name='clave1' class='validate'/>
                    <label for='clave1'>Contraseña</label>
                </div>
                <div class='input-field col s12 m6'>
                    <i class='material-icons prefix'>security</i>
                    <input id='clave2' type='password' name='clave2' class='validate'/>
                    <label for='clave2'>Confirmar contraseña</label>
                </div>
            </div>
            
            <div class='row center-align'>
                <button type='submit' class='btn waves-effect'><i class='material-icons'></i>Guardar</button>
            </div>
        </form>  

<!--Aqui se muestra el pie de pagina-->
<?php
Page::footer();
?>