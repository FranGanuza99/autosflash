<?php
ob_start();
require("../lib/page.php");
Page::header("Iniciar sesión");

if (isset($_SESSION['nombre_usuario'])){
    header("location: index.php");
} 

//consulta los usuarios
$sql = "SELECT * FROM usuarios";
$data = Database::getRows($sql, null);
if($data == null)
{
    header("location: register.php");
}

//valida si el post esta vacio
if(!empty($_POST))
{
	$_POST = validator::validateForm($_POST);
  	$alias = $_POST['alias'];
  	$clave = $_POST['clave'];
  	try
    {
      	if($alias != "" && $clave != "")
  		{
            //Consulta los registros de usuario
  			$sql = "SELECT * FROM cargos_usuarios, usuarios WHERE usuarios.codigo_cargo = cargos_usuarios.codigo_cargo AND usuarios.usuario = ?";
		    $params = array($alias);
		    $data = Database::getRow($sql, $params);
		    if($data != null)
		    {
		    	$hash = $data['contrasenia_usuario'];
		    	if(password_verify($clave, $hash)) 
		    	{
			    	//Llenando variables de sesion
                    $_SESSION['cargo'] = $data['cargo_usuario'];
                    $_SESSION['id_usuario'] = $data['codigo_usuario'];
			      	$_SESSION['nombre_usuario'] = $data['nombre_usuario']." ".$data['apellido_usuario'];
                    $_SESSION['foto_perfil'] = $data['url_foto'];
                    header("location: index.php");
				}
				else 
				{
					throw new Exception("La clave ingresada es incorrecta");
				}
		    }
		    else
		    {
		    	throw new Exception("El alias ingresado no existe");
		    }
	  	}
	  	else
	  	{
	    	throw new Exception("Debe ingresar un alias y una clave");
	  	}
    }
    catch (Exception $error)
    {
        Page::showMessage(2, $error->getMessage(), null);
    }
}

?>
        
<!--primera fila-->
<div class="row">
    <!--columna del login-->
    <div class="col s12 m6 offset-m3">
        <br>
        <div class="card-panel">
            <h3 class="center-align">Iniciar Sesión</h3>
            <br>
            <!--Inicio del formulario-->
            <form method="post">
                <div class="row">
                    <div class='input-field col s12'>
                        <i class='material-icons prefix'>person_pin</i>
                        <input id='alias' type='text' name='alias' class='validate' required/>
                        <label for='alias'>Usuario</label>
                    </div>
                    <div class='input-field col s12'>
                        <i class='material-icons prefix'>security</i>
                        <input id='clave' type='password' name='clave' class="validate" required/>
                        <label for='clave'>Contraseña</label>
                    </div>
                </div>
                <!--botones-->
                <div class="row">
                    <div class="center">
                        <div class="center-sesion">
                            <button class="btn waves-effect waves-light green" type="submit" name="action">Iniciar Sesión
                                <i class="material-icons left">send</i>
                            </button>

                        </div>
                    </div>
                </div>
            </form>
            <br>
        </div>
    </div>
</div>

<!--Aqui se muestra el pie de pagina-->

<?php
Page::footer();
?>
        