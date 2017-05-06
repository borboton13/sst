<?php
$id = base64_decode($_GET["id"]);
$id_contact = $_GET["id_contact"];
$consulta="DELETE FROM contactos WHERE id='$id_contact' AND id_cliente='$id'";
$resultado=mysql_query($consulta); 
header("Location: clientes.php?path=cliente_detalles.php&nro=".base64_encode($id));
?>

