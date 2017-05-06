<?php
session_start();
if (isset($_POST['adicionar_cliente'])) 
{ 
require("../../funciones/motor.php");
require("../../funciones/verificar_sesion.php");
//datos cliente
$rs = $_POST["rs"];
$rs = ereg_replace( "([     ]+)", " ", trim($rs) );
$nivelc = $_POST["nivelc"];
$tipoc = $_POST["tipoc"];
$area = $_POST["area"];
$caracteristicas = $_POST["caracteristicas"];
$nit = $_POST["nit"];
$dir = $_POST["dir"];
$pais = $_POST['pais'];
$ciudad = $_POST['ciudad'];
//datos contacto
$cnombre = $_POST["cnombre"];
$ccargo = $_POST["ccargo"];
$cdpto = $_POST["cdpto"];
$ctelf = $_POST["ctelf"];
$ccel = $_POST["cel"];
$cmail = $_POST["cmail"];
$cfax = $_POST["cfax"];
$cobs = $_POST['cobs'];
$dato=mysql_fetch_array(mysql_query("select ADDTIME(now(),ajuste) FROM ajuste_hora_server LIMIT 1"));
$fecha_registro=$dato[0];

$dato=mysql_fetch_array(mysql_query("SELECT valor FROM secuencias WHERE id_secuencia='clientes';"));
$dato=mysql_fetch_array(mysql_query("SELECT incrementar( '".$dato[0]."',1)"));
$nro_=$dato[0];
mysql_query("UPDATE secuencias SET valor='".$nro_."' WHERE id_secuencia='clientes';");

?>
<SCRIPT type=text/javascript>
function insertar()
{
window.opener.document.amper.sw.value='SI';
window.opener.document.amper.cliente.value =window.document.formu.rs.value;

}
</SCRIPT>
<form name="formu" action="JavaScript:close();">
<input name="rs" type="hidden" value="<? echo $rs; ?>">
<?
$filas=mysql_num_rows(mysql_query("SELECT id FROM clientes WHERE razon_social='$rs';"));
if($filas==0)
{
//inserta cliente
$consulta="INSERT INTO clientes (id, razon_social, caracteristicas, nit, tcliente, area, direccion, pais, ciudad, nivel_cliente, creador, fecha_crea, resp_mod, ult_fecha_mod) VALUES ('$nro_', '$rs', '$caracteristicas', '$nit', '$tipoc', '$area', '$dir', '$pais', '$ciudad', '$nivelc', '$id_user', '$fecha_registro', '$id_user', '$fecha_registro')";
$resultado=mysql_query($consulta);  
//inseeta contacto
$consulta="INSERT INTO contactos (id, id_cliente, nombre, cargo, dpto, telf, celular, email, fax, obs, id_user, fecha_registro) VALUES ('', '$nro_', '$cnombre', '$ccargo', '$cdpto', '$ctelf', '$ccel', '$cmail', '$cfax', '$cobs', '$id_user', '$fecha_registro')";
$resultado=mysql_query($consulta);  
if($resultado)
{
?>
<div align="center">Acción exitosa!<br />
  Cliente: <strong><? echo $rs; ?></strong><br />
  <br />
  <a href="JavaScript:close();" title="pasar valor" onClick="insertar();">PASAR VALOR Y CERRAR VENTANA</a><BR /></div>
  <?
}
else echo"Ocurrio un error: ".mysql_error();

}
else echo"<center>MENSAJE: El CLIENTE <b>$rs</b> ya exite! <br />
  <a href=\"JavaScript:close();\">CERRAR VENTANA</a></center>";
?>
  </form>
<?

}
else 
{
header("Location: ../index.php");
}
?>

