<?php
ob_start();
require("../lib/page.php");

Page::header("Agregar Imagenes");
$id = $_GET['id'];

    


?>

<div class= 'card-panel'>
<h2>Galeria</h2>
<?php
	print("
	<a href='save.php?id=$id' class='waves-effect waves-light btn'><i class='material-icons left'>add</i>Agregar</a>
	<div class='row'>
	");

	$sql = "SELECT url_foto FROM fotos_vehiculos, tipos_fotos WHERE tipos_fotos.codigo_tipo_foto = fotos_vehiculos.codigo_tipo_foto and codigo_vehiculo = ? and fotos_vehiculos.codigo_tipo_foto = 1";
	$params = array($id);
	$data = Database::getRow($sql, $params);

	if($data != null)
	{
		foreach($data as $row)
		{
			print("
				<div class= 'col s12 m3 l3'>
					<img src='data:image/*;base64,".$data['url_foto']."' class='materialboxed' width='150' height='150'>
				</div>
			");
		}
	} else {

	}
?>
</div>
</div>

<div class= 'card-panel'>
	<h2>Slider</h2> 
<?php
		print("
		<a href='save.php?id=$id' class='waves-effect waves-light btn'><i class='material-icons left'>add</i>Agregar</a>
		<div class='row'>");

		$sql = "SELECT url_foto FROM fotos_vehiculos, tipos_fotos WHERE tipos_fotos.codigo_tipo_foto = fotos_vehiculos.codigo_tipo_foto and codigo_vehiculo = ? and fotos_vehiculos.codigo_tipo_foto = 2";
		$params = array($id);
		$data = Database::getRow($sql, $params);

		if($data != null)
		{

			foreach($data as $row)
			{
				print("
					<div class= 'col s12 m3 l3'>
						<img class='activator' src='data:image/*;base64,$data[url_foto]' width=150 heigh=150>
					</div>
				");
			}
		} else {

		}
	?>
</div>
</div>


<?php
Page::footer();
?>

