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
		'fontSize' => 10,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'title'=>array('justification'=>'center','width'=>555)
		)
	));
$pdf->ezText("\n",5);
$data = array(
	array('c1'=>'<b>Nombre estación:</b>',	'c2'=>$data_f['nom_estacion'], 	'c3'=>'<b>Fecha Mtto:</b>', 'c4'=>date_format(date_create($data_f['inicio']), 'd/m/Y')),
	array('c1'=>'<b>Marca:</b>',			'c2'=>$data_f['p01'],			'c3'=>'<b>Serie:</b>', 		'c4'=>$data_f['p02']),
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
$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/
$text_p03 = $data_f['p03'];
$arrays = explode('|', $text_p03);
$arr_f1 = explode(';', $arrays[0]);

if($arr_f1[1] != '') $arr_f1[1] = 'X';
if($arr_f1[2] != '') $arr_f1[2] = 'X';
if($arr_f1[3] != '') $arr_f1[3] = 'X';


$data = array(
	array('c1'=>'', 'c2'=>'RED - GRUPO', 'c3'=>'PANEL - GRUPO', 'c4'=>'GRUPO - GRUPO'),
	array('c1'=>$arr_f1[0], 'c2'=>$arr_f1[1], 'c3'=>$arr_f1[2], 'c4'=>$arr_f1[3])
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
		'c1'=>array('justification'=>'center','width'=>190),
		'c2'=>array('justification'=>'center','width'=>120),
		'c3'=>array('justification'=>'center','width'=>120),
		'c4'=>array('justification'=>'center','width'=>120)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/
$data=array(array('h01'=>'MEDIDAS CON EL MOTOR EN FUNCIONAMIENTO', 'h02'=>'ANTES MTTO.', 'h03'=>'DESPUES MTTO.'));
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
			'h01'=>array('justification'=>'center','width'=>270),
			'h02'=>array('justification'=>'center','width'=>140),
			'h03'=>array('justification'=>'center','width'=>140)
		)
	));
/** -------------------------------------------------------------------- **/
$text_p04 = $data_f['p04'];
$arrays = explode('|', $text_p04);
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
	array('c1'=>$arr_f5[0], 'c2'=>$arr_f5[1], 'c3'=>$arr_f5[2], 'c4'=>$arr_f5[3]),
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
		'c1'=>array('justification'=>'left','width'=>210),
		'c2'=>array('justification'=>'center','width'=>60),
		'c3'=>array('justification'=>'center','width'=>140),
		'c4'=>array('justification'=>'center','width'=>140)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/
$data=array(array('h01'=>'Medidas de AC del grupo generador sin carga', 'h02'=>'ANTES MTTO.', 'h03'=>'DESPUES MTTO.'));
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
			'h01'=>array('justification'=>'center','width'=>175),
			'h02'=>array('justification'=>'center','width'=>186),
			'h03'=>array('justification'=>'center','width'=>186)
		)
	));
/** -------------------------------------------------------------------- **/
$text_p05 = $data_f['p05'];
$arrays = explode('|', $text_p05);
$arr_f1 = explode(';', $arrays[0]);
$arr_f2 = explode(';', $arrays[1]);

$data = array(
	array('c1'=>'', 'c2'=>'', 'c3'=>'Fase 1', 'c4'=>'Fase 2', 'c5'=>'Fase 3', 'c6'=>'Fase 1', 'c7'=>'Fase 2', 'c8'=>'Fase 3'),
	array('c1'=>$arr_f1[0], 'c2'=>$arr_f1[1], 'c3'=>$arr_f1[2], 'c4'=>$arr_f1[3], 'c5'=>$arr_f1[4], 'c6'=>$arr_f1[5], 'c7'=>$arr_f1[6], 'c8'=>$arr_f1[7])
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
		'c1'=>array('justification'=>'left','width'=>150),
		'c2'=>array('justification'=>'center','width'=>25),
		'c3'=>array('justification'=>'center','width'=>62),
		'c4'=>array('justification'=>'center','width'=>62),
		'c5'=>array('justification'=>'center','width'=>62),
		'c6'=>array('justification'=>'center','width'=>62),
		'c7'=>array('justification'=>'center','width'=>62),
		'c8'=>array('justification'=>'center','width'=>62)
	)
);
$pdf->ezTable($data, '','',$options);
/** ---	 **/
$data = array(
	array('c1'=>$arr_f2[0], 'c2'=>$arr_f2[1], 'c3'=>$arr_f2[2], 'c6'=>$arr_f2[5])
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
		'c1'=>array('justification'=>'left','width'=>150),
		'c2'=>array('justification'=>'center','width'=>25),
		'c3'=>array('justification'=>'center','width'=>186),
		'c6'=>array('justification'=>'center','width'=>186)
	)
);
$pdf->ezTable($data, '','',$options);

