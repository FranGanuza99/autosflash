<?php
ob_start();
require("../lib/page.php");
Page::header("Eliminar usuarios");

//valida si se ha obtenido el id
if(!empty($_GET['id'])) 
{
    $id = $_GET['id'];
}
else
{
    header("location: index.php");
}

//valida si el post esta vacio
if(!empty($_POST))
{
	//validacion al eliminar el mismo usuario
	if ($id == $_SESSION['id_usuario']){
		Page::showMessage(2, "No puede eliminar este usuario", null);
		header("location: index.php");
	} else {
		$id = $_POST['id'];
		try 
		{	
			//elimina el registro
			$sql = "DELETE FROM usuarios WHERE codigo_usuario = ?";
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
}
?>
<!-- inicio de formulario (botones) -->
<form method='post'>
	<div class='row center-align'>
		<input type='hidden' name='id' value='<?php print($id); ?>'/>
		<button type='submit' class='btn waves-effect red'><i class='material-icons'>remove_circle</i></button>
		<a href='index.php' class='btn waves-effect grey'><i class='material-icons'>cancel</i></a>
	</div>
</form>

<!-- Se muestra el footer -->
<?php
Page::footer();
?>