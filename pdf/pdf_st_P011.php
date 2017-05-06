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
//$pdf->line(20,742,590,742);
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
		'fontSize' => 9,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'title'=>array('justification'=>'center','width'=>555)
		)
	));
$pdf->ezText("\n",2);
$data = array(
	array('c1'=>'<b>Nombre estación:</b>',	'c2'=>$data_f['nom_estacion'], 	'c3'=>'<b>Fecha Mtto:</b>', 'c4'=>date_format(date_create($data_f['inicio']), 'd/m/Y'))
);
$options = array('xPos'=>'left',
                'xOrientation'=>'right',
				'showHeadings'=>0,
				'width'=>480,
				'colGap' => 5,
				'shaded'=> 0,
				'showLines'=> 0,
				'fontSize' => 10,
				'lineCol' => array(0.48,0.48,0.48),
				'cols'=>array(
				'c1'=>array('justification'=>'right','width'=>95),
				'c2'=>array('justification'=>'left','width'=>230),
				'c3'=>array('justification'=>'right','width'=>70),
				'c4'=>array('justification'=>'left','width'=>155)
				)
            );
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",1);
/** -------------------------------------------------------------------- **/
$text_p01 = $data_f['p01'];
$arrays = explode('|', $text_p01);
$arr_f01 = explode(';', $arrays[0]);
$arr_f02 = explode(';', $arrays[1]);
$arr_f03 = explode(';', $arrays[2]);
$arr_f04 = explode(';', $arrays[3]);

if($arr_f01[1] != '') $arr_f01[1] = 'X';
if($arr_f01[2] != '') $arr_f01[2] = 'X';
if($arr_f01[3] != '') $arr_f01[3] = 'X';
if($arr_f01[4] != '') $arr_f01[4] = 'X';
if($arr_f01[5] != '') $arr_f01[5] = 'X';
if($arr_f01[6] != '') $arr_f01[6] = 'X';
if($arr_f01[7] != '') $arr_f01[7] = 'X';
if($arr_f01[8] != '') $arr_f01[8] = 'X';
if($arr_f01[9] != '') $arr_f01[9] = 'X';
if($arr_f01[10] != '') $arr_f01[10] = 'X';

if($arr_f02[1] != '') $arr_f02[1] = 'X';
if($arr_f02[2] != '') $arr_f02[2] = 'X';
if($arr_f02[3] != '') $arr_f02[3] = 'X';
if($arr_f02[4] != '') $arr_f02[4] = 'X';
if($arr_f02[5] != '') $arr_f02[5] = 'X';
if($arr_f02[6] != '') $arr_f02[6] = 'X';
if($arr_f02[7] != '') $arr_f02[7] = 'X';
if($arr_f02[8] != '') $arr_f02[8] = 'X';
if($arr_f02[9] != '') $arr_f02[9] = 'X';
if($arr_f02[10] != '') $arr_f02[10] = 'X';

if($arr_f03[1] != '') $arr_f03[1] = 'X';
if($arr_f03[2] != '') $arr_f03[2] = 'X';
if($arr_f03[3] != '') $arr_f03[3] = 'X';
if($arr_f03[4] != '') $arr_f03[4] = 'X';
if($arr_f03[5] != '') $arr_f03[5] = 'X';
if($arr_f03[6] != '') $arr_f03[6] = 'X';
if($arr_f03[7] != '') $arr_f03[7] = 'X';
if($arr_f03[8] != '') $arr_f03[8] = 'X';
if($arr_f03[9] != '') $arr_f03[9] = 'X';
if($arr_f03[10] != '') $arr_f03[10] = 'X';

if($arr_f04[1] != '') $arr_f04[1] = 'X';
if($arr_f04[2] != '') $arr_f04[2] = 'X';
if($arr_f04[3] != '') $arr_f04[3] = 'X';
if($arr_f04[4] != '') $arr_f04[4] = 'X';
if($arr_f04[5] != '') $arr_f04[5] = 'X';
if($arr_f04[6] != '') $arr_f04[6] = 'X';
if($arr_f04[7] != '') $arr_f04[7] = 'X';
if($arr_f04[8] != '') $arr_f04[8] = 'X';
if($arr_f04[9] != '') $arr_f04[9] = 'X';
if($arr_f04[10] != '') $arr_f04[10] = 'X';