$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/
$data=array(array('h01'=>'Medidas de AC del grupo generador con carga', 'h02'=>'ANTES MTTO.', 'h03'=>'DESPUES MTTO.'));
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
		'c1'=>array('justification'=>'left','width'=>220),
		'c2'=>array('justification'=>'center','width'=>54),
		'c3'=>array('justification'=>'center','width'=>54),
		'c4'=>array('justification'=>'center','width'=>54),
		'c5'=>array('justification'=>'center','width'=>54),
		'c6'=>array('justification'=>'center','width'=>54),
		'c7'=>array('justification'=>'center','width'=>54)
	)
);
$pdf->ezTable($data, '','',$options);
/** ---	 **/
$data = array(
	array('c1'=>$arr_f3[0], 'c2'=>$arr_f3[1], 'c5'=>$arr_f3[4])
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
		'c1'=>array('justification'=>'left','width'=>220),
		'c2'=>array('justification'=>'center','width'=>162),
		'c5'=>array('justification'=>'center','width'=>162)
	)
);
$pdf->ezTable($data, '','',$options);
/** --- */
$data = array(
	array('c1'=>$arr_f4[0], 'c2'=>$arr_f4[1], 'c3'=>$arr_f4[2], 'c4'=>$arr_f4[3], 'c5'=>$arr_f4[4], 'c6'=>$arr_f4[5], 'c7'=>$arr_f4[6])
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
		'c1'=>array('justification'=>'left','width'=>220),
		'c2'=>array('justification'=>'center','width'=>54),
		'c3'=>array('justification'=>'center','width'=>54),
		'c4'=>array('justification'=>'center','width'=>54),
		'c5'=>array('justification'=>'center','width'=>54),
		'c6'=>array('justification'=>'center','width'=>54),
		'c7'=>array('justification'=>'center','width'=>54)
	)
);
$pdf->ezTable($data, '','',$options);
/** ---	 **/
$data = array(
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
		'c1'=>array('justification'=>'left','width'=>220),
		'c2'=>array('justification'=>'center','width'=>162),
		'c5'=>array('justification'=>'center','width'=>162)
	)
);
$pdf->ezTable($data, '','',$options);
/** ---	 **/
$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/
$data = array(
	array('c1'=>'Verificación del funcionamiento en tensión del alternador de Baja [V]: ', 'c2'=>$data_f['p06_1'])
);
$options = array('xPos'=>'left',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>540,
	'colGap' => 5,
	'shaded'=> 0,
	'showLines'=> 0,
	'fontSize' => 8,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'left','width'=>255),
		'c2'=>array('justification'=>'left','width'=>80)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/
$text_p07 = $data_f['p07'];
$arrays = explode('|', $text_p07);
$arr_f01 = explode(';', $arrays[0]);
$arr_f02 = explode(';', $arrays[1]);
$arr_f03 = explode(';', $arrays[2]);
$arr_f04 = explode(';', $arrays[3]);
$arr_f05 = explode(';', $arrays[4]);
$arr_f06 = explode(';', $arrays[5]);
$arr_f07 = explode(';', $arrays[6]);
$arr_f08 = explode(';', $arrays[7]);
$arr_f09 = explode(';', $arrays[8]);
$arr_f10 = explode(';', $arrays[9]);
$arr_f11 = explode(';', $arrays[10]);
$arr_f12 = explode(';', $arrays[11]);
$arr_f13 = explode(';', $arrays[12]);
$arr_f14 = explode(';', $arrays[13]);
$arr_f15 = explode(';', $arrays[14]);
$arr_f16 = explode(';', $arrays[15]);
$arr_f17 = explode(';', $arrays[16]);
$arr_f18 = explode(';', $arrays[17]);
$arr_f19 = explode(';', $arrays[18]);
$arr_f20 = explode(';', $arrays[19]);
$arr_f21 = explode(';', $arrays[20]);
$arr_f22 = explode(';', $arrays[21]);

