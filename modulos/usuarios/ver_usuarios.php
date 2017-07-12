<?
include("../../funciones/class.paginado.php");
if (isset($_GET['pagina'])){
$pagina = $_GET['pagina'];
}				  
$nro_por_pagina=15;

$consulta="SELECT id,CONCAT(nombre,' ',ap_pat,' ',ap_mat) AS nom,DATE_FORMAT(fecha_nacimiento,'%d/%m/%Y') AS nac,cuenta,direccion,mail,mail2,skype,msn,telf,cel,telf_oficina,interno,cargo,nro_ing,activo FROM usuarios";

 if($nively=='1') $admin=true;
 else  $admin=false;

?>
<div align="center"><span class="title">LISTA DE USUARIOS</span></div>
<table width="100%" class="table4">
<tr>
    <td colspan="6" class="paginado">
        <div align="left">
        <?
        $rs = new paginado($conexion);
        $rs->pagina($pagina);
        $rs->porPagina($nro_por_pagina);
        $rs->propagar("path");
        $rs->propagar("nro_por_pagina");
        if(!$rs->query($consulta))
        {    die( $rs->error() );
        }
        echo "Mostrando ".$rs->desde()." - ".$rs->hasta()." de un total de ".$rs->total()."<br>"; ?>
        </div>
    </td>
    <td colspan="4" class="paginado">
        <div align="right">
            <input class="btn_dark" onClick="location.href='<?=$musuarios?>nuevo_usuario.php'" type="button" value="Nuevo">
        </div>
    </td>
</tr>					  
<tr>
<th width="3%" height="16">COD</th>
<th width="22%">USUARIO</th>
<th width="17%">CARGO</th>			              
<th width="20%">CORREOS</th>
<th width="17%">CUENTAS EXTERNAS </th> 
<th width="8%">TELF</th>
<th width="5%">TELF OF</th>	
<th width="3%">INT</th>	
<th width="2%">ACT</th>
<th width="3%"></th>
</tr>
<?
$i=0;
  while($row = $rs->obtenerArray())
 {
 
 $id=$row['id'];
 $nom=$row['nom'];
 $nac=$row['nac'];
 $cuenta=$row['cuenta'];
 $direccion=$row['direccion'];
 $mail=$row['mail'];
 $mail2=$row['mail2'];
 $skype=$row['skype'];
	if($skype!="") $skype_link='<a href="skype:'.$skype.'?chat" class="enlaceboton">'.$skype.'<img src="../../img/ico_skype.gif" width="16" height="16" border="0"></a>
';
else $skype_link="";
 $msn=$row['msn'];
	if($msn!="") $msn='<a href="msnim:chat?contact='.$msn.'" class="enlaceboton">'.$msn.'<img src="../../img/ico_msn.gif" width="16" height="16" border="0"></a>';

 $telf=$row['telf'];
 $cel=$row['cel'];
 $telf_oficina=$row['telf_oficina'];
 $interno=$row['interno'];
 $cargo=$row['cargo'];
 $nro_ing=$row['nro_ing'];
 $activo=$row['activo'];
 switch($activo){
 case '1' : $activo='<img src="../../img/ico_2.gif" width="16" height="16" border="0" alt="Activo">'; break;
 case '0' : $activo='<img src="../../img/ico_0.gif" width="16" height="16" border="0" alt="Usuario Inactivo">'; break;
 default: $activo="?";
 }
 

if($buscar!=NULL)
switch($campo)
{
case 'c.razon_social':
$cliente=eregi_replace ($buscar,"<span class='marcar'>".$buscar."</span>",$cliente); break;
case 'p.proyecto':
$proyecto=eregi_replace ($buscar,"<span class='marcar'>".$buscar."</span>",$proyecto); break;
} 

 $i++;
	 if($i%2==0)
	{
	$rowt="#f6f7f8";
	}
	else
	{
	$rowt="#f1f1f1";
	}
///////////
 
 if($admin){
 $edit="<a href=\"".$link_modulo."?path=modificar_usuario.php&id=".$id."\"><img src='../../img/change.gif' alt='Modificar Monto' border=\"0\" align=\"absmiddle\"></a>";
 }
 else $edit="";
 	
	echo"<tr height='25' bgcolor='$rowt' onmouseover=\"setPointer(this, '#DADADA')\" onmouseout=\"setPointer(this, '$rowt')\"> 
            <td><DIV ALIGN='CENTER'><B>$id</B></DIV></td>
            <td><span class='title6'>$nom</span> <span class='title5'>$nac<BR>$direccion</span></td>
			<td class='title5'>$cuenta<BR><b>$cargo</b></td>			
            <td class='title5'><a href='mailto:$mail' class='enlacemail'>$mail".'<img src="../../img/ico_outlook.jpg" width="16" height="16" border="0">'."</a><BR>$mail2</td>            
            <td class='title5'>$skype_link<BR>$msn</td>
			<td class='title5'>$telf<BR>$cel</td>
			<td class='title5'>$telf_oficina</td>
			<td><span class='title'>$interno</span></td>			
			<td>$activo</td>
			<td>$edit</td>";
          echo"</tr>";
 }
?>
<tfoot>
<tr> 
<td colspan="10" class="paginado">
<?
echo $rs->anterior()." - ".$rs->nroPaginas()." - ".$rs->siguiente();
?></td>
</tr>	
</tfoot>
</table>
<script type="text/javascript" src="http://download.skype.com/share/skypebuttons/js/skypeCheck.js"></script>
