<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <!--Import Google Icon Font-->
        <link href="../css/icons.css" rel="stylesheet">
        <title>Editar perfil</title>
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
        //Enlaza los archivos necesarios
        
        require("../lib/page.php");
        ob_start();
        //calculo de fecha
        if(isset($_SESSION['id_cliente'])) 
        {
            
            $id = $_SESSION['id_cliente'];
            
            //realiza la consulta y llena las variavles con los datos de la consulta
            $sql = "SELECT * FROM clientes WHERE codigo_cliente = ?";
            $params = array($id);
            $data = Database::getRow($sql, $params);

            $nombres = $data['nombre_cliente'];
            $apellidos = $data['apellido_cliente'];
            $correo = $data['correo_cliente'];
            $dui = $data['dui_cliente'];
            $nit = $data['nit_cliente'];
            $telefono = $data['telefono_cliente'];
            $direccion = $data['direccion_cliente'];
            $estado = $data['estado_cliente'];
            $foto = $data['foto'];
            $hash = $data['contrasenia'];
        }
        else{
             Page::showMessage(2, "Inicie sesion", "sesion.php");
        }
       
        //valida si post esta vacio y asigna variables a los campos
        if(!empty($_POST))
        {
            $_POST = Validator::validateForm($_POST);
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $correo = $_POST['correo'];
            $dui = $_POST['dui'];
            $nit = $_POST['nit'];
            $telefono =$_POST['telefono'];
            $direccion =$_POST['direccion'];
            $archivo = $_FILES['foto'];

            try 
            {
                //validacion de campos
                if($nombres != "" && $apellidos != "")
                {
                    if($correo != "")
                    {
                        if($dui != "")
                        {
                            if($nit != "")
                            {
                                if($telefono != "")
                                {
                                    if ($direccion !="")
                                    {
                                        if (filter_var($correo, FILTER_VALIDATE_EMAIL)) { 
                                            //validacion de imagen
                                            if($archivo['name'] != null)
                                            {
                                                $foto = Validator::validateImageProfile($archivo);
                                            }
                                            if(password_verify($correo, $hash)) 
                                            {
                                                throw new Exception("Error al ingresar el correo.");
                                            }
                                            else 
                                            {
                                                $sql = "UPDATE clientes SET nombre_cliente = ?, apellido_cliente = ?, correo_cliente = ?, dui_cliente = ?, nit_cliente = ?, telefono_cliente = ?, direccion_cliente = ?, estado_cliente = ?, foto = ? WHERE codigo_cliente = ?";
                                                $params = array($nombres, $apellidos, $correo, $dui, $nit, $telefono, $direccion, $estado, $foto, $id);
                                                if(Database::executeRow($sql, $params))
                                                {
                                                    Page::showMessage(1, "Operación satisfactoria", "index.php");
                                                    $_SESSION['nombre_cliente'] = $nombres." ".$apellidos;
                                                    $_SESSION['foto_cliente'] = $foto;
                                                }
                                            }    
                                        }
                                        else
                                        {
                                            throw new Exception("Debe ingresar un correo valido");
                                        }    
                                    }
                                    else 
                                    {
                                        throw new Exception("Debe ingresar su dirección");
                                    }
                                }
                                else
                                {
                                    throw new Exception("Debe ingresar su número de teléfono");
                                }
                            }
                            else
                            {
                                throw new Exception("Debe ingresar su nit");
                            }
                        }
                        else
                        {
                            throw new Exception("Debe ingresar su dui");
                        }
                    }
                    else
                    {
                        throw new Exception("Debe ingresar un correo electrónico");
                    }
                }
                else
                {
                    throw new Exception("Debe ingresar el nombre completo");
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
            
                <!--columna del form-->
                <div class="col s12 m12 ">
                    <br>
                    <div class="card-panel">
                        <h3 class="center-txt">Editar Perfil</h3>
                        <br>
                        
                        <!--inicio del form de registro-->
                        <!--nombre-->
                        <form method='post' enctype='multipart/form-data' autocomplete='off'>
                            <div class="row">
                                <h5>Datos personales</h5>
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">account_circle</i>
                                    <input type="text" id="nombres" name="nombres"  class="validate" value='<?php print($nombres); ?>' required />
                                    <label for="nombres">Nombres</label>
                                </div>
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">account_circle</i>
                                    <input type="text" id="apellidos" name="apellidos" class="validate" value='<?php print($apellidos); ?>' required />
                                    <label for="apellidos">Apellidos</label>
                                </div>
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">account_circle</i>
                                    <input type="text" id="dui" name="dui" pattern='^[0-9]{8}-[0-9]{1}' class="validate" value='<?php print($dui); ?>' required />
                                    <label for="dui">Dui</label>
                                </div>
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">account_circle</i>
                                    <input type="text" id="nit" name="nit" pattern='^[0-9]{4}-[0-9]{6}-[0-9]{3}-[0-9]{1}' class="validate" value='<?php print($nit); ?>' required />
                                    <label for="nit">Nit</label>
                                </div>
                                <!--telefono-->
                                <div class='input-field col s12 m6'>
                                    <i class='material-icons prefix'>description</i>
                                    <input id='telefono' type='text' name='telefono' pattern='^[0-9]{8}' class='validate' value='<?php print($telefono); ?>' required/>
                                    <label for='telefono'>Teléfono</label>
                                </div>
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">account_circle</i>
                                    <input type="text" id="direccion" name="direccion"  class="validate" value='<?php print($direccion); ?>' required />
                                    <label for="direccion">Direccion</label>
                                </div>

                                <h5>Datos de usuario</h5>
                                <!--email-->
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">email</i>
                                    <input type="email" id="correo" name="correo" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" class="validate" value='<?php print($correo); ?>' required />
                                    <label for="correo" data-error="wrong" data-success="right">Correo electrónico</label>
                                </div>
                                <div id='profile-img' class='file-field input-field col s12 m6'>
                                    <div class='btn waves-effect'>
                                        <span><i class='material-icons'>image</i></span>
                                        <input type='file' name='foto'/>
                                    </div>
                                    <div class='file-path-wrapper'>
                                        <input class='file-path validate' type='text' placeholder='Seleccione una foto de perfil'/>
                                    </div>
                                </div>

                            </div>
                            <!--botones del form--> 
                            <div class='row center-align'>
                                <button type='submit' class='btn waves-effect green'>Actualizar información</button>
                                <a href='index.php' class="waves-effect waves-light btn grey">Cancelar</a>
                            </div>
                        </form>         
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