if($arr_f01[1] != '') $arr_f01[1] = 'X';
if($arr_f01[2] != '') $arr_f01[2] = 'X';
if($arr_f01[3] != '') $arr_f01[3] = 'X';
if($arr_f01[4] != '') $arr_f01[4] = 'X';

if($arr_f02[1] != '') $arr_f02[1] = 'X';
if($arr_f02[2] != '') $arr_f02[2] = 'X';
if($arr_f02[3] != '') $arr_f02[3] = 'X';
if($arr_f02[4] != '') $arr_f02[4] = 'X';

if($arr_f03[1] != '') $arr_f03[1] = 'X';
if($arr_f03[2] != '') $arr_f03[2] = 'X';
if($arr_f03[3] != '') $arr_f03[3] = 'X';
if($arr_f03[4] != '') $arr_f03[4] = 'X';

if($arr_f04[1] != '') $arr_f04[1] = 'X';
if($arr_f04[2] != '') $arr_f04[2] = 'X';
if($arr_f04[3] != '') $arr_f04[3] = 'X';
if($arr_f04[4] != '') $arr_f04[4] = 'X';

if($arr_f05[1] != '') $arr_f05[1] = 'X';
if($arr_f05[2] != '') $arr_f05[2] = 'X';
if($arr_f05[3] != '') $arr_f05[3] = 'X';
if($arr_f05[4] != '') $arr_f05[4] = 'X';

if($arr_f06[1] != '') $arr_f06[1] = 'X';
if($arr_f06[2] != '') $arr_f06[2] = 'X';
if($arr_f06[3] != '') $arr_f06[3] = 'X';
if($arr_f06[4] != '') $arr_f06[4] = 'X';

if($arr_f07[1] != '') $arr_f07[1] = 'X';
if($arr_f07[2] != '') $arr_f07[2] = 'X';
if($arr_f07[3] != '') $arr_f07[3] = 'X';
if($arr_f07[4] != '') $arr_f07[4] = 'X';

if($arr_f08[1] != '') $arr_f08[1] = 'X';
if($arr_f08[2] != '') $arr_f08[2] = 'X';
if($arr_f08[3] != '') $arr_f08[3] = 'X';
if($arr_f08[4] != '') $arr_f08[4] = 'X';

if($arr_f09[1] != '') $arr_f09[1] = 'X';
if($arr_f09[2] != '') $arr_f09[2] = 'X';
if($arr_f09[3] != '') $arr_f09[3] = 'X';
if($arr_f09[4] != '') $arr_f09[4] = 'X';

if($arr_f10[1] != '') $arr_f10[1] = 'X';
if($arr_f10[2] != '') $arr_f10[2] = 'X';
if($arr_f10[3] != '') $arr_f10[3] = 'X';
if($arr_f10[4] != '') $arr_f10[4] = 'X';

if($arr_f11[1] != '') $arr_f11[1] = 'X';
if($arr_f11[2] != '') $arr_f11[2] = 'X';
if($arr_f11[3] != '') $arr_f11[3] = 'X';
if($arr_f11[4] != '') $arr_f11[4] = 'X';

if($arr_f12[1] != '') $arr_f12[1] = 'X';
if($arr_f12[2] != '') $arr_f12[2] = 'X';
if($arr_f12[3] != '') $arr_f12[3] = 'X';
if($arr_f12[4] != '') $arr_f12[4] = 'X';

if($arr_f13[1] != '') $arr_f13[1] = 'X';
if($arr_f13[2] != '') $arr_f13[2] = 'X';
if($arr_f13[3] != '') $arr_f13[3] = 'X';
if($arr_f13[4] != '') $arr_f13[4] = 'X';

