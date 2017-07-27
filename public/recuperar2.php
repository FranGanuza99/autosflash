<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <!--Import Google Icon Font-->
        <link href="../css/icons.css" rel="stylesheet">
        <title>Recuperación de contraseña - Paso 2</title>
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="../css/icon.css"  media="screen,projection"/>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <!--  archivos css-->
        <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection"/>
        <link type="text/css" rel="stylesheet" href="css/mystyle-sheet.css" media="screen,projection"/>
        <link type="text/css" rel="stylesheet" href="../css/sweetalert2.min.css" media="screen,projection"/>
        <script type="text/javascript" src="../js/sweetalert2.min.js"></script>
    </head>
    <body>

        <?php
        //Aqui se muestra el menu
        include("inc/menu.php");
        //Se elanzan archivos necesarios
        require("../lib/page.php");

        //validar sesion
        if(isset($_SESSION['nombre_cliente'])){
            header('location: index.php');
        }

        //valida si el post esta vacio y enlaza las variables con el campo
        if(!empty($_POST))
        {
            $_POST = validator::validateForm($_POST);
            $clave = $_POST['clave'];
            try
            {
                //valida campos
                if($clave != "")
                {
                    //consulta al cliente ingresado
                    $sql = "SELECT * FROM clientes WHERE codigo_cliente = ?";
                    $params = array($_SESSION['id_cliente']);
                    $data = Database::getRow($sql, $params); 
                    $hash = $data['contrasenia'];
                    if(password_verify($clave, $hash)) 
                    {
                        $_SESSION['verifiacion'] = 1;
                        Page::showMessage(1, "Cuenta verificada correctamente", "recuperar3.php");
                    }
                    else 
                    {
                        throw new Exception("La clave ingresada es incorrecta");
                    }
                }
                else
                {
                    throw new Exception("Debe ingresar la cadena enviada a su correo");
                }
            }
            catch (Exception $error)
            {
                Page::showMessage(2, $error->getMessage(), null);
            }
        }
        ?>
        
        <!--Aqui comienza la pagina-->
        <div class="container">
            <!--primera fila-->
            <div class="row">
                <!--columna del login-->
                <div class="col s12 m6 offset-m3">
                    <br>
                    <div class="card-panel">
                        <h3 class="center-txt">Validación de usuario</h3>
                        <br>
                        <p>Revice su correo e ingrese la clave enviada.</p>
                        <!--Inicio del formulario-->
                        <form  method='post' autocomplete='off'>
                            <div class="input-field col s12">
                                <input id="clave" name="clave" type="text" class="validate" required/>
                                <label for="clave">Cadena:</label>
                            </div>
                            <!--botones-->
                            <div class="center">
                                <button type='submit' class='btn waves-effect'>Verificar</button>
                                <button type='submit' class='btn waves-effect'>Cancelar</button>
                            </div>
                        </form>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        
        <!--Aqui se muestra el pie de pagina-->
        <?php
        include("inc/footer.php");
        ?>
        

    </body>
</html>