$data=array(array('h01'=>'ATS – CUBICAL DE CONTROL', 'h02'=>'ANTES MTTO.', 'h03'=>'DESPUES MTTO.'));
$pdf->ezTable($data,'','',
	array('xPos'=>'left',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>206,
		'colGap' => 5,
		'shaded'=> 0,
		'showLines'=> 2,
		'fontSize' => 8,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'h01'=>array('justification'=>'center','width'=>140),
			'h02'=>array('justification'=>'center','width'=>195),
			'h03'=>array('justification'=>'center','width'=>166)
		)
	));

$data = array(
	array('c1'=>'', 'c2'=>'No Existe', 'c3'=>'Malo', 'c4'=>'Bajo', 'c5'=>'Medio', 'c6'=>'Alto', 'c7'=>'Bueno', 'c8'=>'Reparado', 'c9'=>'Ajustado', 'c10'=>'Cambiado', 'c11'=>'Pendiente', 'c12'=>'Otro'),
	array('c1'=>$arr_f01[0], 'c2'=>$arr_f01[1], 'c3'=>$arr_f01[2], 'c4'=>$arr_f01[3], 'c5'=>$arr_f01[4], 'c6'=>$arr_f01[5], 'c7'=>$arr_f01[6], 'c8'=>$arr_f01[7], 'c9'=>$arr_f01[8], 'c10'=>$arr_f01[9], 'c11'=>$arr_f01[10], 'c12'=>$arr_f01[11]),
	array('c1'=>$arr_f02[0], 'c2'=>$arr_f02[1], 'c3'=>$arr_f02[2], 'c4'=>$arr_f02[3], 'c5'=>$arr_f02[4], 'c6'=>$arr_f02[5], 'c7'=>$arr_f02[6], 'c8'=>$arr_f02[7], 'c9'=>$arr_f02[8], 'c10'=>$arr_f02[9], 'c11'=>$arr_f02[10], 'c12'=>$arr_f02[11]),
	array('c1'=>$arr_f03[0], 'c2'=>$arr_f03[1], 'c3'=>$arr_f03[2], 'c4'=>$arr_f03[3], 'c5'=>$arr_f03[4], 'c6'=>$arr_f03[5], 'c7'=>$arr_f03[6], 'c8'=>$arr_f03[7], 'c9'=>$arr_f03[8], 'c10'=>$arr_f03[9], 'c11'=>$arr_f03[10], 'c12'=>$arr_f03[11]),
	array('c1'=>$arr_f04[0], 'c2'=>$arr_f04[1], 'c3'=>$arr_f04[2], 'c4'=>$arr_f04[3], 'c5'=>$arr_f04[4], 'c6'=>$arr_f04[5], 'c7'=>$arr_f04[6], 'c8'=>$arr_f04[7], 'c9'=>$arr_f04[8], 'c10'=>$arr_f04[9], 'c11'=>$arr_f04[10], 'c12'=>$arr_f04[11])
);
$options = array('xPos'=>'left',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>540,
	'colGap' => 5,
	'shaded'=> 1,
	'showLines'=> 1,
	'fontSize' => 7,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'center','width'=>140),
		'c2'=>array('justification'=>'center','width'=>40),
		'c3'=>array('justification'=>'center','width'=>30),
		'c4'=>array('justification'=>'center','width'=>30),
		'c5'=>array('justification'=>'center','width'=>30),
		'c6'=>array('justification'=>'center','width'=>30),
		'c7'=>array('justification'=>'center','width'=>35),
		'c8'=>array('justification'=>'center','width'=>42),
		'c9'=>array('justification'=>'center','width'=>40),
		'c10'=>array('justification'=>'center','width'=>42),
		'c11'=>array('justification'=>'center','width'=>42),
		'c12'=>array('justification'=>'center','width'=>50)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/
$text_p02 = $data_f['p02'];
$arrays = explode('|', $text_p02);
$arr_f1 = explode(';', $arrays[0]);
$arr_f2 = explode(';', $arrays[1]);

