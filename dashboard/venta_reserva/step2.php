<?php
ob_start();
require("../lib/page.php");
require("../../lib/zebra.php");
Page::header("Reservas realizadas");

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
	$sql = "SELECT  reservaciones.codigo_reserva, clientes.foto, clientes.nombre_cliente,clientes.apellido_cliente,clientes.dui_cliente,vehiculos.nombre_vehiculo, vehiculos.precio_vehiculo FROM clientes,vehiculos, reservaciones WHERE clientes.codigo_cliente=reservaciones.codigo_cliente AND vehiculos.codigo_vehiculo =reservaciones.codigo_vehiculo AND reservaciones.estado_reserva=1 AND clientes.nombre_cliente LIKE ? ";
	$params = array("%$search%");
}
else
{
	$sql = "SELECT  reservaciones.codigo_reserva, clientes.foto, clientes.nombre_cliente,clientes.apellido_cliente,clientes.dui_cliente,vehiculos.nombre_vehiculo, vehiculos.precio_vehiculo FROM clientes,vehiculos, reservaciones WHERE clientes.codigo_cliente=reservaciones.codigo_cliente AND vehiculos.codigo_vehiculo =reservaciones.codigo_vehiculo AND reservaciones.estado_reserva=1";
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
			<th>FOTO</th>
			<th>NOMBRE</th>
			<th>APELLIDO</th>
			<th>DUI</th>
			<th>VEHICULO</th>
			<th>PRECIO($)</th>
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
				<td><img src='data:image/*;base64,".$row['foto']."' class='materialboxed' width='120' height='100'></td>
				<td>".$row['nombre_cliente']."</td>
				<td>".$row['apellido_cliente']."</td>
				<td>".$row['dui_cliente']."</td>
				<td>".$row['nombre_vehiculo']."</td>
				<td>".$row['precio_vehiculo']."</td>
				<td>
					<a href='step3.php?reserva=".$row['codigo_reserva']."' class='blue-text'><i class='material-icons'>done</i></a>
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
	Page::showMessage(4, "No hay reservas disponibles", "../ventas/");
}
Page::footer();
?>

