<?php
ob_start();
require("../lib/page.php");
Page::header("Agregar Imagenes");
$id = $_GET['id'];

//inicializando variables
$foto1 = null;
$foto2 = null;
$foto3 = null;
$foto4 = null;

//validando los campos de imagen
if(!empty($_FILES))
{
    //instanciando variables
    $archivo1 =  $_FILES['perfil'];
    $archivo2 =  $_FILES['general1'];
    $archivo3 =  $_FILES['general2'];
    $archivo4 =  $_FILES['general3'];
    try 
    { 
        //perfil
        if($archivo1['name'] != null)
        {
            $base64 = Validator::validateImage($archivo1);
            if($base64 != false)
            {
                $foto1 = $base64;
            }
            else
            {
                throw new Exception("Ocurrió un problema con la imagen");
            }
        } else {

            if($foto1 == null)
            {
                throw new Exception("Debe seleccionar una imagen");
            }
        }

        //general1
        if($archivo2['name'] != null)
        {
            $base64 = Validator::validateImage($archivo2);
            if($base64 != false)
            {
                $foto2 = $base64;
            }
            else
            {
                throw new Exception("Ocurrió un problema con la imagen");
            }
        } else {

            if($foto2 == null)
            {
                throw new Exception("Debe seleccionar una imagen");
            }
        }

        //general2
        if($archivo3['name'] != null)
        {
            $base64 = Validator::validateImage($archivo3);
            if($base64 != false)
            {
                $foto3 = $base64;
            }
            else
            {
                throw new Exception("Ocurrió un problema con la imagen");
            }
        } else {

            if($foto3 == null)
            {
                throw new Exception("Debe seleccionar una imagen");
            }
        }

        //general3
        if($archivo4['name'] != null)
        {
            $base64 = Validator::validateImage($archivo4);
            if($base64 != false)
            {
                $foto4 = $base64;
            }
            else
            {
                throw new Exception("Ocurrió un problema con la imagen");
            }
        } else {

            if($foto4 == null)
            {
                throw new Exception("Debe seleccionar una imagen");
            }
        }

        //validacion de foto para agregar o modificar
        $sql = "SELECT url_foto FROM fotos_vehiculos WHERE codigo_vehiculo = ? AND codigo_tipo_foto = 1";
        $params = array($id);
        $data = Database::getRows($sql, $params);
        if ($data == null){
            $sql = "INSERT INTO fotos_vehiculos(codigo_vehiculo, url_foto, codigo_tipo_foto) VALUES (?, ?, ?)";
            $params = array($id, $foto1, 1);
        } else {
            $sql = "UPDATE fotos_vehiculos SET url_foto = ? WHERE codigo_vehiculo = ? AND codigo_tipo_foto = 1";
            $params = array($foto1, $id);
        }
        if(Database::executeRow($sql, $params))
        {

        }

        //ingreso de fotos dentro de vehiculos
        $sql = "UPDATE vehiculos SET foto_general1 = ?, foto_general2 = ?, foto_general3 = ? WHERE codigo_vehiculo = ?";
        $params = array($foto2, $foto3, $foto4, $id);
        if(Database::executeRow($sql, $params))
        {
            Page::showMessage(1, "Operación satisfactoria", "index.php?id=$id");
        }
                                                                                                      
    }
    catch (Exception $error)
    {
        Page::showMessage(2, $error->getMessage(), null);
    }
}
?>

<!-- Incio del formulario -->
<form method='post' enctype='multipart/form-data'>
    <!-- Primera imagen -->
    <div class='row'>
        <div class='col s12 m5'>
            <h5>Foto principal:</h5>
            <p>Imagen que se mostrará al principio</p>
        </div>
        <div  class='file-field input-field col s12 m7'>
            <div class='btn waves-effect'>
                <span><i class='material-icons'>image</i></span>
                <input type='file' name='perfil' <?php print(($foto1 == null)?"required":""); ?>/>
            </div>
            <div class='file-path-wrapper'>
                <input class='file-path validate' type='text' placeholder='Seleccione una imagen'/>
            </div>
        </div>
    </div>

    <!-- Segunda imagen -->
    <div class='row'>
        <div class='col s12 m5'>
            <h5>Foto general 1:</h5>
            <p>Primer imagen sobre los datos generales.</p>
        </div>
        <div  class='file-field input-field col s12 m7'>
            <div class='btn waves-effect'>
                <span><i class='material-icons'>image</i></span>
                <input type='file' name='general1' <?php print(($foto2 == null)?"required":""); ?>/>
            </div>
            <div class='file-path-wrapper'>
                <input class='file-path validate' type='text' placeholder='Seleccione una imagen'/>
            </div>
        </div>
    </div>

    <!-- Tercera imagen -->
    <div class='row'>
        <div class='col s12 m5'>
            <h5>Foto general 2:</h5>
            <p>Segunda imagen sobre los datos generales.</p>
        </div>
        <div  class='file-field input-field col s12 m7'>
            <div class='btn waves-effect'>
                <span><i class='material-icons'>image</i></span>
                <input type='file' name='general2' <?php print(($foto3 == null)?"required":""); ?>/>
            </div>
            <div class='file-path-wrapper'>
                <input class='file-path validate' type='text' placeholder='Seleccione una imagen'/>
            </div>
        </div>
    </div>

    <!-- Cuarta imagen -->
    <div class='row'>
        <div class='col s12 m5'>
            <h5>Foto general 3:</h5>
            <p>Tercera imagen sobre los datos generales.</p>
        </div>
        <div  class='file-field input-field col s12 m7'>
            <div class='btn waves-effect'>
                <span><i class='material-icons'>image</i></span>
                <input type='file' name='general3' <?php print(($foto4 == null)?"required":""); ?>/>
            </div>
            <div class='file-path-wrapper'>
                <input class='file-path validate' type='text' placeholder='Seleccione una imagen'/>
            </div>
        </div>
        
    </div>
    <div class='row center-align'>
        <a href='index.php' class='btn waves-effect grey'><i class='material-icons'>cancel</i></a>
        <button type='submit' class='btn waves-effect blue'><i class='material-icons'>save</i></button>
    </div>
</form>

<!-- se muestra el footer -->
<?php
Page::footer();
?>