<?php
ob_start();
require("../lib/page.php");
require("../../lib/zebra.php");
Page::header("Vehiculos");
//se hace un select de todos los vehiculos
//se inicia conexion
if(!empty($_POST))
{
	//se crea un buscador
	$search = trim($_POST['buscar']);
	$sql = "SELECT* FROM vehiculos AND nombre_vehiculo LIKE ? ";
	$params = array("%$search%");
}
else
{
	$sql = "SELECT * FROM vehiculos ";
	$params = null;
}
//se guarda la informacion en la variable data
$data = Database::getRows($sql, $params);

//obtenemos el numero de filas y cantidad maxima
$num_registros = count($data); 
$resul_x_pagina = 10; 

//instanciando la clase y enviando parametros
$paginacion = new Zebra_Pagination(); 
$paginacion->records($num_registros); 
$paginacion->records_per_page($resul_x_pagina);

//Consulta utilizando limit
$consulta = $sql.' LIMIT '.(($paginacion->get_page() - 1) * $resul_x_pagina). ',' .$resul_x_pagina;
//ejecuta la consulta
$data = Database::getRows($consulta, $params);

if($data != null)
{
?>
<form method='post'>
	<div class='row'>
		<div class='input-field col s6 m4'>
			<i class='material-icons prefix'>search</i>
			<input id='buscar' type='text' name='buscar'/>
			<label for='buscar'>Buscar</label>
		</div>
		<div class='input-field col s6 m4'>
			<button type='submit' class='btn waves-effect green'><i class='material-icons'>check_circle</i></button> 	
		</div>
		<div class='input-field col s12 m4'>
			<a href='save.php' class='btn waves-effect indigo'><i class='material-icons'>add_circle</i></a>
		</div>
	</div>
</form>
<table class='striped'>
	<thead>
		<tr>
			<th>NOMBRE DE VEHICULO</th>
			<th>PRECIO DE VEHICULO ($)</th>
			<th>CANTIDAD DISPONIBLE</th>
			<th>AÑO DE VEHICULO ($)</th>
		</tr>
	</thead>
	<tbody>

<?php
//se recorre data y al final todo se muestra en una tabla
//se mandan los id
	foreach($data as $row)
	{
		print("
        
			<tr>
				<td>".$row['nombre_vehiculo']."</td>
				<td>".$row['precio_vehiculo']."</td>
				<td>".$row['cantidad_disponible']."</td>
				<td>".$row['anio_vehiculo']."</td>
				<td>
				");
		if($row['estado_vehiculo'] == 1)
		{
			print("<i class='material-icons'>visibility</i>");
		}
		else
		{
			print("<i class='material-icons'>visibility_off</i>");
		}
		print("
				</td>
				<td>
					<a href='save.php?id=".$row['codigo_vehiculo']."' class='blue-text'><i class='material-icons'>mode_edit</i></a>
					<a href='delete.php?id=".$row['codigo_vehiculo']."' class='red-text'><i class='material-icons'>delete</i></a>
					<a href='../fotos/index.php?id=".$row['codigo_vehiculo']."' class='green-text'><i class='material-icons'>view_quilt</i></a>
					<a href='../comentarios/index.php?id=".$row['codigo_vehiculo']."' class='yellow-text'><i class='material-icons'>comment</i></a>
				</td>
			</tr>
		");
	}
	print("
		</tbody>
	</table>

	");
	$paginacion->render();
} //Fin de if que comprueba la existencia de registros.
else
{
	Page::showMessage(4, "No hay registros disponibles", "save.php");
}
Page::footer();
?>

