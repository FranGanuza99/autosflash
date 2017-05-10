<?php
require("../lib/page.php");
Page::header("Perfil del usuario");


$imagen = null;
if(!empty($_POST)) {
    $_POST = Validator::validateForm($_POST);
  	$nombres = $_POST['nombres'];
  	$apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $alias = $_POST['alias'];
    $clave1 = $_POST['clave1'];
    $clave2 = $_POST['clave2'];
    $archivo = $_FILES['imagen'];

    try 
    {
      	if($nombres != "" && $apellidos != "")
        {
            if($correo != "")
            {
                if($alias != "")
                {
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

                        if($clave1 != "" || $clave2 != "")
                        {
                            if($clave1 == $clave2)
                            {
                                $clave = password_hash($clave1, PASSWORD_DEFAULT);
                                $sql = "UPDATE usuarios SET nombre_usuario = ?, apellido_usuario = ?, correo_usuario = ?, usuario = ?, contrasenia_usuario = ?, url_foto = ? WHERE codigo_usuario = ?";
                                $params = array($nombres, $apellidos, $correo, $alias, $clave, $imagen, $_SESSION['id_usuario']);
                            }
                            else
                            {
                                throw new Exception("Las contraseñas no coinciden");
                            }
                        }
                        else
                        {
                            $sql = "UPDATE usuarios SET nombre_usuario = ?, apellido_usuario = ?, correo_usuario = ?, usuario = ?, url_foto = ? WHERE codigo_usuario = ?";
                            $params = array($nombres, $apellidos, $correo, $alias, $imagen, $_SESSION['id_usuario']);
                        }
                        Database::executeRow($sql, $params);
                        Page::showMessage(1, "Operación satisfactoria", "index.php");
                        $_SESSION['nombre_usuario'] = $nombres." ".$apellidos;
                        $_SESSION['foto_perfil'] = $imagen;

                    } else if ($imagen == null) {
                        
                        if($clave1 != "" || $clave2 != "")
                        {
                            if($clave1 == $clave2)
                            {
                                $clave = password_hash($clave1, PASSWORD_DEFAULT);
                                $sql = "UPDATE usuarios SET nombre_usuario = ?, apellido_usuario = ?, correo_usuario = ?, usuario = ?, contrasenia_usuario = ? WHERE codigo_usuario = ?";
                                $params = array($nombres, $apellidos, $correo, $alias, $clave, $_SESSION['id_usuario']);
                            }
                            else
                            {
                                throw new Exception("Las contraseñas no coinciden");
                            }
                        }
                        else
                        {
                            $sql = "UPDATE usuarios SET nombre_usuario = ?, apellido_usuario = ?, correo_usuario = ?, usuario = ? WHERE codigo_usuario = ?";
                            $params = array($nombres, $apellidos, $correo, $alias, $_SESSION['id_usuario']);
                        }
                        Database::executeRow($sql, $params);
                        Page::showMessage(1, "Operación satisfactoria", "index.php");
                        $_SESSION['nombre_usuario'] = $nombres." ".$apellidos;
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
    $sql = "SELECT * FROM usuarios WHERE codigo_usuario = ?";
    $params = array($_SESSION['id_usuario']);
    $data = Database::getRow($sql, $params);
    $nombres = $data['nombre_usuario'];
    $apellidos = $data['apellido_usuario'];
    $correo = $data['correo_usuario'];
    $alias = $data['usuario'];
    $imagen = $data['url_foto'];
}
?>

    <!--start container-->
    <div id="main" class="container">
        <h3 class= "center-align">Registro de usuario</h3>
        <form method='post' enctype='multipart/form-data'>
            <div class='row'>
                <h5>Foto de perfil</h5>
                <div class="col s12 m3">
                    <?php
                        if ($imagen == null){
                            print("<img src='../img/usuarios/usuario.png' class='materialboxed' width='200' height='200'>");
                        } else {
                            print("<img src='data:image/*;base64,".$imagen."' class='materialboxed' width='200' height='200'>");
                        }
                    ?>
                </div>
                
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
            <div class="row">
                <h5>Cambiar contraseña</h5>
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

        

    </div>
    <!--end container-->

<!--Aqui se muestra el pie de pagina-->
<?php
Page::footer();
?>