<?php
ob_start();
require("../lib/page.php");

Page::header("Agregar Imagenes");
$id = $_GET['id'];

$tipo = null;
$foto = null;

if(!empty($_POST))
{
    
    $_POST = Validator::validateForm($_POST);
    $archivo =  $_FILES['foto'];
    $tipo =  $_POST['tipo'];
    
     
    try 
    {
        
        if($tipo > 0)
        {
            
            if($archivo['name'] != null)
            {
                $base64 = Validator::validateImage($archivo);
                if($base64 != false)
                {
                    $foto = $base64;
                }
                else
                {
                    throw new Exception("Ocurrió un problema con la imagen");
                }
            } else {

                if($foto == null)
                {
                    throw new Exception("Debe seleccionar una imagen");
                }
            }

            
                $sql = "INSERT INTO fotos_vehiculos(codigo_vehiculo, url_foto, codigo_tipo_foto) VALUES (?, ?, ?)";
                $params = array($id, $foto, $tipo);
            
            Database::executeRow($sql, $params);
            header("location: index.php?id=$id");
                                                                                                      
                      
        }    
        else
        {
            throw new Exception("Debe seleccionar un tipo de foto");
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

        <div  class='file-field input-field col s12 m6'>
            <div class='btn waves-effect'>
                <span><i class='material-icons'>image</i></span>
                <input type='file' name='foto' <?php print(($foto == null)?"required":""); ?>/>
            </div>
            <div class='file-path-wrapper'>
                <input class='file-path validate' type='text' placeholder='Seleccione una imagen'/>
            </div>
        </div>
        <div class='input-field col s12 m6'>
            <h6>Tipo:</h6>
            <input name="tipo" type="radio" id="activo" value='2' class='with-gap' <?php print(($tipo == 2)?"checked":""); ?> />
            <label for="activo">Galeria</label>
            <input name="tipo" type="radio" id="inactivo" value='3' class='with-gap' <?php print(($tipo == 3)?"checked":""); ?> />
            <label for="inactivo">Slider</label>
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