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

//valida si el post esta vacio y enlaza las variables con el campo
if(!empty($_POST))
{
    $_POST = validator::validateForm($_POST);
    $clave = $_POST['clave'];
    try
    {
        //valida campos
        if($clave != "")
        {
            //consulta al cliente ingresado
            $sql = "SELECT * FROM usuarios WHERE codigo_usuario = ?";
            $params = array($_SESSION['id_usuario']);
            $data = Database::getRow($sql, $params); 
            $hash = $data['contrasenia_usuario'];
            if(password_verify($clave, $hash)) 
            {
                $_SESSION['verifiacion_usuario'] = 1;
                Page::showMessage(1, "Cuenta verificada correctamente", "recuperar3.php");
            }
            else 
            {
                throw new Exception("La clave ingresada es incorrecta");
            }
        }
        else
        {
            throw new Exception("Debe ingresar la cadena enviada a su correo");
        }
    }
    catch (Exception $error)
    {
        Page::showMessage(2, $error->getMessage(), null);
    }
}

?>
        
<!--primera fila-->
<div class="row">
    <!--columna del login-->
    <div class="col s12 m6 offset-m3">
        <br>
        <div class="card-panel">
        
            <h3 class="center-txt">Validación de usuario</h3>
            <br>
            <p>Revice su correo e ingrese la clave enviada.</p>
            <!--Inicio del formulario-->
            <form  method='post' autocomplete='off'>
                <div class="input-field col s12">
                    <input id="clave" name="clave" type="text" class="validate" required/>
                    <label for="clave">Cadena:</label>
                </div>
                <!--botones-->
                <div class="center">
                    <button type='submit' class='btn waves-effect'>Verificar</button>
                    <button type='submit' class='btn waves-effect'>Cancelar</button>
                </div>
            </form>
            <br>
        </div>
    </div>
</div>

<!--Aqui se muestra el pie de pagina-->

<?php
Page::footer();
?>
        