if($arr_f14[1] != '') $arr_f14[1] = 'X';
if($arr_f14[2] != '') $arr_f14[2] = 'X';
if($arr_f14[3] != '') $arr_f14[3] = 'X';
if($arr_f14[4] != '') $arr_f14[4] = 'X';

if($arr_f15[1] != '') $arr_f15[1] = 'X';
if($arr_f15[2] != '') $arr_f15[2] = 'X';
if($arr_f15[3] != '') $arr_f15[3] = 'X';
if($arr_f15[4] != '') $arr_f15[4] = 'X';

if($arr_f16[1] != '') $arr_f16[1] = 'X';
if($arr_f16[2] != '') $arr_f16[2] = 'X';
if($arr_f16[3] != '') $arr_f16[3] = 'X';
if($arr_f16[4] != '') $arr_f16[4] = 'X';

if($arr_f17[1] != '') $arr_f17[1] = 'X';
if($arr_f17[2] != '') $arr_f17[2] = 'X';
if($arr_f17[3] != '') $arr_f17[3] = 'X';
if($arr_f17[4] != '') $arr_f17[4] = 'X';

if($arr_f18[1] != '') $arr_f18[1] = 'X';
if($arr_f18[2] != '') $arr_f18[2] = 'X';
if($arr_f18[3] != '') $arr_f18[3] = 'X';
if($arr_f18[4] != '') $arr_f18[4] = 'X';

if($arr_f19[1] != '') $arr_f19[1] = 'X';
if($arr_f19[2] != '') $arr_f19[2] = 'X';
if($arr_f19[3] != '') $arr_f19[3] = 'X';
if($arr_f19[4] != '') $arr_f19[4] = 'X';

if($arr_f20[1] != '') $arr_f20[1] = 'X';
if($arr_f20[2] != '') $arr_f20[2] = 'X';
if($arr_f20[3] != '') $arr_f20[3] = 'X';
if($arr_f20[4] != '') $arr_f20[4] = 'X';

if($arr_f21[1] != '') $arr_f21[1] = 'X';
if($arr_f21[2] != '') $arr_f21[2] = 'X';
if($arr_f21[3] != '') $arr_f21[3] = 'X';
if($arr_f21[4] != '') $arr_f21[4] = 'X';

if($arr_f22[1] != '') $arr_f22[1] = 'X';
if($arr_f22[2] != '') $arr_f22[2] = 'X';
if($arr_f22[3] != '') $arr_f22[3] = 'X';
if($arr_f22[4] != '') $arr_f22[4] = 'X';

