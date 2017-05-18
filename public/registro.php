<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <!--Import Google Icon Font-->
        <link href="../css/icons.css" rel="stylesheet">
        <title>Formulario de registro</title>
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="../css/icon.css"  media="screen,projection"/>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <!--  archivos css-->
        <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection"/>
        <link type="text/css" rel="stylesheet" href="css/mystyle-sheet.css" media="screen,projection"/>
    </head>
    <body>
        <!---->
        
        
        <!--Aqui se muestra el menu-->
        <?php
        include("inc/menu.php");
        ?>

        <?php
        require("../lib/database.php");
        require("../lib/validator.php");

        $fecha = getdate();
        $registro = $fecha['year'].'-'.$fecha['mon'].'-'.$fecha['mday'];
        if(!empty($_POST))
        {
            $_POST = Validator::validateForm($_POST);
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $correo = $_POST['correo'];
            $dui = $_POST['dui'];
            $nit = $_POST['nit'];
            $clave1 = $_POST['clave1'];
            $clave2 =$_POST['clave2'];
            $telefono =$_POST['telefono'];
            $direccion =$_POST['direccion'];
            $archivo = $_FILES['foto'];
            

            try 
            {
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
                                        if($archivo['name'] != null)
                                        {
                                            $base64 = Validator::validateImageProfile($archivo);
                                            if($base64 != false)
                                            {
                                                $foto = $base64;
                                            }
                                            else
                                            {
                                                throw new Exception("Ocurrió un problema con la imagen");
                                            }
                                        }
                                        else
                                        {
                                            if($foto == null)
                                            {
                                                throw new Exception("Debe seleccionar una imagen");
                                            }
                                        }

                                        if($clave1 != "" && $clave2 != "")
                                        {
                                            if($clave1 == $clave2)
                                            {
                                                $clave = password_hash($clave1, PASSWORD_DEFAULT);
                                                $sql = "INSERT INTO clientes(nombre_cliente, apellido_cliente, dui_cliente, nit_cliente, telefono_cliente, correo_cliente, contrasenia, fecha_registro_cliente, direccion_cliente, foto) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                                                $params = array($nombres, $apellidos, $dui, $nit, $telefono, $correo, $clave, $registro, $direccion, $foto);
                                                Database::executeRow($sql, $params);
                                                header ('location: sesion.php');
                                            }
                                            else
                                            {
                                                throw new Exception("Las contraseñas no coinciden");
                                            }
                                        }
                                        else {
                                            throw new Exception("Debe ingresar ambas contraseñas");
                                        }
                                                
                                            
                                    }
                                    else {
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
                
            }

        } else {
            $nombres = null;
            $apellidos = null;
            $correo = null;
            $dui = null;
            $nit = null;
            $clave1 = null;
            $calve2 = null;
            $telefono = null;
            $direccion = null;
            $archivo = null;
        }

        ?>
        
        <!--Aqui comienza la pagina-->
        <div class="container">
            <!--primera fila-->
            
                <!--columna del form-->
                <div class="col s12 m12 ">
                    <br>
                    <div class="card-panel">
                        <h3 class="center-txt">Registro de usuarios</h3>
                        <br>
                        
                        <!--inicio del form de registro-->
                        <!--nombre-->
                        <form method='post' enctype='multipart/form-data'>
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
                                    <input type="text" id="dui" name="dui" class="validate" value='<?php print($dui); ?>' required />
                                    <label for="dui">Dui</label>
                                </div>
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">account_circle</i>
                                    <input type="text" id="nit" name="nit" class="validate" value='<?php print($nit); ?>' required />
                                    <label for="nit">Nit</label>
                                </div>
                                <!--telefono-->
                                <div class='input-field col s12 m6'>
                                    <i class='material-icons prefix'>description</i>
                                    <input id='telefono' type='number' name='telefono' class='validate' value='<?php print($telefono); ?>' required/>
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
                                    <input type="email" id="correo" name="correo" class="validate" value='<?php print($correo); ?>' required />
                                    <label for="correo" data-error="wrong" data-success="right">Correo electrónico</label>
                                </div>
                                <div id='profile-img' class='file-field input-field col s12 m6'>
                                    <div class='btn waves-effect'>
                                        <span><i class='material-icons'>image</i></span>
                                        <input type='file' name='foto' required/>
                                    </div>
                                    <div class='file-path-wrapper'>
                                        <input class='file-path validate' type='text' placeholder='Seleccione una foto de perfil'/>
                                    </div>
                                </div>
                                <!--contra-->
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">vpn_key</i>
                                    <input id="clave1" type="password" name="clave1" class="validate"  required />
                                    <label for="clave1">Contraseña</label>
                                </div>
                                <!--contra2-->
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">replay</i>
                                    <input id="clave2" type="password" name="clave2" class="validate" required />
                                    <label for="clave2">Confirmar contraseña</label>
                                </div>
                                
                                
                            </div>
                            <!--botones del form--> 
                            <div class='row center-align'>
                                <button type='submit' class='btn waves-effect'>Registrarme</button>
                                <button type='submit' class='btn waves-effect'>Cancelar</button>
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