<?php
ob_start();
require("../lib/page.php");
//se colocan las variables
if(empty($_GET['id'])) 
{
    Page::header("Agregar cargos");
    $id = null;
    $cargo = null;
    $agregar_vehiculo = 1;
    $agregar_usuario = 1;
    $ver_datos =1;
    $promociones = 1;
    $facturar = 1;
    $modificar_cliente =1;
    $modificar_usuario =1;
}
else
{
    //se cargan los datos en las variables en caso se modifique la clase
    Page::header("Modificar cargos");
    $id = $_GET['id'];
    $sql = "SELECT * FROM cargos_usuarios WHERE codigo_cargo = ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $cargo = $data['cargo_usuario'];
    $agregar_vehiculo = $data['permiso_agregar_vehiculos'];
    $agregar_usuario = $data['permiso_agregar_usuario'];
    $ver_datos =$data['permiso_datos_estadisticos'];
    $promociones = $data['permiso_agregar_promociones'];
    $facturar = $data['permiso_facturar'];
    $modificar_cliente =$data['permiso_modificar_cliente'];
    $modificar_usuario =$data['permiso_modificar_usuario'];
}

if(!empty($_POST))
{
    //se validan las variables para acontinuacion guardar o modificar
    $_POST = Validator::validateForm($_POST);
    $cargo = $_POST['cargo_usuario'];
    $agregar_vehiculo = $_POST['agregar_vehiculo'];
    $agregar_usuario = $_POST['agregar_usuario'];
    $ver_datos = $_POST['ver_datos'];
    $promociones = $_POST['promociones'];
    $facturar = $_POST['facturar'];
    $modificar_cliente = $_POST['modificar_cliente'];
    $modificar_usuario = $_POST['modificar_usuario'];
    
    try 
    {
      	if($cargo != "")
        {
            if($id == null)
            {
                $sql = "INSERT INTO cargos_usuarios(cargo_usuario, permiso_agregar_vehiculos, permiso_agregar_usuario, permiso_datos_estadisticos, permiso_agregar_promociones, permiso_facturar, permiso_modificar_cliente, permiso_modificar_usuario) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $params = array($cargo, $agregar_vehiculo, $agregar_usuario, $ver_datos, $promociones, $facturar, $modificar_cliente, $modificar_usuario);
            }
            else
            {
                $sql = "UPDATE cargos_usuarios SET cargo_usuario = ?, permiso_agregar_vehiculos = ?, permiso_agregar_usuario = ?, permiso_datos_estadisticos = ?, permiso_agregar_promociones = ?, permiso_facturar = ?, permiso_modificar_cliente = ?, permiso_modificar_usuario = ? WHERE cargos_usuarios.codigo_cargo = ?";
                $params = array($cargo, $agregar_vehiculo, $agregar_usuario, $ver_datos, $promociones, $facturar, $modificar_cliente, $modificar_usuario, $id);
            }
            if(Database::executeRow($sql, $params))
            {
                Page::showMessage(1, "Operación satisfactoria", "index.php");
            }  
        }
        else
       {
       throw new Exception("Debe digitar un cargo");
       }
    }
    catch (Exception $error)
    {
        Page::showMessage(2, $error->getMessage(), null);
    }
}
?>
<!--se inicia com el diseño del formulario, adicional a cada imput se le asigna una variale-->
<form method='post'>
    <div class='row'>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>note_add</i>
            <input id='cargo_usuario' type='text' name='cargo_usuario' class='validate' value='<?php print($cargo); ?>' required/>
            <label for='cargo_usuario'>Cargo</label>
        </div>
    </div>
    <div class='row'>
        <div class='input-field col s12 m6'>
            <span>Permiso de gestionar vehiculo:</span>
            <input id='activo' type='radio' name='agregar_vehiculo' class='with-gap' value='1' <?php print(($agregar_vehiculo == 1)?"checked":""); ?>/>
            <label for='activo'><i class='material-icons left'>done</i></label>
            <input id='inactivo' type='radio' name='agregar_vehiculo' class='with-gap' value='0' <?php print(($agregar_vehiculo == 0)?"checked":""); ?>/>
            <label for='inactivo'><i class='material-icons left'>not_interested</i></label>
        </div>
        <div class='input-field col s12 m6'>
            <span>Permiso de gestionar usuario:</span>
            <input id='activo1' type='radio' name='agregar_usuario' class='with-gap' value='1' <?php print(($agregar_usuario == 1)?"checked":""); ?>/>
            <label for='activo1'><i class='material-icons left'>done</i></label>
            <input id='inactivo1' type='radio' name='agregar_usuario' class='with-gap' value='0' <?php print(($agregar_usuario == 0)?"checked":""); ?>/>
            <label for='inactivo1'><i class='material-icons left'>not_interested</i></label>
        </div>
        <div class='input-field col s12 m6'>
            <span>Permiso ver datos estadisticos:</span>
            <input id='activo2' type='radio' name='ver_datos' class='with-gap' value='1' <?php print(($ver_datos == 1)?"checked":""); ?>/>
            <label for='activo2'><i class='material-icons left'>done</i></label>
            <input id='inactivo2' type='radio' name='ver_datos' class='with-gap' value='0' <?php print(($ver_datos == 0)?"checked":""); ?>/>
            <label for='inactivo2'><i class='material-icons left'>not_interested</i></label>
        </div>
        <div class='input-field col s12 m6'>
            <span>Permiso gestionar promociones:</span>
            <input id='activo3' type='radio' name='promociones' class='with-gap' value='1' <?php print(($promociones == 1)?"checked":""); ?>/>
            <label for='activo3'><i class='material-icons left'>done</i></label>
            <input id='inactivo3' type='radio' name='promociones' class='with-gap' value='0' <?php print(($promociones == 0)?"checked":""); ?>/>
            <label for='inactivo3'><i class='material-icons left'>not_interested</i></label>
        </div>
        <div class='input-field col s12 m6'>
            <span>Permiso facturar:</span>
            <input id='activo4' type='radio' name='facturar' class='with-gap' value='1' <?php print(($facturar == 1)?"checked":""); ?>/>
            <label for='activo4'><i class='material-icons left'>done</i></label>
            <input id='inactivo4' type='radio' name='facturar' class='with-gap' value='0' <?php print(($facturar == 0)?"checked":""); ?>/>
            <label for='inactivo4'><i class='material-icons left'>not_interested</i></label>
        </div>
        <div class='input-field col s12 m6'>
            <span>Permiso modificar clientes:</span>
            <input id='activo5' type='radio' name='modificar_cliente' class='with-gap' value='1' <?php print(($modificar_cliente == 1)?"checked":""); ?>/>
            <label for='activo5'><i class='material-icons left'>done</i></label>
            <input id='inactivo5' type='radio' name='modificar_cliente' class='with-gap' value='0' <?php print(($modificar_cliente == 0)?"checked":""); ?>/>
            <label for='inactivo5'><i class='material-icons left'>not_interested</i></label>
        </div>
        <div class='input-field col s12 m6'>
            <span>Permiso modificar usuarios:</span>
            <input id='activo6' type='radio' name='modificar_usuario' class='with-gap' value='1' <?php print(($modificar_usuario == 1)?"checked":""); ?>/>
            <label for='activo6'><i class='material-icons left'>done</i></label>
            <input id='inactivo6' type='radio' name='modificar_usuario' class='with-gap' value='0' <?php print(($modificar_usuario == 0)?"checked":""); ?>/>
            <label for='inactivo6'><i class='material-icons left'>not_interested</i></label>
        </div>
       </div>
    <div class='row center-align'>
        <a href='index.php' class='btn waves-effect grey'><i class='material-icons'>cancel</i></a>
        <button type='submit' class='btn waves-effect blue'><i class='material-icons'>save</i></button>
    </div>
</form>
<!--se finaliza con el formulario-->
<?php
Page::footer();
?>