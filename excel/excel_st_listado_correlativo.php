<?
require("../funciones/motor.php");

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=st_listado_".date("Y-m-d").".xls");
header("Pragma: no-cache");
header("Expires: 0");


$nro = base64_decode($_GET["nro"]);

$sql="SELECT form,nro,DATE_FORMAT(p1,'%Y-%m-%d') AS inicio,DATE_FORMAT(p1,'%h:%i') AS inicio_hora,DATE_FORMAT(hora_salida,'%Y-%m-%d') AS solucion,DATE_FORMAT(hora_salida,'%h:%i') AS solucion_hora,ubicacion,departamento,producto,caracteristicas,funcionario,personal,revision,condicion_final,postm_condicion_final,pasos,id_usuario,id_item FROM v_correlativo WHERE 1=1";

$txt="CRITERIO DE BUSQUEDA y/o FILTRADO: ";
////////ubicacion
if (isset($_GET['ubicacion']) && $_GET['ubicacion']!=""){
$ubicacion = $_GET['ubicacion'];
$sql.=" AND ubicacion like '%$ubicacion%'";
$txt.=" | UBICACION -> <b>".$ubicacion."</b>";
}
///depto
if(isset($_GET['departamento']) && $_GET['departamento']!="") {
$departamento=$_GET['departamento'];
$sql.=" AND departamento='$departamento'";
$txt.="| DEPTO: <B>$departamento</B> ";
}
///producto
if(isset($_GET['producto']) && $_GET['producto']!="") {
$producto=$_GET['producto'];
$sql.=" AND producto='$producto'";
$txt.="| DEPTO: <B>$producto</B> ";
}
///detalles
if(isset($_GET['caracteristicas']) && $_GET['caracteristicas']!="") {
$caracteristicas=$_GET['caracteristicas'];
$sql.=" AND caracteristicas like '%$caracteristicas%'";
$txt.="| DETALLES: <B>$caracteristicas</B> ";
}
///funcionario
if(isset($_GET['funcionario']) && $_GET['funcionario']!="") {
$funcionario=$_GET['funcionario'];
$sql.=" AND funcionario LIKE '%$funcionario%'";
$txt.="| FUNCIONARIO: <B>$funcionario</B> ";
}
///tecnico
if(isset($_GET['tecnico']) && $_GET['tecnico']!="") {
$tecnico=$_GET['tecnico'];
$sql.=" AND personal='$tecnico'";
$txt.="| TECNICO: <B>$tecnico</B> ";
}
///revision
if(isset($_GET['revision']) && $_GET['revision']!="") {
$revision=$_GET['revision'];
$sql.=" AND revision='$revision'";
$txt.="| REVISION: <B>$revision</B> ";
}
///estado
if(isset($_GET['estado']) && $_GET['estado']!="") {
$estado=$_GET['estado'];

switch($estado){
case "postok": $sql.=" AND postm_condicion_final='OK+'"; break;
case "Pendiente": $sql.=" AND condicion_final='$estado' AND postm_condicion_final='0'"; break;
default: $sql.=" AND condicion_final='$estado'";
}

$txt.="| ESTADO: <B>$estado</B> ";
}
/////////ORDENAR
if (isset($_GET['ordenar_por'])){
$ordenar_por = $_GET['ordenar_por'];
$orden = $_GET['orden'];
	switch($ordenar_por){
	case 'inicio': $sql.=" ORDER BY p1 $orden"; break;
	case 'solucion': $sql.=" ORDER BY hora_salida $orden"; break;
	case 'nro': $sql.=" ORDER BY form,nro $orden"; break;
	}
$sw_ordenar=1;
$txt.=" | Ordenado por <b>".$ordenar_por."</b> en orden <b>".$orden."</b>";
}
else {
$ordenar_por = "nro";
$orden = "ASC";
$sql.=" ORDER BY form,nro ASC";
}

