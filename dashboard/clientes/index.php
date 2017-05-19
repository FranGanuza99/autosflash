<?php
ob_start();
require("../lib/page.php");
require("../../lib/zebra.php");
Page::header("Clientes");

//valida si el post esta vacio para la busqueda
if(!empty($_POST))
{
	$search = trim($_POST['buscar']);
	$sql = "SELECT * FROM clientes WHERE nombre_cliente LIKE ? ORDER BY nombre_cliente";
	$params = array("%$search%");
}
else
{
	$sql = "SELECT * FROM clientes ORDER BY nombre_cliente";
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
<form method='post' >
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
<!-- Encabezados de la tabla -->
<table class='striped'>
	<thead>
		<tr>
			<th>IMAGEN</th>
			<th>NOMBRE</th>
			<th>DUI</th>
			<th>TELEFONO</th>
			<th>EMAIL</th>
		</tr>
	</thead>
	<tbody>

<?php
	//se muestran las filas de registros
	foreach($data as $row)
	{
		print("
        
			<tr>
				<td><img src='data:image/*;base64,".$row['foto']."' class='materialboxed' width='100' height='100'></td>
				<td>".$row['nombre_cliente']." ".$row['apellido_cliente']."</td>
				<td>".$row['dui_cliente']."</td>
				<td>".$row['telefono_cliente']."</td>
				<td>".$row['correo_cliente']."</td>
				<td>
		");
		
		if($row['estado_cliente'] == 1)
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
					<a href='save.php?id=".$row['codigo_cliente']."' class='blue-text'><i class='material-icons'>mode_edit</i></a>
					<a href='delete.php?id=".$row['codigo_cliente']."' class='red-text'><i class='material-icons'>delete</i></a>
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

//se muestra el footer
Page::footer();
?>