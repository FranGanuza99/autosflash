<?php
ob_start();
require("../lib/page.php");
require("../../lib/zebra.php");
Page::header("Vehiculos disponibles");
$id = $_GET['id'];

//validando permisos
global $facturar;
if($facturar == 0){
	header("location: ../ventas/index.php");
}

//se hace un select de todos los vehiculos
if(!empty($_POST))
{
	//se crea un buscador
	$search = trim($_POST['buscar']);
	$sql = "SELECT* FROM vehiculos, fotos_vehiculos, marcas, series, modelos WHERE fotos_vehiculos.codigo_vehiculo = vehiculos.codigo_vehiculo AND marcas.codigo_marca = series.codigo_marca AND series.codigo_serie = modelos.codigo_serie AND modelos.codigo_modelo = vehiculos.codigo_modelo AND cantidad_disponible > 0 AND fotos_vehiculos.codigo_tipo_foto = 1 AND estado_vehiculo = 1 AND nombre_vehiculo LIKE ? ";
	$params = array("%$search%");
}
else
{
	$sql = "SELECT * FROM vehiculos, fotos_vehiculos, marcas, series, modelos WHERE fotos_vehiculos.codigo_vehiculo = vehiculos.codigo_vehiculo AND marcas.codigo_marca = series.codigo_marca AND series.codigo_serie = modelos.codigo_serie AND modelos.codigo_modelo = vehiculos.codigo_modelo AND cantidad_disponible > 0 AND fotos_vehiculos.codigo_tipo_foto = 1 AND estado_vehiculo = 1";
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
			<th>IMEGEN</th>
			<th>MARCA</th>
			<th>SERIE</th>
			<th>MODELO</th>
			<th>PRECIO ($)</th>
			<th>CANTIDAD</th>
			<th>AÑO</th>
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
				<td><img src='data:image/*;base64,".$row['url_foto']."' class='materialboxed' width='120' height='100'></td>
				<td>".$row['marca']."</td>
				<td>".$row['nombre_serie']."</td>
				<td>".$row['nombre_modelo']."</td>
				<td>".$row['precio_vehiculo']."</td>
				<td>".$row['cantidad_disponible']."</td>
				<td>".$row['anio_vehiculo']."</td>
				<td>
					<a href='step3.php?id=".$id."&auto=".$row['codigo_vehiculo']."' class='blue-text'><i class='material-icons'>done</i></a>
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

