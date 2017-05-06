<?php
if (isset($_POST['cliente_contacto_adicionae'])) 
{ 
$id = $_POST["id"];
$nombre = $_POST["cnombre"];
$cargo = $_POST["ccargo"];
$dpto = $_POST["cdpto"];
$telf = $_POST["ctelf"];
$cel = $_POST["ccel"];
$mail = $_POST["cmail"];
$fax = $_POST["cfax"];
$obs = $_POST['cobs'];

$consulta="INSERT INTO contactos (id, id_cliente, nombre, cargo, dpto, telf, celular, email, fax, obs, id_user, fecha_registro) VALUES ('', '$id', '$nombre', '$cargo', '$dpto', '$telf', '$cel', '$mail', '$fax', '$obs', '$id_user', NOW())";
	if(mysql_query($consulta))
	{
	?>
	<script type="text/javascript">
	window.open('clientes.php?path=cliente_detalles.php&nro=<?=base64_encode($id)?>', '_top');
	</script>
	<?
	}
	else echo"OCURRIO UN ERROR - intente nuevamente"; 
}
else 
{
header("Location: ../index.php");
}
?>

