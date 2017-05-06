<?php
$id_st_cronograma_informes = $_POST["id_st_cronograma_informes"];
$item = $_POST["item"];
$volver = $_POST["volver"];
$pro_key = $_POST["pro_key"];
$titulo = $_POST["titulo"];
$link_volver = $pro_key."_".$_POST["volver"];

	$consulta="UPDATE st_cronograma_informes_".$pro_key."_archivos SET 
	titulo='".$titulo."' 
	WHERE id_st_cronograma_informes_".$pro_key."='".$id_st_cronograma_informes."' AND item='".$item."';";
	$resultado=mysql_query($consulta);
	if($resultado) {	
	?>
		<script type="text/javascript">
        window.open('<?=$link_modulo?>?path=trabajos_informar_<?=$link_volver?>.php&id_st_cronograma_informes=<?=$id_st_cronograma_informes?>', '_top');
    </script> 
	<?
	}
	else echo"ocurrio un error ".$consulta;
?>