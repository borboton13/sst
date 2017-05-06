<?
$nro = base64_decode($_GET["nro"]);
require("../funciones/motor.php");
include ('lib/class.ezpdf.php');
$datox=mysql_fetch_array(mysql_query("SELECT descripcion FROM parametrica WHERE grupo='pie' AND sub_grupo='pie_pdf'"));
$pie=$datox['descripcion'];

function translate($html){			
$html = str_replace ("&ldquo;", "\"", $html);
$html = str_replace ("&rdquo;", "\"", $html);
$html = str_replace ("<br>", "\n", $html);
$html = str_replace ("<br />", "\n", $html);
$html = str_replace ("&nbsp;", " ", $html);
$html = str_replace ("<strong>", "<b>", $html);
$html = str_replace ("</strong>", "</b>", $html);
$html = str_replace ("<em>", "<i>", $html);
$html = str_replace ("</em>", "</i>", $html);
$html = str_replace ("&Aacute;", "Á", $html);
$html = str_replace ("&Eacute;", "É", $html);
$html = str_replace ("&Iacute;", "Í", $html);
$html = str_replace ("&Oacute;", "Ó", $html);
$html = str_replace ("&Uacute;", "Ú", $html);
$html = str_replace ("&aacute;", "á", $html);
$html = str_replace ("&eacute;", "é", $html);
$html = str_replace ("&iacute;", "i", $html);
$html = str_replace ("&oacute;", "ó", $html);
$html = str_replace ("&uacute;", "ú", $html);
$html = str_replace ("&ntilde;", "ñ", $html);
$html = str_replace ("&Ntilde;", "Ñ", $html);
$html = strip_tags ($html,'<i></i><b></b><u></u>');
return $html;
}

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
$pdf->addTextWrap(20,20,740,9,$pie,'center');
$pdf->restoreState();
$pdf->closeObject();
$pdf->addObject($all,'all');
/*
$pdf->setColor(0.48,0.48,0.48);
$pdf->filledRectangle(30,560,740,30);
$pdf->setColor(0.941,0.941,0.953);
$pdf->filledRectangle(30,500,740,60);
$pdf->setColor(1,0.8,0);
$pdf->addText(35,570,14,'<b><i>LISTADO DE EQUIPOS PARA SEGUIMIENTO TECNICO</i></b>');
$pdf->addJpegFromFile('img/amper_sombra.jpg',740,560,'');
$pdf->setColor(0,0,0);
*/
$pdf->setColor(0.941,0.941,0.953);
$pdf->filledRectangle(43,460,727,55);
$pdf->setColor(0,0,0);
$pdf->ezImage('../img/logo_pdf.jpg',0,'','','left',array('width'=>1));
$pdf->rectangle(192,517,578,64);
$pdf->addText(250,560,12,'<b><i>RESUMEN DEL ESTADO ACTUAL DE LOS EQUIPOS/SERVICIOS</i></b>');
$pdf->rectangle(43,460,727,55);

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
	 
	 $fila1=" Nro: <b>".$nro."</b>\n CLIENTE <b>".$razon_social."</b>\n ingresado por: <b>".$id_usuario."</b>";
	 $fila2="FECHA INICAL <b>".$fecha_inicio."</b>\n FECHA FINAL <b>".$fecha_final."</b>\n Fecha Registro: <b>".$fecha_registro."</b>";	 

$data = array(
array('izq'=>$fila1,'der'=>$fila2)
);

$pdf->ezTable($data,'','',array('xOrientation'=>'center',
                'width'=>550,
				'showHeadings'=>0,
				'shaded'=> 0,
				'showLines'=> 0,
				'rowGap' => 0,
				'cols'=>array(
				'der'=>array('justification'=>'right','width'=>450),
				'izq'=>array('justification'=>'left','width'=>270)
				)
				));
$pdf->ezText("\n",5);

$pdf->ezText("<b>Declaración del proyecto:</b>\n".translate($declaracion_proyecto),10);

//////////// detalles
$consulta="SELECT departamento,producto,marca,caracteristicas,sn,ubicacion,id_item FROM st_trabajos WHERE id_st_proyecto='".$nro."' ORDER BY departamento ASC, id_item ASC";
	$resultado=mysql_query($consulta);
	$filas=mysql_num_rows($resultado);
if($filas!=0)
{ 	
$i=0;
$titles = array('0'=>'<b>N°  </b>', '1'=>'<b>PRODUCTO</b>', '2'=>'<b>MARCA</b>', '3'=>'<b>CARACTERISTICAS</b>', '4'=>'<b>UBICACION</b>', '5'=>'<b>ESTADO</b>', '6'=>'<b>FECHA</b>', '7'=>'<b>TRS</b>');
$options = array('xPos'=>'left',
                'xOrientation'=>'right',
				'colGap' => 2,
				'shaded'=> 0,
				'showLines'=> 2,
				'titleFontSize' => 16,
				'lineCol' => array(0.48,0.48,0.48),
				'cols'=>array(
				'0'=>array('justification'=>'right','width'=>20),
				'1'=>array('justification'=>'center','width'=>120),
				'2'=>array('justification'=>'center','width'=>140),
				'3'=>array('justification'=>'left','width'=>140),
				'4'=>array('justification'=>'left','width'=>160),
				'5'=>array('justification'=>'center','width'=>60),
				'6'=>array('justification'=>'center','width'=>50),
				'7'=>array('justification'=>'center','width'=>30)
				)
            );
			
	while($dato=mysql_fetch_array($resultado))
	 {
	$departamento=$dato[0];

	 if($dato[4]!='') $aa=$dato[3]."\n".$dato[4];	 
	 else $aa=$dato[3];
	 
$dato_st=mysql_fetch_array(mysql_query("SELECT b.descripcion FROM st_trabajos a, parametrica b  WHERE a.id_item='".$dato[6]."' AND b.grupo='st' AND b.sub_grupo=a.producto"));
$st_cronograma_informes=$dato_st['descripcion'];
	 
	 $resultadox=mysql_query("SELECT date_format(fecha,'%d/%m/%y'),condicion_final FROM ".$st_cronograma_informes." WHERE id_item='".$dato[6]."' AND condicion_final<>'' ORDER BY fecha DESC limit 1"); 
	 $filasx=mysql_num_rows($resultadox);
	 
	 if($filasx!=0)
	 { 
	  $b=mysql_fetch_array($resultadox); 
	  $bb1=$b[1];
	  $bb2=$b[0];
	 }
	 else { $bb1="Sin Reporte"; $bb2=" ";}
	 
	 $c=mysql_fetch_array(mysql_query("SELECT count(id_".$st_cronograma_informes."),count(condicion_final) FROM ".$st_cronograma_informes." WHERE id_item='".$dato[6]."'"));		
	 
	 if($c[0]!=0)
	 {
	 $cc=$c[1]."/".$c[0]; 
	 }
	 else {$cc="?";}	
	 
	 $i++;	 	 	
	
	 if($departamento_aux!=$departamento && $i!=1)
	 { 	 
	 $pdf->ezTable($array_auxiliar, $titles,$departamento_aux,$options);
	 unset($array_auxiliar); 
	 }	 
	 $array_auxiliar[] = array('0'=>$i,'1'=>$dato[1],'2'=>$dato[2],'3'=>$aa,'4'=>$dato[5],'5'=>$bb1,'6'=>$bb2,'7'=>$cc);		
     $departamento_aux=$departamento;
}
	 $pdf->ezTable($array_auxiliar, $titles,$departamento_aux,$options);
	} 	

$pdf->ezStream();
?>