$data = array(
	array('c1'=>'ACTIVIDADES SEGUN HORAS DE FUNCIONAMIENTO', 'c2'=>'250 Hr', 'c3'=>'500 Hr', 'c4'=>'750 Hr', 'c5'=>'1000 Hr'),
	array('c1'=>$arr_f01[0], 'c2'=>$arr_f01[1], 'c3'=>$arr_f01[2], 'c4'=>$arr_f01[3], 'c5'=>$arr_f01[4]),
	array('c1'=>$arr_f02[0], 'c2'=>$arr_f02[1], 'c3'=>$arr_f02[2], 'c4'=>$arr_f02[3], 'c5'=>$arr_f02[4]),
	array('c1'=>$arr_f03[0], 'c2'=>$arr_f03[1], 'c3'=>$arr_f03[2], 'c4'=>$arr_f03[3], 'c5'=>$arr_f03[4]),
	array('c1'=>$arr_f04[0], 'c2'=>$arr_f04[1], 'c3'=>$arr_f04[2], 'c4'=>$arr_f04[3], 'c5'=>$arr_f04[4]),
	array('c1'=>$arr_f05[0], 'c2'=>$arr_f05[1], 'c3'=>$arr_f05[2], 'c4'=>$arr_f05[3], 'c5'=>$arr_f05[4]),
	array('c1'=>$arr_f06[0], 'c2'=>$arr_f06[1], 'c3'=>$arr_f06[2], 'c4'=>$arr_f06[3], 'c5'=>$arr_f06[4]),
	array('c1'=>$arr_f07[0], 'c2'=>$arr_f07[1], 'c3'=>$arr_f07[2], 'c4'=>$arr_f07[3], 'c5'=>$arr_f07[4]),
	array('c1'=>$arr_f08[0], 'c2'=>$arr_f08[1], 'c3'=>$arr_f08[2], 'c4'=>$arr_f08[3], 'c5'=>$arr_f08[4]),
	array('c1'=>$arr_f09[0], 'c2'=>$arr_f09[1], 'c3'=>$arr_f09[2], 'c4'=>$arr_f09[3], 'c5'=>$arr_f09[4]),
	array('c1'=>$arr_f10[0], 'c2'=>$arr_f10[1], 'c3'=>$arr_f10[2], 'c4'=>$arr_f10[3], 'c5'=>$arr_f10[4]),
	array('c1'=>$arr_f11[0], 'c2'=>$arr_f11[1], 'c3'=>$arr_f11[2], 'c4'=>$arr_f11[3], 'c5'=>$arr_f11[4]),
	array('c1'=>$arr_f13[0], 'c2'=>$arr_f13[1], 'c3'=>$arr_f13[2], 'c4'=>$arr_f13[3], 'c5'=>$arr_f13[4]),
	array('c1'=>$arr_f14[0], 'c2'=>$arr_f14[1], 'c3'=>$arr_f14[2], 'c4'=>$arr_f14[3], 'c5'=>$arr_f14[4]),
	array('c1'=>$arr_f15[0], 'c2'=>$arr_f15[1], 'c3'=>$arr_f15[2], 'c4'=>$arr_f15[3], 'c5'=>$arr_f15[4]),
	array('c1'=>$arr_f16[0], 'c2'=>$arr_f16[1], 'c3'=>$arr_f16[2], 'c4'=>$arr_f16[3], 'c5'=>$arr_f16[4]),
	array('c1'=>$arr_f17[0], 'c2'=>$arr_f17[1], 'c3'=>$arr_f17[2], 'c4'=>$arr_f17[3], 'c5'=>$arr_f17[4]),
	array('c1'=>$arr_f18[0], 'c2'=>$arr_f18[1], 'c3'=>$arr_f18[2], 'c4'=>$arr_f18[3], 'c5'=>$arr_f18[4]),
	array('c1'=>$arr_f19[0], 'c2'=>$arr_f19[1], 'c3'=>$arr_f19[2], 'c4'=>$arr_f19[3], 'c5'=>$arr_f19[4]),
	array('c1'=>$arr_f20[0], 'c2'=>$arr_f20[1], 'c3'=>$arr_f20[2], 'c4'=>$arr_f20[3], 'c5'=>$arr_f20[4]),
	array('c1'=>$arr_f21[0], 'c2'=>$arr_f21[1], 'c3'=>$arr_f21[2], 'c4'=>$arr_f21[3], 'c5'=>$arr_f21[4]),
	array('c1'=>$arr_f22[0], 'c2'=>$arr_f22[1], 'c3'=>$arr_f22[2], 'c4'=>$arr_f22[3], 'c5'=>$arr_f22[4])
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
		'c1'=>array('justification'=>'left','width'=>330),
		'c2'=>array('justification'=>'center','width'=>54),
		'c3'=>array('justification'=>'center','width'=>54),
		'c4'=>array('justification'=>'center','width'=>54),
		'c5'=>array('justification'=>'center','width'=>54),
		'c6'=>array('justification'=>'center','width'=>54),
		'c7'=>array('justification'=>'center','width'=>54)
	)
);
$pdf->ezTable($data, '','',$options);
/** -------------------------------------------------------------------- **/
$pdf->ezNewPage();
$pdf->ezText("\n",15);
/** -------------------------------------------------------------------- **/
$text_p08 = $data_f['p08'];
$arrays = explode('|', $text_p08);
$arr_f01 = explode(';', $arrays[0]);
$arr_f02 = explode(';', $arrays[1]);
$arr_f03 = explode(';', $arrays[2]);
$arr_f04 = explode(';', $arrays[3]);
$arr_f05 = explode(';', $arrays[4]);
$arr_f06 = explode(';', $arrays[5]);
$arr_f07 = explode(';', $arrays[6]);
$arr_f08 = explode(';', $arrays[7]);

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

