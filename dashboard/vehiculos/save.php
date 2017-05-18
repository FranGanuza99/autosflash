<?php
ob_start();
require("../lib/page.php");
//se realiza la conexion
//se captura el id en caso que se modifique
//se crean las variables
if(empty($_GET['id'])) 
{
    Page::header("Agregar Vehiculo");
    $id = null;
    $nombre_vehiculo = null;
    $precio_vehiculo = null;
    $descripcion_vehiculo = null;
    $fecha_registro_vehiculo = null;
    $codigo_tipo_vehiculo = null;
    $codigo_proveedor = null;
    $cantidad_disponible = null;
    $codigo_modelo = null;
    $anio_vehiculo = null;
    $potencia_vehiculo = null;
    $manejo_vehiculo = null;
    $rueda_vehiculo = null;
    $comodida_vehiculo = null;
    $apariencia_vehiculo = null;
    $ventana_vehiculo = null;
    $general1_vehiculo = null;
    $general2_vehiculo = null;
    $general3_vehiculo = null;
    $descuento_vehiculo = null;
    $estado = 1;
    
}
else
{
    //se le asignas valores a las variables
    Page::header("Modificar Vehiculos");
    $id = $_GET['id'];
    $sql = "SELECT * FROM vehiculos WHERE codigo_vehiculo= ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $nombre_vehiculo =  $data['nombre_vehiculo'];
    $precio_vehiculo =  $data['precio_vehiculo'];
    $descripcion_vehiculo =  $data['descripcion_vehiculo'];
    $fecha_registro_vehiculo =  $data['fecha_registro_vehiculo'];
    $codigo_tipo_vehiculo =  $data['codigo_tipo_vehiculo'];
    $codigo_proveedor =  $data['codigo_proveedor'];
    $cantidad_disponible =  $data['cantidad_disponible'];
    $codigo_modelo =  $data['codigo_modelo'];
    $anio_vehiculo =  $data['anio_vehiculo'];
    $potencia_vehiculo =  $data['potencia_vehiculo'];
    $manejo_vehiculo =  $data['manejo_vehiculo'];
    $rueda_vehiculo =  $data['rueda_vehiculo'];
    $comodida_vehiculo =  $data['comodida_vehiculo'];
    $apariencia_vehiculo =  $data['apariencia_vehiculo'];
    $ventana_vehiculo = $data['ventana_vehiculo'];
    $general1_vehiculo =  $data['general1_vehiculo'];
    $general2_vehiculo =  $data['general2_vehiculo'];
    $general3_vehiculo =  $data['general3_vehiculo'];
    $descuento_vehiculo =  $data['descuento_vehiculo'];
    $estado = $data['estado_vehiculo']; 
}

