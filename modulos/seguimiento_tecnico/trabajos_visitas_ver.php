<?
if($nively=='1'){ $adm=1;}

$id_item=$_GET["id_item"];
$resultado=mysql_query("SELECT departamento,producto,marca,caracteristicas,sn,ubicacion,id_st_proyecto FROM st_trabajos WHERE id_item='".$id_item."'");
$dato=mysql_fetch_array($resultado);
$nro=$dato['id_st_proyecto'];
 
 $dato_p=mysql_fetch_array(mysql_query("SELECT descripcion FROM parametrica WHERE grupo='st_archivo' AND sub_grupo='".$dato['producto']."'"));
 $pro_key=$dato_p['descripcion'];
	 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../../css/general.css" rel="stylesheet" type="text/css">
<title>Actividades</title>
</head>
<body style="padding-top:5px;">
<table width="440" class="table2" align="center">
<caption>DATOS DEL ITEM:</caption>
	<tr><th width="28%">Departamento:</th>
	<td width="72%" ><span class="azul"><?=$dato['departamento'];?></span></td>
	</tr>
	<tr><th>Producto/serv:</th><td ><span class="azul"><?=$dato['producto'];?></span></td></tr>
	<tr><th>Marca:</th><td ><span class="azul"><?=$dato['marca'];?></span> <? if($dato['sn']!='') echo"<br><span class='small'>S/N: ".$dato['sn']."</span>";  ?></td></tr>	
	<tr><th>Caracteristicas:</th><td ><span class="azul"><?=$dato['caracteristicas']?></span></td></tr>
	<tr><th width="28%">Estaci&oacute;n:</th>
	<td width="72%" ><span class="azul"><?=$dato['ubicacion']?></span></td>
	</tr>	  
</table>
<?
$consulta="SELECT st.id_st_cronograma_informes_".$pro_key.",date_format(st.fecha,'%d/%m/%Y'),st.condicion_final,st.id_usuario,CONCAT(u.nombre,' ',u.ap_pat),date_format(st.hora_programada,'%H:%i'),st.postm_condicion_final,st.postm_fecha,st.periodo,st.pasos,st.revision
FROM st_cronograma_informes_".$pro_key." st, usuarios u
WHERE st.id_item='".$id_item."' AND st.id_usuario=u.id
ORDER BY st.periodo ASC";
	$resultado=mysql_query($consulta);
	$filas=mysql_num_rows($resultado);
