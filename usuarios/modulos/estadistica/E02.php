
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Mantenimiento DIMESAT S.R.L.</title>

		<style type="text/css">

		</style>
	</head>
	<body>
<script src="../../../charts/code/highcharts.js"></script>
<script src="../../../charts/code/modules/data.js"></script>
<script src="../../../charts/code/modules/drilldown.js"></script>

<div id="container" style="min-width: 310px; max-width: 700px; height: 500px; margin: 0 auto"></div>


		<script type="text/javascript">
<?php
if($nively=='1'){ $adm=1;}
include("../../../funciones/class.paginado.php");
if (isset($_GET['pagina'])){
$pagina = $_GET['pagina'];
}
?>

<?php
if (isset($_GET['fini'])) $fini = $_GET['fini'];
if (isset($_GET['ffin'])) $ffin = $_GET['ffin'];
        
        
?>

<?php

/*Incluimos el fichero de la clase*/
include("../../../funciones/Db.class.php");


/*Creamos la instancia del objeto. Ya estamos conectados*/
$bd=Db::getInstance();

/*Creamos una query sencilla*/
$sql="SELECT st_cronograma_informes_f001.id_st_proyecto from st_cronograma_informes_f001
where fecha BETWEEN '" . $fini ."' AND '". $ffin ."' LIMIT 1";
//echo $sql;
$stmt=$bd->ejecutar($sql);

while ($x=$bd->obtener_fila($stmt,0)){
    $id_st_proyecto= $x['id_st_proyecto'];
}


$sql="SELECT centro.nombre, count(st_trabajos.id_st_proyecto) AS total  FROM st_trabajos
        INNER JOIN estacion
        ON st_trabajos.idestacion= estacion.idestacion
            INNER JOIN centro
            on centro.idcentro=estacion.idcentro
    WHERE st_trabajos.id_st_proyecto='" . $id_st_proyecto ."' AND st_trabajos.producto='Mantenimiento correctivo'
    GROUP BY nombre
    HAVING COUNT(estacion.nombre)
    ORDER BY total DESC";


           //echo $sql;

/*Ejecutamos la query*/
$stmt=$bd->ejecutar($sql);
 //$numero_filas = mysql_num_rows($stmt);
 echo $numero_filas;

/*Realizamos un bucle para ir obteniendo los resultados*/


?>


// Create the chart
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Mantenimiento Correctivo'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Incidencias'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.0f}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> of total<br/>'
    },

    "series": [
        {
            "name": "Incidencias",
            "colorByPoint": true,
            "data": [
            <?php            
               

                $i=0;
                while ($x=$bd->obtener_fila($stmt,0))
                  
             {?>
                {
                    "name": "<?php echo($x['nombre']);  ?>",
                    "y":<?php echo($x['total']);?>  ,
                    "drilldown": null
                }
                <? $i++;
                if ($i> $numero_filas){
                echo ",";
                    }

                } 
                ?> 
            ]
        }
    ]
});
		</script>
	</body>
</html>
