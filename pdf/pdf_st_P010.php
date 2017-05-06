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
/** -------------------------------------------------------------------- **/
$pdf->ezText("<b>1. Relevamiento</b>",10);
$pdf->ezText("\n",10);
/** -------------------------------------------------------------------- **/
$text_p01 = $data_f['p01'];
$arrays = explode('|', $text_p01);
$arr_f01 = explode(';', $arrays[0]);
$arr_f02 = explode(';', $arrays[1]);
$arr_f03 = explode(';', $arrays[2]);
$arr_f04 = explode(';', $arrays[3]);
$arr_f05 = explode(';', $arrays[4]);
$arr_f06 = explode(';', $arrays[5]);
$arr_f07 = explode(';', $arrays[6]);
$arr_f08 = explode(';', $arrays[7]);

$data = array(
	array('c1'=>'', 'c2'=>'EQUIPO 1', 'c3'=>'EQUIPO 2'),
	array('c1'=>$arr_f01[0], 'c2'=>$arr_f01[1], 'c3'=>$arr_f01[2]),
	array('c1'=>$arr_f02[0], 'c2'=>$arr_f02[1], 'c3'=>$arr_f02[2]),
	array('c1'=>$arr_f03[0], 'c2'=>$arr_f03[1], 'c3'=>$arr_f03[2]),
	array('c1'=>$arr_f04[0], 'c2'=>$arr_f04[1], 'c3'=>$arr_f04[2]),
	array('c1'=>$arr_f05[0], 'c2'=>$arr_f05[1], 'c3'=>$arr_f05[2]),
	array('c1'=>$arr_f06[0], 'c2'=>$arr_f06[1], 'c3'=>$arr_f06[2]),
	array('c1'=>$arr_f07[0], 'c2'=>$arr_f07[1], 'c3'=>$arr_f07[2]),
	array('c1'=>$arr_f08[0], 'c2'=>$arr_f08[1], 'c3'=>$arr_f08[2])
);
$options = array('xPos'=>'70',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>550,
	'colGap' => 5,
	'shaded'=> 1,
	'showLines'=> 1,
	'fontSize' => 9,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'center','width'=>200),
		'c2'=>array('justification'=>'center','width'=>150),
		'c3'=>array('justification'=>'center','width'=>150)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",12);
/** -------------------------------------------------------------------- **/
$pdf->ezText("<b>2. Mantenimiento Preventivo</b>",10);
$pdf->ezText("\n",10);
/** -------------------------------------------------------------------- **/
$data=array(array('izq'=>'ANTES MTTO.', 'der'=>'DESPUES MTTO.'));
$pdf->ezTable($data,'','',
	array('xPos'=>'312.5',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>206,
		'colGap' => 5,
		'shaded'=> 2,
		'showLines'=> 2,
		'fontSize' => 8,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'izq'=>array('justification'=>'center','width'=>120),
			'der'=>array('justification'=>'center','width'=>150),
		)
	));
/** -------------------------------------------------------------------- **/
$data=array(array(	'h01'=>'Malo','h02'=>'Bajo','h03'=>'Medio','h04'=>'Alto',
					'h05'=>'Reparado','h06'=>'Ajustado','h07'=>'Cambiado','h08'=>'Pendiente'));
$pdf->ezTable($data,'','',
	array('xPos'=>'312.5',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>400,
		'colGap' => 5,
		'shaded'=> 1,
		'showLines'=> 2,
		'fontSize' => 6,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'h01'=>array('justification'=>'center','width'=>30),
			'h02'=>array('justification'=>'center','width'=>30),
			'h03'=>array('justification'=>'center','width'=>30),
			'h04'=>array('justification'=>'center','width'=>30),
			'h05'=>array('justification'=>'center','width'=>37),
			'h06'=>array('justification'=>'center','width'=>37),
			'h07'=>array('justification'=>'center','width'=>38),
			'h08'=>array('justification'=>'center','width'=>38)
		)
	));