if(!empty($_POST))
{
    //se guardan en las varibles los datos para luego hacer el insert
    $_POST = Validator::validateForm($_POST);
    $nombre_vehiculo =  $_POST['nombre_vehiculo'];
    $precio_vehiculo =  $_POST['precio_vehiculo'];
    $descripcion_vehiculo =  $_POST['descripcion_vehiculo'];
    $fecha_registro_vehiculo =  $_POST['fecha_registro_vehiculo'];
    $codigo_tipo_vehiculo =  $_POST['codigo_tipo_vehiculo'];
    $codigo_proveedor =  $_POST['codigo_proveedor'];
    $cantidad_disponible =  $_POST['cantidad_disponible'];
    $codigo_modelo =  $_POST['codigo_modelo'];
    $anio_vehiculo =  $_POST['anio_vehiculo'];
    $potencia_vehiculo =  $_POST['potencia_vehiculo'];
    $manejo_vehiculo =  $_POST['manejo_vehiculo'];
    $rueda_vehiculo =  $_POST['rueda_vehiculo'];
    $comodida_vehiculo =  $_POST['comodida_vehiculo'];
    $apariencia_vehiculo =  $_POST['apariencia_vehiculo'];
    $ventana_vehiculo = $_POST['ventana_vehiculo'];
    $general1_vehiculo =  $_POST['general1_vehiculo'];
    $general2_vehiculo =  $_POST['general2_vehiculo'];
    $general3_vehiculo =  $_POST['general3_vehiculo'];
    $descuento_vehiculo =  $_POST['descuento_vehiculo'];
    $estado = $_POST['estado'];
     
     //se hace una validacion que los campos no esten vacion
    try 
    {
        if($nombre_vehiculo != "")
        {
            if($precio_vehiculo != "")
            {
                if($descripcion_vehiculo != "")
                 {
                     if($fecha_registro_vehiculo != "")
                     {
                         if($codigo_tipo_vehiculo != "")
                         {
                              if($codigo_proveedor != "")
                              {
                                  if($cantidad_disponible != "")
                                  {
                                      if($codigo_modelo != "")
                                      {
                                                if($anio_vehiculo != "")
                                                    {
                                                        if($potencia_vehiculo != "")
                                                        {
                                                            if($manejo_vehiculo != "")
                                                            {
                                                                if($rueda_vehiculo != "")
                                                                {
                                                                    if($comodida_vehiculo != "")
                                                                    {
                                                                        if($apariencia_vehiculo != "")
                                                                        {
                                                                            if($ventana_vehiculo != "")
                                                                            {
                                                                                    if($general1_vehiculo != "")
                                                                                    {
                                                                                        if($general2_vehiculo != "")
                                                                                        {
                                                                                                if($general3_vehiculo != "")
                                                                                                {
                                                                                                    if($descuento_vehiculo != "")
                                                                                                    {

                                                                                                                if($id == null)
                                                                                                                {
                                                                                                                $sql = "INSERT INTO vehiculos(nombre_vehiculo, precio_vehiculo, descripcion_vehiculo, fecha_registro_vehiculo, codigo_tipo_vehiculo,codigo_proveedor, cantidad_disponible, codigo_modelo, anio_vehiculo, potencia_vehiculo, manejo_vehiculo, rueda_vehiculo, comodida_vehiculo, apariencia_vehiculo, ventana_vehiculo, general1_vehiculo, general2_vehiculo, general3_vehiculo, descuento_vehiculo, estado_vehiculo) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                                                                                                                $params = array($nombre_vehiculo,$precio_vehiculo,$descripcion_vehiculo,$fecha_registro_vehiculo,$codigo_tipo_vehiculo,$codigo_proveedor,$cantidad_disponible,$codigo_modelo,$anio_vehiculo,$potencia_vehiculo,$manejo_vehiculo,$rueda_vehiculo,$comodida_vehiculo,$apariencia_vehiculo,$ventana_vehiculo,$general1_vehiculo,$general2_vehiculo,$general3_vehiculo,$descuento_vehiculo,$estado);
                                                                                                                }
                                                                                                                else
                                                                                                                {
                                                                                                                $sql = "UPDATE vehiculos SET nombre_vehiculo =?, precio_vehiculo =?, descripcion_vehiculo =?, fecha_registro_vehiculo =?, codigo_tipo_vehiculo =?, codigo_proveedor =?, cantidad_disponible = ?, codigo_modelo = ?, anio_vehiculo =?, potencia_vehiculo =?, manejo_vehiculo =?, rueda_vehiculo =?, comodida_vehiculo =?, apariencia_vehiculo =?, ventana_vehiculo = ?, general1_vehiculo =?, general2_vehiculo =?, general3_vehiculo =?, descuento_vehiculo =?, estado_vehiculo=? WHERE codigo_vehiculo= ?";
                                                                                                                $params = array($nombre_vehiculo,$precio_vehiculo,$descripcion_vehiculo,$fecha_registro_vehiculo,$codigo_tipo_vehiculo,$codigo_proveedor,$cantidad_disponible,$codigo_modelo,$anio_vehiculo,$potencia_vehiculo,$manejo_vehiculo,$rueda_vehiculo,$comodida_vehiculo,$apariencia_vehiculo,$ventana_vehiculo,$general1_vehiculo,$general2_vehiculo,$general3_vehiculo,$descuento_vehiculo,$estado, $id);
                                                                                                                }
                                                                                                                Database::executeRow($sql, $params);
                                                                                                                header("location: index.php");
                                                                                                    }
                                                                                                    else{
                                                                                                    throw new Exception("Debe ingresar descuento del vehiculo");
                                                                                                    } 
                                                                                        
                                                                                                }
                                                                                                else{
                                                                                                throw new Exception("Debe ingresar dato general 3 del vehiculo");
                                                                                                } 

                                                                                        }
                                                                                        else{
                                                                                        throw new Exception("Debe ingresar dato general 2 del vehiculo");
                                                                                        } 
                                                                                        
                                                                                    }
                                                                                    else{
                                                                                    throw new Exception("Debe ingresar dato general 1 del vehiculo");
                                                                                    } 

                                                                                }
                                                                                else{
                                                                                throw new Exception("Debe ingresar ventanas del vehiculo");
                                                                                } 
                                                                                
                                                                        }
                                                                        else{
                                                                        throw new Exception("Debe ingresar apariencia del vehiculo");
                                                                        } 
                                                                    
                                                                    }
                                                                    else{
                                                                    throw new Exception("Debe ingresar comodidad del vehiculo");
                                                                    } 
                                                            
                                                            }
                                                            else{
                                                            throw new Exception("Debe ingresar el tipo de ruedas del vehiculo");
                                                            } 
                                                            
                                                        }
                                                        else{
                                                        throw new Exception("Debe ingresar el tipo de manejo del vehiculo");
                                                        } 
                                                            
                                                        }
                                                        else{
                                                        throw new Exception("Debe ingresar la potencia del vehiculo");
                                                        } 

                                                    }
                                                    else{
                                                    throw new Exception("Debe ingresar el año del vehiculo");
                                                    } 
                                         }
                                        else{
                                        throw new Exception("Debe ingresar el modelo del vehiculo");
                                        }
                                    }
                                    else{
                                    throw new Exception("Debe ingresar la cantidad de vehiculos");
                                    }
                            }
                            else{
                            throw new Exception("Debe ingresar el proveedor del vehiculo");
                            }
                        
                        }
                        else{
                        throw new Exception("Debe ingresar el tipo de vehiculo");
                        } 

                    }
                    else{
                    throw new Exception("Debe ingresar fecha de registro");
                    } 
                

                }
                else{
                throw new Exception("Debe ingresar descripcion del vehiculo");
                }  
            }
            else{
                throw new Exception("Debe ingresar precio del vehiculo");
             }           
         }    
        else
        {
            throw new Exception("Debe ingresar el nombre del vehiculo");
        }
    }
    catch (Exception $error)
    {
        Page::showMessage(2, $error->getMessage(), null);
    }
}
?>
<form method='post'>
<!--se crea formulario en el cual despues se capturan los datos y tambien se hace un select de las tablas padres-->
    <div class='row'>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>note_add</i>
            <input id='nombre_vehiculo' type='text' name='nombre_vehiculo' class='validate' value='<?php print($nombre_vehiculo); ?>' required/>
            <label for='nombre_vehiculo'>Nombre del vehiculo</label>
        </div>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>note_add</i>
            <input id='precio_vehiculo' type='number' name='precio_vehiculo' class='validate' value='<?php print($precio_vehiculo); ?>' required/>
            <label for='precio_vehiculo'>Precio del vehiculo</label>
        </div>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>note_add</i>
           <textarea id="descripcion_vehiculo" class="materialize-textarea" name='descripcion_vehiculo' class='validate' value='<?php print($descripcion_vehiculo); ?>' required/></textarea>
            <label for='descripcion_vehiculo'>Descripcion del vehiculo</label>
        </div>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>note_add</i>
            <input id='fecha_registro_vehiculo' type="date" class="datepicker" name='fecha_registro_vehiculo' value='<?php print($fecha_registro_vehiculo); ?>' required/>
        </div>
        <div class='input-field col s12 m6'>
         <i class='material-icons prefix'>note_add</i>
            <?php
            $sql = "SELECT codigo_tipo_vehiculo, tipo_vehiculo FROM tipos_vehiculos";
            Page::setCombo("Tipos de vehiculos", "codigo_tipo_vehiculo", $codigo_tipo_vehiculo, $sql);
            ?>
        </div>    
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>note_add</i>
            <?php
            $sql = "SELECT codigo_proveedor, nombre_proveedor FROM proveedores";
            Page::setCombo("Proveedor", "codigo_proveedor", $codigo_proveedor, $sql);
            ?> 
        </div>
        <div class='input-field col s12 m6'>        
            <i class='material-icons prefix'>note_add</i>
            <input id='cantidad_disponible' type='number' name='cantidad_disponible' class='validate' value='<?php print($cantidad_disponible); ?>' required/>
            <label for='cantidad_disponible'>Cantidad Disponible</label>
        </div>
        <div class='input-field col s12 m6'>
         <i class='material-icons prefix'>note_add</i>
            <?php
            $sql = "SELECT codigo_modelo, nombre_modelo FROM modelos";
            Page::setCombo("Modelo", "codigo_modelo", $codigo_modelo, $sql);
            ?>
        </div>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>note_add</i>
            <input id='anio_vehiculo' type='number' name='anio_vehiculo' class='validate' value='<?php print($anio_vehiculo); ?>' required/>
            <label for='anio_vehiculo'>Año del vehiculo</label>
        </div>
        <div class='input-field col s12 m6'>
           <i class='material-icons prefix'>note_add</i>
           <textarea id="potencia_vehiculo" class="materialize-textarea" name='potencia_vehiculo' class='validate' value='<?php print($potencia_vehiculo); ?>' required/></textarea>
            <label for='potencia_vehiculo'>Potencia del vehiculo</label>
        </div>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>note_add</i>
            <textarea id="manejo_vehiculo" class="materialize-textarea" name='manejo_vehiculo' class='validate' value='<?php print($manejo_vehiculo); ?>' required/></textarea>
            <label for='manejo_vehiculo'>Manejo del vehiculo</label>
        </div>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>note_add</i>
           <textarea id="rueda_vehiculo" class="materialize-textarea" name='rueda_vehiculo' class='validate' value='<?php print($rueda_vehiculo); ?>' required/></textarea>
            <label for='rueda_vehiculo'>Ruedas del vehiculo</label>
        </div>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>note_add</i>
           <textarea id="comodida_vehiculo" class="materialize-textarea" name='comodida_vehiculo' class='validate' value='<?php print($comodida_vehiculo); ?>' required/></textarea>
            <label for='comodida_vehiculo'>Comodida del vehiculo</label>
        </div>
       <div class='input-field col s12 m6'>
           <i class='material-icons prefix'>note_add</i>
           <textarea id="apariencia_vehiculo" class="materialize-textarea" name='apariencia_vehiculo' class='validate' value='<?php print($apariencia_vehiculo); ?>' required/></textarea>
            <label for='apariencia_vehiculo'>Apariencia del vehiculo</label>
        </div>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>note_add</i>
           <textarea id="ventana_vehiculo" class="materialize-textarea" name='ventana_vehiculo' class='validate' value='<?php print($ventana_vehiculo); ?>' required/></textarea>
            <label for='ventana_vehiculo'>Ventanas del vehiculo</label>
        </div>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>note_add</i>
            <textarea id="general1_vehiculo" class="materialize-textarea" name='general1_vehiculo' class='validate' value='<?php print($general1_vehiculo); ?>' required/></textarea>
            <label for='general1_vehiculo'>Dato general 1 del vehiculo</label>
        </div>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>note_add</i>
           <textarea id="general2_vehiculo" class="materialize-textarea" name='general2_vehiculo' class='validate' value='<?php print($general2_vehiculo); ?>' required/></textarea>
            <label for='general2_vehiculo'>Dato general 2 del vehiculo</label>
        </div>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>note_add</i>
           <textarea id="general3_vehiculo" class="materialize-textarea" name='general3_vehiculo' class='validate' value='<?php print($general3_vehiculo); ?>' required/></textarea>
            <label for='general3_vehiculo'>Dato general 3 del vehiculo</label>
        </div>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>note_add</i>
            <input id='descuento_vehiculo' type='number' name='descuento_vehiculo' class='validate' value='<?php print($descuento_vehiculo); ?>' required/>
            <label for='descuento_vehiculo'>Descuento del vehiculo(%)</label>
        </div>
          <div class='input-field col s12 m6'>
            <span>Estado:</span>
            <input id='activo' type='radio' name='estado' class='with-gap' value='1' <?php print(($estado == 1)?"checked":""); ?>/>
            <label for='activo'><i class='material-icons left'>visibility</i></label>
            <input id='inactivo' type='radio' name='estado' class='with-gap' value='0' <?php print(($estado == 0)?"checked":""); ?>/>
            <label for='inactivo'><i class='material-icons left'>visibility_off</i></label>
        </div>    
        <!--se muestran los botones-->
    </div>
    <div class='row center-align'>
        <a href='index.php' class='btn waves-effect grey'><i class='material-icons'>cancel</i></a>
        <button type='submit' class='btn waves-effect blue'><i class='material-icons'>save</i></button>
    </div>
</form>
<?php
Page::footer();
?>