?>
	<table width="440" class="table2" align="center">
	<caption>
	INTERVENCIONES
	:
	</caption>
      <tbody>
        <tr>
          <th height="14" colspan="2"><div align="center">INTERVENCION</div></th>
          <th width="201"><div align="center">INFORME</div></th>
          <th width="62"><div align="center">ESTADO</div></th>
		  <th width="43"><div align="center">RPT</div></th>
        </tr>
        <? 
	if($filas!=0)
	{
	while($dato=mysql_fetch_array($resultado))
	 { 
	 $id_st_cronograma_informes=$dato[0];
	 $fecha=$dato[1];
	 $condicion_final=$dato[2];
	 $id_usuario=$dato[3];
	 $tecnico=$dato[4];
	 $hora_p=$dato[5];
	 $postm_condicion_final=$dato[6];
	 $i=$dato[8];
 	 $pasos=$dato[9];
	 $revision=$dato['revision'];
	 if($pasos=='') $pasos=0;
	 
	 if($adm){
	 	 $img='<a class="listing" href="'.$link_modulo_r.'?path=trabajos_visitas_ver_eliminar_r.php&id_st_cronograma_informes='.$id_st_cronograma_informes.'&pro_key='.base64_encode($pro_key).'">BORRAR</a>';
		 }else{
		 $img='&nbsp;';
		 }
	 
	 	$nro_inf=strtoupper($pro_key).str_pad($id_st_cronograma_informes, 4, "0", STR_PAD_LEFT);
	 
	 if($condicion_final!=NULL && $condicion_final!=""){     
	switch($condicion_final){
	case 'OK' : $img="<img src='../../img/semaforo_verde.gif' border=\"0\" width=\"46\" height=\"16\" align=\"absmiddle\" alt='Estado: OK'>"; break;
	case 'Pendiente' : 
	if($postm_condicion_final=="OK+") {
	$img="<img src='../../img/semaforo_azul.gif' border=\"0\" width=\"62\" height=\"16\" align=\"absmiddle\" alt='Estado: OK $postm_fecha'>";
	$condicion_final=$postm_condicion_final;
	}		
		else $img="<img src='../../img/semaforo_amarillo.gif' border=\"0\" width=\"46\" height=\"16\" align=\"absmiddle\" alt='Estado: Pendiente'>"; break;
	case 'Irreparable' : 
	if($postm_condicion_final=="OK+") {
	$img="<img src='../../img/semaforo_azul.gif' border=\"0\" width=\"62\" height=\"16\" align=\"absmiddle\" alt='Estado: OK $postm_fecha'>";
	$condicion_final=$postm_condicion_final;
	}		
		else $img="<img src='../../img/semaforo_rojo.gif' border=\"0\" width=\"46\" height=\"16\" align=\"absmiddle\" alt='Estado: Irreparable'>"; break;
	default: $img='&nbsp;';
	}	
	}
?>
        <tr>
          <td width="29" class="marco" align="right"><span class="title"><?=$i;?></span></td>
          <td width="81" class="marco" style="font-size:10px"><div align="center">
           <B><?=$nro_inf;?></B>
            <?=$fecha."<br>".$hora_p;?>
          </div></td>
          <td width="201" class="marco">
		  <?		  
 switch($pro_key){
					case "f001" :
					  switch($pasos)
					  {
					  case '3' : $link="f001_3"; break;
					  case '2' : $link="f001_3"; break;
					  case '1' : $link="f001_2"; break;
					  default: $link="f001_1";
					  }
					  $npasos=3;
					break;
					case "f002" : 
	  				  switch($pasos)
					  {
					  case '3' : $link="f002_3"; break;
					  case '2' : $link="f002_3"; break;
					  case '1' : $link="f002_2"; break;
					  default: $link="f002_1";
					  }
					  $npasos=3;
					break;									
					case "f003" : 
	  				  switch($pasos)
					  {
					  case '3' : $link=$pro_key."_3"; break;
					  case '2' : $link=$pro_key."_3"; break;
					  case '1' : $link=$pro_key."_2"; break;
					  default: $link=$pro_key."_1";
					  }
					  $npasos=3;
					break;														
					}
					
		  echo"<img src='../../img/includes_aons.gif' alt='$tecnico' border=\"0\"> ";
		  $edit_p=" <a class=\"enlaceboton\" href='".$link_modulo_r."?path=trabajos_reprogramar.php&id_st_cronograma_informes=".$id_st_cronograma_informes."&pro_key=".$pro_key."' title='Reprogramar tarea'><img src='../../img/change.gif' border=\"0\"></a>";	
		  $link=$link_modulo."?path=trabajos_informar_".$link.".php&id_st_cronograma_informes=".$id_st_cronograma_informes;
		  
		  switch($revision){
	case 'R': 
	if($adm){
	echo"<a class=\"enlaceboton\" href='".$link."' target='_top'><img src='../../img/tarea.gif' alt='dar Informe' border=\"0\"><span class='naranja'> Pendiente de Revision</span></a>";
	}
	else{
	echo"<span class='naranja'>Pendiente de Revision</span>";
	}
	break;
	case 'E':  
	if($adm){
	echo"<img src='../../img/ejecutado.gif' border=\"0\">".'<label title="REVISADO Y ENVIADO" class="verde">Terminado</label>'; echo"<a title='EDITAR INFORME TERMINADO' class=\"listing\" href='".$link."' target='_top'><img src='../../img/change.gif' border=\"0\">Informe</a>"; 
	}
	else{
	echo"<img src='../../img/ejecutado.gif' border=\"0\"><span class='verde'>Terminado</span>";
	}
	break;
	default: if($id_user==$id_usuario || $adm==1) { 
					
				  echo"<a class=\"enlaceboton\" href='".$link."' target='_top'><img src='../../img/tarea.gif' alt='dar Informe' border=\"0\"> Llenar Informe </a>".$pasos."/".$npasos.$edit_p; }
				  else echo"Otro tecnico a cargo";
	}
		  ?>		  </td>
		  <td class="marco" align="center"><?=$img?><? 
		  		  	if($condicion_final=="Pendiente" && ($id_user==$id_usuario || $adm==1)) { echo"<br><a class=\"enlaceboton\" href='".$link_modulo_r."?path=trabajos_informar_ajuste.php&id_st_cronograma_informes=".base64_encode($id_st_cronograma_informes)."&id_item=".base64_encode($id_item)."'><img src='../../img/ajuste.gif' alt='Llenar Ajuste del Informe' border=\"0\" align=\"absmiddle\" >Ajuste</a>"; }
		  ?></td>
		  		  <td class="marco" align="center"><?
		  echo" <a class=\"enlaceboton\" href='../../html/html_st_".$pro_key.".php?id_st_cronograma_informes=".base64_encode($id_st_cronograma_informes)."' onClick=\"openNewWindowhtml( this, '800', '590' );return false;\"><img src='../../img/c_html.gif' alt='Ver Informe en HTML' border=\"0\"></a><a class=\"enlaceboton\" href='../../pdf/pdf_st_".$pro_key.".php?id_st_cronograma_informes=".base64_encode($id_st_cronograma_informes)."' onClick=\"openNewWindowhtml( this, '800', '590' );return false;\"><img src='../../img/imp.gif' alt='Ver Informe en PDF' border=\"0\"></a> ";
		  ?></td>
        </tr>
        <?


	 }
	}
