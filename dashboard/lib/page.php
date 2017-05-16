<?php
require("../../lib/database.php");
require("../../lib/validator.php");
class Page
{
	public static function header($title)
	{
		session_start();
		ini_set("date.timezone","America/El_Salvador");
		print("
			<!DOCTYPE html>
			<html lang='es'>
				<head>
					<meta charset='utf-8'/>
					<!--Import Google Icon Font-->
					
					<title>".$title. " - Dashboard</title>
					<!--Let browser know website is optimized for mobile-->
					<meta name='viewport' content='width=device-width, initial-scale=1.0'/>

					<!--  archivos css-->
					<link type='text/css' rel='stylesheet' href='../../css/materialize.min.css' media='screen,projection'/>
					<link type='text/css' rel='stylesheet' href='../../css/sweetalert2.min.css' media='screen,projection'/>
					<link type='text/css' rel='stylesheet' href='../../css/icons.css' media='screen,projection'/>
					<link type='text/css' rel='stylesheet' href='../css/dashboard.css' media='screen,projection'/>
					<script type='text/javascript' src='../../js/sweetalert2.min.js'></script>
				</head>
				<body>
		");
		if(isset($_SESSION['nombre_usuario']))
		{
			print("
				<ul class='side-nav fixed' id='mobile-menu'>
					<li class='user-details'>
						<div class='row'>
							<div class='col col s4 m4 l4'>
								<img id='profile' src='data:image/*;base64,".$_SESSION['foto_perfil']."' alt=' class='circle responsive-img valign profile-image'>
							</div>
							<div class='col col s8 m8 l8 '>

								<ul id='profile-dropdown' class='dropdown-content'>
									<li><a href='../main/profile.php'><i class='user-icons material-icons'>person</i> Perfil</a>
									</li>
									<li><a href='#'><i class='user-icons material-icons'>settings</i> Ajustes</a>
									</li>
									<li><a href='#'><i class='user-icons material-icons'>live_help</i> Ayuda</a>
									</li>
									<li class='divider'></li>
									<li><a href='../main/logout.php'><i class='user-icons material-icons'>input</i> Salir</a>
									</li>
								</ul>
								<a class='btn-flat dropdown-button waves-effect waves-light white-text profile-btn'  data-activates='profile-dropdown'>".$_SESSION['nombre_usuario']."<i class='tiny material-icons right'>details</i></a>
								<p class='user-roal'>".$_SESSION['cargo']."</p>
							</div>
						</div>
					</li>
					<li class=bold active><i class='material-icons iconos-menu'>dashboard</i><a href='../main/index.php' class='waves-effect waves-teal'>Dashboard</a></li>
					<li class=bold><i class='material-icons iconos-menu'>supervisor_account</i><a href='../usuarios/index.php' class='waves-effect waves-teal'>Usuarios</a></li>
					<li class=bold'>
					<ul class='collapsible collapsible-accordion'>
						<li class='bold'><i class='material-icons iconos-menu'>contacts</i><a href='../proveedores/index.php' class='waves-effect waves-teal'>Proveedores</a>
						</li>
						<li class='bold'><i class='material-icons iconos-menu'>view_module</i><a class='collapsible-header  waves-effect waves-teal'>Vehiculos</a>
						<div class='collapsible-body'>
							<ul>
							<li><i class='material-icons sub-iconos'>keyboard_arrow_right</i><a class='sub-menu' href='../vehiculos/'> Todos los vehiculos</a></li>
							<li><i class='material-icons sub-iconos'>keyboard_arrow_right</i><a class='sub-menu' href='../marcas/'> Marcas</a></li>
							<li><i class='material-icons sub-iconos'>keyboard_arrow_right</i><a class='sub-menu' href='../series/'> Series</a></li>
							<li><i class='material-icons sub-iconos'>keyboard_arrow_right</i><a class='sub-menu' href='../modelos/'> Modelos</a></li>
							<li><i class='material-icons sub-iconos'>keyboard_arrow_right</i><a class='sub-menu' href='../tipos_vehiculos/'> Tipo de Vehiculos</a></li>
							</ul>
						</div>
						</li>
						<li class='bold'><i class='material-icons iconos-menu'>perm_identity</i><a class='waves-effect waves-teal'>Clientes</a></li>
					</ul>
					</li>
					<li class='bold'><i class='material-icons iconos-menu'>library_books</i><a href='http://materializecss.com/mobile.html' class='waves-effect waves-teal'>Reservaciones</a></li>
					<li class='bold'><i class='material-icons iconos-menu'>shop</i><a href='showcase.html' class='waves-effect waves-teal'>Ventas</a></li>
					<li class='bold'><i class='material-icons iconos-menu'>list</i><a href='themes.html' class='waves-effect waves-teal'>Promociones</a></li>

				</ul>
			


				<div class='title'>
					<div class='navbar'>
						<nav class=''>
							<div class='nav-wrapper'>
								<a href='index.php' class='brand-logo'><h3 class='title-txt center-align black-text'>".$title."</h3></a>
								<a href='#' data-activates='mobile-menu' class='button-collapse'><i class='large material-icons black-text'>menu</i></a>   
							</div>
						</nav>  
					</div>
				</div>

				<div class='pagina'>

			");
		}
		else
		{
			
			print("
				<div class='navbar-fixed'>
					<nav id='out'>
						<div class='nav-wrapper blue' >
							<div class='container'>
							<a href='login.php' class='brand-logo'><i class='material-icons'>dashboard</i>Dashboard</a>
							</div>
						</div>
					</nav>
					
				</div>
				<div class='container'>
			");
			$filename = basename($_SERVER['PHP_SELF']);
			if($filename != "login.php" && $filename != "register.php")
			{
				self::showMessage(3, "¡Debe iniciar sesión!", "../main/login.php");
				self::footer();
				exit;
			}
			else
			{
				//print("<h3 class='center-align'>".$title."</h3>");
			}
		}
	}

	public static function footer()
	{
		if (isset($_SESSION['nombre_usuario'])) {
			print("
				</div>
				<div class = 'end'>");
		} else {
			print("
				</div>
				<div>");
		}
		print("
			
			
			<footer class='page-footer black'>
				<div class='container'>
					<div class='row'>
						<div class='col s12 m6'>
							<h5 class='white-text'>Dashboard</h5>
							<a class='white-text' href='mailto:dacasoft@outlook.com'><i class='material-icons left'>email</i>Ayuda</a>
						</div>
						<div class='col s12 m6'>
							<h5 class='white-text'>Enlaces</h5>
							<a class='white-text' href='../../public/' target='_blank'><i class='material-icons left'>store</i>Sitio público</a>
						</div>
					</div>
				</div>
				<div class='footer-copyright'>
					<div class='container'>
						<span>©".date(' Y ')."CoffeeCode, todos los derechos reservados.</span>
						<span class='white-text right'>Diseñado con <a class='red-text text-accent-1' href='http://materializecss.com/' target='_blank'><b>Materialize</b></a></span>
					</div>
				</div>
			</footer>
			</div>
			<script type='text/javascript' src='../../js/jquery-2.1.1.min.js'></script>
			<script type='text/javascript' src='../../js/materialize.min.js'></script>
			<script type='text/javascript' src='../js/myjs.js'></script>
			</body>
			</html>
		");
	}

	public static function setCombo($label, $name, $value, $query)
	{
		$data = Database::getRows($query, null);
		print("<select name='$name' required>");
		if($data != null)
		{
			if($value == null)
			{
				print("<option value='' disabled selected>Seleccione una opción</option>");
			}
			foreach($data as $row)
			{
				if(isset($_POST[$name]) == $row[0] || $value == $row[0])
				{
					print("<option value='$row[0]' selected>$row[1]</option>");
				}
				else
				{
					print("<option value='$row[0]'>$row[1]</option>");
				}
			}
		}
		else
		{
			print("<option value='' disabled selected>No hay registros</option>");
		}
		print("
			</select>
			<label>$label</label>
		");
	}

	public static function showMessage($type, $message, $url)
	{
		$text = addslashes($message);
		switch($type)
		{
			case 1:
				$title = "Éxito";
				$icon = "success";
				break;
			case 2:
				$title = "Error";
				$icon = "error";
				break;
			case 3:
				$title = "Advertencia";
				$icon = "warning";
				break;
			case 4:
				$title = "Aviso";
				$icon = "info";
		}
		if($url != null)
		{
			print("<script>swal({title: '$title', text: '$text', type: '$icon', confirmButtonText: 'Aceptar', allowOutsideClick: false, allowEscapeKey: false}).then(function(){location.href = '$url'})</script>");
		}
		else
		{
			print("<script>swal({title: '$title', text: '$text', type: '$icon', confirmButtonText: 'Aceptar', allowOutsideClick: false, allowEscapeKey: false})</script>");
		}
	}
}
?>