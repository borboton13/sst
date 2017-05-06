<?php
require("../../funciones/motor.php");
require("../../funciones/funciones.php");
/*
$id_item = $_POST["id_item"];
$id_st_cronograma_informes = $_POST["id_st_cronograma_informes"];
*/
$idEvento = $_POST["idEvento"];
$anio = $_POST["anio"];
$codCentro = $_POST["codCentro"];
$fechaInicio = $_POST["fechaInicio"];
$fechaFin = $_POST["fechaFin"];
$codigoEstacion = $_POST["codigoEstacion"];
$nombreEstacion = $_POST["nombreEstacion"];

$nombreCarpeta = $codigoEstacion.$nombreEstacion;
$arr = explode("-", $fechaInicio);
$mes = $arr[1];
$ruta = "archivos_st/ST_PREV/$anio/$mes/$codCentro/$codigoEstacion";

//$filename = strtolower ($_POST["filename"]);
$filename = $_POST["filename"];
$carpeta    = "archivos_st/ST_PREV/".$anio."/".$codCentro;

$dir        = "../../".$ruta."/";
$directorio = "../../".$ruta;

print($directorio);
print("<br />");
if (!file_exists($directorio)) {
    mkdir($directorio, 0777, true);
}

$retornar="Cierre la Venta y Vuelva a Intentar";

$resultado=mysql_query("SELECT sub_grupo FROM parametrica WHERE grupo='tamano_archivo'");
$dato=mysql_fetch_array($resultado);
$max_filesize = $dato[0] * 1024; 
if ($_FILES["file"]["size"] < $max_filesize){
    if ($_FILES["file"]["error"] > 0){
        echo "Codigo de Error: " . $_FILES["file"]["error"]."<br>";
	echo $retornar;
	exit;
    }else{
        if (file_exists($dir . $filename)){
            echo $filename." ya existe<br>";
            echo $retornar;
            exit;
        }else{
            echo "<font face=Tahoma size=2><center><img src='../../img/loading.gif'><br><b>Cargando archivo, por favor espere...!</b></center></font>";	  
            move_uploaded_file($_FILES["file"]["tmp_name"],$dir.$filename);	    
        }
    }

$id = incrementar_id("documento", "iddocumento");
$consulta="INSERT INTO documento SET 
iddocumento='$id',
idevento='".$idEvento."',
titulo='".$_POST["titulo"]."',
nombre='".$filename."'";

$resultado=mysql_query($consulta);

//mysql_query("UPDATE evento SET estado = 'EJE' WHERE idevento = '$idEvento';");

$href = "$link_modulo?path=prev_estacion.php&anio=$anio&codCentro=$codCentro&ini=$fechaInicio&fin=$fechaFin&idev=$idEvento&codEs=$codigoEstacion&nomEs=$nombreEstacion";
?>
<script type="text/javascript">
        window.open('<?=$href?>', '_top');
</script> 
<?php

}else{
    echo "El archivo no puede ser mayor a ... Kb !<br>";
    echo $retornar;
}
?>
