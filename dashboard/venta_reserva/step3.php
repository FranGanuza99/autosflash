<?php
ob_start();
require("../lib/page.php");
require("../../lib/zebra.php");
Page::header("Resumen de la venta");
$fecha = null;
$total = null;

if(empty($_GET['reserva'])) 
{
	//se declaran las variables
	$marca = null;
	$serie = null;
	$modelo = null;
	$precio = null;
	$tipo = null;
	$anio = null;
	$foto = null;

} else {
	$reserva = $_GET['reserva'];
	$sql = "SELECT * FROM vehiculos, reservaciones WHERE vehiculos.codigo_vehiculo=reservaciones.codigo_vehiculo AND reservaciones.estado_reserva=1 AND reservaciones.codigo_reserva= ?";
	$params = array($reserva);
	$data = Database::getRow($sql, $params);
	$auto = $data['codigo_vehiculo'];
	$cliente = $data['codigo_cliente'];

	//se hace un select del vehiculo
	$sql = "SELECT * FROM vehiculos, fotos_vehiculos, marcas, series, modelos, tipos_vehiculos WHERE tipos_vehiculos.codigo_tipo_vehiculo = vehiculos.codigo_tipo_vehiculo AND fotos_vehiculos.codigo_vehiculo = vehiculos.codigo_vehiculo AND marcas.codigo_marca = series.codigo_marca AND series.codigo_serie = modelos.codigo_serie AND modelos.codigo_modelo = vehiculos.codigo_modelo AND cantidad_disponible > 0 AND fotos_vehiculos.codigo_tipo_foto = 1 AND estado_vehiculo = 1 AND vehiculos.codigo_vehiculo = ?";
	$params = array($auto);
	$data = Database::getRow($sql, $params);

	$marca = $data['marca'];
	$serie = $data['nombre_serie'];
	$modelo = $data['nombre_modelo'];
	$precio = $data['precio_vehiculo'];
	$tipo = $data['tipo_vehiculo'];
	$anio = $data['anio_vehiculo'];
	$imagen = $data['url_foto'];
	$cantidad = $data['cantidad_disponible'];
	$estadov = $data['estado'];
}

if(empty($_GET['reserva'])) 
{
	$nombre = null;
	$apellido = null;
	$correo = null;
	$dui = null;
	$nit = null;
	$telefono = null;
	$foto = null;

} else {
	//se hace un select del cliente
	$sql = "SELECT * FROM clientes WHERE codigo_cliente = ?";
	$params = array($cliente);
	$data = Database::getRow($sql, $params);

	$nombre = $data['nombre_cliente'];
	$apellido = $data['apellido_cliente'];
	$correo = $data['correo_cliente'];
	$dui = $data['dui_cliente'];
	$nit = $data['nit_cliente'];
	$telefono = $data['telefono_cliente'];
	$foto = $data['foto'];
	$estadoc = $data['estado_cliente'];

	$date = getdate();
    $fecha = $date['year'].'-'.$date['mon'].'-'.$date['mday'];
}

