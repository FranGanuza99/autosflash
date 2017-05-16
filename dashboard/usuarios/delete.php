<?php
ob_start();
require("../lib/page.php");
Page::header("Eliminar usuarios");

if(!empty($_GET['id'])) 
{
    $id = $_GET['id'];
}
else
{
    header("location: index.php");
}

if(!empty($_POST))
{
	if ($id == $_SESSION['id_usuario']){
		Page::showMessage(2, "No puede eliminar este usuario", null);
		header("location: index.php");
	} else {
		$id = $_POST['id'];
		try 
		{
			$sql = "UPDATE usuarios set estado_usuario = 0 where codigo_usuario = ?";
			$params = array($id);
			Database::executeRow($sql, $params);
			header("location: index.php");
		}
		catch (Exception $error) 
		{
			Page::showMessage(2, $error->getMessage(), "index.php");
		}
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