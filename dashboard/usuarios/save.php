<?php
ob_start();
require("../lib/page.php");
//valida si se ha recibido el id
if(empty($_GET['id'])) 
{
    //asigna null a las variables
    Page::header("Agregar usuarios");
    $id = null;
    $nombre = null;
    $apellido = null;
    $correo = null;
    $usuario = null;
    $nacimiento = null;
    $cargo = 1;
    $foto = null;
    $estado = 1;
}
else
{
    Page::header("Modificar usuarios");
    $id = $_GET['id'];
    //valida si el id es el mismo del usuario 
    if ($id == $_SESSION['id_usuario']){
        header("location: ../main/profile.php");
    } else {
        //realiza la consulta y llena las variavles con los datos de la consulta
        $sql = "SELECT * FROM usuarios WHERE codigo_usuario = ?";
        $params = array($id);
        $data = Database::getRow($sql, $params);

        $nombre = $data['nombre_usuario'];
        $apellido = $data['apellido_usuario'];
        $correo = $data['correo_usuario'];
        $usuario = $data['usuario'];
        $nacimiento = $data['fecha_nacimiento'];
        $cargo = $data['codigo_cargo'];
        $foto = $data['url_foto'];
        $estado = $data['estado_usuario'];
        $hash = $data['contrasenia_usuario'];
    }  
}

//validando permisos
global $agregar_usuario;
global $modificar_usuario;
if($agregar_usuario == 0 && empty($_GET['id']))
{
    header("location: index.php");
} 

if($modificar_usuario == 0 && !empty($_GET['id']))
{
    header("location: index.php");
}

$fecha = getdate();
$actual = $fecha['year'].'-'.$fecha['mon'].'-'.$fecha['mday'];

