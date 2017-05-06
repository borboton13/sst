<?
$adm = $_GET["adm"];
$id_user = $_GET["id_user"];
$mes = $_GET["mes"];
$anio = $_GET["anio"];
	
	switch($mes)
	  {
	  case 1: $mes_="ENERO";break;
	  case 2: $mes_="FEBRERO";break;
	  case 3: $mes_="MARZO";break;
	  case 4: $mes_="ABRIL";break;
	  case 5: $mes_="MAYO";break;
	  case 6: $mes_="JUNIO";break;
	  case 7: $mes_="JULIO";break;
	  case 8: $mes_="AGOSTO";break;
	  case 9: $mes_="SEPTIEMBRE";break;
	  case 10: $mes_="OCTUBRE";break;
	  case 11: $mes_="NOVIEMBRE";break;
	  case 12: $mes_="DICIEMBRE";break;		  	  
	  }
require("../funciones/motor.php");
include ('lib/class.ezpdf.php');

$datox=mysql_fetch_array(mysql_query("SELECT descripcion FROM parametrica WHERE grupo='pie' AND sub_grupo='pie_pdf'"));
$pie=$datox['descripcion'];

$pdf =& new Cezpdf('LETTER','landscape');
$pdf->selectFont('fonts/Helvetica.afm');
$pdf->ezSetCmMargins(1.5,1.5,1.7,1);
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

$pdf->ezImage('../img/logo_pdf.jpg',0,'','','left',array('width'=>1));
$pdf->rectangle(198,517,572,64);
$pdf->addText(260,560,12,'<b><i>CRONOGRAMA DE EQUIPOS/SERVICIOS PARA SEGUIMIENTO TECNICO</i></b>');
$pdf->addText(380,535,12,'<b>(mes de '.$mes_.' de '.$anio.')</b>');


$pdf->ezText("\n",5);

if(strlen($declaracion_proyecto)>150) $pdf->ezText("<b>Declaración del proyecto:</b>\n".$declaracion_proyecto,10);

//////////// detalles
$consulta="SELECT dia,date_format(fecha,'%d/%m/%y'),responsable,condicion_final,razon_social,producto,marca,caracteristicas,ubicacion,departamento FROM v_st_cronograma WHERE MONTH(fecha)='$mes' AND YEAR(fecha)='$anio'";
	if($adm!=1){
	$add_sql=" AND id_usuario='".$id_user."'";
	}	
	$consulta.=$add_sql." ORDER BY fecha";
	
	$resultado=mysql_query($consulta);
	$filas=mysql_num_rows($resultado);
if($filas!=0)
{ 	
$i=0;
$titles = array('0'=>'<b>N°  </b>', '1'=>'<b>FECHA</b>', '2'=>'<b>TECNICO</b>', '3'=>'<b>ESTADO</b>', '4'=>'<b>CLIENTE</b>', '5'=>'<b>PRODUCTO - MARCA - CARAC.</b>', '6'=>'<b>DPTO - UBICACION</b>');
$options = array('xPos'=>'left',
                'xOrientation'=>'right',
				'colGap' => 2,
				'shaded'=> 0,
				'showLines'=> 2,
				'titleFontSize' => 16,
				'lineCol' => array(0.48,0.48,0.48),
				'cols'=>array(
				'0'=>array('justification'=>'right','width'=>20),
				'1'=>array('justification'=>'center','width'=>70),
				'2'=>array('justification'=>'center','width'=>95),
				'3'=>array('justification'=>'center','width'=>60),
				'4'=>array('justification'=>'left','width'=>100),
				'5'=>array('justification'=>'left','width'=>200),
				'6'=>array('justification'=>'left','width'=>180)
				)
            );
			
			
	while($dato=mysql_fetch_array($resultado))
	 {
	 $i++;	 	 	
	 $fecha=$dato[0]." ".$dato[1];
	 $tecnico=$dato[2];
	 if($dato[3]!="") $estado=$dato[3]; else $estado="Inicial";
	 $cliente=$dato[4];
	 $producto=$dato[5]." - ".$dato[6]." - ".$dato[7];
	 $lugar=$dato[9]." - ".$dato[8];
	$array_auxiliar[] = array('0'=>$i,'1'=>$fecha,'2'=>$tecnico,'3'=>$estado,'4'=>$cliente,'5'=>$producto,'6'=>$lugar);		
     }
	 $pdf->ezTable($array_auxiliar, $titles,$departamento_aux,$options);
	} 	

$pdf->ezStream();
?>