<?php
ob_start();
require("../lib/page.php");
//se obtine el ide para luego modificarlo o agregar un dato nuevo si no tiene id
if(empty($_GET['id'])) 
{
    Page::header("Agregar Serie de Vehiculo");
    //se colocan las variables donde se cargara la data
    $id = null;
    $nombre_serie = null;
    $codigo_marca = null;
}
else
{
    //se colocan las variables a utilizar
    Page::header("Modificar Series de Vehiculos");
    $id = $_GET['id'];
    $sql = "SELECT * FROM series WHERE codigo_serie= ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $nombre_serie = $data['nombre_serie'];
    $codigo_marca = $data['codigo_marca'];
}

if(!empty($_POST))
{
  //se llaman las variables donde esta almacendada la data para luego validar  
    $_POST = Validator::validateForm($_POST);
    $nombre_serie = $_POST['nombre_serie'];
    $codigo_marca = $_POST['codigo_marca'];
     
    try 
    {
        if($nombre_serie != "")
        {
            if($codigo_marca != "")
            {
                if($id == null)
                {
                    $sql = "INSERT INTO series(nombre_serie, codigo_marca) VALUES(?,?)";
                    $params = array($nombre_serie,$codigo_marca);
                }
                else
                {
                    $sql = "UPDATE series SET nombre_serie = ?, codigo_marca=? WHERE codigo_serie = ?";
                    $params = array($nombre_serie, $codigo_marca, $id);
                }
                if(Database::executeRow($sql, $params))
                {
                    Page::showMessage(1, "Operación satisfactoria", "index.php");
                }
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
//se crea una parte del diseño a demas de cargar en select otra tabla
?>
<form method='post'>
    <div class='row'>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>note_add</i>
            <input id='nombre_serie' type='text' name='nombre_serie' class='validate' value='<?php print($nombre_serie); ?>' required/>
            <label for='nombre_serie'>Serie</label>
        </div>
       <div class='input-field col s12 m6'>
            <?php
            $sql = "SELECT codigo_marca, marca FROM marcas";
            Page::setCombo("Marca", "codigo_marca", $codigo_marca, $sql);
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