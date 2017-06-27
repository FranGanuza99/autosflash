<?php
//reiniciar header
ob_start();
require("../lib/page.php");
Page::header("Eliminar Imagen");

//valida si se selecciono un registro
if(!empty($_GET['img'])) 
{
    $img = $_GET['img'];
	$id = $_GET['id'];
}
else
{
    header("location: index.php");
}

//valida si post esta vacio
if(!empty($_POST))
{
	$img= $_POST['img'];
	try 
	{
		$sql = "DELETE FROM fotos_vehiculos WHERE codigo_foto = ?";
	    $params = array($img);
	    if(Database::executeRow($sql, $params))
		{
			Page::showMessage(1, "Registro eliminado correctamente", "vista.php?id=$id");
		}
	}
	catch (Exception $error) 
	{
		Page::showMessage(2, $error->getMessage(), "index.php?id=$id");
	}
}
?>

<!-- Inicio de formulario-->
<form method='post'>
	<div class='row center-align'>
		<input type='hidden' name='img' value='<?php print($img); ?>'/>
		<button type='submit' class='btn waves-effect red'><i class='material-icons'>remove_circle</i></button>
		<?php print ("<a href='vista.php?id=$id' class='btn waves-effect grey'><i class='material-icons'>cancel</i></a>") ?>
	</div>
</form>

<!-- Llamada a footer-->
<?php
Page::footer();
?>