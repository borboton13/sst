<?php
if (isset($_POST['cliente_contacto_modificar'])) 
{
$id = $_POST['id'];
$id_contact = $_POST['id_contact'];

//datos contacto
$ccargo = $_POST["ccargo"];
$cdpto = $_POST["cdpto"];
$ctelf = $_POST["ctelf"];
$ccel = $_POST["ccel"];
$cmail = $_POST["cmail"];
$cfax = $_POST["cfax"];
$cobs = $_POST["cobs"];

$consulta="UPDATE contactos SET
cargo='$ccargo',
dpto='$cdpto',
telf='$ctelf',
celular='$ccel',
email='$cmail',
fax='$cfax',
obs='$cobs',
fecha_registro=NOW()
WHERE id='$id_contact'";

	if(mysql_query($consulta))
	{
	?>
	<script type="text/javascript">
	window.open('clientes.php?path=cliente_detalles.php&nro=<?=base64_encode($id);?>', '_top');
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