$data = array(
	array('c1'=>$arr_f1[0], 'c2'=>$arr_f1[1], 'c3'=>$arr_f1[2], 'c4'=>$arr_f1[3], 'c5'=>$arr_f1[4], 'c6'=>$arr_f1[5]),
	array('c1'=>$arr_f2[0], 'c2'=>$arr_f2[1], 'c3'=>$arr_f2[2], 'c4'=>$arr_f2[3], 'c5'=>$arr_f2[4], 'c6'=>$arr_f2[5])
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
		'c1'=>array('justification'=>'left','width'=>220),
		'c2'=>array('justification'=>'center','width'=>60),
		'c3'=>array('justification'=>'center','width'=>70),
		'c4'=>array('justification'=>'center','width'=>65),
		'c5'=>array('justification'=>'center','width'=>70),
		'c6'=>array('justification'=>'center','width'=>65)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/
$text_p03 = $data_f['p03'];
$arrays = explode('|', $text_p03);
$arr_f01 = explode(';', $arrays[0]);
$arr_f02 = explode(';', $arrays[1]);
$arr_f03 = explode(';', $arrays[2]);
$arr_f04 = explode(';', $arrays[3]);
$arr_f05 = explode(';', $arrays[4]);

if($arr_f01[1] != '') $arr_f01[1] = 'X';
if($arr_f01[2] != '') $arr_f01[2] = 'X';
if($arr_f01[3] != '') $arr_f01[3] = 'X';
if($arr_f01[4] != '') $arr_f01[4] = 'X';
if($arr_f01[5] != '') $arr_f01[5] = 'X';
if($arr_f01[6] != '') $arr_f01[6] = 'X';
if($arr_f01[7] != '') $arr_f01[7] = 'X';
if($arr_f01[8] != '') $arr_f01[8] = 'X';
if($arr_f01[9] != '') $arr_f01[9] = 'X';
if($arr_f01[10] != '') $arr_f01[10] = 'X';

if($arr_f02[1] != '') $arr_f02[1] = 'X';
if($arr_f02[2] != '') $arr_f02[2] = 'X';
if($arr_f02[3] != '') $arr_f02[3] = 'X';
if($arr_f02[4] != '') $arr_f02[4] = 'X';
if($arr_f02[5] != '') $arr_f02[5] = 'X';
if($arr_f02[6] != '') $arr_f02[6] = 'X';
if($arr_f02[7] != '') $arr_f02[7] = 'X';
if($arr_f02[8] != '') $arr_f02[8] = 'X';
if($arr_f02[9] != '') $arr_f02[9] = 'X';
if($arr_f02[10] != '') $arr_f02[10] = 'X';

if($arr_f03[1] != '') $arr_f03[1] = 'X';
if($arr_f03[2] != '') $arr_f03[2] = 'X';
if($arr_f03[3] != '') $arr_f03[3] = 'X';
if($arr_f03[4] != '') $arr_f03[4] = 'X';
if($arr_f03[5] != '') $arr_f03[5] = 'X';
if($arr_f03[6] != '') $arr_f03[6] = 'X';
if($arr_f03[7] != '') $arr_f03[7] = 'X';
if($arr_f03[8] != '') $arr_f03[8] = 'X';
if($arr_f03[9] != '') $arr_f03[9] = 'X';
if($arr_f03[10] != '') $arr_f03[10] = 'X';

if($arr_f04[1] != '') $arr_f04[1] = 'X';
if($arr_f04[2] != '') $arr_f04[2] = 'X';
if($arr_f04[3] != '') $arr_f04[3] = 'X';
if($arr_f04[4] != '') $arr_f04[4] = 'X';
if($arr_f04[5] != '') $arr_f04[5] = 'X';
if($arr_f04[6] != '') $arr_f04[6] = 'X';
if($arr_f04[7] != '') $arr_f04[7] = 'X';
if($arr_f04[8] != '') $arr_f04[8] = 'X';
if($arr_f04[9] != '') $arr_f04[9] = 'X';
if($arr_f04[10] != '') $arr_f04[10] = 'X';

if($arr_f05[1] != '') $arr_f05[1] = 'X';
if($arr_f05[2] != '') $arr_f05[2] = 'X';
if($arr_f05[3] != '') $arr_f05[3] = 'X';
if($arr_f05[4] != '') $arr_f05[4] = 'X';
if($arr_f05[5] != '') $arr_f05[5] = 'X';
if($arr_f05[6] != '') $arr_f05[6] = 'X';
if($arr_f05[7] != '') $arr_f05[7] = 'X';
if($arr_f05[8] != '') $arr_f05[8] = 'X';
if($arr_f05[9] != '') $arr_f05[9] = 'X';
if($arr_f05[10] != '') $arr_f05[10] = 'X';

$data=array(array('h01'=>'Funcionamiento de indicadores (display, medidores de aguja, LEDs y focos)', 'h02'=>'ANTES MTTO.', 'h03'=>'DESPUES MTTO.'));
$pdf->ezTable($data,'','',
	array('xPos'=>'left',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>206,
		'colGap' => 5,
		'shaded'=> 0,
		'showLines'=> 2,
		'fontSize' => 8,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'h01'=>array('justification'=>'center','width'=>160),
			'h02'=>array('justification'=>'center','width'=>135),
			'h03'=>array('justification'=>'center','width'=>180)
		)
	));

