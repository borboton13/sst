<?
$nro = base64_decode($_GET["nro"]);
$id_user = base64_decode($_GET["id_user"]);
$periodo = $_GET["periodo"];
require("../funciones/motor.php");
include ('lib/class.ezpdf.php');

$pdf =& new Cezpdf('LETTER','landscape');
$pdf->selectFont('fonts/Helvetica.afm');
$pdf->ezSetCmMargins(1.5,1.5,1.5,1);
////informacion de la pagina
$datacreator = array (
                    'Title'=>'ORDEN DE COMPRA INTERNO',
                    'Author'=>'Marcelo Chavez Duran',
                    'Subject'=>'ARCHIVO PDF AMPER',
                    'Creator'=>'marcelo.chavez@amperonline.com',
                    'Producer'=>'http://www.amperonline.com'
                    );
$pdf->addInfo($datacreator);
//encabezado
$all = $pdf->openObject();
$pdf->saveState();
$pdf->ezStartPageNumbers(710,35,10,'right','Pag. {PAGENUM} de {TOTALPAGENUM}');
$pdf->setStrokeColor(1,hexdec ('33')/255,hexdec('00')/255);
$pdf->line(30,32,765,32);
$pdf->addTextWrap(20,20,740,9,'<b>AMPER S.R.L.</b> | Calle México 1790 | Edif. María Reyna P.2 Of. 2-C | Telf.: 2486584 – 2486597 | Fax: 2486635 | Casilla 7981  | La Paz, Bolivia | www.amperonline.com','center');
$pdf->restoreState();
$pdf->closeObject();
$pdf->addObject($all,'all');

$pdf->setColor(0.48,0.48,0.48);
$pdf->filledRectangle(30,560,740,30);
$pdf->setColor(0.941,0.941,0.953);
$pdf->filledRectangle(30,500,740,60);
$pdf->setColor(1,0.8,0);
$pdf->addText(35,570,14,'<b><i>LISTADO DE EQUIPOS PARA SEGUIMIENTO TECNICO ('.$periodo.'° PERIODO)</i></b>');
$pdf->addJpegFromFile('img/amper_sombra.jpg',740,560,'');
$pdf->setColor(0,0,0);

	$consulta="SELECT c.razon_social,s.declaracion_proyecto,date_format(s.fecha_inicio,'%d/%m/%Y'),date_format(s.fecha_final,'%d/%m/%Y'),concat(u.nombre, ' ', u.ap_pat),s.fecha_registro 
FROM (st_proyecto s INNER JOIN clientes c ON s.id_cliente=c.id) INNER JOIN usuarios u ON s.id_usuario=u.id WHERE s.id_st_proyecto='".$nro."'";
	$resultado=mysql_query($consulta);
	$filas=mysql_num_rows($resultado);
    $dato=mysql_fetch_array($resultado);
	
	 $razon_social=$dato[0]; 
	 $declaracion_proyecto=$dato[1]; 
	 $fecha_inicio=$dato[2]; 
	 $fecha_final=$dato[3]; 
	 $id_usuario=$dato[4]; 
	 $fecha_registro=$dato[5];
	 
	 $fila1=" Nro: <b>".$nro."</b>\n CLIENTE <b>".$razon_social."</b>\n FECHA INICAL <b>".$fecha_inicio."</b>\n FECHA FINAL <b>".$fecha_final."</b>";
	 $fila2="Fecha Registro: <b>".$fecha_registro."</b>\n ingresado por: <b>".$id_usuario."</b>";	 
	 if(strlen($declaracion_proyecto)<=150) $fila2="Proyecto: ".$declaracion_proyecto."\n".$fila2;

$data = array(
array('izq'=>$fila1,'der'=>$fila2)
);