if($arr_f06[1] != '') $arr_f06[1] = 'X';
if($arr_f06[2] != '') $arr_f06[2] = 'X';
if($arr_f06[3] != '') $arr_f06[3] = 'X';
if($arr_f06[4] != '') $arr_f06[4] = 'X';
if($arr_f06[5] != '') $arr_f06[5] = 'X';
if($arr_f06[6] != '') $arr_f06[6] = 'X';
if($arr_f06[7] != '') $arr_f06[7] = 'X';
if($arr_f06[8] != '') $arr_f06[8] = 'X';
if($arr_f06[9] != '') $arr_f06[9] = 'X';
if($arr_f06[10] != '') $arr_f06[10] = 'X';

if($arr_f07[1] != '') $arr_f07[1] = 'X';
if($arr_f07[2] != '') $arr_f07[2] = 'X';
if($arr_f07[3] != '') $arr_f07[3] = 'X';
if($arr_f07[4] != '') $arr_f07[4] = 'X';
if($arr_f07[5] != '') $arr_f07[5] = 'X';
if($arr_f07[6] != '') $arr_f07[6] = 'X';
if($arr_f07[7] != '') $arr_f07[7] = 'X';
if($arr_f07[8] != '') $arr_f07[8] = 'X';
if($arr_f07[9] != '') $arr_f07[9] = 'X';
if($arr_f07[10] != '') $arr_f07[10] = 'X';

if($arr_f08[1] != '') $arr_f08[1] = 'X';
if($arr_f08[2] != '') $arr_f08[2] = 'X';
if($arr_f08[3] != '') $arr_f08[3] = 'X';
if($arr_f08[4] != '') $arr_f08[4] = 'X';
if($arr_f08[5] != '') $arr_f08[5] = 'X';
if($arr_f08[6] != '') $arr_f08[6] = 'X';
if($arr_f08[7] != '') $arr_f08[7] = 'X';
if($arr_f08[8] != '') $arr_f08[8] = 'X';
if($arr_f08[9] != '') $arr_f08[9] = 'X';
if($arr_f08[10] != '') $arr_f08[10] = 'X';

$data=array(array('h01'=>'MTTO CON EL MOTOR APAGADO Y FRIO', 'h02'=>'ANTES MTTO.', 'h03'=>'DESPUES MTTO.'));
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
	array('c1'=>$arr_f04[0], 'c2'=>$arr_f04[1], 'c3'=>$arr_f04[2], 'c4'=>$arr_f04[3], 'c5'=>$arr_f04[4], 'c6'=>$arr_f04[5], 'c7'=>$arr_f04[6], 'c8'=>$arr_f04[7], 'c9'=>$arr_f04[8], 'c10'=>$arr_f04[9], 'c11'=>$arr_f04[10], 'c12'=>$arr_f04[11]),
	array('c1'=>$arr_f05[0], 'c2'=>$arr_f05[1], 'c3'=>$arr_f05[2], 'c4'=>$arr_f05[3], 'c5'=>$arr_f05[4], 'c6'=>$arr_f05[5], 'c7'=>$arr_f05[6], 'c8'=>$arr_f05[7], 'c9'=>$arr_f05[8], 'c10'=>$arr_f05[9], 'c11'=>$arr_f05[10], 'c12'=>$arr_f05[11]),
	array('c1'=>$arr_f06[0], 'c2'=>$arr_f06[1], 'c3'=>$arr_f06[2], 'c4'=>$arr_f06[3], 'c5'=>$arr_f06[4], 'c6'=>$arr_f06[5], 'c7'=>$arr_f06[6], 'c8'=>$arr_f06[7], 'c9'=>$arr_f06[8], 'c10'=>$arr_f06[9], 'c11'=>$arr_f06[10], 'c12'=>$arr_f06[11]),
	array('c1'=>$arr_f07[0], 'c2'=>$arr_f07[1], 'c3'=>$arr_f07[2], 'c4'=>$arr_f07[3], 'c5'=>$arr_f07[4], 'c6'=>$arr_f07[5], 'c7'=>$arr_f07[6], 'c8'=>$arr_f07[7], 'c9'=>$arr_f07[8], 'c10'=>$arr_f07[9], 'c11'=>$arr_f07[10], 'c12'=>$arr_f07[11]),
	array('c1'=>$arr_f08[0], 'c2'=>$arr_f08[1], 'c3'=>$arr_f08[2], 'c4'=>$arr_f08[3], 'c5'=>$arr_f08[4], 'c6'=>$arr_f08[5], 'c7'=>$arr_f08[6], 'c8'=>$arr_f08[7], 'c9'=>$arr_f08[8], 'c10'=>$arr_f08[9], 'c11'=>$arr_f08[10], 'c12'=>$arr_f08[11])
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
$text_p09 = $data_f['p09'];
$arrays = explode('|', $text_p09);
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