$data = array(
	array('c1'=>'', 'c2'=>'No Existe', 'c3'=>'Mal', 'c4'=>'Bien', 'c5'=>'Mal', 'c6'=>'Bien', 'c7'=>'Ajustado', 'c8'=>'Pendiente', 'c9'=>'Otro'),
	array('c1'=>$arr_f01[0], 'c2'=>$arr_f01[1], 'c3'=>$arr_f01[2], 'c4'=>$arr_f01[3], 'c5'=>$arr_f01[4], 'c6'=>$arr_f01[5], 'c7'=>$arr_f01[6], 'c8'=>$arr_f01[7], 'c9'=>$arr_f01[8]),
	array('c1'=>$arr_f02[0], 'c2'=>$arr_f02[1], 'c3'=>$arr_f02[2], 'c4'=>$arr_f02[3], 'c5'=>$arr_f02[4], 'c6'=>$arr_f02[5], 'c7'=>$arr_f02[6], 'c8'=>$arr_f02[7], 'c9'=>$arr_f02[8]),
	array('c1'=>$arr_f03[0], 'c2'=>$arr_f03[1], 'c3'=>$arr_f03[2], 'c4'=>$arr_f03[3], 'c5'=>$arr_f03[4], 'c6'=>$arr_f03[5], 'c7'=>$arr_f03[6], 'c8'=>$arr_f03[7], 'c9'=>$arr_f03[8]),
	array('c1'=>$arr_f04[0], 'c2'=>$arr_f04[1], 'c3'=>$arr_f04[2], 'c4'=>$arr_f04[3], 'c5'=>$arr_f04[4], 'c6'=>$arr_f04[5], 'c7'=>$arr_f04[6], 'c8'=>$arr_f04[7], 'c9'=>$arr_f04[8]),
	array('c1'=>$arr_f05[0], 'c2'=>$arr_f05[1], 'c3'=>$arr_f05[2], 'c4'=>$arr_f05[3], 'c5'=>$arr_f05[4], 'c6'=>$arr_f05[5], 'c7'=>$arr_f05[6], 'c8'=>$arr_f05[7], 'c9'=>$arr_f05[8])
);
$options = array('xPos'=>'left',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>540,
	'colGap' => 5,
	'shaded'=> 1,
	'showLines'=> 1,
	'fontSize' => 7,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'center','width'=>160),
		'c2'=>array('justification'=>'center','width'=>45),
		'c3'=>array('justification'=>'center','width'=>45),
		'c4'=>array('justification'=>'center','width'=>45),
		'c5'=>array('justification'=>'center','width'=>45),
		'c6'=>array('justification'=>'center','width'=>45),
		'c7'=>array('justification'=>'center','width'=>45),
		'c8'=>array('justification'=>'center','width'=>45),
		'c9'=>array('justification'=>'center','width'=>75)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/
