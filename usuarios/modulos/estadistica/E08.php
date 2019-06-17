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


<div id="container" style="min-width: 310px; max-width: 700px; height: 1000px; margin: 0 auto"></div>
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
$sql="SELECT consulta3.nombre ,COUNT(consulta3.id_item)AS total FROM(
    SELECT consulta1.id_item,consulta1.nombre FROM(
        SELECT st_trabajos.id_item, estacion.idestacion,estacion.nombre FROM st_trabajos
        INNER JOIN estacion
        ON st_trabajos.idestacion= estacion.idestacion
        INNER JOIN centro
        on centro.idcentro=estacion.idcentro
    )consulta1  
            
    inner JOIN(
        SELECT consulta2.id_item,consulta2.fecha FROM(
            SELECT c.id_item,c.fecha FROM(
                SELECT id_item,fecha FROM st_cronograma_informes_f001
                union
                SELECT id_item,fecha FROM st_cronograma_informes_f002
            )AS c
            INNER JOIN st_trabajos
            ON c.id_item=st_trabajos.id_item
            WHERE  (c.fecha BETWEEN '" . $fini ."'  AND '". $ffin ."')
        )as consulta2)tx
    ON consulta1.id_item= tx.id_item
    ) AS consulta3 
    GROUP BY consulta3.nombre
HAVING COUNT(consulta3.id_item)
ORDER BY Total desc";

           // echo $sql;

/*Ejecutamos la query*/
$stmt=$bd->ejecutar($sql);
 $numero_filas = mysql_num_rows($stmt);
 //echo $numero_filas;

/*Realizamos un bucle para ir obteniendo los resultados*/


?>



		<script type="text/javascript">

Highcharts.chart('container', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'INTERVENCION A SITIOS CM CBBA'
    }/*,
    subtitle: {
        text: 'CM Cochabamba'
    }*/,
    xAxis: {
        categories: [
            <?php            
               

                $i=0;
                while ($x=$bd->obtener_fila($stmt,0)){
                  
                    echo('"' . $x['nombre'] . '"'); 

                    $i++;
                    if ($i< $numero_filas){
                        echo ",";
                    }
                }                   

                
        ?> 
        ],
        title: {
            text: null
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Cantidad',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: ''
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            },
            point: {   
                events:{
                    click: function(e) {
                        location.href = 'https://en.wikipedia.org/wiki/' +this.category ;
                    }
                }
            }
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: false,
        borderWidth: 1,
        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: [{
        name: 'Incidencias',
        colorByPoint: true,
        data: [<?php            
               $stmt=$bd->ejecutar($sql);
                $numero_filas = mysql_num_rows($stmt);

                $i=0;
                while ($x=$bd->obtener_fila($stmt,0)){
                echo($x['total']);
            
                   
                     $i++;
                    if ($i< $numero_filas){
                        echo ",";
                    }                            
                
            }
            ?>
            ]
    }]
});
		</script>
	</body>
</html>