$data=array(array('h01'=>'MTTO DEL ALTERNADOR DE BAJA, MOTOR APAGADO', 'h02'=>'ANTES MTTO.', 'h03'=>'DESPUES MTTO.'));
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
$text_p10 = $data_f['p10'];
$arrays = explode('|', $text_p10);
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

$data=array(array('h01'=>'MEDIDAS RELACIONADAS AL GRUPO GENERADOR', 'h02'=>'ANTES MTTO.', 'h03'=>'DESPUES MTTO.'));
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
	array('c1'=>$arr_f04[0], 'c2'=>$arr_f04[1], 'c3'=>$arr_f04[2], 'c4'=>$arr_f04[3], 'c5'=>$arr_f04[4], 'c6'=>$arr_f04[5], 'c7'=>$arr_f04[6], 'c8'=>$arr_f04[7], 'c9'=>$arr_f04[8], 'c10'=>$arr_f04[9], 'c11'=>$arr_f04[10], 'c12'=>$arr_f04[11]),
	array('c1'=>$arr_f05[0], 'c2'=>$arr_f05[1], 'c3'=>$arr_f05[2], 'c4'=>$arr_f05[3], 'c5'=>$arr_f05[4], 'c6'=>$arr_f05[5], 'c7'=>$arr_f05[6], 'c8'=>$arr_f05[7], 'c9'=>$arr_f05[8], 'c10'=>$arr_f05[9], 'c11'=>$arr_f05[10], 'c12'=>$arr_f05[11])
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
$text_p11 = $data_f['p11'];
$arrays = explode('|', $text_p11);
$arr_f1 = explode(';', $arrays[0]);
$arr_f2 = explode(';', $arrays[1]);

$data = array(
	array('c1'=>$arr_f1[0], 'c2'=>$arr_f1[1], 'c3'=>$arr_f1[2], 'c4'=>$arr_f1[3]),
	array('c1'=>$arr_f2[0], 'c2'=>$arr_f2[1], 'c3'=>$arr_f2[2], 'c4'=>$arr_f2[3])
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
		'c1'=>array('justification'=>'left','width'=>225),
		'c2'=>array('justification'=>'center','width'=>50),
		'c3'=>array('justification'=>'center','width'=>225),
		'c4'=>array('justification'=>'center','width'=>50)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/
$text_p14 = $data_f['p14'];
$arrays = explode('|', $text_p14);
$arr_f01 = explode(';', $arrays[0]);
$arr_f02 = explode(';', $arrays[1]);
$arr_f03 = explode(';', $arrays[2]);

$data=array(array('h01'=>'MTTO BATERIAS DE ARRANQUE', 'h02'=>'Marca Bateria 1: '.$data_f['p12'], 'h03'=>'Marca Bateria 2: '.$data_f['p13']));
$pdf->ezTable($data,'','',
	array('xPos'=>'left',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>206,
		'colGap' => 5,
		'shaded'=> 0,
		'showLines'=> 2,
		'fontSize' => 7,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'h01'=>array('justification'=>'center','width'=>120),
			'h02'=>array('justification'=>'center','width'=>216),
			'h03'=>array('justification'=>'center','width'=>216)
		)
	));

