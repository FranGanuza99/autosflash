<?php
require("../lib/page.php");
Page::header("Registrar primer usuario");

//consulta si hay algun usuario
$sql = "SELECT * FROM usuarios";
$data = Database::getRows($sql, null);
if($data != null)
{
    header("location: login.php");
}

//calculo de fecha
$fecha = getdate();
$registro = $fecha['year'].'-'.$fecha['mon'].'-'.$fecha['mday'];

//valida si post esta vacio
if(!empty($_POST))
{
    $_POST = Validator::validateForm($_POST);
    //elaza las variables con los campos
  	$nombres = $_POST['nombres'];
  	$apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $alias = $_POST['alias'];
    $clave1 = $_POST['clave1'];
    $clave2 = $_POST['clave2'];
    $nacimiento =$_POST['nacimiento'];
    $archivo = $_FILES['foto'];

    try 
    {
      	if($nombres != "" && $apellidos != "")
        {
            if($correo != "")
            {
                if($alias != "")
                {
                    if ($nacimiento !="")
                    {
                        //validacion de foto
                        if($archivo['name'] != null)
                        {
                            $base64 = Validator::validateImageProfile($archivo);
                            if($base64 != false)
                            {
                                $foto = $base64;
                            }
                            else
                            {
                                throw new Exception("Ocurrió un problema con la imagen");
                            }
                        }
                                
                        
                        if($clave1 != "" && $clave2 != "")
                        {
                            if($clave1 == $clave2)
                            {
                                if ($clave1 != $alias)
                                {
                                    //Inserta el registro del nuevo usuario
                                    $clave = password_hash($clave1, PASSWORD_DEFAULT);
                                    $sql = "INSERT INTO usuarios(nombre_usuario, apellido_usuario, correo_usuario, usuario, contrasenia_usuario, fecha_clave, fecha_nacimiento, codigo_cargo, estado_usuario, url_foto) VALUES(?, ?, ?, ?, ?, ?, ?, 1, 1, ?)";
                                    $params = array($nombres, $apellidos, $correo, $alias, $clave, $registro, $nacimiento, $foto);
                                    Database::executeRow($sql, $params);
                                    Page::showMessage(1, "Operación satisfactoria", "login.php");
                                }
                                else 
                                {
                                    throw new Exception("La contraseña no se puede procesar, intente ingresando una diferente.");
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
                    else {
                        throw new Exception("Debe ingresar la fecha");
                    }
                }
                else
                {
                    throw new Exception("Debe ingresar un alias");
                }
            }
            else
            {
                throw new Exception("Debe ingresar un correo electrónico");
            }
        }
        else
        {
            throw new Exception("Debe ingresar el nombre completo");
        }
    }
    catch (Exception $error)
    {
        Page::showMessage(2, $error->getMessage(), null);
    }
}
else
{
    //asigna null a las variables
    $nombres = null;
    $apellidos = null;
    $correo = null;
    $alias = null;
    $nacimiento = null;

}
?>

<!-- Inicio del panel -->
<div class="card-panel">
    <h3 class= "center-align">Registro de usuario</h3>
    <!-- Inicio del formulario -->
    <form method='post' enctype='multipart/form-data' autocomplete='off'>
        <div class='row'>
            <h5>Foto de perfil</h5> 
            <div class='file-field input-field col s12 m6'>
                <div class='btn waves-effect'>
                    <span><i class='material-icons'>image</i></span>
                    <input type='file' name='foto' required/>
                </div>
                <div class='file-path-wrapper'>
                    <input class='file-path validate' type='text' placeholder='Seleccione una imagen'/>
                </div>
            </div>
        </div>
        <!-- campos -->
        <div class='row'>
            <h5>Datos personales</h5>
            <div class='input-field col s12 m6'>
                <i class='material-icons prefix'>person</i>
                <input id='nombres' type='text' name='nombres' class='validate' value='<?php print($nombres); ?>' required/>
                <label for='nombres'>Nombres</label>
            </div>
            <div class='input-field col s12 m6'>
                <i class='material-icons prefix'>person</i>
                <input id='apellidos' type='text' name='apellidos' class='validate' value='<?php print($apellidos); ?>' required/>
                <label for='apellidos'>Apellidos</label>
            </div>
            <div class='input-field col s12 m6'>
                <i class='material-icons prefix'>email</i>
                <input id='correo' type='email' name='correo' class='validate' value='<?php print($correo); ?>' required/>
                <label for='correo'>Correo</label>
            </div>
            <div class='input-field col s12 m6'>
                <i class='material-icons prefix'>person_pin</i>
                <input id='alias' type='text' name='alias' class='validate' value='<?php print($alias); ?>' required/>
                <label for='alias'>Alias</label>
            </div>
            <div class='input-field col s12 m6'>
                <i class='material-icons prefix'>security</i>
                <input id='clave1' type='password' name='clave1' class='validate' required/>
                <label for='clave1'>Contraseña</label>
            </div>
            <div class='input-field col s12 m6'>
                <i class='material-icons prefix'>security</i>
                <input id='clave2' type='password' name='clave2' class='validate' required/>
                <label for='clave2'>Confirmar contraseña</label>
            </div>
            <div class='input-field col s12 m6 '>
                <i class='material-icons prefix'>perm_contact_calendar</i>
                <input id="nacimiento" name="nacimiento" type="date" class="datepicker validate">  
            </div>
        </div>

        <div class='row center-align'>
            <button type='submit' class='btn waves-effect'><i class='material-icons'></i>Guardar</button>
        </div>
    </form>
</div>

<!-- Se muestra el footer -->
<?php
Page::footer();
?>