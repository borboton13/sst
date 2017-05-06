<?
$nro = $_GET["nro"];
	$consulta="SELECT departamento,producto,marca,caracteristicas,ubicacion FROM st_trabajos WHERE id_st_proyecto='".$nro."'";
	$resultado=mysql_query($consulta);
	$filas=mysql_num_rows($resultado);
	if($filas!=0)
	{ 
	while($dato=mysql_fetch_array($resultado))
	 {
	 $departamento=$dato[0]; 
	 $producto=$dato[1]; 
	 $marca=$dato[2]; 
	 $caracteristicas=$dato[3]; 
	 $ubicacion=$dato[4]; 
	 }
	}
?>

<table width="100%" class="table1">
						  <tr bgcolor="#485765">
						  <td width="4%" height="16" class="title3">N&deg;</td>
			              <td  width="16%"  class="title3">
              <div align="center">PRODUCTO</div></td>			              
            <td  width="18%"  class="title3">
                <div align="center">MARCA</div></td>
           <td  width="13%"  class="title3"><div align="center">CARACTERISTICAS</div>             </td> 
            <td  width="23%" class="title3">
              <div align="center">UBICACION</div></td>
			  <td  width="12%"class="title3"><div align="center">ESTADO ACTUAL </div></td>
			  <td  width="7%"class="title3"><div align="center">INFORME</div></td>
			  <td  width="7%"class="title3"><div align="center">VISITAS </div></td>
						  </tr>
            </table>
