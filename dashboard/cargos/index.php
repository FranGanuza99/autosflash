<?php
require("../lib/page.php");
Page::header("Cargos");
//se consultan las clases para mostrarlas o caso contrario redireccione al save.php
if(!empty($_POST))
{
	$search = trim($_POST['buscar']);
	$sql = "SELECT * FROM cargos_usuarios WHERE cargo_usuario LIKE ? ORDER BY codigo_cargo";
	$params = array("%$search%");
}
else
{
	$sql = "SELECT * FROM cargos_usuarios  ORDER BY cargo_usuario";
	$params = null;
}
$data = Database::getRows($sql, $params);
if($data != null)
{
?>
<!--se crea el diseño del index para acontinuacion cargar los datos en la tabla-->
<form method='post'>
	<div class='row'>
		<div class='input-field col s6 m4'>
			<i class='material-icons prefix'>search</i>
			<input id='buscar' type='text' name='buscar'/>
			<label for='buscar'>Buscar clase por nombre</label>
		</div>
		<div class='input-field col s6 m4'>
			<button type='submit' class='btn tooltipped waves-effect green' data-tooltip='Busca por nombre'><i class='material-icons'>check_circle</i></button>
		</div>
		<div class='input-field col s12 m4'>
			<a href='save.php' class='btn waves-effect indigo'><i class='material-icons'>add_circle</i></a>
		</div>
	</div>
</form>
<table class='striped'>
	<thead>
		<tr>
			<th>CARGOS</th>
			<th>AGREGAR VEHICULO</th>
			<th>AGREGAR USUARIO</th>
			<th>VER DATOS</th>
			<th>AGREGAR PROMOCIONES</th>
			<th>FACTURAR</th>
			<th>MODIFICAR CLIENTE</th>
			<th>MODIFICAR USUARIO</th>
		</tr>
	</thead>
	<tbody>

<?php
//se cargan los datos y los if son para verificar si hay clases ese dia
	foreach($data as $row)
	{
		print("
			<tr>
				<td>".$row['cargo_usuario']."</td>
				<td>
		");
		if($row['permiso_agregar_vehiculos'] == 1)
		{
			print("<i class='material-icons'>done</i>");
		}
		else
		{
			print("<i class='material-icons'>not_interested</i>");
		}
		if($row['permiso_agregar_usuario'] == 1)
		{
			print("</td><td><i class='material-icons'>done</i>");
		}
		else
		{
			print("</td><td><i class='material-icons'>not_interested</i>");
		}
		if($row['permiso_datos_estadisticos'] == 1)
		{
			print("</td><td><i class='material-icons'>done</i>");
		}
		else
		{
			print("</td><td><i class='material-icons'>not_interested</i>");
		}
		if($row['permiso_agregar_promociones'] == 1)
		{
			print("</td><td><i class='material-icons'>done</i>");
		}
		else
		{
			print("</td><td><i class='material-icons'>not_interested</i>");
		}
		if($row['permiso_facturar'] == 1)
		{
			print("</td><td><i class='material-icons'>done</i>");
		}
		else
		{
			print("</td><td><i class='material-icons'>not_interested</i>");
		}
		if($row['permiso_modificar_cliente'] == 1)
		{
			print("</td><td><i class='material-icons'>done</i>");
		}
		else
		{
			print("</td><td><i class='material-icons'>not_interested</i>");
		}
		if($row['permiso_modificar_usuario'] == 1)
		{
			print("</td><td><i class='material-icons'>done</i>");
		}
		else
		{
			print("</td><td><i class='material-icons'>not_interested</i>");
		}
		print("
				</td>
				<td>
					<a href='save.php?id=".$row['codigo_cargo']."' class='blue-text'><i class='material-icons'>edit</i></a>
					<a href='delete.php?id=".$row['codigo_cargo']."' class='red-text'><i class='material-icons'>delete</i></a>
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