$text_p04 = $data_f['p04'];
$arrays = explode('|', $text_p04);
$arr_f1 = explode(';', $arrays[0]);
$arr_f2 = explode(';', $arrays[1]);
$arr_f3 = explode(';', $arrays[2]);

$data = array(
	array('c1'=>$arr_f1[0], 'c2'=>$arr_f1[1], 'c3'=>$arr_f1[2]),
	array('c1'=>$arr_f2[0], 'c2'=>$arr_f2[1], 'c3'=>$arr_f2[2]),
	array('c1'=>$arr_f3[0], 'c2'=>$arr_f3[1], 'c3'=>$arr_f3[2])
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
		'c1'=>array('justification'=>'left','width'=>220),
		'c2'=>array('justification'=>'center','width'=>60),
		'c3'=>array('justification'=>'center','width'=>70)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/
$text_p05 = $data_f['p05'];
$arrays = explode('|', $text_p05);
$arr_f1 = explode(';', $arrays[0]);
$arr_f2 = explode(';', $arrays[1]);

if($arr_f1[2] != '') $arr_f1[2] = 'X';
if($arr_f1[4] != '') $arr_f1[4] = 'X';

if($arr_f2[2] != '') $arr_f2[2] = 'X';
if($arr_f2[4] != '') $arr_f2[4] = 'X';

$data = array(
	array('c1'=>$arr_f1[0], 'c2'=>$arr_f1[1], 'c3'=>$arr_f1[2], 'c4'=>$arr_f1[3], 'c5'=>$arr_f1[4]),
	array('c1'=>$arr_f2[0], 'c2'=>$arr_f2[1], 'c3'=>$arr_f2[2], 'c4'=>$arr_f2[3], 'c5'=>$arr_f2[4])
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
		'c1'=>array('justification'=>'left','width'=>220),
		'c2'=>array('justification'=>'center','width'=>60),
		'c3'=>array('justification'=>'center','width'=>70),
		'c4'=>array('justification'=>'center','width'=>65),
		'c5'=>array('justification'=>'center','width'=>70)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/
$data=array(array('h01'=>'Medidas eléctricas de energía comercial', 'h02'=>'ANTES MTTO.', 'h03'=>'DESPUES MTTO.'));
$pdf->ezTable($data,'','',
	array('xPos'=>'left',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>206,
		'colGap' => 5,
		'shaded'=> 0,
		'showLines'=> 2,
		'fontSize' => 8,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'h01'=>array('justification'=>'center','width'=>220),
			'h02'=>array('justification'=>'center','width'=>162),
			'h03'=>array('justification'=>'center','width'=>162)
		)
	));
/** -------------------------------------------------------------------- **/
$text_p06 = $data_f['p06'];
$arrays = explode('|', $text_p06);
$arr_f1 = explode(';', $arrays[0]);
$arr_f2 = explode(';', $arrays[1]);
$arr_f3 = explode(';', $arrays[2]);
$arr_f4 = explode(';', $arrays[3]);
$arr_f5 = explode(';', $arrays[4]);

$data = array(
	array('c1'=>'', 'c2'=>'Fase 1', 'c3'=>'Fase 2', 'c4'=>'Fase 3', 'c5'=>'Fase 1', 'c6'=>'Fase 2', 'c7'=>'Fase 3'),
	array('c1'=>$arr_f1[0], 'c2'=>$arr_f1[1], 'c3'=>$arr_f1[2], 'c4'=>$arr_f1[3], 'c5'=>$arr_f1[4], 'c6'=>$arr_f1[5], 'c7'=>$arr_f1[6]),
	array('c1'=>$arr_f2[0], 'c2'=>$arr_f2[1], 'c3'=>$arr_f2[2], 'c4'=>$arr_f2[3], 'c5'=>$arr_f2[4], 'c6'=>$arr_f2[5], 'c7'=>$arr_f2[6]),
	array('c1'=>$arr_f3[0], 'c2'=>$arr_f3[1], 'c3'=>$arr_f3[2], 'c4'=>$arr_f3[3], 'c5'=>$arr_f3[4], 'c6'=>$arr_f3[5], 'c7'=>$arr_f3[6])
);
$options = array('xPos'=>'left',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>540,
	'colGap' => 5,
	'shaded'=> 1,
	'showLines'=> 1,
	'fontSize' => 7,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'center','width'=>220),
		'c2'=>array('justification'=>'center','width'=>54),
		'c3'=>array('justification'=>'center','width'=>54),
		'c4'=>array('justification'=>'center','width'=>54),
		'c5'=>array('justification'=>'center','width'=>54),
		'c6'=>array('justification'=>'center','width'=>54),
		'c7'=>array('justification'=>'center','width'=>54)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",1);
/** ---	 **/
$data = array(
	array('c1'=>$arr_f4[0], 'c2'=>$arr_f4[1], 'c5'=>$arr_f4[4]),
	array('c1'=>$arr_f5[0], 'c2'=>$arr_f5[1], 'c5'=>$arr_f5[4])
);
$options = array('xPos'=>'left',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>540,
	'colGap' => 5,
	'shaded'=> 1,
	'showLines'=> 1,
	'fontSize' => 7,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'center','width'=>220),
		'c2'=>array('justification'=>'center','width'=>162),
		'c5'=>array('justification'=>'center','width'=>162)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/
$text_p07 = $data_f['p07'];
$arrays = explode('|', $text_p07);
$arr_f1 = explode(';', $arrays[0]);
$arr_f2 = explode(';', $arrays[1]);

if($arr_f1[2] != '') $arr_f1[2] = 'X';
if($arr_f1[4] != '') $arr_f1[4] = 'X';

if($arr_f2[2] != '') $arr_f2[2] = 'X';
if($arr_f2[4] != '') $arr_f2[4] = 'X';

$data = array(
	array('c1'=>$arr_f1[0], 'c2'=>$arr_f1[1], 'c3'=>$arr_f1[2], 'c4'=>$arr_f1[3], 'c5'=>$arr_f1[4]),
	array('c1'=>$arr_f2[0], 'c2'=>$arr_f2[1], 'c3'=>$arr_f2[2], 'c4'=>$arr_f2[3], 'c5'=>$arr_f2[4])
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
		'c1'=>array('justification'=>'center','width'=>265),
		'c2'=>array('justification'=>'center','width'=>70),
		'c3'=>array('justification'=>'center','width'=>70),
		'c4'=>array('justification'=>'center','width'=>70),
		'c5'=>array('justification'=>'center','width'=>70)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/
$data=array(array('h01'=>'U P S', 'h02'=>'ANTES MTTO.', 'h03'=>'DESPUES MTTO.'));
$pdf->ezTable($data,'','',
	array('xPos'=>'left',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>206,
		'colGap' => 5,
		'shaded'=> 0,
		'showLines'=> 2,
		'fontSize' => 8,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'h01'=>array('justification'=>'center','width'=>220),
			'h02'=>array('justification'=>'center','width'=>162),
			'h03'=>array('justification'=>'center','width'=>162)
		)
	));
/** -------------------------------------------------------------------- **/
$text_p08 = $data_f['p08'];
$arrays = explode('|', $text_p08);
$arr_f1 = explode(';', $arrays[0]);
$arr_f2 = explode(';', $arrays[1]);
$arr_f3 = explode(';', $arrays[2]);
$arr_f4 = explode(';', $arrays[3]);
$arr_f5 = explode(';', $arrays[4]);

$data = array(
	array('c1'=>'', 'c2'=>'Fase 1', 'c3'=>'Fase 2', 'c4'=>'Fase 3', 'c5'=>'Fase 1', 'c6'=>'Fase 2', 'c7'=>'Fase 3'),
	array('c1'=>$arr_f1[0], 'c2'=>$arr_f1[1], 'c3'=>$arr_f1[2], 'c4'=>$arr_f1[3], 'c5'=>$arr_f1[4], 'c6'=>$arr_f1[5], 'c7'=>$arr_f1[6]),
	array('c1'=>$arr_f2[0], 'c2'=>$arr_f2[1], 'c3'=>$arr_f2[2], 'c4'=>$arr_f2[3], 'c5'=>$arr_f2[4], 'c6'=>$arr_f2[5], 'c7'=>$arr_f2[6])
);
$options = array('xPos'=>'left',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>540,
	'colGap' => 5,
	'shaded'=> 1,
	'showLines'=> 1,
	'fontSize' => 7,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'center','width'=>220),
		'c2'=>array('justification'=>'center','width'=>54),
		'c3'=>array('justification'=>'center','width'=>54),
		'c4'=>array('justification'=>'center','width'=>54),
		'c5'=>array('justification'=>'center','width'=>54),
		'c6'=>array('justification'=>'center','width'=>54),
		'c7'=>array('justification'=>'center','width'=>54)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",1);
/** ---	 **/
$data = array(
	array('c1'=>$arr_f3[0], 'c2'=>$arr_f3[1], 'c5'=>$arr_f3[4]),
	array('c1'=>$arr_f4[0], 'c2'=>$arr_f4[1], 'c5'=>$arr_f4[4]),
	array('c1'=>$arr_f5[0], 'c2'=>$arr_f5[1], 'c5'=>$arr_f5[4])
);
$options = array('xPos'=>'left',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>540,
	'colGap' => 5,
	'shaded'=> 1,
	'showLines'=> 1,
	'fontSize' => 7,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'center','width'=>220),
		'c2'=>array('justification'=>'center','width'=>162),
		'c5'=>array('justification'=>'center','width'=>162)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/
$text_p09 = $data_f['p09'];
$arrays = explode('|', $text_p09);
$arr_f1 = explode(';', $arrays[0]);
$arr_f2 = explode(';', $arrays[1]);
$arr_f3 = explode(';', $arrays[2]);
$arr_f4 = explode(';', $arrays[3]);
$arr_f5 = explode(';', $arrays[4]);

if($arr_f1[2] != '') $arr_f1[2] = 'X';
if($arr_f1[4] != '') $arr_f1[4] = 'X';

if($arr_f2[2] != '') $arr_f2[2] = 'X';
if($arr_f2[4] != '') $arr_f2[4] = 'X';

if($arr_f3[2] != '') $arr_f3[2] = 'X';
if($arr_f3[4] != '') $arr_f3[4] = 'X';

if($arr_f4[2] != '') $arr_f4[2] = 'X';
if($arr_f4[4] != '') $arr_f4[4] = 'X';

$data = array(
	array('c1'=>$arr_f1[0], 'c2'=>$arr_f1[1], 'c3'=>$arr_f1[2], 'c4'=>$arr_f1[3], 'c5'=>$arr_f1[4]),
	array('c1'=>$arr_f2[0], 'c2'=>$arr_f2[1], 'c3'=>$arr_f2[2], 'c4'=>$arr_f2[3], 'c5'=>$arr_f2[4]),
	array('c1'=>$arr_f3[0], 'c2'=>$arr_f3[1], 'c3'=>$arr_f3[2], 'c4'=>$arr_f3[3], 'c5'=>$arr_f3[4]),
	array('c1'=>$arr_f4[0], 'c2'=>$arr_f4[1], 'c3'=>$arr_f4[2], 'c4'=>$arr_f4[3], 'c5'=>$arr_f4[4])
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
		'c1'=>array('justification'=>'center','width'=>280),
		'c2'=>array('justification'=>'center','width'=>65),
		'c3'=>array('justification'=>'center','width'=>65),
		'c4'=>array('justification'=>'center','width'=>70),
		'c5'=>array('justification'=>'center','width'=>65)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",1);
/** -------------------------------------------------------------------- **/
$data = array(
	array('c1'=>$arr_f5[0], 'c2'=>$arr_f5[1], 'c3'=>$arr_f5[2])
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
		'c1'=>array('justification'=>'center','width'=>280),
		'c2'=>array('justification'=>'center','width'=>65),
		'c3'=>array('justification'=>'center','width'=>200)
	)
);
$pdf->ezTable($data, '','',$options);
/** -------------------------------------------------------------------- **/
/** -------------------------------------------------------------------- **/
/** -------------------------------------------------------------------- **/
/** -------------------------------------------------------------------- **/
/** -------------------------------------------------------------------- **/
/** -------------------------------------------------------------------- **/

$pdf->ezStream();
?>