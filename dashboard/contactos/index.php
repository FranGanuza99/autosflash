<?php
ob_start();
require("../lib/page.php");
require("../../lib/zebra.php");
Page::header("Consultas de usuarios");

//valida si el post esta vacio para la busqueda
if(!empty($_POST))
{
	$search = trim($_POST['buscar']);
	$sql = "SELECT * FROM contactos WHERE nombre_contacto LIKE ? ORDER BY nombre_contacto";
	$params = array("%$search%");
}
else
{
	$sql = "SELECT * FROM contactos ORDER BY codigo_contacto desc";
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
			<th>NOMBRE</th>
			<th>CORREO</th>
			<th>MENSAJE</th>
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
				<td>".$row['nombre_contacto']." ".$row['apellido_contacto']."</td>
				<td>".$row['correo_contacto']."</td>
				<td>".$row['mensaje']."</td>
				<td>".$row['fecha']."</td>
				
				<td>
					<a href='delete.php?id=".$row['codigo_contacto']."' class='red-text'><i class='material-icons'>delete</i></a>
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