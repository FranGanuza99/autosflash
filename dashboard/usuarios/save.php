<?php
ob_start();
require("../lib/page.php");
if(empty($_GET['id'])) 
{
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
    if ($id == $_SESSION['id_usuario']){
        header("location: ../main/profile.php");
    } else {
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
    }
    
}

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
                            if($cargo > 0)
                            {
                                
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
                                
                                if($id == null)
                                {
                                    $usuario = $_POST['usuario'];
                                    if($usuario != "")
                                    {
                                        $clave1 = $_POST['clave1'];
                                        $clave2 = $_POST['clave2'];
                                        if($clave1 != "" && $clave2 != "")
                                        {
                                            if($clave1 == $clave2)
                                            {
                                                $clave = password_hash($clave1, PASSWORD_DEFAULT);
                                                $sql = "INSERT INTO usuarios(nombre_usuario, apellido_usuario, correo_usuario, usuario, contrasenia_usuario, fecha_nacimiento, codigo_cargo, url_foto, estado_usuario) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
                                                $params = array($nombre, $apellido, $correo, $usuario, $clave, $nacimiento, $cargo, $foto, $estado);
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
                                        throw new Exception("Debe ingresar un alias");
                                    }
                                }
                                else
                                {
                                    $sql = "UPDATE usuarios SET nombre_usuario = ?, apellido_usuario = ?, correo_usuario = ?, usuario = ?, fecha_nacimiento = ?, codigo_cargo = ?, url_foto = ?, estado_usuario = ? WHERE codigo_usuario = ?";
                                    $params = array($nombre, $apellido, $correo, $usuario, $nacimiento, $cargo, $foto, $estado, $id);
                                }
                                Database::executeRow($sql, $params);
                                header("location: index.php");

                               
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
?>


<form method='post' enctype='multipart/form-data'>
    <div class='row'>
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
            <input id='correo' type='email' name='correo' class='validate' value='<?php print($correo); ?>' required/>
            <label for='correo'>Correo</label>
        </div>
        <div class='input-field col s12 m6 '>
            <i class='material-icons prefix'>perm_contact_calendar</i>
            <input id="nacimiento" name="nacimiento" type="date" value='<?php print($nacimiento); ?>' class="datepicker validate">  
        </div>
    </div>

    <div class = 'row'>
        <h5>Datos personales</h5>
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
        

    </div>
    <div class='row center-align'>
        <a href='index.php' class='btn waves-effect grey'><i class='material-icons'>cancel</i></a>
        <button type='submit' class='btn waves-effect blue'><i class='material-icons'>save</i></button>
    </div>
</form>


<?php
Page::footer();
?>