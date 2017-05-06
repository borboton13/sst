<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Listado de usuarios registrados en el Portal</title>
<link href="../../css/general.css" rel="stylesheet" type="text/css">
</head>
<body>

<?
require("../../funciones/motor.php");
include("../../funciones/class.paginado.php");
if (isset($_GET['pagina'])){
$pagina = $_GET['pagina'];
}
if (isset($_GET['id'])){
$id = $_GET['id'];
$id_=base64_decode($id);
}
?>
<table width="430" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="31" class="title4"><br>
                  Historial de Accesos de Usuario
                :  
<?
$sql="SELECT nombre_completo,correo,descripcion FROM st_personal_veedor WHERE id_st_personal_veedor='".$id_."'";
$resultado=mysql_query($sql);
$dato=mysql_fetch_array($resultado);
$nombre_completo=$dato[0];
$correo=$dato[1];
$descripcion=$dato[2];
?>					
                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="table1">
                      <tbody>
                        <tr>
                          <td width="694" height="20" bgcolor="#474747" class="title3"><img src="../../img/user.gif" alt="user" width="16" height="16" border="0" align="absbottom" /> <? 
		echo"<span class='title3'>$nombre_completo</span>"; ?><br /><a href="mailto:<?=$correo;?>" class="enlaceboton" title="Enviar Correo"><span class="title7"><?=$correo;?></span>
	    </a><br /><span class="title3"><?=$descripcion;?></span></td>
                        </tr>
                      </tbody>
                    </table></td>
              </tr>

<tr> 
<tr>
<td>
<table width="100%" cellspacing="0" bgcolor="#E0E0E0">
<tr>
		             <td>
                       <div align="right">
                         <?
$rs = new paginado($conexion);
$rs->pagina($pagina);
$rs->porPagina(20);
$rs->propagar("id");
if(!$rs->query("SELECT id_st_registro_usuarios,date_format(fecha, '%d/%m/%y %H:%i:%s'),ip,isp FROM st_registro_usuarios WHERE id_st_personal_veedor='$id_' ORDER BY fecha DESC"))
{    die( $rs->error() );
}
echo "Mostrando ".$rs->desde()." - ".$rs->hasta()." de un total de ".$rs->total()."<br>";
?>	 
    </div></td>
</tr>		
</table>
</td></tr>	  
              <tr>
              
                <td >
  
				  <table width="100%" class="table1">
						  <tr bgcolor="#485765">
						  <td width="7%" height="16" class="title3">ID</td>
			              <td  width="34%" class="title3">
              <div align="center"> FECHA Y HORA </div></td>	
			  <td  width="28%"class="title3"><div align="center">IP</div></td>
			  <td  width="31%"class="title3"><div align="center">ISP</div></td>
						  </tr>
						  
						  <?
  $i=0; 
  while($row = $rs->obtenerArray())
 {
 $nro=$row[0];
 $fecha=$row[1];
 $ip=$row[2];
 $isp=$row[3];
///////////
	 $i++;
	 if($i%2==0)
	{
	$rowt="#f6f7f8";
	}
	else
	{
	$rowt="#f1f1f1";
	}
	echo"<tr height='25' bgcolor='$rowt' onmouseover=\"setPointer(this, '#DADADA')\" onmouseout=\"setPointer(this, '$rowt')\"> 
            <td>$nro</td>
			<td><DIV ALIGN='center'>$fecha</DIV></td>
			<td><DIV ALIGN='center'>$ip</DIV></td>
			<td><DIV ALIGN='center'>$isp</DIV></td>"; 
          echo"</tr>";
 }

?>
			      </table>
			    </td>
				  
              </tr>
			  <tr> 
		             <td colspan="4" bgcolor="#E0E0E0" id=pie>
                       <div align="right">
                         <?
echo $rs->anterior()." - ".$rs->nroPaginas()." - ".$rs->siguiente();
?>					 
                </div></td>
</tr>
              </tr>	
</table>
</body>
</html>
<SCRIPT src="../../js/general.js" type=text/javascript></SCRIPT>