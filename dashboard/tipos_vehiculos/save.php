<?php
ob_start();
require("../lib/page.php");
//se obtiene el id para modificar
if(empty($_GET['id'])) 
{
    Page::header("Agregar Tipos de Vehiculo");
    $id = null;
    $tipo_vehiculo = null;
}
else
{
    Page::header("Modificar Tipos Vehiculos");
    $id = $_GET['id'];
    $sql = "SELECT * FROM tipos_vehiculos WHERE codigo_tipo_vehiculo = ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);

    $tipo_vehiculo = $data['tipo_vehiculo'];
}

if(!empty($_POST))
{
    //se validan los datos para luego guardarlos o modificarlos
    $_POST = Validator::validateForm($_POST);
  	$tipo_vehiculo = $_POST['tipo_vehiculo'];
    try 
    {
        if($tipo_vehiculo != "")
        {
             if($id == null)
             {
                $sql = "INSERT INTO tipos_vehiculos(tipo_vehiculo) VALUES(?)";
                $params = array($tipo_vehiculo);
             }
             else
             {
                $sql = "UPDATE tipos_vehiculos SET tipo_vehiculo = ? WHERE codigo_tipo_vehiculo = ?";
                $params = array($tipo_vehiculo, $id);
             }
             if(Database::executeRow($sql, $params))
            {
                Page::showMessage(1, "Operación satisfactoria", "index.php");
            }            
         }    
        else
        {
            throw new Exception("Debe ingresar algun tipo de vehiculo");
        }
    }
    catch (Exception $error)
    {
        Page::showMessage(2, $error->getMessage(), null);
    }
}
//se inicia con el diseño y asignacion de variables
?>
<form method='post'>
    <div class='row'>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>note_add</i>
            <input id='tipo_vehiculo' type='text' name='tipo_vehiculo' class='validate' value='<?php print($tipo_vehiculo); ?>' required/>
            <label for='tipo_vehiculo'>Tipos</label>
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