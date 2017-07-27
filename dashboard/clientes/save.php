<?php
ob_start();
require("../lib/page.php");

//valida si se ha recibido el id
if(empty($_GET['id'])) 
{
    //asigna null a las variables
    Page::header("Agregar clientes");
    $id = null;
    $nombre = null;
    $apellido = null;
    $correo = null;
    $dui = null;
    $nit = null;
    $telefono = null;
    $direccion = null;
    $estado = 1;
    $foto = null;
}
else
{
    Page::header("Modificar cliente");
    $id = $_GET['id'];
    
    //realiza la consulta y llena las variavles con los datos de la consulta
    $sql = "SELECT * FROM clientes WHERE codigo_cliente = ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);

    $nombre = $data['nombre_cliente'];
    $apellido = $data['apellido_cliente'];
    $correo = $data['correo_cliente'];
    $dui = $data['dui_cliente'];
    $nit = $data['nit_cliente'];
    $telefono = $data['telefono_cliente'];
    $direccion = $data['direccion_cliente'];
    $estado = $data['estado_cliente'];
    $foto = $data['foto'];
    $clave = $data['contrasenia'];
}

//validando permisos
global $modificar_cliente;
if($modificar_cliente == 0 && !empty($_GET['id']))
{
    header("location: index.php");
} 

//valida si post esta vacio y enlaza las variables con el campo
if(!empty($_POST))
{
    $_POST = Validator::validateForm($_POST);
  	$nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $dui = $_POST['dui'];
    $nit = $_POST['nit'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $estado = $_POST['estado'];
    $archivo = $_FILES['foto'];
   
    //calculo de fecha
    $fecha = getdate();
    $registro = $fecha['year'].'-'.$fecha['mon'].'-'.$fecha['mday'];

    try 
    {
        //validacion de campos
        if($nombre != "" && $apellido != "")
        {
            if($correo != "")
            {
                if($dui != "")
                {
                    if($nit != "")
                    {
                        if($telefono != "")
                        {
                            if ($direccion !="")
                            {
                                if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {    
                                
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
                                
                                    //valida si es un nuevo cliente o una modificacion
                                    if($id == null)
                                    {
                                            
                                        $clave1 = $_POST['clave1'];
                                        $clave2 = $_POST['clave2'];
                                        //valida claves
                                        if($clave1 != "" && $clave2 != "")
                                        {
                                            if($clave1 == $clave2)
                                            {
                                                if (preg_match("/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$@#%&.]).*$/", $clave1))
                                                {
                                                    if ($clave1 != $correo){
                                                        //inserta datos nuevos
                                                        $clave = password_hash($clave1, PASSWORD_DEFAULT);
                                                        $sql = "INSERT INTO clientes(nombre_cliente, apellido_cliente, correo_cliente, dui_cliente, nit_cliente, telefono_cliente, direccion_cliente, estado_cliente, foto, contrasenia, fecha_registro_cliente, fecha_clave) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                                                        $params = array($nombre, $apellido, $correo, $dui, $nit, $telefono, $direccion, $estado, $foto, $clave, $registro, $registro);
                                                    }
                                                    else 
                                                    {
                                                        throw new Exception("El correo y la contraseña deben ser diferentes.");
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
                                        //actializa un registro existente
                                        $sql = "UPDATE clientes SET nombre_cliente = ?, apellido_cliente = ?, correo_cliente = ?, dui_cliente = ?, nit_cliente = ?, telefono_cliente = ?, direccion_cliente = ?, estado_cliente = ?, foto = ? WHERE codigo_cliente = ?";
                                        $params = array($nombre, $apellido, $correo, $dui, $nit, $telefono, $direccion, $estado, $foto, $id);
                                    }
                                    if(Database::executeRow($sql, $params))
                                    {
                                        Page::showMessage(1, "Operación satisfactoria", "index.php");
                                    }
                                 }
                                else{
                                    throw new Exception("Debe ingresar un correo valido");
                                 }
                               
                            }
                            else
                            {
                                throw new Exception("Debe ingresar una dirección");
                            }
                        }
                        else
                        {
                            throw new Exception("Debe ingresar una telefono");
                        }
                    }
                    else
                    {
                        throw new Exception("Debe ingresar su nit");
                    }
                }
                else
                {
                    throw new Exception("Debe ingresar su dui");
                }
            }
            else
            {
                throw new Exception("Debe ingresar el correo electronico");
            }
        }
        else
        {
            throw new Exception("Debe ingresar el nombre y apellido");
        }
    }
    catch (Exception $error)
    {
        Page::showMessage(2, $error->getMessage(), null);
    }
}
?>

<!-- Inicia el formulario -->
<form method='post' enctype='multipart/form-data' autocomplete="off">
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
            <input id='telefono' type='text' name='telefono' pattern='^[2|6|7][0-9]{7}' class='validate' value='<?php print($telefono); ?>' required/>
            <label for='telefono'>Teléfono</label>
        </div>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>description</i>
            <input id='direccion' type='text' name='direccion' class='validate' value='<?php print($direccion); ?>' required/>
            <label for='direccion'>Direccion</label>
        </div>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>note_add</i>
            <input id='dui' type='text' name='dui' pattern='^[0-9]{8}-[0-9]{1}' class='validate' value='<?php print($dui); ?>' required/>
            <label for='dui'>DUI (########-#)</label>
        </div>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>note_add</i>
            <input id='nit' type='text' name='nit' pattern='^[0-9]{4}-[0-9]{6}-[0-9]{3}-[0-9]{1}' class='validate' value='<?php print($nit); ?>' required/>
            <label for='nit'>NIT (####-######-###-#)</label>
        </div>
        
    </div>

    <!-- Muestra la info de usuario -->
    <div class = 'row'>
        <h5>Datos de Usuario</h5>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>description</i>
            <input id='correo' type='email' name='correo' pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" class='validate' value='<?php print($correo); ?>' required/>
            <label for='correo'>Correo</label>
        </div>
        <div class='file-field input-field col s12 m6'>
            <div class='btn waves-effect'>
                <span><i class='material-icons'>image</i></span>
                <input type='file' name='foto' <?php print(($foto == null)?"required":""); ?>/>
            </div>
            <div class='file-path-wrapper'>
                <input class='file-path validate' type='text' placeholder='Seleccione una imagen'/>
            </div>
        </div>

        <?php 
        if($id == null)
        {
            print("
                <div class='input-field col s12 m6'>
                    <i class='material-icons prefix'>security</i>
                    <input id='clave1' type='password' name='clave1' class='validate' />
                    <label for='clave1'>Contraseña</label>
                </div>
                <div class='input-field col s12 m6'>
                    <i class='material-icons prefix'>security</i>
                    <input id='clave2' type='password' name='clave2' class='validate' />
                    <label for='clave2'>Confirmar contraseña</label>
                </div>
            ");
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

<!-- Se muestra el footer -->
<?php
Page::footer();
?>