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
$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/
$pdf->ezText("<b>1. RELEVAMIENTO</b>",10);
$pdf->ezText("\n",2);
/** -------------------------------------------------------------------- **/
$data = array(
	array('c1'=>'Se tiene equipo Radio Enlace?:',		'c2'=>$data_f['p01'])
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
$pdf->ezText("\n",3);
/** -------------------------------------------------------------------- **/
$data=array(array('h01'=>'Equipo', 'h02'=>'Estado', 'h03'=>'Fabricante', 'h04'=>'Modelo', 'h05'=>'Radioenlace MW', 'h06'=>'ID Sitio salto radio enlace',
	'h07'=>'Frecuencia Tx (Ghz)', 'h08'=>'Frecuencia Rx (Ghz)', 'h09'=>'Topología Radio MW 1+1, 1+0, 2+0, XPIC, HTBY', 'h10'=>'Azimut', 'h11'=>'Diámetro antena', 'h12'=>'Altura antena'));
$pdf->ezTable($data,'','',
	array('xPos'=>'left',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>206,
		'colGap' => 5,
		'shaded'=> 1,
		'showLines'=> 1,
		'fontSize' => 5,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'h01'=>array('justification'=>'left','width'=>26),
			'h02'=>array('justification'=>'center','width'=>50),
			'h03'=>array('justification'=>'center','width'=>47),
			'h04'=>array('justification'=>'center','width'=>55),
			'h05'=>array('justification'=>'center','width'=>100),
			'h06'=>array('justification'=>'center','width'=>40),
			'h07'=>array('justification'=>'center','width'=>40),
			'h08'=>array('justification'=>'center','width'=>40),
			'h09'=>array('justification'=>'center','width'=>50),
			'h10'=>array('justification'=>'center','width'=>26),
			'h11'=>array('justification'=>'center','width'=>33),
			'h12'=>array('justification'=>'center','width'=>30)
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
$arr_f8 = explode(';', $arrays[7]);
$arr_f9 = explode(';', $arrays[8]);
$arr_f10 = explode(';', $arrays[9]);
$arr_f11 = explode(';', $arrays[10]);
$arr_f12 = explode(';', $arrays[11]);
$arr_f13 = explode(';', $arrays[12]);
$arr_f14 = explode(';', $arrays[13]);
$arr_f15 = explode(';', $arrays[14]);

$data = array(
	array('c1'=>$arr_f1[0], 'c2'=>$arr_f1[1], 'c3'=>$arr_f1[2], 'c4'=>$arr_f1[3], 'c5'=>$arr_f1[4], 'c6'=>$arr_f1[5], 'c7'=>$arr_f1[6], 'c8'=>$arr_f1[7], 'c9'=>$arr_f1[8], 'c10'=>$arr_f1[9], 'c11'=>$arr_f1[10], 'c12'=>$arr_f1[11]),
	array('c1'=>$arr_f2[0], 'c2'=>$arr_f2[1], 'c3'=>$arr_f2[2], 'c4'=>$arr_f2[3], 'c5'=>$arr_f2[4], 'c6'=>$arr_f2[5], 'c7'=>$arr_f2[6], 'c8'=>$arr_f2[7], 'c9'=>$arr_f2[8], 'c10'=>$arr_f2[9], 'c11'=>$arr_f2[10], 'c12'=>$arr_f2[11]),
	array('c1'=>$arr_f3[0], 'c2'=>$arr_f3[1], 'c3'=>$arr_f3[2], 'c4'=>$arr_f3[3], 'c5'=>$arr_f3[4], 'c6'=>$arr_f3[5], 'c7'=>$arr_f3[6], 'c8'=>$arr_f3[7], 'c9'=>$arr_f3[8], 'c10'=>$arr_f3[9], 'c11'=>$arr_f3[10], 'c12'=>$arr_f3[11]),
	array('c1'=>$arr_f4[0], 'c2'=>$arr_f4[1], 'c3'=>$arr_f4[2], 'c4'=>$arr_f4[3], 'c5'=>$arr_f4[4], 'c6'=>$arr_f4[5], 'c7'=>$arr_f4[6], 'c8'=>$arr_f4[7], 'c9'=>$arr_f4[8], 'c10'=>$arr_f4[9], 'c11'=>$arr_f4[10], 'c12'=>$arr_f4[11]),
	array('c1'=>$arr_f5[0], 'c2'=>$arr_f5[1], 'c3'=>$arr_f5[2], 'c4'=>$arr_f5[3], 'c5'=>$arr_f5[4], 'c6'=>$arr_f5[5], 'c7'=>$arr_f5[6], 'c8'=>$arr_f5[7], 'c9'=>$arr_f5[8], 'c10'=>$arr_f5[9], 'c11'=>$arr_f5[10], 'c12'=>$arr_f5[11]),
	array('c1'=>$arr_f6[0], 'c2'=>$arr_f6[1], 'c3'=>$arr_f6[2], 'c4'=>$arr_f6[3], 'c5'=>$arr_f6[4], 'c6'=>$arr_f6[5], 'c7'=>$arr_f6[6], 'c8'=>$arr_f6[7], 'c9'=>$arr_f6[8], 'c10'=>$arr_f6[9], 'c11'=>$arr_f6[10], 'c12'=>$arr_f6[11]),
	array('c1'=>$arr_f7[0], 'c2'=>$arr_f7[1], 'c3'=>$arr_f7[2], 'c4'=>$arr_f7[3], 'c5'=>$arr_f7[4], 'c6'=>$arr_f7[5], 'c7'=>$arr_f7[6], 'c8'=>$arr_f7[7], 'c9'=>$arr_f7[8], 'c10'=>$arr_f7[9], 'c11'=>$arr_f7[10], 'c12'=>$arr_f7[11]),
	array('c1'=>$arr_f8[0], 'c2'=>$arr_f8[1], 'c3'=>$arr_f8[2], 'c4'=>$arr_f8[3], 'c5'=>$arr_f8[4], 'c6'=>$arr_f8[5], 'c7'=>$arr_f8[6], 'c8'=>$arr_f8[7], 'c9'=>$arr_f8[8], 'c10'=>$arr_f8[9], 'c11'=>$arr_f8[10], 'c12'=>$arr_f8[11]),
	array('c1'=>$arr_f9[0], 'c2'=>$arr_f9[1], 'c3'=>$arr_f9[2], 'c4'=>$arr_f9[3], 'c5'=>$arr_f9[4], 'c6'=>$arr_f9[5], 'c7'=>$arr_f9[6], 'c8'=>$arr_f9[7], 'c9'=>$arr_f9[8], 'c10'=>$arr_f9[9], 'c11'=>$arr_f9[10], 'c12'=>$arr_f9[11]),
	array('c1'=>$arr_f10[0], 'c2'=>$arr_f10[1], 'c3'=>$arr_f10[2], 'c4'=>$arr_f10[3], 'c5'=>$arr_f10[4], 'c6'=>$arr_f10[5], 'c7'=>$arr_f10[6], 'c8'=>$arr_f10[7], 'c9'=>$arr_f10[8], 'c10'=>$arr_f10[9], 'c11'=>$arr_f10[10], 'c12'=>$arr_f10[11]),
	array('c1'=>$arr_f11[0], 'c2'=>$arr_f11[1], 'c3'=>$arr_f11[2], 'c4'=>$arr_f11[3], 'c5'=>$arr_f11[4], 'c6'=>$arr_f11[5], 'c7'=>$arr_f11[6], 'c8'=>$arr_f11[7], 'c9'=>$arr_f11[8], 'c10'=>$arr_f11[9], 'c11'=>$arr_f11[10], 'c12'=>$arr_f11[11]),
	array('c1'=>$arr_f12[0], 'c2'=>$arr_f12[1], 'c3'=>$arr_f12[2], 'c4'=>$arr_f12[3], 'c5'=>$arr_f12[4], 'c6'=>$arr_f12[5], 'c7'=>$arr_f12[6], 'c8'=>$arr_f12[7], 'c9'=>$arr_f12[8], 'c10'=>$arr_f12[9], 'c11'=>$arr_f12[10], 'c12'=>$arr_f12[11]),
	array('c1'=>$arr_f13[0], 'c2'=>$arr_f13[1], 'c3'=>$arr_f13[2], 'c4'=>$arr_f13[3], 'c5'=>$arr_f13[4], 'c6'=>$arr_f13[5], 'c7'=>$arr_f13[6], 'c8'=>$arr_f13[7], 'c9'=>$arr_f13[8], 'c10'=>$arr_f13[9], 'c11'=>$arr_f13[10], 'c12'=>$arr_f13[11]),
	array('c1'=>$arr_f14[0], 'c2'=>$arr_f14[1], 'c3'=>$arr_f14[2], 'c4'=>$arr_f14[3], 'c5'=>$arr_f14[4], 'c6'=>$arr_f14[5], 'c7'=>$arr_f14[6], 'c8'=>$arr_f14[7], 'c9'=>$arr_f14[8], 'c10'=>$arr_f14[9], 'c11'=>$arr_f14[10], 'c12'=>$arr_f14[11]),
	array('c1'=>$arr_f15[0], 'c2'=>$arr_f15[1], 'c3'=>$arr_f15[2], 'c4'=>$arr_f15[3], 'c5'=>$arr_f15[4], 'c6'=>$arr_f15[5], 'c7'=>$arr_f15[6], 'c8'=>$arr_f15[7], 'c9'=>$arr_f15[8], 'c10'=>$arr_f15[9], 'c11'=>$arr_f15[10], 'c12'=>$arr_f15[11])
);
$options = array('xPos'=>'left',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>540,
	'colGap' => 5,
	'shaded'=> 1,
	'showLines'=> 1,
	'fontSize' => 5,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'left','width'=>26),
		'c2'=>array('justification'=>'center','width'=>50),
		'c3'=>array('justification'=>'left','width'=>47),
		'c4'=>array('justification'=>'left','width'=>55),
		'c5'=>array('justification'=>'left','width'=>100),
		'c6'=>array('justification'=>'left','width'=>40),
		'c7'=>array('justification'=>'left','width'=>40),
		'c8'=>array('justification'=>'left','width'=>40),
		'c9'=>array('justification'=>'left','width'=>50),
		'c10'=>array('justification'=>'left','width'=>26),
		'c11'=>array('justification'=>'left','width'=>33),
		'c12'=>array('justification'=>'left','width'=>30)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",10);

/** -------------------------------------------------------------------- **/
$pdf->ezText("<b>2. MANTENIMIENTO PREVENTIVO</b>",10);
//$pdf->ezText("\n",1);
/** -------------------------------------------------------------------- **/
$data=array(array('der'=>'Revisado'));
$pdf->ezTable($data,'','',
	array('xPos'=>'380',
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
			'der'=>array('justification'=>'center','width'=>100)
		)
	));
/** -------------------------------------------------------------------- **/
$text_p03 = $data_f['p03'];
$arrays = explode('|', $text_p03);
$arr_f1 = explode(';', $arrays[0]);
$arr_f2 = explode(';', $arrays[1]);
$arr_f3 = explode(';', $arrays[2]);
$arr_f4 = explode(';', $arrays[3]);
$arr_f5 = explode(';', $arrays[4]);
$arr_f6 = explode(';', $arrays[5]);

if($arr_f1[1] != '') $arr_f1[1] = 'OK';
if($arr_f2[1] != '') $arr_f2[1] = 'OK';
if($arr_f3[1] != '') $arr_f3[1] = 'OK';
if($arr_f4[1] != '') $arr_f4[1] = 'OK';
if($arr_f5[1] != '') $arr_f5[1] = 'OK';
if($arr_f6[1] != '') $arr_f6[1] = 'OK';

$data = array(
	array('c1'=>$arr_f1[0], 'c2'=>$arr_f1[1]),
	array('c1'=>$arr_f2[0], 'c2'=>$arr_f2[1]),
	array('c1'=>$arr_f3[0], 'c2'=>$arr_f3[1]),
	array('c1'=>$arr_f4[0], 'c2'=>$arr_f4[1]),
	array('c1'=>$arr_f5[0], 'c2'=>$arr_f5[1]),
	array('c1'=>$arr_f6[0], 'c2'=>$arr_f6[1])
);
$options = array('xPos'=>'60',
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
		'c2'=>array('justification'=>'center','width'=>100)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",8);
/** -------------------------------------------------------------------- **/
$pdf->ezText("<b>    Disponibilidad de interfaces E1, FE, GE</b>",10);
$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/
$data=array(array('izq'=>'En servicio', 'der'=>'Libre'));
$pdf->ezTable($data,'','',
	array('xPos'=>'185',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>206,
		'colGap' => 5,
		'shaded'=> 1,
		'showLines'=> 1,
		'fontSize' => 9,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'izq'=>array('justification'=>'center','width'=>200),
			'der'=>array('justification'=>'center','width'=>200),
		)
	));
/** -------------------------------------------------------------------- **/
$text_p04 = $data_f['p04'];
$arrays = explode('|', $text_p04);
$arr_f1 = explode(';', $arrays[0]);
$arr_f2 = explode(';', $arrays[1]);
$arr_f3 = explode(';', $arrays[2]);
$arr_f4 = explode(';', $arrays[3]);


$data = array(
	array('c1'=>$arr_f1[0], 'c2'=>$arr_f1[1], 'c3'=>$arr_f1[2]),
	array('c1'=>$arr_f2[0], 'c2'=>$arr_f2[1], 'c3'=>$arr_f2[2]),
	array('c1'=>$arr_f3[0], 'c2'=>$arr_f3[1], 'c3'=>$arr_f3[2]),
	array('c1'=>$arr_f4[0], 'c2'=>$arr_f4[1], 'c3'=>$arr_f4[2])
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
		'c1'=>array('justification'=>'left','width'=>130),
		'c2'=>array('justification'=>'center','width'=>200),
		'c3'=>array('justification'=>'left','width'=>200)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/
$data = array(
	array('c1'=>'Observaciones:', 'c2'=>$data_f['p05'])
);
$options = array('xPos'=>'50',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>0,
	'colGap' => 5,
	'shaded'=> 0,
	'showLines'=> 0,
	'fontSize' => 9,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'left','width'=>75),
		'c2'=>array('justification'=>'left','width'=>460)
	)
);
$pdf->ezTable($data, '','',$options);


$pdf->ezStream();
?>