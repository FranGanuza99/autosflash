<?php
ob_start();
require("../lib/page.php");
require("../../lib/zebra.php");
Page::header("Histórico de ventas");

if(empty($_GET['id'])) 
{
	header('location: ../vehiculos/');
} else {
	$id = $_GET['id'];
}

//valida si el post esta vacio para la busqueda
if(!empty($_POST))
{
	$anio = $_POST['anio'];
	$fecha1 = $anio.'-'.'01-01';
	$fecha2 = $anio.'-'.'12-31';

	$orden = $_POST['orden'];

	$sql = "SELECT * FROM facturas, clientes, vehiculos, fotos_vehiculos WHERE
			facturas.codigo_cliente = clientes.codigo_cliente AND 
			facturas.codigo_vehiculo = vehiculos.codigo_vehiculo AND 
			vehiculos.codigo_vehiculo = fotos_vehiculos.codigo_vehiculo 
			AND fotos_vehiculos.codigo_tipo_foto =  1
			AND clientes.codigo_cliente = $id
			AND facturas.fecha_factura BETWEEN ? AND ? 
			ORDER BY codigo_factura $orden";
	$params = array($fecha1, $fecha2);
}
else
{
	$date = getdate();
	$anio = $date['year'];

	$order = "desc";

	$sql = "SELECT * FROM facturas, clientes, vehiculos, marcas, series, modelos, fotos_vehiculos WHERE
			facturas.codigo_cliente = clientes.codigo_cliente AND 
			facturas.codigo_vehiculo = vehiculos.codigo_vehiculo AND 
			vehiculos.codigo_vehiculo = fotos_vehiculos.codigo_vehiculo 
			AND fotos_vehiculos.codigo_tipo_foto =  1 AND clientes.codigo_cliente = $id ORDER BY codigo_factura desc";
	$params = null;
}

//ejecuta la consulta
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


<!-- Inicio del formulario -->
<form method='post'>
	<div class='row'>
		<div class='input-field col s6 m4'>
			<i class='material-icons prefix'>search</i>
			<select name='anio'>
				<option value="<?php print($anio); ?>"><?php print($anio); ?></option>
				<option value="<?php print($anio-1); ?>"><?php print($anio-1); ?></option>
				<option value="<?php print($anio-2); ?>"><?php print($anio-2); ?></option>
				<option value="<?php print($anio-3); ?>"><?php print($anio-3); ?></option>
				<option value="<?php print($anio-4); ?>"><?php print($anio-4); ?></option>
			</select>
		</div>
		<div class='input-field col s6 m4'>
			<select name='orden'>
				<option value="desc">Los más recientes</option>
				<option value="asc">Los más antiguos</option>
			</select>
			
		</div>
		<div class='input-field col s6 m2'>
			<button type='submit' class='btn waves-effect green'><i class='material-icons'>check_circle</i></button> 	
		</div>
	</div>
</form>
<!-- Encabezados de la tabla -->
<table class='striped'>
	<thead>
		<tr>
			<th>FOTO</th>
			<th>AUTOMOVIL</th>
			<th>PRECIO ($)</th>
			<th>CLIENTE</th>
			<th>TELEFONO</th>
			<th>FECHA</th>
		</tr>
	</thead>
	<tbody>

<?php
	//se muestran las filas de registros
	foreach($data as $row)
	{
		print("
        
			<tr>
				<td><img src='data:image/*;base64,".$row['url_foto']."' class='materialboxed' width='120' height='100'></td>
				<td>".$row['nombre_vehiculo']."</td>
				<td>".$row['precio_vehiculo']."</td>
				<td>".$row['nombre_cliente']." ".$row['apellido_cliente']."</td>
				<td>".$row['telefono_cliente']."</td>
				<td>".$row['fecha_factura']."</td>
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
	Page::showMessage(4, "No hay registros disponibles", "index.php");
}

//se muestra el footer
Page::footer();
?>