<?php
require("../../funciones/motor.php");
require("../../funciones/funciones.php");

$idacta  = $_POST["idacta"];
$carpeta = $_POST["carpeta"];


//$filename = strtolower ($_POST["filename"]);
$filename = $_POST["filename"];
//$carpeta  = "archivos_st/actas/".$carpeta;

$ruta = "archivos_st/actas/".$carpeta;
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

$id = incrementar_id("documentoacta", "iddocumentoacta");
$consulta="INSERT INTO documentoacta SET 
            iddocumentoacta='$id',
            idacta='".$idacta."',
            titulo='".$_POST["titulo"]."',
            nombredoc='".$filename."'";

$resultado=mysql_query($consulta);

//mysql_query("UPDATE evento SET estado = 'EJE' WHERE idevento = '$idEvento';");

$href = "$link_modulo?path=actas_ver.php&idacta=".base64_encode($idacta);
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
