<?

$cod 		= strtolower(base64_decode($_GET["cod"]));
$idformtto 	= base64_decode($_GET["idformtto"]);

require("../funciones/motor.php");
require("../funciones/funciones.php");
include ('lib/class.ezpdf.php');

$fecha=date("d/m/Y");

$res_form = mysql_query("
SELECT c.nombre AS nom_centro, c.depto, e.idgrupo, e.inicio, es.codigo, es.nombre AS nom_estacion, p.*
FROM formulario_".$cod." p
JOIN evento e 	 ON p.idevento = e.idevento
JOIN estacion es ON e.idestacion = es.idestacion
JOIN centro c ON e.idcentro = c.idcentro
WHERE p.id = ".$idformtto);
$data_f = mysql_fetch_array($res_form);

$res_grupo = mysql_query("
SELECT CONCAT(u1.nombre,' ', u1.ap_pat) AS user1, CONCAT(u2.nombre,' ', u2.ap_pat) AS user2
FROM grupo g
JOIN usuarios u1 ON g.user1 = u1.id
JOIN usuarios u2 ON g.user2 = u2.id
WHERE g.idgrupo = ".$data_f['idgrupo']);
$data_g = mysql_fetch_array($res_grupo);

$datox=mysql_fetch_array(mysql_query("SELECT descripcion FROM parametrica WHERE grupo='pie' AND sub_grupo='pie_pdf'"));
$pie=$datox['descripcion'];
 
$pdf =& new Cezpdf('LETTER','portrait');
$pdf->selectFont('fonts/Helvetica.afm');
$pdf->ezSetCmMargins(1,1,1.5,1);
			
////informacion de la pagina
$datacreator = array ('Title'=>'SISTEMA DE SEGUIMIENTO TECNICO','Author'=>'Ariel Siles Encinas','Subject'=>'ARCHIVO PDF DIMESAT','Creator'=>'ariel.siles@gmail.com','Producer'=>'http://facebook.com/');
$pdf->addInfo($datacreator);

$all = $pdf->openObject();
$pdf->saveState();
//$pdf->ezStartPageNumbers(537,35,10,'right','Pag. {PAGENUM} de {TOTALPAGENUM}');
$pdf->setStrokeColor(1,hexdec ('33')/255,hexdec('00')/255);
$pdf->line(20,32,590,32);
$pdf->line(20,742,590,742);
//$pdf->line(20,670,590,670);
//$pdf->addTextWrap(12,20,580,9,$pie,'center');
$pdf->restoreState();
$pdf->closeObject();
$pdf->addObject($all,'all');

$data=array(array('title'=>'<b>'.strtoupper($data_f['titulo']).'</b>'));
$pdf->ezTable($data,'','',
	array('xPos'=>'left',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>555,
		'colGap' => 5,
		'shaded'=> 0,
		'showLines'=> 0,
		'fontSize' => 10,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'title'=>array('justification'=>'center','width'=>555)
		)
	));
$pdf->ezText("\n",10);
/** -------------------------------------------------------------------- **/
$pdf->ezText("<b>1. RELEVAMIENTO</b>",10);
$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/
$data = array(
	array('c1'=>'Se tiene equipo satelital?:',		'c2'=>$data_f['p01']),
	array('c1'=>'Estado:',							'c2'=>$data_f['p02']),
	array('c1'=>'Marca:',							'c2'=>$data_f['p03']),
	array('c1'=>'Modelo:',							'c2'=>$data_f['p04']),
	array('c1'=>'Rx Signal(Eb/No) dB:',				'c2'=>$data_f['p05']),
	array('c1'=>'Nivel enlace (Downstream) dB:',	'c2'=>$data_f['p06']),
	array('c1'=>'Nivel enlace (UPsstream) dB:',		'c2'=>$data_f['p07']),
	array('c1'=>'Capacidad:',						'c2'=>$data_f['p08']),
	array('c1'=>'Ancho de banda utilizado (Kbps):',	'c2'=>$data_f['p09']),
	array('c1'=>'Frecuencia de trabajo:',			'c2'=>$data_f['p10']),
	array('c1'=>'Configuración:',					'c2'=>$data_f['p11'])
);
$options = array('xPos'=>'left',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>0,
	'colGap' => 5,
	'shaded'=> 0,
	'showLines'=> 0,
	'fontSize' => 9,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'right','width'=>200),
		'c2'=>array('justification'=>'left','width'=>350)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",10);
/** -------------------------------------------------------------------- **/
$pdf->ezText("<b>2. MANTENIMIENTO PREVENTIVO</b>",10);
$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/
$data=array(array('izq'=>'Revisado', 'der'=>'Observaciones'));
$pdf->ezTable($data,'','',
	array('xPos'=>'375',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>206,
		'colGap' => 5,
		'shaded'=> 1,
		'showLines'=> 1,
		'fontSize' => 8,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'izq'=>array('justification'=>'left','width'=>50),
			'der'=>array('justification'=>'left','width'=>160),
		)
	));
