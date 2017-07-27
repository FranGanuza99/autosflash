<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <!--Import Google Icon Font-->
        <link href="../css/icons.css" rel="stylesheet">
        <title>Recuperación de contraseña - Paso 1</title>
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
        include "../lib/phpmailer/class.phpmailer.php";
        include "../lib/phpmailer/class.smtp.php";


        //validar inicio de sesion
        if(isset($_SESSION['nombre_cliente'])){
            header('location: index.php');
        }

        //valida si el post esta vacio y enlaza las variables con el campo
        if(!empty($_POST))
        {
            $_POST = validator::validateForm($_POST);
            $correo = $_POST['correo'];
            try
            {
                //valida campos
                if($correo != "")
                {
                    //consulta al cliente ingresado
                    $sql = "SELECT * FROM clientes WHERE clientes.correo_cliente = ?";
                    $params = array($correo);
                    $data = Database::getRow($sql, $params);
                    $codigo = $data['codigo_cliente'];
                    $nombres = $data['nombre_cliente']." ".$data['apellido_cliente'];
                    if($data != null)
                    {   
                        $clave_provicional = Validator::generarCodigo(8);
                        $clave = password_hash($clave_provicional, PASSWORD_DEFAULT);
                        $sql = "UPDATE clientes set contrasenia = ? WHERE correo_cliente = ? AND codigo_cliente = ?";
                        $params = array($clave, $correo, $codigo);
                        if(Database::executeRow($sql, $params))
                        {
                            $email_user = "noreply.autosflash@gmail.com";
                            $email_password = "Expo2017";
                            $the_subject = "Recuperar cuenta";
                            $address_to = $correo;
                            $from_name = "Autosflash Services";
                            $phpmailer = new PHPMailer();
                            // ---------- datos de la cuenta de Gmail -------------------------------
                            $phpmailer->Username = $email_user;
                            $phpmailer->Password = $email_password; 
                            //-----------------------------------------------------------------------
                            // $phpmailer->SMTPDebug = 1;
                            $phpmailer->SMTPSecure = 'ssl';
                            $phpmailer->Host = "smtp.gmail.com"; // GMail
                            $phpmailer->Port = 465;
                            $phpmailer->IsSMTP(); // use SMTP
                            $phpmailer->SMTPAuth = true;
                            $phpmailer->setFrom($phpmailer->Username,$from_name);
                            $phpmailer->AddAddress($address_to); // recipients email
                            $phpmailer->Subject = $the_subject;	
                            $phpmailer->Body .="<h1 style='color:#3498db;'>Hola ".$nombres."</h1>";
                            $phpmailer->Body .= "<p>Tu codigo es: ".$clave_provicional."</p>";
                            $phpmailer->Body .= "<p>Fecha y Hora: ".date("d-m-Y h:i:s")."</p>";
                            $phpmailer->IsHTML(true);
                            
                            try {
                                $phpmailer->Send();
                                $_SESSION['id_cliente'] = $data['codigo_cliente'];
                                $_SESSION['verifiacion'] = 0;
                                header('location: recuperar2.php');                             
                            } catch (Exception $exec){
                                Page::showMessage(2, $error->getMessage(), null);
                            }
                            

                            
                        }
                    }
                    else
                    {
                        throw new Exception("El correo ingresado no existe");
                    }
                }
                else
                {
                    throw new Exception("Debe ingresar su correo.");
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
                        <h3 class="center-txt">Recuperar contraseña</h3>
                        <br>
                        <p>A continuación ingrese su correo electrónico. Se enviará un código a su cuenta de correo electronico que deberá ser confirmado en la siguiente ventana.</p>
                        <!--Inicio del formulario-->
                        <form  method='post' autocomplete='off'>
                            <div class="input-field col s12">
                                <input type="email" id="correo" name="correo" class="validate" required/>
                                <label for="correo">Correo eléctronico:</label>
                            </div>                        
                            <!--botones-->
                            <div class="center">
                                <button type='submit' class='btn waves-effect'>Continuar</button>
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