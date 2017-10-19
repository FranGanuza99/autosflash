<?php
ob_start();
require("../lib/page.php");
require("../../lib/zebra.php");
Page::header("Comentarios");

if(empty($_GET['id'])) 
{
	header('location: ../vehiculos/');
} else {
	$id = $_GET['id'];
}

//valida si el post esta vacio para la busqueda
if(!empty($_POST))
{
	$search = trim($_POST['buscar']);
	$sql = "SELECT * FROM comentarios, clientes WHERE comentarios.codigo_cliente = clientes.codigo_cliente AND comentarios.codigo_vehiculo = $id AND clientes.nombre_cliente LIKE ? ORDER BY codigo_comentario";
	$params = array("%$search%");
}
else
{
	$sql = "SELECT * FROM comentarios, clientes WHERE comentarios.codigo_cliente = clientes.codigo_cliente AND comentarios.codigo_vehiculo = $id ORDER BY codigo_comentario";
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
			<input id='buscar' type='text' name='buscar'/>
			<label for='buscar'>Buscar</label>
		</div>
		<div class='input-field col s6 m4'>
			<button type='submit' class='btn waves-effect green'><i class='material-icons'>check_circle</i></button> 	
		</div>
	</div>
</form>
<!-- Encabezados de la tabla -->
<table class='striped'>
	<thead>
		<tr>
			<th>CLIENTE</th>
			<th>COMENTARIO</th>
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
				<td>".$row['nombre_cliente']." ".$row['apellido_cliente']."</td>
				<td>".$row['comentario']."</td>
				<td>".$row['fecha']."</td>
				<td>
					<a href='delete.php?id=".$row['codigo_comentario']."' class='red-text'><i class='material-icons'>delete</i></a>
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
	Page::showMessage(4, "No hay registros disponibles", null);
}

//se muestra el footer
Page::footer();
?>