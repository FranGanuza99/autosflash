<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <!--Import Google Icon Font-->
        <link href="../css/icons.css" rel="stylesheet">
        <title>Inicio</title>
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
        <!--Aqui se muestra el menu-->
        <?php
        include("inc/menu.php");

        include("../lib/page.php");
        include("../lib/zebra.php");

        //valida si el post esta vacio para la busqueda
        $date = getdate();
        $anio = $date['year'];

        $sql = "SELECT * FROM facturas, clientes, vehiculos, marcas, series, modelos, fotos_vehiculos WHERE
                facturas.codigo_cliente = clientes.codigo_cliente AND 
                facturas.codigo_vehiculo = vehiculos.codigo_vehiculo AND 
                vehiculos.codigo_vehiculo = fotos_vehiculos.codigo_vehiculo 
                AND fotos_vehiculos.codigo_tipo_foto =  1 AND facturas.codigo_cliente = ? ORDER BY codigo_factura desc";
        $params = array($_SESSION['id_cliente']);
        

        //ejecuta la consulta
        $data = Database::getRows($sql, $params);
        //obtenemos el numero de filas y cantidad maxima
        $num_registros = count($data); 
        $resul_x_pagina = 10; 

        //instanciando la clase y enviando parametros
        $paginacion = new Zebra_Pagination(); 
        $paginacion->records($num_registros); 
        $paginacion->records_per_page($resul_x_pagina);

        //Consulta utilizando limit
        $consulta = $sql.' LIMIT '.(($paginacion->get_page() - 1) * $resul_x_pagina). ',' .$resul_x_pagina;
        //ejecuta la consulta
        $data = Database::getRows($consulta, $params);

        if($data != null)
        {
        ?>

        <div class= 'container'>
            <br>
                <h3 class="center-txt">Compras realizadas</h3>
                <br>
                <br>
                <!-- Encabezados de la tabla -->
                <table class='striped'>
                    <thead>
                        <tr>
                            <th>FOTO</th>
                            <th>AUTOMOVIL</th>
                            <th>PRECIO ($)</th>
                            <th>TELEFONO</th>
                            <th>FECHA</th>
                        </tr>
                    </thead>
                    <tbody>

                <?php
                    //se muestran las filas de registros
                    foreach($data as $row)
                    {
                        print("
                        
                            <tr>
                                <td><img src='data:image/*;base64,".$row['url_foto']."' class='materialboxed' width='120' height='100'></td>
                                <td>".$row['nombre_vehiculo']."</td>
                                <td>".$row['precio_vehiculo']."</td>
                                <td>".$row['telefono_cliente']."</td>
                                <td>".$row['fecha_factura']."</td>
                            </tr>
                        ");
                    }
                    print("
                        </tbody>
                    </table>
                     <br><br>

                    ");
                    $paginacion->render();
            } //Fin de if que comprueba la existencia de registros.
            else
            {
                Page::showMessage(4, "No hay registros disponibles", "index.php");
            }
            ?>
            <br>
            <br>
            <br>

        </div>
        
        <!--Aqui se muestra el pie de pagina-->
        <?php
        include("inc/footer.php");
        ?>

    </body>
</html>