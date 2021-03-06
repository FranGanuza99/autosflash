<?php
ob_start();
require("../lib/page.php");
require("../../lib/zebra.php");
Page::header("Series de vehiculos");

if(!empty($_POST))
{
	$search = trim($_POST['buscar']);
	$sql = "SELECT codigo_serie, nombre_serie, marca FROM series, marcas WHERE series.codigo_marca = marcas.codigo_marca AND nombre_serie LIKE ? ORDER BY nombre_serie";
	$params = array("%$search%");
}
else
{
	$sql = "SELECT codigo_serie, nombre_serie, marca FROM series, marcas WHERE series.codigo_marca = marcas.codigo_marca ORDER BY nombre_serie";
	$params = null;
}
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
			<th>SERIES DE VEHICULO</th>
			<th>MARCA DE VEHICULO</th>
		</tr>
	</thead>
	<tbody>

<?php
	foreach($data as $row)
	{
		print("
        
			<tr>
				<td>".$row['nombre_serie']."</td>
				<td>".$row['marca']."</td>
				<td>
					<a href='save.php?id=".$row['codigo_serie']."' class='blue-text'><i class='material-icons'>mode_edit</i></a>
					
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