/** -------------------------------------------------------------------- **/
$text_p02 = $data_f['p02'];
$arrays = explode('|', $text_p02);
$arr_f1 = explode(';', $arrays[0]);
$arr_f2 = explode(';', $arrays[1]);
$arr_f3 = explode(';', $arrays[2]);
$arr_f4 = explode(';', $arrays[3]);
$arr_f5 = explode(';', $arrays[4]);
$arr_f6 = explode(';', $arrays[5]);
$arr_f7 = explode(';', $arrays[6]);

if($arr_f1[1] != '') $arr_f1[1] = 'X';
if($arr_f1[2] != '') $arr_f1[2] = 'X';
if($arr_f1[3] != '') $arr_f1[3] = 'X';
if($arr_f1[4] != '') $arr_f1[4] = 'X';
if($arr_f1[5] != '') $arr_f1[5] = 'X';
if($arr_f1[6] != '') $arr_f1[6] = 'X';
if($arr_f1[7] != '') $arr_f1[7] = 'X';
if($arr_f1[8] != '') $arr_f1[8] = 'X';

if($arr_f2[1] != '') $arr_f2[1] = 'X';
if($arr_f2[2] != '') $arr_f2[2] = 'X';
if($arr_f2[3] != '') $arr_f2[3] = 'X';
if($arr_f2[4] != '') $arr_f2[4] = 'X';
if($arr_f2[5] != '') $arr_f2[5] = 'X';
if($arr_f2[6] != '') $arr_f2[6] = 'X';
if($arr_f2[7] != '') $arr_f2[7] = 'X';
if($arr_f2[8] != '') $arr_f2[8] = 'X';

if($arr_f3[1] != '') $arr_f3[1] = 'X';
if($arr_f3[2] != '') $arr_f3[2] = 'X';
if($arr_f3[3] != '') $arr_f3[3] = 'X';
if($arr_f3[4] != '') $arr_f3[4] = 'X';
if($arr_f3[5] != '') $arr_f3[5] = 'X';
if($arr_f3[6] != '') $arr_f3[6] = 'X';
if($arr_f3[7] != '') $arr_f3[7] = 'X';
if($arr_f3[8] != '') $arr_f3[8] = 'X';

if($arr_f4[1] != '') $arr_f4[1] = 'X';
if($arr_f4[2] != '') $arr_f4[2] = 'X';
if($arr_f4[3] != '') $arr_f4[3] = 'X';
if($arr_f4[4] != '') $arr_f4[4] = 'X';
if($arr_f4[5] != '') $arr_f4[5] = 'X';
if($arr_f4[6] != '') $arr_f4[6] = 'X';
if($arr_f4[7] != '') $arr_f4[7] = 'X';
if($arr_f4[8] != '') $arr_f4[8] = 'X';

if($arr_f5[1] != '') $arr_f5[1] = 'X';
if($arr_f5[2] != '') $arr_f5[2] = 'X';
if($arr_f5[3] != '') $arr_f5[3] = 'X';
if($arr_f5[4] != '') $arr_f5[4] = 'X';
if($arr_f5[5] != '') $arr_f5[5] = 'X';
if($arr_f5[6] != '') $arr_f5[6] = 'X';
if($arr_f5[7] != '') $arr_f5[7] = 'X';
if($arr_f5[8] != '') $arr_f5[8] = 'X';

if($arr_f6[1] != '') $arr_f6[1] = 'X';
if($arr_f6[2] != '') $arr_f6[2] = 'X';
if($arr_f6[3] != '') $arr_f6[3] = 'X';
if($arr_f6[4] != '') $arr_f6[4] = 'X';
if($arr_f6[5] != '') $arr_f6[5] = 'X';
if($arr_f6[6] != '') $arr_f6[6] = 'X';
if($arr_f6[7] != '') $arr_f6[7] = 'X';
if($arr_f6[8] != '') $arr_f6[8] = 'X';

