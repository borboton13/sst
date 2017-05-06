<?php
require("../../funciones/motor.php");
$id_item = $_POST["id_item"];
$id_st_cronograma_informes = $_POST["id_st_cronograma_informes"];

$resultado=mysql_query("SELECT producto,id_st_proyecto FROM st_trabajos WHERE id_item='".$id_item."'");
$dato=mysql_fetch_array($resultado);
$producto=$dato[0];
$id_st_proyecto=$dato[1];

$dato=mysql_fetch_array(mysql_query("SELECT descripcion FROM parametrica WHERE grupo='st_archivo' AND sub_grupo='".$producto."'"));
$pro_cod=$dato[0];
$link_volver = $pro_cod."_".$_POST["volver"];
$carpeta_id=$pro_cod."_".$id_st_cronograma_informes;

$filename=strtolower ($_POST["filename"]);
$carpeta="archivos_st/".$id_st_proyecto."/".$carpeta_id;
$dir = "../../".$carpeta."/";

$retornar="Cierre la Venta y Vuelva a Intentar";

$resultado=mysql_query("SELECT sub_grupo FROM parametrica WHERE grupo='tamano_archivo'");
$dato=mysql_fetch_array($resultado);
$max_filesize = $dato[0] * 1024; 
if ($_FILES["file"]["size"] < $max_filesize)
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Codigo de Error: " . $_FILES["file"]["error"]."<br>";
	echo $retornar;
	exit;
    }
  else
    {
	if (file_exists($dir . $filename))
      {
      echo $filename." ya existe<br>";
	  echo $retornar;
	  exit;
      }
    else
      {
	  echo "<font face=Tahoma size=2><center><img src='../../img/loading.gif'><br><b>Cargando archivo, por favor espere...!</b></center></font>";	  
      move_uploaded_file($_FILES["file"]["tmp_name"],$dir.$filename);	    
      }
    }

$dato=mysql_fetch_array(mysql_query("SELECT max(item) FROM st_cronograma_informes_".$pro_cod."_archivos WHERE id_st_cronograma_informes_".$pro_cod."='".$id_st_cronograma_informes."'"));
	if($dato[0]!=NULL) { $nroi=$dato[0]+1; }
	else { $nroi=1;	}
		
	$consulta="INSERT INTO st_cronograma_informes_".$pro_cod."_archivos SET 
id_st_cronograma_informes_".$pro_cod."='".$id_st_cronograma_informes."',
item='".$nroi."',
titulo='".$_POST["titulo"]."',
imagen='".$filename."'
";		
$resultado=mysql_query($consulta);
		 
	?>
		<script type="text/javascript">
        window.open('<?=$link_modulo?>?path=trabajos_informar_<?=$link_volver?>.php&id_st_cronograma_informes=<?=$id_st_cronograma_informes?>', '_top');
    </script> 
	<?

  }
else
  {
  echo "El archivo no puede ser mayor a ".$dato[0]." Kb !<br>";
  echo $retornar;
  }
?>