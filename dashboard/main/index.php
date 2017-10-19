<?php
ob_start();
require("../lib/page.php");
Page::header("Bienvenid@");
?>
<!-- archivos necesarios -->
<script src="../../js/code/highcharts.js"></script>
<script src="../../js/code/highcharts-3d.js"></script>
<script src="../../js/code/modules/exporting.js"></script>

<!-- grafico sobre ventas de productos -->
<?php
    $sql = "SELECT COUNT(codigo_reserva) AS reservas, YEAR(fecha_reserva) AS anio, date_format(fecha_reserva, '%M') AS mes FROM reservaciones AS R INNER JOIN vehiculos AS V ON V.codigo_vehiculo = R.codigo_vehiculo GROUP BY YEAR(fecha_reserva), MONTH(fecha_reserva) ORDER BY YEAR(fecha_reserva), MONTH(fecha_reserva) ASC LIMIT 8";
    $params = array($_SESSION['id_sucursal']);
    $data = Database::getRowsNum($sql, $params);
?>
<div class='row'>
    <div class='col s12 m6'>
        <!-- mostrando grafico -->
        <div id="ventas_productos" style="min-width: 100px; height: 300px; /*margin: 0 auto*/ max-width: 500px;"></div>
    </div>

<script type="text/javascript">

// declaracion del grafico
Highcharts.chart('ventas_productos', {
    // especificacion del tipo de grafico
    chart: {
        type: 'column'
    },
    title: {
        text: 'Reservaciones mensuales'
    },
    xAxis: {
        //recorriendo valores de tipo texto e imprendolos
        categories: [
            <?php
                foreach($data as $row){
                    print("'".$row[2]." ".$row[1]."',");
                }
            ?>
        ],
        crosshair: true
    },
    // valores a tomar en el eje Y 
    yAxis: {
        min: 0,
        title: {
            text: 'Cantidad de reservas'
        }
    },
    //muestrando los valores del punto y el nombre de la serie
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} reservas</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    //configuración para cada tipo de serie.
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    //especificando las series y los datos de cada una
    series: [{
        name: 'Reservas',
        color: '#F7A35C',
        data: [
            <?php 
                foreach ($data as $row){
                    print($row[0].",");
                }
            ?>
        ]

    }]
});
</script>

<!-- grafico sobre ventas de productos -->
<?php
    $sql = "SELECT COUNT(codigo_factura) AS factura, YEAR(fecha_factura) AS anio, date_format(fecha_factura, '%M') AS mes FROM facturas GROUP BY YEAR(fecha_factura), MONTH(fecha_factura) ORDER BY YEAR(fecha_factura), MONTH(fecha_factura) ASC LIMIT 8";
    $params = array($_SESSION['id_sucursal']);
    $data = Database::getRowsNum($sql, $params);
?>
    <div class='col s12 m6'>
        <!-- mostrando grafico -->
        <div id="cantidad" style="min-width: 100px; height: 300px; /*margin: 0 auto*/ max-width: 500px;"></div>
    </div>
</div>

<script type="text/javascript">

// declaracion del grafico
Highcharts.chart('cantidad', {
    // especificacion del tipo de grafico
    chart: {
        type: 'column'
    },
    title: {
        text: 'Ventas mensuales'
    },
    xAxis: {
        //recorriendo valores de tipo texto e imprendolos
        categories: [
            <?php
                foreach($data as $row){
                    print("'".$row[2]." ".$row[1]."',");
                }
            ?>
        ],
        crosshair: true
    },
    // valores a tomar en el eje Y 
    yAxis: {
        min: 0,
        title: {
            text: 'Cantidad de ventas'
        }
    },
    //muestrando los valores del punto y el nombre de la serie
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} ventas</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    //configuración para cada tipo de serie.
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    //especificando las series y los datos de cada una
    series: [{
        name: 'Ventas',
        colores: ['#2f7ed8', '#0d233a', '#8bbc21', '#910000', '#1aadce', 
                  '#492970', '#f28f43', '#77a1e5', '#c42525', '#a6c96a'],
        data: [
            <?php 
                foreach ($data as $row){
                    print($row[0].",");
                }
            ?>
        ]

    }]
});
</script>

<!-- grafico sobre productos mas vendidos -->
<?php
    $sql = "SELECT V.nombre_vehiculo, COUNT(F.codigo_factura) AS cant FROM facturas AS F INNER JOIN vehiculos AS V ON V.codigo_vehiculo = F.codigo_vehiculo GROUP BY V.nombre_vehiculo LIMIT 10";
    $params = array($_SESSION['id_sucursal']);
    $data = Database::getRowsNum($sql, $params);
?>
<div class='row'>
    <br>
    <br>    
    <div class='col s12 m6'>
        <!-- mostrando grafico -->
        <div id="productos_vendidos" style="max-width: 500px; min-width: 100px;"></div>
    </div>

<script type="text/javascript">

// declaracion del grafico
Highcharts.chart('productos_vendidos', {
    // especificacion del tipo de grafico
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
        }
    },
    title: {
        text: 'Vehiculos más vendidos'
    },
    //muestrando los valores del punto y el nombre de la serie
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    //configuración para cada tipo de serie.
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 35,
            dataLabels: {
                enabled: true,
                format: '{point.name}'
            }
        }
    },
    //especificando las series y los datos de cada una
    series: [{
        type: 'pie',
        name: 'Porcentaje',
        colores: ['#2f7ed8', '#0d233a', '#8bbc21', '#910000', '#1aadce', 
                  '#492970', '#f28f43', '#77a1e5', '#c42525', '#a6c96a'],
        data: [
            <?php
				foreach($data as $row){
					print("['".$row[0]."', ".$row[1]."],");
				}
			?>
        ]
    }]
});
</script>

<!-- grafico sobre productos mas vendidos -->
<?php
    $sql = "SELECT nombre_vehiculo, visto FROM vehiculos LIMIT 8";
    $params = array($_SESSION['id_sucursal']);
    $data = Database::getRowsNum($sql, $params);
?>
    <div class='col s12 m6'>
        <!-- mostrando grafico -->
        <div id="autos_populares" style="max-width: 500px; min-width: 100px;"></div>
    </div>
</div>
<script type="text/javascript">

// declaracion del grafico
Highcharts.chart('autos_populares', {
    // especificacion del tipo de grafico
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
        }
    },
    title: {
        text: 'Autos más vistos'
    },
    //muestrando los valores del punto y el nombre de la serie
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    //configuración para cada tipo de serie.
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 35,
            dataLabels: {
                enabled: true,
                format: '{point.name}'
            }
        }
    },
    //especificando las series y los datos de cada una
    series: [{
        type: 'pie',
        name: 'Porcentaje',
        colors: ['#4572A7', '#AA4643', '#89A54E', '#80699B', '#3D96AE', 
                 '#DB843D', '#92A8CD', '#A47D7C', '#B5CA92'],
        data: [
            <?php
				foreach($data as $row){
					print("['".$row[0]."', ".$row[1]."],");
				}
			?>
        ]
    }]
});
</script>

<!--Aqui se muestra el pie de pagina-->
<?php
Page::footer();
?>