<?php
ob_start();
require("../lib/page.php");

//inicializando variables
$foto = null;
$tipo = 2;

//validando si se recibio un id
if(empty($_GET['img'])) 
{
    Page::header("Agregar imagenes");
    $img = null;
    $id = $_GET['id'];
}
else
{
    Page::header("Modificar imagenes");
    $id = $_GET['id'];
    $img = $_GET['img'];
    $sql = "SELECT * FROM fotos_vehiculos WHERE codigo_foto = ?";
    $params = array($img);
    $data = Database::getRow($sql, $params);
    $tipo = $data['codigo_tipo_foto'];
    $foto = $data['url_foto'];
}

//validando los campos con el post
if(!empty($_POST))
{
    
    $_POST = Validator::validateForm($_POST);
    $archivo =  $_FILES['foto'];
    $tipo = $_POST['tipo'];
     
    try 
    { 
        if($tipo > 0)
        {
            //validacion de imagenes
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

            //ingreso o actualizacion de registros
            if($img == null)
            {
                $sql = "INSERT INTO fotos_vehiculos(codigo_vehiculo, url_foto, codigo_tipo_foto) VALUES (?, ?, ?)";
                $params = array($id, $foto, $tipo);
            } else {
                $sql = "UPDATE fotos_vehiculos SET url_foto = ?, codigo_tipo_foto = ? WHERE codigo_foto = ?";
                $params = array($foto, $tipo, $img);
            }
            if(Database::executeRow($sql, $params))
            {
                Page::showMessage(1, "Operación satisfactoria", "vista.php?id=$id");
            }    
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

<!-- Inicio del formulario de ingreso -->
<form method='post' enctype='multipart/form-data'>
    <div class='row'>

        <!-- campo de imagen -->
        <div  class='file-field input-field col s12 m6'>
            <div class='btn waves-effect'>
                <span><i class='material-icons'>image</i></span>
                <input type='file' name='foto' <?php print(($foto == null)?"required":""); ?>/>
            </div>
            <div class='file-path-wrapper'>
                <input class='file-path validate' type='text' placeholder='Seleccione una imagen'/>
            </div>
        </div>

        <!-- seleccion del tipo -->
        <div class='input-field col s12 m6'>
            <h6>Tipo:</h6>
            <input name="tipo" type="radio" id="activo" value='2' class='with-gap' <?php print(($tipo == 2)?"checked":""); ?> />
            <label for="activo">Galeria</label>
            <input name="tipo" type="radio" id="inactivo" value='3' class='with-gap' <?php print(($tipo == 3)?"checked":""); ?> />
            <label for="inactivo">Slider</label>
        </div>
    </div>
    <div class='row center-align'>
        
        <?php
            $sql = "SELECT codigo_vehiculo FROM fotos_vehiculos WHERE codigo_foto = ?";
            $params = array($id);
            $id = Database::getRow($sql, $params);

            print("<a href='vista.php?id=".$id['codigo_vehiculo']."' class='btn waves-effect grey'><i class='material-icons'>cancel</i></a>");
        ?>
        
        <button type='submit' class='btn waves-effect blue'><i class='material-icons'>save</i></button>
    </div>
</form>

<!-- se muestra el footer -->
<?php
Page::footer();
?>