//valida si post esta vacio y enlaza las variables con el campo
if(!empty($_POST))
{
    $_POST = Validator::validateForm($_POST);
  	$nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $usuario = $_POST['usuario'];
    $nacimiento = $_POST['nacimiento'];
    $cargo = $_POST['cargo'];
    $estado = $_POST['estado'];
    $archivo = $_FILES['foto'];

    $response_recapchat =  $_POST['g-recaptcha-response'];
    $secret = "6LehqioUAAAAAEfCqpsYct5UaPLCTQlLVDJTwxNv";
            if(!$response_recapchat){
                Page::showMessage(2, "Eres humano?", "save.php");       
            }
            $ip=$_SERVER['REMOTE_ADDR'];
            $validation_server = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response_recapchat&remoteip=$ip");
            //var_dump($validation_server);     
            $arr  = json_decode($validation_server, TRUE);
            if($arr['success']){
                try 
                {
                    if($nombre != "")
                    {
                        if($apellido != "")
                        {
                            if($correo != "")
                            {
                                if($usuario != "")
                                {
                                    if($nacimiento != "")
                                    {
                                        $nacimiento = new DateTime($nacimiento);
                                        $nacimiento = $nacimiento->format('Y-m-d');
                                        if($cargo > 0)
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
                                            
                                            //valida si es un nuevo usuario o una modificacion
                                            if($id == null)
                                            {
                                                
                                                $clave1 = $_POST['clave1'];
                                                $clave2 = $_POST['clave2'];
                                                //valida claves
                                                if($clave1 != "" && $clave2 != "")
                                                {
                                                    if($clave1 == $clave2)
                                                    {
                                                        if (preg_match("/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$@#%&]).*$/", $clave1))
                                                        {
                                                            if ($usuario != $clave1){
                                                                //inserta datos nuevos
                                                                $clave = password_hash($clave1, PASSWORD_DEFAULT);
                                                                $sql = "INSERT INTO usuarios(nombre_usuario, apellido_usuario, correo_usuario, usuario, contrasenia_usuario, fecha_nacimiento, codigo_cargo, url_foto, estado_usuario, fecha_clave) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                                                                $params = array($nombre, $apellido, $correo, $usuario, $clave, $nacimiento, $cargo, $foto, $estado, $actual);
                                                            } else {
                                                                throw new Exception("El alias y la contraseña son los mismos");
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
                                                    throw new Exception("Debe ingresar ambas contraseñas");
                                                }
                                            }
                                            else
                                            {
                                                if(password_verify($usuario, $hash)) 
                                                { 
                                                    throw new Exception("El usuario no puede ser modificado. Intente ingresando otro alias.");
                                                } else {
                                                    //actializa un registro existente
                                                    $sql = "UPDATE usuarios SET nombre_usuario = ?, apellido_usuario = ?, correo_usuario = ?, usuario = ?, fecha_nacimiento = ?, codigo_cargo = ?, url_foto = ?, estado_usuario = ? WHERE codigo_usuario = ?";
                                                    $params = array($nombre, $apellido, $correo, $usuario, $nacimiento, $cargo, $foto, $estado, $id);
                                                }
                                            }
                                            if(Database::executeRow($sql, $params))
                                            {
                                                Page::showMessage(1, "Operación satisfactoria", "index.php");
                                            }
                                        }
                                        else
                                        {
                                            throw new Exception("Debe ingresar una dirección");
                                        }
                                    }
                                    else
                                    {
                                        throw new Exception("Debe ingresar una dirección");
                                    }
                                }
                                else
                                {
                                    throw new Exception("Debe ingresar un nombre de usuario");
                                }
                            }
                            else
                            {
                                throw new Exception("Debe ingresar el correo electrónico");
                            }
                        }
                        else
                        {
                            throw new Exception("Debe ingresar el apellido");
                        }
                    }
                    else
                    {
                        throw new Exception("Debe ingresar el nombre");
                    }
                }
                catch (Exception $error)
                {
                    Page::showMessage(2, $error->getMessage(), null);
                }
             }
            else{
                Page::showMessage(2, "Eres humano?", "save.php");       
            }
}
?>

<!-- Inicia el formulario -->
<form  autocomplete='off' action="<?php $_SERVER['PHP_SELF']; ?>" method='post' enctype='multipart/form-data'>
    <div class='row'>
        <!-- Muestra la foto -->
        <h5>Foto de perfil</h5>
        <div class="col s12 m3">
        <?php
            print("<img src='data:image/*;base64,".$foto."' class='materialboxed' width='200' height='200'>");
        ?>
        </div>
        <div id='profile-img' class='file-field input-field col s12 m6'>
            <div class='btn waves-effect'>
                <span><i class='material-icons'>image</i></span>
                <input type='file' name='foto' <?php print(($foto == null)?"required":""); ?>/>
            </div>
            <div class='file-path-wrapper'>
                <input class='file-path validate' type='text' placeholder='Seleccione una imagen'/>
            </div>
        </div>
	</div>

    <!-- Muestra la info personal -->
    <div class='row'>
        <h5>Datos personales</h5>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>note_add</i>
            <input id='nombre' type='text' name='nombre' class='validate' value='<?php print($nombre); ?>' required/>
            <label for='nombre'>Nombre</label>
        </div>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>description</i>
            <input id='apellido' type='text' name='apellido' class='validate' value='<?php print($apellido); ?>' required/>
            <label for='apellido'>Apellido</label>
        </div>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>description</i>
            <input id='correo' type='text' name='correo' pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" class='validate' value='<?php print($correo); ?>' required/>
            <label for='correo'>Correo</label>
        </div>
        <div class='input-field col s12 m6 '>
            <i class='material-icons prefix'>perm_contact_calendar</i>
            <input id="nacimiento" name="nacimiento" type="date" value='<?php print($nacimiento); ?>' class="datepicker ">  
        </div>
    </div>

    <!-- Muestra la info de usuario -->
    <div class = 'row'>
        <h5>Datos de Usuario</h5>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>description</i>
            <input id='usuario' type='text' name='usuario' class='validate' value='<?php print($usuario); ?>' required/>
            <label for='usuario'>Usuario</label>
        </div>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>security</i>
            <?php
            $sql = "SELECT codigo_cargo, cargo_usuario FROM cargos_usuarios";
            Page::setCombo("Cargo", "cargo", $cargo, $sql);
            ?>
        </div>

        <?php
        //valida que no pueda cambiar contrasena a otros usuarios
        if($id == null)
        {
        ?>

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

        <?php
        }
        ?>

        <div class='input-field col s12 m6'>
            <h6>Estado:</h6>
            <input name="estado" type="radio" id="activo" value='1' class='with-gap' <?php print(($estado == 1)?"checked":""); ?> />
            <label for="activo">Activo</label>
            <input name="estado" type="radio" id="inactivo" value='0' class='with-gap' <?php print(($estado == 0)?"checked":""); ?> />
            <label for="inactivo">Inactivo</label>
        </div>
        <div class="input-field col s6">
             <div class="g-recaptcha" data-sitekey="6LehqioUAAAAAMnvaYRXfAf8SkWR5rWz_hQjvH73"></div>
         </div>        
    </div>
    <div class='row center-align'>
        <a href='index.php' class='btn waves-effect grey'><i class='material-icons'>cancel</i></a>
        <button type='submit' class='btn waves-effect blue'><i class='material-icons'>save</i></button>
    </div>
</form>

<!-- Se muestra el footer -->
<?php
Page::footer();
?>