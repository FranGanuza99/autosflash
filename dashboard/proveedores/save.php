<?php
ob_start();
require("../lib/page.php");

//valida si se ha recibido el id
     
{
    Page::header("Agregar proveedores");
    //asigna null a las variables
    $id = null;
    $nombre = null;
    $contacto = null;
    $telefono = null;
    $direccion = null;
}
else
{
    //realiza la consulta y llena las variavles con los datos de la consulta
    Page::header("Modificar proveedores");
    $id = $_GET['id'];
    $sql = "SELECT * FROM proveedores WHERE codigo_proveedor = ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);

    $nombre = $data['nombre_proveedor'];
    $contacto = $data['contacto_proveedor'];
    $telefono = $data['telefono_proveedor'];
    $direccion = $data['direccion_provedor'];
}

//valida si post esta vacio y enlaza las variables con el campo
if(!empty($_POST))
{
    $_POST = Validator::validateForm($_POST);
  	$nombre = $_POST['nombre'];
  	$contacto = $_POST['contacto'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    try 
    {
        if($nombre != "")
        {
            if($contacto != "")
            {
                if($telefono > 0)
                {
                    if($direccion != "")
                    {
                        if($id == null)
                        {
                            //inserta datos nuevos
                            $sql = "INSERT INTO proveedores(nombre_proveedor, contacto_proveedor, telefono_proveedor, direccion_provedor) VALUES(?, ?, ?, ?)";
                            $params = array($nombre, $contacto, $telefono, $direccion);
                        }
                        else
                        {
                            //actualiza datos existentes
                            $sql = "UPDATE proveedores SET nombre_proveedor = ?, contacto_proveedor = ?, telefono_proveedor = ?, direccion_provedor = ? WHERE codigo_proveedor = ?";
                            $params = array($nombre, $contacto, $telefono, $direccion, $id);
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
                    throw new Exception("Debe ingresar un telefono válido");
                }
            }
            else
            {
                throw new Exception("Debe ingresar el contacto");
            }
        }
        else
        {
            throw new Exception("Debe digitar la empresa");
        }
    }
    catch (Exception $error)
    {
        Page::showMessage(2, $error->getMessage(), null);
    }
}
?>

<!-- Inicio del formulario -->
<form method='post'>
    <div class='row'>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>note_add</i>
            <input id='nombre' type='text' name='nombre' class='validate' value='<?php print($nombre); ?>' required/>
            <label for='nombre'>Empresa</label>
        </div>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>description</i>
            <input id='contacto' type='text' name='contacto' class='validate' value='<?php print($contacto); ?>' required/>
            <label for='contacto'>Contacto</label>
        </div>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>description</i>
            <input id='telefono' type='text' name='telefono' pattern='^[2|6|7][0-9]{7}' class='validate' value='<?php print($telefono); ?>' required/>
            <label for='telefono'>Teléfono</label>
        </div>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>description</i>
            <input id='direccion' type='text' name='direccion' class='validate' value='<?php print($direccion); ?>' required/>
            <label for='direccion'>Dirección</label>
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