<!DOCTYPE HTML>
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
$sql="SELECT detalles AS situacion ,COUNT(id_item)AS total FROM st_cronograma_informes_f001
where (fecha BETWEEN '" . $fini ."'  AND '". $ffin ."') AND p5='BTS'
GROUP BY detalles
HAVING COUNT(id_item)
ORDER BY total DESC";

           // echo $sql;

/*Ejecutamos la query*/
$stmt=$bd->ejecutar($sql);
 $numero_filas = mysql_num_rows($stmt);
 //echo $numero_filas;

/*Realizamos un bucle para ir obteniendo los resultados*/


?>
		<script type="text/javascript">

// Create the chart
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'BTS CM CBBA POR SITUACIONES'
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
            },
            point: {   
                events:{
                    click: function(e) {
                        location.href = '../estadistica/E00.php?fini=' + ('<?php echo $fini; ?>')
                                +'&ffin='+ ('<?php echo $ffin; ?>')
                                +'&ffin='+ ('<?php echo $ffin; ?>')
                                +'&detalles='+ this.name ;
                    }
                }
            }

        },
        
        
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> of total<br/>'
    },

    "series": [
        {
            "name": "Incidencias",
            "colorByPoint": true,
            "data": [<?php            
               

                $i=0;
                while ($x=$bd->obtener_fila($stmt,0))
                  
             {?>
                {
                    "name": "<?php echo($x['situacion']);  ?>",
                    "y": <?php echo($x['total']);?>  ,
                    "drilldown": null
                }
                <? $i++;
                if ($i< $numero_filas){
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
