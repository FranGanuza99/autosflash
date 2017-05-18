<?php
ob_start();
require("../lib/page.php");
Page::header("MODELOS DE VEHICULOS");

if(!empty($_POST))
{
	$search = trim($_POST['buscar']);
	$sql = "SELECT codigo_modelo, nombre_modelo, nombre_serie FROM modelos, series WHERE modelos.codigo_serie = series.codigo_serie AND nombre_modelo LIKE ? ORDER BY nombre_modelo";
	$params = array("%$search%");
}
else
{
	$sql = "SELECT codigo_modelo, nombre_modelo, nombre_serie FROM modelos, series WHERE modelos.codigo_serie = series.codigo_serie ORDER BY nombre_modelo";
	$params = null;
}
$data = Database::getRows($sql, $params);
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
			<th>MODELOS DE VEHICULO</th>
			<th>SERIES DE VEHICULO</th>
		</tr>
	</thead>
	<tbody>

<?php
	foreach($data as $row)
	{
		print("
        
			<tr>
				<td>".$row['nombre_modelo']."</td>
				<td>".$row['nombre_serie']."</td>
				<td>
					<a href='save.php?id=".$row['codigo_modelo']."' class='blue-text'><i class='material-icons'>mode_edit</i></a>
					<a href='delete.php?id=".$row['codigo_modelo']."' class='red-text'><i class='material-icons'>delete</i></a>
				</td>
			</tr>
		");
	}
	print("
		</tbody>
	</table>

	");
} //Fin de if que comprueba la existencia de registros.
else
{
	Page::showMessage(4, "No hay registros disponibles", "save.php");
}
Page::footer();
?>
