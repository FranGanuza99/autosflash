<?php
ob_start();
require("../lib/page.php");
include "../../lib/phpmailer/class.phpmailer.php";
include "../../lib/phpmailer/class.smtp.php";
Page::header("Recuperar contraseña");

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

if (isset($_SESSION['id_usuario']) && isset($_SESSION['verifiacion_usuario']))
{
    if ($_SESSION['verifiacion_usuario'] == 1)
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
                        if (preg_match("/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/", $clave1))
                        {
                            
                            //ingreso de datos de usuario
                            $clave = password_hash($clave1, PASSWORD_DEFAULT);
                            //actializa un registro existente
                            $sql = "UPDATE usuarios SET contrasenia_usuario = ? WHERE codigo_usuario = ?";
                            $params = array($clave, $_SESSION['id_usuario']);
                            if(Database::executeRow($sql, $params))
                            {
                                $sql = "SELECT * FROM cargos_usuarios, usuarios WHERE usuarios.codigo_cargo = cargos_usuarios.codigo_cargo AND usuarios.codigo_usuario = ?";
                                $params = array($_SESSION['id_usuario']);
                                $data = Database::getRow($sql, $params);
                                if ($data != null){
                                    $_SESSION['cargo'] = $data['cargo_usuario'];
                                    $_SESSION['id_usuario'] = $data['codigo_usuario'];
                                    $_SESSION['nombre_usuario'] = $data['nombre_usuario']." ".$data['apellido_usuario'];
                                    $_SESSION['foto_usuario'] = $data['url_foto'];
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
        Page::showMessage(2, "No se ha verificado la cuenta", "recuperar2.php");
        header("location: recuperar2.php");
    }
}

?>
        
<!--primera fila-->
<div class="row">
    <!--columna del login-->
    <div class="col s12 m6 offset-m3">
        <br>
        <div class="card-panel">
            <h3 class="center-txt">Cambiar contraseña</h3>
            <br>
            <!--Inicio del formulario-->
            <form  method='post'>
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
            <br>
        </div>
    </div>
</div>

<!--Aqui se muestra el pie de pagina-->

<?php
Page::footer();
?>
        