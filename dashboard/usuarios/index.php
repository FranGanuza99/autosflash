<?php
ob_start();
require("../lib/page.php");
Page::header("Usuarios");

//valida si el post esta vacio para la busqueda
if(!empty($_POST))
{
	$search = trim($_POST['buscar']);
	$sql = "SELECT * FROM usuarios, cargos_usuarios WHERE usuarios.codigo_cargo = cargos_usuarios.codigo_cargo AND nombre_usuario LIKE ? ORDER BY nombre_usuario";
	$params = array("%$search%");
}
else
{
	$sql = "SELECT * FROM usuarios, cargos_usuarios WHERE usuarios.codigo_cargo = cargos_usuarios.codigo_cargo ORDER BY nombre_usuario";
	$params = null;
}
//ejecuta la consulta
$data = Database::getRows($sql, $params);
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
			<th>CORREO</th>
			<th>CARGO</th>
		</tr>
	</thead>
	<tbody>

<?php
	//se muestran las filas de registros
	foreach($data as $row)
	{
		print("
        
			<tr>
				<td><img src='data:image/*;base64,".$row['url_foto']."' class='materialboxed' width='100' height='100'></td>
				<td>".$row['nombre_usuario']." ".$row['apellido_usuario']."</td>
				<td>".$row['correo_usuario']."</td>
				<td>".$row['cargo_usuario']."</td>
				
				<td>
					<a href='save.php?id=".$row['codigo_usuario']."' class='blue-text'><i class='material-icons'>mode_edit</i></a>
					<a href='delete.php?id=".$row['codigo_usuario']."' class='red-text'><i class='material-icons'>delete</i></a>
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

//se muestra el footer
Page::footer();
?>