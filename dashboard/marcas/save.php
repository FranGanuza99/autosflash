<?php
ob_start();
require("../lib/page.php");
//se obtiene el id para luego usarlo para modifcar el vehiculo
if(empty($_GET['id'])) 
{
    Page::header("Agregar Marca de Vehiculo");
    $id = null;
    $marca_vehiculo = null;
}
else
{
    Page::header("Modificar Marca de Vehiculos");
    $id = $_GET['id'];
    $sql = "SELECT * FROM marcas WHERE codigo_marca = ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $marca_vehiculo = $data['marca'];
}
if(!empty($_POST))
{
    // se ejecuta la validacion para agregar o modificar la marca
    $_POST = Validator::validateForm($_POST);
  	$marca_vehiculo = $_POST['marca'];
    try 
    {
        if($marca_vehiculo != "")
        {
            if($id == null)
            {
                $sql = "INSERT INTO marcas(marca) VALUES(?)";
                $params = array($marca_vehiculo);
            }
            else
            {
                $sql = "UPDATE marcas SET marca = ? WHERE codigo_marca = ?";
                $params = array($marca_vehiculo, $id);
            }
            if(Database::executeRow($sql, $params))
            {
                Page::showMessage(1, "Operación satisfactoria", "index.php");
            }
         }    
        else
        {
            throw new Exception("Debe ingresar alguna marca de vehiculo");
        }
    }
    catch (Exception $error)
    {
        Page::showMessage(2, $error->getMessage(), null);
    }
}
//se inicia el diseño del formulario
?>
<form method='post'>
    <div class='row'>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>note_add</i>
            <input id='marca' type='text' name='marca' class='validate' value='<?php print($marca_vehiculo); ?>' required/>
            <label for='marca'>Marcas</label>
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