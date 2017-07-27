<?php
require("../lib/page.php");
Page::header("Perfil del usuario");

//inicializo la variable de imagen
$imagen = null;

$sql = "SELECT * FROM usuarios WHERE codigo_usuario = ?";
$params = array($_SESSION['id_usuario']);
$data = Database::getRow($sql, $params);
$hash = $data['contrasenia_usuario'];
$imagen = $data['url_foto'];

//valida si post esta vacio
if(!empty($_POST)) {
    $_POST = Validator::validateForm($_POST);
    //emlaza la variable con el campo
  	$nombres = $_POST['nombres'];
  	$apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $alias = $_POST['alias'];
    $archivo = $_FILES['imagen'];

    try 
    {
        //validaciones
      	if($nombres != "" && $apellidos != "")
        {
            if($correo != "")
            {
                if($alias != "")
                {
                    if(password_verify($alias, $hash)) 
		    	    { 
                        throw new Exception("El usuario no puede ser modificado. Intente ingresando otro alias.");
                    } 
                    else 
                    {
                        //validacion de imagen
                        if($archivo['name'] != null)
                        {
                            $base64 = Validator::validateImage($archivo);
                            if($base64 != false)
                            {
                                $imagen = $base64;
                            }
                            else
                            {
                                throw new Exception("Ocurrió un problema con la imagen");
                            }
                            //Actualiza junto sin la contraseña
                            $sql = "UPDATE usuarios SET nombre_usuario = ?, apellido_usuario = ?, correo_usuario = ?, usuario = ?, url_foto = ? WHERE codigo_usuario = ?";
                            $params = array($nombres, $apellidos, $correo, $alias, $imagen, $_SESSION['id_usuario']);
                            
                            if (Database::executeRow($sql, $params)){
                                Page::showMessage(1, "Operación satisfactoria", "index.php");
                                //Actualiza algunas variables de sesion
                                $_SESSION['nombre_usuario'] = $nombres." ".$apellidos;
                                $_SESSION['foto_usuario'] = $imagen;
                            }

                        } else {
                            //actualiza sin la imagen y sin clave
                            $sql = "UPDATE usuarios SET nombre_usuario = ?, apellido_usuario = ?, correo_usuario = ?, usuario = ? WHERE codigo_usuario = ?";
                            $params = array($nombres, $apellidos, $correo, $alias, $_SESSION['id_usuario']);
                            
                            if (Database::executeRow($sql, $params)){
                                Page::showMessage(1, "Operación satisfactoria", "index.php");
                                $_SESSION['nombre_usuario'] = $nombres." ".$apellidos;
                            }           
                        } 
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
} else {
    //consulta los registros de la base
    $sql = "SELECT * FROM usuarios WHERE codigo_usuario = ?";
    $params = array($_SESSION['id_usuario']);
    $data = Database::getRow($sql, $params);
    $nombres = $data['nombre_usuario'];
    $apellidos = $data['apellido_usuario'];
    $correo = $data['correo_usuario'];
    $alias = $data['usuario'];
    $imagen = $data['url_foto'];
    $hash = $data['contrasenia_usuario'];
}
?>
    <!--inicia el formulario-->
        <form method='post' enctype='multipart/form-data' autocomplete='off'>
            <div class='row'>
                <h5>Foto de perfil</h5>
                <!-- Muestra la foto actual -->
                <div class="col s12 m3">
                    <?php
                        if ($imagen == null){
                            print("<img src='../img/usuarios/usuario.png' class='materialboxed' width='200' height='200'>");
                        } else {
                            print("<img src='data:image/*;base64,".$imagen."' class='materialboxed' width='200' height='200'>");
                        }
                    ?>
                </div>
                <!-- campo de imagen -->
                <div id='profile-img' class='file-field input-field col s12 m6'>
                    <div class='btn waves-effect'>
                        <span><i class='material-icons'>image</i></span>
                        <input type='file' name='imagen' <?php print(($imagen == null)?"required":""); ?>/>
                    </div>
                    <div class='file-path-wrapper'>
                        <input class='file-path validate' type='text' placeholder='Seleccione una imagen'/>
                    </div>
                </div>
            </div>
            <!-- Campos del perfil -->
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
            </div>
            
            <div class='row center-align'>
                <button type='submit' class='btn waves-effect'><i class='material-icons'></i>Guardar</button>
            </div>
        </form>  

<!--Aqui se muestra el pie de pagina-->
<?php
Page::footer();
?>