?>
      </tbody>
<? if($adm){ ?>	  
<tfoot>
<tr>
<td colspan="5" align="right">
<a href="<?=$link_modulo_r?>?path=trabajos_visitas_ver_adicionar.php&id_item=<?=$id_item?>" class="enlaceboton"><img src="../../img/adicionar.gif" alt="Adicionar" border="0" align="absmiddle" >Adicionar intervenci&oacute;n a esta estación</a>
</td>
</tr>
</tfoot>	  
<? }?>
</table>
	<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit="return verificar();">		
	<input type="hidden" name="path" value="trabajos_informar_obs_r.php" />
	<input name="nro" type="hidden" value="<?=$nro;?>" />
	<input name="id_item" type="hidden" value="<?=$id_item;?>" />	
	<table width="440" class="table2" align="center">

	<caption>OBSERVACION: </caption>
	<tr>
	<td colspan="2" bgcolor="#E2E2E2">
	  <div align="center">	    
	    <textarea name="observacion" cols="65" rows="5" class="Text_left" id="observacion"></textarea>
	  </div></td>
	</tr><tr>
	<td width="279" bgcolor="#E2E2E2"  ><div align="center">
	      <label class="title2">
          <div align="left">
            <input type="checkbox" name="ocultar" id="ocultar" value="1" onclick="activar();"/>
            Ocultar</div>
	      </label>
	</div></td>
	<td width="139" bgcolor="#E2E2E2"  ><input name="enviar" type="submit" value="Guardar Observacion" /></td>
	</tr>
	</table>
	</form>
</body>
<script type="text/javascript">
function openNewWindowhtml( object, width, height ) 
{
    ventana = window.open( object.href, '','toolbar=1, location=0, directories=0, status=0, menubar=1, scrollbars=1, resizable=1, width=' + width + ', height=' + height );
}
function verificar() 
{
if (document.getElementById('ocultar').checked == false)
{
if(document.amper.observacion.value!="") { return true;}
else { alert("Inserte su observación"); document.amper.observacion.focus();	return false;}
}
}
function activar() {
		if (document.getElementById('ocultar').checked == true)
		{
        document.amper.observacion.value="";
		document.amper.observacion.disabled="disabled";			
		}
		else
		{
		document.amper.observacion.disabled="";
		document.amper.observacion.focus();	
		}
}
</script>
</html>
