<?
require("../../funciones/motor.php");
$id_item=$_GET["id_item"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../../css/general.css" rel="stylesheet" type="text/css">
<title>Actividades</title>
</head>

<body>
<? 
$consulta="SELECT DATE_FORMAT(a.fecha,'%d/%m/%y %H:%s') as fecha,a.observacion,CONCAT(b.nombre,' ',ap_pat) AS usuario FROM st_items_obs a JOIN usuarios b ON a.id_usuario=b.id AND id_item=$id_item ORDER BY fecha DESC";
	$resultado=mysql_query($consulta);
	$filas=mysql_num_rows($resultado);
?>
<table width="268" height="62" border="0" align="center" cellpadding="0" cellspacing="2">
	  <tr>
        <td height="20" colspan="3" bgcolor="#FFE3BB"><img src="../../img/informe2.jpg" alt="Ver Informe Completo" width="22" height="22" border="0" align="absmiddle" />Ver Historial de Observaciones:</td>
      </tr>
      <tbody>
        <tr>
          <td height="14" bgcolor="#485765" class="title3"><div align="center">FECHA</div></td>
          <td height="14" bgcolor="#485765" class="title3">OBSERVACION</td>
        </tr>
<?
	if($filas!=0)
	{
	while($dato=mysql_fetch_array($resultado))
	 {
?>
        <tr>
          <td width="26%" height="20" bgcolor="#F1F1F1"><center><span class="title7"><?=$dato['fecha'];?></span><BR /><span class="title5"><?=$dato['usuario'];?></span></center></td>
          <td width="74%" height="20" bgcolor="#F1F1F1" valign="top"><?=$dato['observacion'];?></td>
        </tr>
<?
	 }
	 
	}
?>
      </tbody>
</table>
</body>
</html>