if(!empty($_POST))
{
	try {
		if ($cantidad > 0) {
			if ($estadoc > 0 ) {
				if ($estadov > 0 ) {
					//inserta datos nuevos
					$sql = "INSERT INTO facturas(codigo_cliente, codigo_vehiculo, fecha_factura, codigo_usuario) VALUES(?, ?, ?, ?)";
					$params = array($cliente, $auto, $fecha, $_SESSION['id_usuario']);
					if(Database::executeRow($sql, $params))
					{
						$cantidad = $cantidad - 1;
						$sql = "UPDATE vehiculos SET cantidad_disponible = ? WHERE codigo_vehiculo = ?";
						$params = array($cantidad, $auto);
						Database::executeRow($sql, $params);
						$sql = "UPDATE reservaciones SET estado_reserva = 0 WHERE codigo_reservacion = ?";
						$params = array($reserva);
						Database::executeRow($sql, $params);
						Page::showMessage(1, "Operación satisfactoria", "../ventas/index.php");
					}
				} else {
					throw new Exception("El vehiculo se encuentra en estado inactivo.");
				}

			} else {
				throw new Exception("El cliente se encuentra en estado inactivo.");
			}
			
		} else {
			throw new Exception("Por el momento la empresa no cuenta con autos disponibles de este modelo.");
		}
	} catch (Exception $error) {
		Page::showMessage(2, $error->getMessage(), null);
	}
} 
//se crea el formulario adicionalmente se le asignas las variables para que posteriormente sean capturados los valores
?>
<form method='post' enctype='multipart/form-data'>
	<div class='row'>
		<div class='row'>
			<h4 class='center-align'>Información del automovil</h4>
			<br>
			<div class='row'>
				<div class="col s12 m3 offset-m4">
					<?php print("<img src='data:image/*;base64,".$imagen."' class='materialboxed circle' width='300' height='220'>");?>
				</div>
			</div>
			<div class='input-field col s12 m6'>
				<i class='material-icons prefix'>note_add</i>
				<input id='marca' type='text' name='marca' value='<?php print($marca); ?>' readonly />
				<label for='marca'>Marca</label>
			</div>
			<div class='input-field col s12 m6'>
				<i class='material-icons prefix'>description</i>
				<input id='serie' type='text' name='serie' value='<?php print($serie); ?>' readonly/>
				<label for='serie'>Serie</label>
			</div>
			<div class='input-field col s12 m6'>
				<i class='material-icons prefix'>description</i>
				<input id='modelo' type='text' name='modelo' value='<?php print($modelo); ?>' readonly/>
				<label for='modelo'>Modelo</label>
			</div>
			<div class='input-field col s12 m6'>
				<i class='material-icons prefix'>note_add</i>
				<input id='anio' type='number' name='anio' value='<?php print($anio); ?>' readonly/>
				<label for='anio'>Año</label>
			</div>
			<div class='input-field col s12 m6'>
				<i class='material-icons prefix'>note_add</i>
				<input id='precio' type='number' name='precio' value='<?php print($precio); ?>' readonly/>
				<label for='precio'>Precio ($)</label>
			</div>
			<div class='input-field col s12 m6'>
				<i class='material-icons prefix'>note_add</i>
				<input id='tipo' type='text' name='tipo' value='<?php print($tipo); ?>' readonly/>
				<label for='tipo'>Tipo</label>
			</div>
		</div>
		<br>
		<br>
		<div class='row'>
        	<h4 class='center-align'>Información del cliente</h4>
			<br>
			<div class='input-field col s12 m6'>
				<i class='material-icons prefix'>note_add</i>
				<input id='nombre' type='text' name='nombre' value='<?php print($nombre); ?>' readonly/>
				<label for='nombre'>Nombre</label>
			</div>
			<div class='input-field col s12 m6'>
				<i class='material-icons prefix'>description</i>
				<input id='apellido' type='text' name='apellido' value='<?php print($apellido); ?>' readonly/>
				<label for='apellido'>Apellido</label>
			</div>
			<div class='input-field col s12 m6'>
				<i class='material-icons prefix'>description</i>
				<input id='correo' type='email' name='correo' pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" value='<?php print($correo); ?>' readonly/>
				<label for='correo'>Correo</label>
			</div>
			<div class='input-field col s12 m6'>
				<i class='material-icons prefix'>description</i>
				<input id='correo' type='email' name='correo' pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" value='<?php print($correo); ?>' readonly/>
				<label for='correo'>Correo</label>
			</div>
			<div class='input-field col s12 m6'>
				<i class='material-icons prefix'>note_add</i>
				<input id='dui' type='text' name='dui' pattern='^[0-9]{8}-[0-9]{1}' value='<?php print($dui); ?>' readonly/>
				<label for='dui'>DUI</label>
			</div>
			<div class='input-field col s12 m6'>
				<i class='material-icons prefix'>note_add</i>
				<input id='nit' type='text' name='nit' pattern='^[0-9]{4}-[0-9]{6}-[0-9]{3}-[0-9]{1}' value='<?php print($nit); ?>' readonly/>
				<label for='nit'>NIT</label>
			</div>
		</div>
		<br>
		<br>
		<div class='row'>
			<h4 class='center-align'>Información de la compra</h4>
			<br>
			<div class='input-field col s12 m6'>
				<i class='material-icons prefix'>note_add</i>
				<input id='fecha' type='text' name='fecha' value='<?php print($fecha); ?>' readonly/>
				<label for='fecha'>Fecha</label>
			</div>
			<div class='input-field col s12 m6'>
				<i class='material-icons prefix'>note_add</i>
				<input id='usuario' type='text' name='usuario' value='<?php print($_SESSION['nombre_usuario']); ?>' readonly/>
				<label for='usuario'>Caja</label>
			</div>
		</div>
		<br>
		<br>
		<div class='row center-align'>
			<a href='step1.php' class='btn waves-effect grey'><i class='material-icons right'>cancel</i>Cancelar</a>
			<button type='submit' class='btn waves-effect blue'><i class="material-icons right">send</i>Siguiente</button>
		</div>
	</div>
</form>

<?php
Page::footer();
?>

