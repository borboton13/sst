<?
session_start(); 
require("../funciones/motor.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD>
<TITLE>Amper :: Sistema Integrado Administrativo</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/general.css" rel="stylesheet" type="text/css">
</HEAD>
<BODY>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
						  <tr bgcolor="#485765">
						  <td width="5%" height="16" bgcolor="#666666" class="title3">NRO</td>
			              <td  width="25%" bgcolor="#666666"  class="title3">
              <div align="center">CLIENTE</div></td>			              
            <td  width="27%" bgcolor="#666666"  class="title3">
                <div align="center">DIRECCION</div></td>
            <td  width="13%" bgcolor="#666666" class="title3">
              <div align="center">CARCATERISTICAS</div></td>
			  <td  width="17%" bgcolor="#666666" class="title3">
              <div align="center">NIVEL</div></td>
			  <td  width="13%" bgcolor="#666666"  class="title3"><div align="center">AREA</div>             </td> 
            <td  width="13%" bgcolor="#666666" class="title3">
              <div align="center">CIUDAD</div></td>
			  </tr>
						  
						  <?

					  

	$consulta="SELECT id,razon_social,direccion,caracteristicas,nivel_cliente,area,ciudad FROM clientes ORDER BY razon_social ASC;";
$resultado=mysql_query($consulta);
$filas=mysql_num_rows($resultado);
if($filas!=0)
{  $i=0;
	while($row=mysql_fetch_array($resultado))
	 {	 
 $id=$row[0];
 $razon_social=$row[1];
 $direccion=nl2br($row[2]);
 $caracteristicas=$row[3];
 $nivel=$row[4];
 $area=$row[5];
 $ciudad=$row[6];

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
	$consulta2="SELECT nombre,cargo,telf,celular,email,obs FROM contactos WHERE id_cliente='".$id."' ORDER BY 		nombre ASC";		
	$resultado2=mysql_query($consulta2);
		$filas2=mysql_num_rows($resultado2);
		$expandir=$filas2+1;
		
			echo"<tr height='25' bgcolor='$rowt'> 
            <td rowspan='$expandir' class='table1'><DIV ALIGN='RIGHT'>$i</DIV></td>
            <td class='table1'><strong>$razon_social</strong></td>			
            <td class='table1'>$direccion &nbsp;</td>            
            <td class='table1'><DIV ALIGN='center'>$caracteristicas &nbsp;</DIV></td>
			<td class='table1'><DIV ALIGN='center'>$nivel</DIV></td>
			<td class='table1'><DIV ALIGN='center'>$area</DIV></td>
			<td class='table1'><DIV ALIGN='center'>$ciudad</DIV></td>
			";  
          echo"</tr>";
		  		
		if($filas2!=0)
		{  
		  
			while($dato=mysql_fetch_array($resultado2))
			 {
			 	$nombre=$dato[0];
				$cargo=$dato[1];
				$telf=$dato[2];
				$celular=$dato[3];
				$email=$dato[4];
				$obs=nl2br($dato[5]);

		
		
					echo"<tr><td colspan='6'  class='table1'> 
           <em>Nombre:</em> $nombre | 
			<em>Cargo:</em> $cargo |
			<em>Telf:</em> $telf |
			<em>Cel:</em> $celular |
			<em>mail:</em> $email |
			<em>Obs:</em> $obs
			</td>			
			";  
          echo"</tr>";
			 }
		   
		}	 	  
		  
 }
}  
 
?>
</table>					  
</BODY></HTML>