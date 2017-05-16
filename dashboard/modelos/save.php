<?php
ob_start();
require("../lib/page.php");
if(empty($_GET['id'])) 
{
    Page::header("Agregar Modelo de Vehiculo");
    $id = null;
    $nombre_modelo = null;
    $codigo_serie = null;
    
}
else
{
    Page::header("Modificar Modelo de Vehiculos");
    $id = $_GET['id'];
    $sql = "SELECT * FROM modelos WHERE codigo_modelo= ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $nombre_modelo = $data['nombre_modelo'];
    $codigo_serie = $data['codigo_serie'];
   
}

if(!empty($_POST))
{
    
    $_POST = Validator::validateForm($_POST);
    $nombre_modelo = $_POST['nombre_modelo'];
    $codigo_serie = $_POST['codigo_serie'];
     
    try 
    {
        if($nombre_modelo != "")
        {
            if($codigo_serie != "")
            {
                if($id == null)
                {
                $sql = "INSERT INTO modelos(nombre_modelo, codigo_serie) VALUES(?,?)";
                $params = array($nombre_modelo,$codigo_serie);
                }
                else
                {
                $sql = "UPDATE modelos SET nombre_modelo = ?, codigo_serie=? WHERE codigo_modelo = ?";
                $params = array($nombre_modelo, $codigo_serie, $id);
                }
                Database::executeRow($sql, $params);
                header("location: index.php");
            }
            else{
                throw new Exception("Debe ingresar alguna serie de marca");
             }           
         }    
        else
        {
            throw new Exception("Debe ingresar alguna serie de vehiculo");
        }
    }
    catch (Exception $error)
    {
        Page::showMessage(2, $error->getMessage(), null);
    }
}
?>
<form method='post'>
    <div class='row'>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>note_add</i>
            <input id='nombre_modelo' type='text' name='nombre_modelo' class='validate' value='<?php print($nombre_modelo); ?>' required/>
            <label for='nombre_modelo'>Serie</label>
        </div>
       <div class='input-field col s12 m6'>
            <?php
            $sql = "SELECT codigo_serie, nombre_serie FROM series";
            Page::setCombo("Serie", "codigo_serie", $codigo_serie, $sql);
            ?>
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