<?php
//reiniciar header
ob_start();
require("../lib/page.php");

//asignacion del titulo
Page::header("Agregar Imagenes");
$id = $_GET['id'];

?>

<!-- Aqui inicia los paneles -->
<div class= 'card-panel'>
	<h2>Fotos principales</h2>
	<?php
		print("
		<a href='save1.php?id=$id' class='waves-effect waves-light btn'><i class='material-icons left'>add</i>Agregar</a>
		<div id='imagesv' class='row'>
		");

		//consulta de la foto en fotos_vehiculos
		$sql1 = "SELECT url_foto FROM fotos_vehiculos, tipos_fotos WHERE tipos_fotos.codigo_tipo_foto = fotos_vehiculos.codigo_tipo_foto and codigo_vehiculo = ? and fotos_vehiculos.codigo_tipo_foto = 1";
		$params = array($id);
		$data1 = Database::getRows($sql1, $params);

		//consulta de las fotos de vehiculo
		$sql2 = "SELECT foto_general1, foto_general2, foto_general3 FROM vehiculos WHERE codigo_vehiculo =?";
		$data2 = Database::getRows($sql2, $params);

		//mostrando la primer imagen
		if($data1 != null)
		{
			foreach($data1 as $row1)
			{
				print("
					<div class= 'col s12 m3 l3'>
						<img src='data:image/*;base64,$row1[url_foto]' class='materialboxed' width='150' height='150'>
					</div>
				");
			}
		} else {
		
		}

		//mostrando las imagenes
		if($data2 != null)
		{
			foreach($data2 as $row2)
			{
				if ($row2['foto_general1'] == null || $row2['foto_general2'] == null || $row2['foto_general3'] == null ) {
					print("<div class='card-panel yellow'><i class='material-icons left'>warning</i>No hay registros disponibles en este momento.</div>");
				} else {
					print("
						<div class= 'col s12 m3 l3'>
							<img src='data:image/*;base64,$row2[foto_general1]' class='materialboxed' width='150' height='150'>
						</div>
						<div class= 'col s12 m3 l3'>
							<img src='data:image/*;base64,$row2[foto_general2]' class='materialboxed' width='150' height='150'>
						</div>
						<div class= 'col s12 m3 l3'>
							<img src='data:image/*;base64,$row2[foto_general3]' class='materialboxed' width='150' height='150'>
						</div>
					");
				}
				
			}
		} else {
			
		}
	?>
	</div>
</div>

<!-- Siguiente panel -->
<div class= 'card-panel'>
	<h2>Galeria</h2>
	<?php
		print("
		<a href='vista.php?id=$id' class='waves-effect waves-light btn'><i class='material-icons left'>add</i>Ver imagenes</a>
		<div id='imagesv' class='row'>
		");

		//consulta de las fotos de galeria
		$sql = "SELECT url_foto FROM fotos_vehiculos, tipos_fotos WHERE tipos_fotos.codigo_tipo_foto = fotos_vehiculos.codigo_tipo_foto and codigo_vehiculo = ? and fotos_vehiculos.codigo_tipo_foto = 2";
		$params = array($id);
		$data = Database::getRows($sql, $params);

		//mostrando imagenes
		if($data != null)
		{
			foreach($data as $row)
			{
				print("
					<div class= 'col s12 m3 l3'>
						<img src='data:image/*;base64,$row[url_foto]' class='materialboxed' width='150' height='150'>
					</div>
				");
			}
		} else {
			print("<div class='card-panel yellow'><i class='material-icons left'>warning</i>No hay registros disponibles en este momento.</div>");
		}
	?>
	</div>
</div>

<!-- Siguiente paginas -->
<div class= 'card-panel'>
	<h2>Slider</h2> 
	<?php
		print("
		<a href='vista.php?id=$id' class='waves-effect waves-light btn'><i class='material-icons left'>add</i>Ver imagenes</a>
		<div id='imagesv' class='row'>");

		//consulta del slider
		$sql = "SELECT url_foto FROM fotos_vehiculos, tipos_fotos WHERE tipos_fotos.codigo_tipo_foto = fotos_vehiculos.codigo_tipo_foto and codigo_vehiculo = ? and fotos_vehiculos.codigo_tipo_foto = 3";
		$params = array($id);
		$data = Database::getRows($sql, $params);

		//mostrando los registros
		if($data != null)
		{

			foreach($data as $row)
			{
				print("
					<div class= 'col s12 m3 l3'>
						<img src='data:image/*;base64,$row[url_foto]' class='materialboxed' width='150' height='100'>
					</div>
				");
			}
		} else {
			print("<div class='card-panel yellow'><i class='material-icons left'>warning</i>No hay registros disponibles en este momento.</div>");
		}
	?>
	</div>
</div>

<!-- mostrando el footer -->
<?php
Page::footer();
?>