if($arr_f7[1] != '') $arr_f7[1] = 'X';
if($arr_f7[2] != '') $arr_f7[2] = 'X';
if($arr_f7[3] != '') $arr_f7[3] = 'X';
if($arr_f7[4] != '') $arr_f7[4] = 'X';
if($arr_f7[5] != '') $arr_f7[5] = 'X';
if($arr_f7[6] != '') $arr_f7[6] = 'X';
if($arr_f7[7] != '') $arr_f7[7] = 'X';
if($arr_f7[8] != '') $arr_f7[8] = 'X';

$data = array(
	array('c1'=>$arr_f1[0], 'c2'=>$arr_f1[1], 'c3'=>$arr_f1[2], 'c4'=>$arr_f1[3], 'c5'=>$arr_f1[4], 'c6'=>$arr_f1[5], 'c7'=>$arr_f1[6], 'c8'=>$arr_f1[7], 'c9'=>$arr_f1[8]),
	array('c1'=>$arr_f2[0], 'c2'=>$arr_f2[1], 'c3'=>$arr_f2[2], 'c4'=>$arr_f2[3], 'c5'=>$arr_f2[4], 'c6'=>$arr_f2[5], 'c7'=>$arr_f2[6], 'c8'=>$arr_f2[7], 'c9'=>$arr_f2[8]),
	array('c1'=>$arr_f3[0], 'c2'=>$arr_f3[1], 'c3'=>$arr_f3[2], 'c4'=>$arr_f3[3], 'c5'=>$arr_f3[4], 'c6'=>$arr_f3[5], 'c7'=>$arr_f3[6], 'c8'=>$arr_f3[7], 'c9'=>$arr_f3[8]),
	array('c1'=>$arr_f4[0], 'c2'=>$arr_f4[1], 'c3'=>$arr_f4[2], 'c4'=>$arr_f4[3], 'c5'=>$arr_f4[4], 'c6'=>$arr_f4[5], 'c7'=>$arr_f4[6], 'c8'=>$arr_f4[7], 'c9'=>$arr_f4[8]),
	array('c1'=>$arr_f5[0], 'c2'=>$arr_f5[1], 'c3'=>$arr_f5[2], 'c4'=>$arr_f5[3], 'c5'=>$arr_f5[4], 'c6'=>$arr_f5[5], 'c7'=>$arr_f5[6], 'c8'=>$arr_f5[7], 'c9'=>$arr_f5[8]),
	array('c1'=>$arr_f6[0], 'c2'=>$arr_f6[1], 'c3'=>$arr_f6[2], 'c4'=>$arr_f6[3], 'c5'=>$arr_f6[4], 'c6'=>$arr_f6[5], 'c7'=>$arr_f6[6], 'c8'=>$arr_f6[7], 'c9'=>$arr_f6[8]),
	array('c1'=>$arr_f7[0], 'c2'=>$arr_f7[1], 'c3'=>$arr_f7[2], 'c4'=>$arr_f7[3], 'c5'=>$arr_f7[4], 'c6'=>$arr_f7[5], 'c7'=>$arr_f7[6], 'c8'=>$arr_f7[7], 'c9'=>$arr_f7[8])
);
$options = array('xPos'=>'left',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>540,
	'colGap' => 5,
	'shaded'=> 1,
	'showLines'=> 1,
	'fontSize' => 8,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'left','width'=>270),
		'c2'=>array('justification'=>'center','width'=>30),
		'c3'=>array('justification'=>'center','width'=>30),
		'c4'=>array('justification'=>'center','width'=>30),
		'c5'=>array('justification'=>'center','width'=>30),
		'c6'=>array('justification'=>'center','width'=>37),
		'c7'=>array('justification'=>'center','width'=>37),
		'c8'=>array('justification'=>'center','width'=>38),
		'c9'=>array('justification'=>'center','width'=>38)
	)
);
$pdf->ezTable($data, '','',$options);
/** -------------------------------------------------------------------- **/

/** -------------------------------------------------------------------- **/

/** -------------------------------------------------------------------- **/

/** -------------------------------------------------------------------- **/

/** -------------------------------------------------------------------- **/

$pdf->ezStream();
?>