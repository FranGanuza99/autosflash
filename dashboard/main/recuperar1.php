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
    $correo = $_POST['correo'];
    try
    {
        //valida campos
        if($correo != "")
        {
            //consulta al cliente ingresado
            $sql = "SELECT * FROM usuarios WHERE usuarios.correo_usuario = ?";
            $params = array($correo);
            $data = Database::getRow($sql, $params);
            $codigo = $data['codigo_usuario'];
            $nombres = $data['nombre_usuario']." ".$data['apellido_usuario'];
            if($data != null)
            {   
                $clave_provicional = Validator::generarCodigo(8);
                $clave = password_hash($clave_provicional, PASSWORD_DEFAULT);
                $sql = "UPDATE usuarios set contrasenia_usuario = ? WHERE correo_usuario = ? AND codigo_usuario = ?";
                $params = array($clave, $correo, $codigo);
                if(Database::executeRow($sql, $params))
                {
                    $email_user = "noreply.autosflash@gmail.com";
                    $email_password = "Expo2017";
                    $the_subject = "Recuperar cuenta";
                    $address_to = $correo;
                    $from_name = "Autosflash Services";
                    $phpmailer = new PHPMailer();
                    // ---------- datos de la cuenta de Gmail -------------------------------
                    $phpmailer->Username = $email_user;
                    $phpmailer->Password = $email_password; 
                    //-----------------------------------------------------------------------
                    // $phpmailer->SMTPDebug = 1;
                    $phpmailer->SMTPSecure = 'ssl';
                    $phpmailer->Host = "smtp.gmail.com"; // GMail
                    $phpmailer->Port = 465;
                    $phpmailer->IsSMTP(); // use SMTP
                    $phpmailer->SMTPAuth = true;
                    $phpmailer->setFrom($phpmailer->Username,$from_name);
                    $phpmailer->AddAddress($address_to); // recipients email
                    $phpmailer->Subject = $the_subject;	
                    $phpmailer->Body .="<h1 style='color:#3498db;'>Hola ".$nombres."</h1>";
                    $phpmailer->Body .= "<p>Tu codigo es: ".$clave_provicional."</p>";
                    $phpmailer->Body .= "<p>Fecha y Hora: ".date("d-m-Y h:i:s")."</p>";
                    $phpmailer->IsHTML(true);
                    
                    try {
                        $phpmailer->Send();
                        $_SESSION['id_usuario'] = $data['codigo_usuario'];
                        $_SESSION['verifiacion_usuario'] = 0;
                        header('location: recuperar2.php');                             
                    } catch (Exception $exec){
                        Page::showMessage(2, $error->getMessage(), null);
                    }
                    

                    
                }
            }
            else
            {
                throw new Exception("El correo ingresado no existe");
            }
        }
        else
        {
            throw new Exception("Debe ingresar su correo.");
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
        
            <h3 class='center-align'>Iniciar Sesión</h3>
            <br>
            <br>
            <p>A continuación ingrese su correo electrónico. Se enviará un código a su cuenta de correo electronico que deberá ser confirmado en la siguiente ventana.</p>
            <!--Inicio del formulario-->
            <form  method='post' autocomplete='off'>
                <div class="input-field col s12">
                    <input type="email" id="correo" name="correo" class="validate" required/>
                    <label for="correo">Correo eléctronico:</label>
                </div>                        
                <!--botones-->
                <div class="center">
                    <button type='submit' class='btn waves-effect'>Continuar</button>
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
        