?>
<table border="1">
<caption>
EQUIPOS/SERVICIOS PARA EL SEGUIMIENTO TECNICO DEL PROYECTO POR CORRELATIVO
</caption>
  <tr>
    <td colspan="12"><?=$txt?></td>
  </tr>
  <tr>
    <th>N&deg;</th>
    <th>Nro INF </th>
    <th>FECHA INICIO </th>
    <th>HORA INI</th>
    <th>FECHA INICIO </th>
    <th>HORA SOL</th>
    <th>ESTACION</th>
    <th>DEPTO</th>
    <th>PROD/SERV</th>
    <th>DETALLES</th>
    <th>FUNCIONARIO</th>
    <th>TECNICO</th>
    <th>INFORME</th>
    <th>ESTADO</th>
  </tr>
  <tbody>
    <?
	$resultado=mysql_query($sql);
	$filas=mysql_num_rows($resultado);
	if($filas!=0)
	{ 

	$i=0;
	while($row=mysql_fetch_array($resultado))
	 {
///////////
$img='';
$cliente=$row['razon_social'];
$condicion_final=$row['condicion_final'];
$postm_condicion_final=$row['postm_condicion_final'];
$pro_key=$row['form'];
$id_st_cronograma_informes=$row['nro'];
$pasos=$row['pasos'];
if($pasos=='') $pasos=0;
$id_usuario=$row['id_usuario'];
$id_item=$row['id_item'];

if($ubicacion!="") { $row['ubicacion']=eregi_replace ($ubicacion,"<span class='marcar'>".$ubicacion."</span>",$row['ubicacion']); }
if($departamento!="") { $row['departamento']=eregi_replace ($departamento,"<span class='marcar'>".$departamento."</span>",$row['departamento']); }
if($producto!="") { $row['producto']=eregi_replace ($producto,"<span class='marcar'>".$producto."</span>",$row['producto']); }
if($caracteristicas!="") { $row['caracteristicas']=eregi_replace ($caracteristicas,"<span class='marcar'>".$caracteristicas."</span>",$row['caracteristicas']); }
if($funcionario!="") { $row['funcionario']=eregi_replace ($funcionario,"<span class='marcar'>".$funcionario."</span>",$row['funcionario']); }
if($tecnico!="") { $row['personal']=eregi_replace ($tecnico,"<span class='marcar'>".$tecnico."</span>",$row['personal']); }
	 
	$nro_inf=strtoupper($pro_key).str_pad($id_st_cronograma_informes, 4, "0", STR_PAD_LEFT);
		  
	 if($condicion_final!=NULL && $condicion_final!=""){     
	if($condicion_final=='Pendiente' && $postm_condicion_final=="OK+"){
		$condicion_final=$postm_condicion_final;
		}		
	}

?>
    <tr>
      <td align="right"><?=$i?></td>
      <td align="center"><B><?=$nro_inf?></B></td>
      <td align="center" style="mso-number-format:'dd/mm/yyyy'"><?=$row['inicio']?></td>
      <td align="center"><?=$row['inicio_hora']?></td>
      <td align="center" style="mso-number-format:'dd/mm/yyyy'"><?=$row['solucion']?></td>
      <td align="center"><?=$row['solucion_hora']?></td>
      <td><?=$row['ubicacion']?></td>
      <td><?=$row['departamento']?></td>
      <td align="center"><?=$row['producto']?></td>
      <td><?=$row['caracteristicas']?></td>
      <td><?=$row['funcionario']?></td>
      <td><?=$row['personal']?></td>
      <td align="center"><?
	switch($row['revision']){
	case 'R': echo"Pendiente de Revision"; break;
	case 'E': echo"Terminado y Enviado"; break;
	case '0': echo"Sin Informe"; break;
	}
	?></td>
      <td><?=$condicion_final?></td>
    </tr>
    <?
$i++;
 }
}
?>
</table>