/** -------------------------------------------------------------------- **/
$text_p12 = $data_f['p12'];
$arrays = explode('|', $text_p12);
$arr_f1 = explode(';', $arrays[0]);
$arr_f2 = explode(';', $arrays[1]);
$arr_f3 = explode(';', $arrays[2]);
$arr_f4 = explode(';', $arrays[3]);

if($arr_f1[1] != '') $arr_f1[1] = 'OK';
if($arr_f2[1] != '') $arr_f2[1] = 'OK';
if($arr_f3[1] != '') $arr_f3[1] = 'OK';
if($arr_f4[1] != '') $arr_f4[1] = 'OK';

$data = array(
	array('c1'=>$arr_f1[0], 'c2'=>$arr_f1[1], 'c3'=>$arr_f1[2]),
	array('c1'=>$arr_f2[0], 'c2'=>$arr_f2[1], 'c3'=>$arr_f2[2]),
	array('c1'=>$arr_f3[0], 'c2'=>$arr_f3[1], 'c3'=>$arr_f3[2]),
	array('c1'=>$arr_f4[0], 'c2'=>$arr_f4[1], 'c3'=>$arr_f4[2]),
);
$options = array('xPos'=>'55',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>540,
	'colGap' => 5,
	'shaded'=> 1,
	'showLines'=> 1,
	'fontSize' => 8,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'left','width'=>320),
		'c2'=>array('justification'=>'center','width'=>50),
		'c3'=>array('justification'=>'left','width'=>160)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",8);
/** -------------------------------------------------------------------- **/
$data=array(array('h01'=>'', 'h02'=>'Estado', 'h03'=>'IP', 'h04'=>'Observaciones'));
$pdf->ezTable($data,'','',
	array('xPos'=>'55',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>206,
		'colGap' => 5,
		'shaded'=> 1,
		'showLines'=> 1,
		'fontSize' => 8,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'h01'=>array('justification'=>'center','width'=>120),
			'h02'=>array('justification'=>'center','width'=>120),
			'h03'=>array('justification'=>'center','width'=>120),
			'h04'=>array('justification'=>'center','width'=>170)
		)
	));
/** -------------------------------------------------------------------- **/
$text_p13 = $data_f['p13'];
$arrays = explode('|', $text_p13);
$arr_f1 = explode(';', $arrays[0]);
$arr_f2 = explode(';', $arrays[1]);
$arr_f3 = explode(';', $arrays[2]);
$arr_f4 = explode(';', $arrays[3]);
$arr_f5 = explode(';', $arrays[4]);

$data = array(
	array('c1'=>$arr_f1[0], 'c2'=>$arr_f1[1], 'c3'=>$arr_f1[2], 'c4'=>$arr_f1[3]),
	array('c1'=>$arr_f2[0], 'c2'=>$arr_f2[1], 'c3'=>$arr_f2[2], 'c4'=>$arr_f2[3]),
	array('c1'=>$arr_f3[0], 'c2'=>$arr_f3[1], 'c3'=>$arr_f3[2], 'c4'=>$arr_f3[3]),
	array('c1'=>$arr_f4[0], 'c2'=>$arr_f4[1], 'c3'=>$arr_f4[2], 'c4'=>$arr_f4[3]),
	array('c1'=>$arr_f5[0], 'c2'=>$arr_f5[1], 'c3'=>$arr_f5[2], 'c4'=>$arr_f5[3])
);
$options = array('xPos'=>'55',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>540,
	'colGap' => 5,
	'shaded'=> 1,
	'showLines'=> 1,
	'fontSize' => 8,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'left','width'=>120),
		'c2'=>array('justification'=>'left','width'=>120),
		'c3'=>array('justification'=>'left','width'=>120),
		'c4'=>array('justification'=>'left','width'=>170)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",8);
/** -------------------------------------------------------------------- **/

$pdf->ezStream();
?>