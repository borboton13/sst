<?php
require("../../funciones/motor.php");
require("../../funciones/funciones.php");

$idevento = $_POST["idevento"];

$arr        = explode('-', $_POST["formulario"]);
$idformulario   = $arr[0];
$codigoForm     = $arr[1];
$nombreForm     = $arr[2];


$href = "$link_modulo?path=prev_nuevo_form_$codigoForm.php&idevento=$idevento&idform=$idformulario&nombreForm=$nombreForm";
?>

<script type="text/javascript">
        window.open('<?=$href?>', '_top');
</script> 