$pdf->ezTable($data,array('izq'=>'','der'=>''),'',array('xOrientation'=>'center',
                'width'=>560,
				'shaded'=> 0,
				'showLines'=> 0,
				'rowGap' => 0,
				'cols'=>array(
				'der'=>array('justification'=>'right','width'=>460),
				'izq'=>array('justification'=>'left','width'=>270)
				)
				));
$pdf->ezText("\n",5);

if(strlen($declaracion_proyecto)>150) $pdf->ezText("<b>Declaración del proyecto:</b>\n".$declaracion_proyecto,10);

//////////// detalles
$consulta="SELECT departamento,id_item,sn FROM st_trabajos WHERE id_st_proyecto='".$nro."' ORDER BY departamento ASC, id_item ASC";
	$resultado=mysql_query($consulta);
	$filas=mysql_num_rows($resultado);
if($filas!=0)
{ 	
$i=0;
$titles = array('0'=>'<b>N°  </b>', '1'=>'<b>PRODUCTO</b>', '2'=>'<b>MARCA</b>', '3'=>'<b>CARACT.</b>', '4'=>'<b>S/N</b>', '5'=>'<b>UBICACION</b>', '6'=>'<b>ESTADO</b>', '7'=>'<b>FECHA</b>');
$options = array('xPos'=>'left',
                'xOrientation'=>'right',
				'colGap' => 2,
				'shaded'=> 0,
				'showLines'=> 2,
				'titleFontSize' => 16,
				'lineCol' => array(0.48,0.48,0.48),
				'cols'=>array(
				'0'=>array('justification'=>'right','width'=>20),
				'1'=>array('justification'=>'center','width'=>80),
				'2'=>array('justification'=>'center','width'=>140),
				'3'=>array('justification'=>'left','width'=>60),
				'4'=>array('justification'=>'center','width'=>110),
				'5'=>array('justification'=>'left','width'=>150),
				'6'=>array('justification'=>'center','width'=>60),				
				'7'=>array('justification'=>'center','width'=>100)
				)
            );
			
	while($dato=mysql_fetch_array($resultado))
	 {
	
	$id_item=$dato[1]; 
	 $limit_ini=$periodo-1;
	 $limit_fin=$periodo;
	
	$resultadox=mysql_query("SELECT producto,marca,caracteristicas,ubicacion,dia,date_format(fecha,'%d/%m/%y') as fecha,condicion_final,date_format(hora_programada,'%H:%i') AS hora_programada,postm_condicion_final,id_usuario FROM v_st_cronograma WHERE id_item='".$id_item."' ORDER BY fecha ASC limit $limit_ini,$limit_fin");
	
	$b=mysql_fetch_array($resultadox);
	
	if($b['id_usuario']==$id_user)
	{
		
		$departamento=$dato[0];
		$sn=$dato[2];
		$producto=$b['producto'];
		$marca=$b['marca'];
		$caracteristicas=$b['caracteristicas'];
		$ubicacion=$b['ubicacion'];
	
		$fecha=$b['dia']." ".$b['fecha']." ".$b['hora_programada'];
		if($b['condicion_final']!="") {
		$condicion_final=$b['condicion_final']; 
		if($postm_condicion_final=="OK+") $condicion_final=$b['postm_condicion_final']; 
		}
		else $condicion_final="Inicial"; 
	
	
		 $i++;	 	 	
		
		 if($departamento_aux!=$departamento && $i!=1)
		 { 	 
		 $pdf->ezTable($array_auxiliar, $titles,$departamento_aux,$options);
		 unset($array_auxiliar); 
		 }	 
		 $array_auxiliar[] = array('0'=>$i,'1'=>$producto,'2'=>$marca,'3'=>$caracteristicas,'4'=>$sn,'5'=>$ubicacion,'6'=>$condicion_final,'7'=>$fecha);		
		 
	 
	 $departamento_aux=$departamento;
	 
	 }
}
	 $pdf->ezTable($array_auxiliar, $titles,$departamento_aux,$options);
	} 	

$pdf->ezStream();
?>