$data = array(
	array('c1'=>'', 'c2'=>'Celda 1', 'c3'=>'Celda 2', 'c4'=>'Celda 3', 'c5'=>'Celda 4', 'c6'=>'Celda 5', 'c7'=>'Celda 6', 'c8'=>'Celda 1', 'c9'=>'Celda 2', 'c10'=>'Celda 3', 'c11'=>'Celda 4', 'c12'=>'Celda 5', 'c13'=>'Celda 6'),
	array('c1'=>$arr_f01[0], 'c2'=>$arr_f01[1], 'c3'=>$arr_f01[2], 'c4'=>$arr_f01[3], 'c5'=>$arr_f01[4], 'c6'=>$arr_f01[5], 'c7'=>$arr_f01[6], 'c8'=>$arr_f01[7], 'c9'=>$arr_f01[8], 'c10'=>$arr_f01[9], 'c11'=>$arr_f01[10], 'c12'=>$arr_f01[11], 'c13'=>$arr_f01[12]),
	array('c1'=>$arr_f02[0], 'c2'=>$arr_f02[1], 'c3'=>$arr_f02[2], 'c4'=>$arr_f02[3], 'c5'=>$arr_f02[4], 'c6'=>$arr_f02[5], 'c7'=>$arr_f02[6], 'c8'=>$arr_f02[7], 'c9'=>$arr_f02[8], 'c10'=>$arr_f02[9], 'c11'=>$arr_f02[10], 'c12'=>$arr_f02[11], 'c13'=>$arr_f02[12]),
	array('c1'=>$arr_f03[0], 'c2'=>$arr_f03[1], 'c3'=>$arr_f03[2], 'c4'=>$arr_f03[3], 'c5'=>$arr_f03[4], 'c6'=>$arr_f03[5], 'c7'=>$arr_f03[6], 'c8'=>$arr_f03[7], 'c9'=>$arr_f03[8], 'c10'=>$arr_f03[9], 'c11'=>$arr_f03[10], 'c12'=>$arr_f03[11], 'c13'=>$arr_f03[12])
);
$options = array('xPos'=>'left',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>550,
	'colGap' => 5,
	'shaded'=> 1,
	'showLines'=> 1,
	'fontSize' => 7,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'center','width'=>120),
		'c2'=>array('justification'=>'center','width'=>36),
		'c3'=>array('justification'=>'center','width'=>36),
		'c4'=>array('justification'=>'center','width'=>36),
		'c5'=>array('justification'=>'center','width'=>36),
		'c6'=>array('justification'=>'center','width'=>36),
		'c7'=>array('justification'=>'center','width'=>36),
		'c8'=>array('justification'=>'center','width'=>36),
		'c9'=>array('justification'=>'center','width'=>36),
		'c10'=>array('justification'=>'center','width'=>36),
		'c11'=>array('justification'=>'center','width'=>36),
		'c12'=>array('justification'=>'center','width'=>36),
		'c13'=>array('justification'=>'center','width'=>36)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/
$text_p15 = $data_f['p15'];
$arrays = explode('|', $text_p15);
$arr_f1 = explode(';', $arrays[0]);
$arr_f2 = explode(';', $arrays[1]);
$arr_f3 = explode(';', $arrays[2]);

if($arr_f1[1] != '') $arr_f1[1] = 'X';
if($arr_f2[1] != '') $arr_f2[1] = 'X';
if($arr_f3[1] != '') $arr_f3[1] = 'X';

$data = array(
	array('c1'=>'', 'c2'=>'OK'),
	array('c1'=>$arr_f1[0], 'c2'=>$arr_f1[1]),
	array('c1'=>$arr_f2[0], 'c2'=>$arr_f2[1]),
	array('c1'=>$arr_f3[0], 'c2'=>$arr_f3[1])
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
		'c1'=>array('justification'=>'left','width'=>350),
		'c2'=>array('justification'=>'center','width'=>100)
	)
);
$pdf->ezTable($data, '','',$options);
/** -------------------------------------------------------------------- **/
/** -------------------------------------------------------------------- **/
/** -------------------------------------------------------------------- **/
/** -------------------------------------------------------------------- **/

$pdf->ezStream();
?>