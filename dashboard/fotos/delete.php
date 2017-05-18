<?php
//reiniciar header
ob_start();
require("../lib/page.php");
Page::header("Eliminar Imagen");

//valida si se selecciono un registro
if(!empty($_GET['id'])) 
{
    $id = $_GET['id'];
}
else
{
    header("location: index.php");
}

//valida si post esta vacio
if(!empty($_POST))
{
	$id = $_POST['id'];
	try 
	{
		$sql = "DELETE FROM fotos_vehiculos WHERE codigo_foto = ?";
	    $params = array($id);
	    Database::executeRow($sql, $params);
	    header("location: index.php");
	}
	catch (Exception $error) 
	{
		Page::showMessage(2, $error->getMessage(), "index.php");
	}
}
?>

<!-- Inicio de formulario-->
<form method='post'>
	<div class='row center-align'>
		<input type='hidden' name='id' value='<?php print($id); ?>'/>
		<button type='submit' class='btn waves-effect red'><i class='material-icons'>remove_circle</i></button>
		<a href='index.php' class='btn waves-effect grey'><i class='material-icons'>cancel</i></a>
	</div>
</form>

<!-- Llamada a footer-->
<?php
Page::footer();
?>