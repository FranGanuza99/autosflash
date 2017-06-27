<?php
ob_start();
require("../lib/page.php");
Page::header("Eliminar Marca de Vehiculo");
//se capturan los id para eliminar la marca en especifico
if(!empty($_GET['id'])) 
{
    $id = $_GET['id'];
}
else
{
    header("location: index.php");
}
//se ejecuta el delete  y acontinuacion se redirecciona
if(!empty($_POST))
{
	$id = $_POST['id'];
	try 
	{
		$sql = "DELETE FROM marcas WHERE codigo_marca = ?";
	    $params = array($id);
	    if(Database::executeRow($sql, $params))
		{
			Page::showMessage(1, "Registro eliminado correctamente", "index.php");
		}
	}
	catch (Exception $error) 
	{
		Page::showMessage(2, $error->getMessage(), "index.php");
	}
}
?>
<form method='post'>
	<div class='row center-align'>
		<input type='hidden' name='id' value='<?php print($id); ?>'/>
		<button type='submit' class='btn waves-effect red'><i class='material-icons'>remove_circle</i></button>
		<a href='index.php' class='btn waves-effect grey'><i class='material-icons'>cancel</i></a>
	</div>
</form>
<?php
Page::footer();
?>