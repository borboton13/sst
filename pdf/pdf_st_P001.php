<?
$id_st_cronograma_informes = base64_decode($_GET["id_st_cronograma_informes"]);
$pro_key="f001";

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
$pdf->line(20,670,590,670);
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
array('c1'=>'<b>CM/SCM:</b>',				'c2'=>$data_f['nom_centro'], 					'c3'=>'',						'c4'=>''),
array('c1'=>'<b>Nomb. Responsables:</b>',	'c2'=>$data_g['user1'].' , '.$data_g['user2'],	'c3'=>'<b>Fecha Mtto:</b>', 	'c4'=>date_format(date_create($data_f['inicio']), 'd/m/Y')),
array('c1'=>'<b>Departamento:</b>',			'c2'=>$data_f['depto'],							'c3'=>'', 						'c4'=>''),
array('c1'=>'<b>Nombre estación:</b>',		'c2'=>$data_f['nom_estacion'], 					'c3'=>'<b>ID estación:</b> ',	'c4'=> $data_f['codigo'])
);
$options = array('xPos'=>'left',
                'xOrientation'=>'right',
				'showHeadings'=>0,
				'width'=>480,
				'colGap' => 5,
				'shaded'=> 0,
				'showLines'=> 0,
				'fontSize' => 9,
				'lineCol' => array(0.48,0.48,0.48),
				'cols'=>array(
				'c1'=>array('justification'=>'right','width'=>120),
				'c2'=>array('justification'=>'left','width'=>250),
				'c3'=>array('justification'=>'right','width'=>70),
				'c4'=>array('justification'=>'left','width'=>100)
				)
            );
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",5);

$pdf->ezText("<b>1. Relevamiento</b>",10);
$data = array(
	array('c1'=>'Dirección:',				'c2'=>$data_f['p01']),
	array('c1'=>'Tipo de estación:',		'c2'=>$data_f['p02']),
	array('c1'=>'Propiedad:',				'c2'=>$data_f['p03']),
	array('c1'=>'Requiere desmalezado?:',	'c2'=>$data_f['p04']),
	array('c1'=>'Horarios de accesibilidad al sitio:',	'c2'=>$data_f['p05'])
);
$options = array('xPos'=>'left',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>480,
	'colGap' => 5,
	'shaded'=> 0,
	'showLines'=> 0,
	'fontSize' => 9,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'right','width'=>160),
		'c2'=>array('justification'=>'left','width'=>380)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",3);

$data=array(array('izq'=>'Temporada Seca', 'der'=>'Temporada Lluvia'));
$pdf->ezTable($data,'','',
	array('xPos'=>'102',
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
			'izq'=>array('justification'=>'center','width'=>102),
			'der'=>array('justification'=>'center','width'=>102),
			)
	));

$text_p06 = $data_f['p06'];
$arrays = explode('|', $text_p06);
$arr_f1 = explode(';', $arrays[0]);
$arr_f2 = explode(';', $arrays[1]);
$arr_f3 = explode(';', $arrays[2]);
$arr_f4 = explode(';', $arrays[3]);
$arr_f5 = explode(';', $arrays[4]);

$data = array(
	array('c1'=>'Tipo de acceso', 'c2'=>'Distancia Km', 'c3'=>'Tiempo en hrs', 'c4'=>'Distancia Km', 'c5'=>'Tiempo en hrs', 'c6'=>'Observaciones'),
	array('c1'=>$arr_f1[0], 'c2'=>$arr_f1[1], 'c3'=>$arr_f1[2], 'c4'=>$arr_f1[3], 'c5'=>$arr_f1[4], 'c6'=>$arr_f1[5]),
	array('c1'=>$arr_f2[0], 'c2'=>$arr_f2[1], 'c3'=>$arr_f2[2], 'c4'=>$arr_f2[3], 'c5'=>$arr_f2[4], 'c6'=>$arr_f2[5]),
	array('c1'=>$arr_f3[0], 'c2'=>$arr_f3[1], 'c3'=>$arr_f3[2], 'c4'=>$arr_f3[3], 'c5'=>$arr_f3[4], 'c6'=>$arr_f3[5]),
	array('c1'=>$arr_f4[0], 'c2'=>$arr_f4[1], 'c3'=>$arr_f4[2], 'c4'=>$arr_f4[3], 'c5'=>$arr_f4[4], 'c6'=>$arr_f4[5]),
	array('c1'=>$arr_f5[0], 'c2'=>$arr_f5[1], 'c3'=>$arr_f5[2], 'c4'=>$arr_f5[3], 'c5'=>$arr_f5[4], 'c6'=>$arr_f5[5])
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
		'c1'=>array('justification'=>'center','width'=>60),
		'c2'=>array('justification'=>'center','width'=>52),
		'c3'=>array('justification'=>'center','width'=>50),
		'c4'=>array('justification'=>'center','width'=>52),
		'c5'=>array('justification'=>'center','width'=>50),
		'c6'=>array('justification'=>'center','width'=>150)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/
$data=array(array(	'h01'=>'No Existe','h02'=>'Malo','h03'=>'Bajo','h04'=>'Medio','h05'=>'Alto',
					'h06'=>'Bueno','h07'=>'Reparado','h08'=>'Ajustado','h09'=>'Cambiado','h10'=>'Pendiente'));
$pdf->ezTable($data,'','',
	array('xPos'=>'280',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>400,
		'colGap' => 5,
		'shaded'=> 2,
		'showLines'=> 2,
		'fontSize' => 5,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'h01'=>array('justification'=>'center','width'=>33),
			'h02'=>array('justification'=>'center','width'=>30),
			'h03'=>array('justification'=>'center','width'=>30),
			'h04'=>array('justification'=>'center','width'=>30),
			'h05'=>array('justification'=>'center','width'=>30),
			'h06'=>array('justification'=>'center','width'=>30),
			'h07'=>array('justification'=>'center','width'=>33),
			'h08'=>array('justification'=>'center','width'=>30),
			'h09'=>array('justification'=>'center','width'=>33),
			'h10'=>array('justification'=>'center','width'=>33)
		)
	));

$text_p07 = $data_f['p07'];
$arrays = explode('|', $text_p07);
$arr_f1 = explode(';', $arrays[0]);
$arr_f2 = explode(';', $arrays[1]);

if($arr_f1[1] != '') $arr_f1[1] = 'X';
if($arr_f1[2] != '') $arr_f1[2] = 'X';
if($arr_f1[3] != '') $arr_f1[3] = 'X';
if($arr_f1[4] != '') $arr_f1[4] = 'X';
if($arr_f1[5] != '') $arr_f1[5] = 'X';
if($arr_f1[6] != '') $arr_f1[6] = 'X';
if($arr_f1[7] != '') $arr_f1[7] = 'X';
if($arr_f1[8] != '') $arr_f1[8] = 'X';
if($arr_f1[9] != '') $arr_f1[9] = 'X';
if($arr_f1[10] != '') $arr_f1[10] = 'X';

if($arr_f2[1] != '') $arr_f2[1] = 'X';
if($arr_f2[2] != '') $arr_f2[2] = 'X';
if($arr_f2[3] != '') $arr_f2[3] = 'X';
if($arr_f2[4] != '') $arr_f2[4] = 'X';
if($arr_f2[5] != '') $arr_f2[5] = 'X';
if($arr_f2[6] != '') $arr_f2[6] = 'X';
if($arr_f2[7] != '') $arr_f2[7] = 'X';
if($arr_f2[8] != '') $arr_f2[8] = 'X';
if($arr_f2[9] != '') $arr_f2[9] = 'X';
if($arr_f2[10] != '') $arr_f2[10] = 'X';

$data = array(
	array('c1'=>$arr_f1[0], 'c2'=>$arr_f1[1], 'c3'=>$arr_f1[2], 'c4'=>$arr_f1[3], 'c5'=>$arr_f1[4], 'c6'=>$arr_f1[5], 'c7'=>$arr_f1[6], 'c8'=>$arr_f1[7], 'c9'=>$arr_f1[8], 'c10'=>$arr_f1[9], 'c11'=>$arr_f1[10]),
	array('c1'=>$arr_f2[0], 'c2'=>$arr_f2[1], 'c3'=>$arr_f2[2], 'c4'=>$arr_f2[3], 'c5'=>$arr_f2[4], 'c6'=>$arr_f2[5], 'c7'=>$arr_f2[6], 'c8'=>$arr_f2[7], 'c9'=>$arr_f2[8], 'c10'=>$arr_f2[9], 'c11'=>$arr_f2[10])
);
$options = array('xPos'=>'left',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>540,
	'colGap' => 5,
	'shaded'=> 1,
	'showLines'=> 1,
	'fontSize' => 6,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'left','width'=>238),
		'c2'=>array('justification'=>'center','width'=>33),
		'c3'=>array('justification'=>'center','width'=>30),
		'c4'=>array('justification'=>'center','width'=>30),
		'c5'=>array('justification'=>'center','width'=>30),
		'c6'=>array('justification'=>'center','width'=>30),
		'c7'=>array('justification'=>'center','width'=>33),
		'c8'=>array('justification'=>'center','width'=>30),
		'c9'=>array('justification'=>'center','width'=>30),
		'c10'=>array('justification'=>'center','width'=>33),
		'c11'=>array('justification'=>'center','width'=>33)
	)
);
$pdf->ezTable($data, '','',$options);
/** -------------------------------------------------------------------- **/
$pdf->ezText("\n",5);
$pdf->ezText("<b>2. Mantenimiento Preventivo</b>",10);
$data=array(array(	'h01'=>'No Existe','h02'=>'Malo','h03'=>'Bajo','h04'=>'Medio','h05'=>'Alto',
	'h06'=>'Bueno','h07'=>'Reparado','h08'=>'Ajustado','h09'=>'Cambiado','h10'=>'Pendiente'));
$pdf->ezTable($data,'','',
	array('xPos'=>'280',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>400,
		'colGap' => 5,
		'shaded'=> 1,
		'showLines'=> 2,
		'fontSize' => 5,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'h01'=>array('justification'=>'center','width'=>33),
			'h02'=>array('justification'=>'center','width'=>30),
			'h03'=>array('justification'=>'center','width'=>30),
			'h04'=>array('justification'=>'center','width'=>30),
			'h05'=>array('justification'=>'center','width'=>30),
			'h06'=>array('justification'=>'center','width'=>30),
			'h07'=>array('justification'=>'center','width'=>33),
			'h08'=>array('justification'=>'center','width'=>30),
			'h09'=>array('justification'=>'center','width'=>33),
			'h10'=>array('justification'=>'center','width'=>33)
		)
	));

$text_p08 = $data_f['p08'];
$arrays = explode('|', $text_p08);
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
$arr_f16 = explode(';', $arrays[15]);

if($arr_f1[1] != '') $arr_f1[1] = 'X';
if($arr_f1[2] != '') $arr_f1[2] = 'X';
if($arr_f1[3] != '') $arr_f1[3] = 'X';
if($arr_f1[4] != '') $arr_f1[4] = 'X';
if($arr_f1[5] != '') $arr_f1[5] = 'X';
if($arr_f1[6] != '') $arr_f1[6] = 'X';
if($arr_f1[7] != '') $arr_f1[7] = 'X';
if($arr_f1[8] != '') $arr_f1[8] = 'X';
if($arr_f1[9] != '') $arr_f1[9] = 'X';
if($arr_f1[10] != '') $arr_f1[10] = 'X';

if($arr_f2[1] != '') $arr_f2[1] = 'X';
if($arr_f2[2] != '') $arr_f2[2] = 'X';
if($arr_f2[3] != '') $arr_f2[3] = 'X';
if($arr_f2[4] != '') $arr_f2[4] = 'X';
if($arr_f2[5] != '') $arr_f2[5] = 'X';
if($arr_f2[6] != '') $arr_f2[6] = 'X';
if($arr_f2[7] != '') $arr_f2[7] = 'X';
if($arr_f2[8] != '') $arr_f2[8] = 'X';
if($arr_f2[9] != '') $arr_f2[9] = 'X';
if($arr_f2[10] != '') $arr_f2[10] = 'X';

if($arr_f3[1] != '') $arr_f3[1] = 'X';
if($arr_f3[2] != '') $arr_f3[2] = 'X';
if($arr_f3[3] != '') $arr_f3[3] = 'X';
if($arr_f3[4] != '') $arr_f3[4] = 'X';
if($arr_f3[5] != '') $arr_f3[5] = 'X';
if($arr_f3[6] != '') $arr_f3[6] = 'X';
if($arr_f3[7] != '') $arr_f3[7] = 'X';
if($arr_f3[8] != '') $arr_f3[8] = 'X';
if($arr_f3[9] != '') $arr_f3[9] = 'X';
if($arr_f3[10] != '') $arr_f3[10] = 'X';

if($arr_f4[1] != '') $arr_f4[1] = 'X';
if($arr_f4[2] != '') $arr_f4[2] = 'X';
if($arr_f4[3] != '') $arr_f4[3] = 'X';
if($arr_f4[4] != '') $arr_f4[4] = 'X';
if($arr_f4[5] != '') $arr_f4[5] = 'X';
if($arr_f4[6] != '') $arr_f4[6] = 'X';
if($arr_f4[7] != '') $arr_f4[7] = 'X';
if($arr_f4[8] != '') $arr_f4[8] = 'X';
if($arr_f4[9] != '') $arr_f4[9] = 'X';
if($arr_f4[10] != '') $arr_f4[10] = 'X';

if($arr_f5[1] != '') $arr_f5[1] = 'X';
if($arr_f5[2] != '') $arr_f5[2] = 'X';
if($arr_f5[3] != '') $arr_f5[3] = 'X';
if($arr_f5[4] != '') $arr_f5[4] = 'X';
if($arr_f5[5] != '') $arr_f5[5] = 'X';
if($arr_f5[6] != '') $arr_f5[6] = 'X';
if($arr_f5[7] != '') $arr_f5[7] = 'X';
if($arr_f5[8] != '') $arr_f5[8] = 'X';
if($arr_f5[9] != '') $arr_f5[9] = 'X';
if($arr_f5[10] != '') $arr_f5[10] = 'X';

if($arr_f6[1] != '') $arr_f6[1] = 'X';
if($arr_f6[2] != '') $arr_f6[2] = 'X';
if($arr_f6[3] != '') $arr_f6[3] = 'X';
if($arr_f6[4] != '') $arr_f6[4] = 'X';
if($arr_f6[5] != '') $arr_f6[5] = 'X';
if($arr_f6[6] != '') $arr_f6[6] = 'X';
if($arr_f6[7] != '') $arr_f6[7] = 'X';
if($arr_f6[8] != '') $arr_f6[8] = 'X';
if($arr_f6[9] != '') $arr_f6[9] = 'X';
if($arr_f6[10] != '') $arr_f6[10] = 'X';

if($arr_f7[1] != '') $arr_f7[1] = 'X';
if($arr_f7[2] != '') $arr_f7[2] = 'X';
if($arr_f7[3] != '') $arr_f7[3] = 'X';
if($arr_f7[4] != '') $arr_f7[4] = 'X';
if($arr_f7[5] != '') $arr_f7[5] = 'X';
if($arr_f7[6] != '') $arr_f7[6] = 'X';
if($arr_f7[7] != '') $arr_f7[7] = 'X';
if($arr_f7[8] != '') $arr_f7[8] = 'X';
if($arr_f7[9] != '') $arr_f7[9] = 'X';
if($arr_f7[10] != '') $arr_f7[10] = 'X';

if($arr_f8[1] != '') $arr_f8[1] = 'X';
if($arr_f8[2] != '') $arr_f8[2] = 'X';
if($arr_f8[3] != '') $arr_f8[3] = 'X';
if($arr_f8[4] != '') $arr_f8[4] = 'X';
if($arr_f8[5] != '') $arr_f8[5] = 'X';
if($arr_f8[6] != '') $arr_f8[6] = 'X';
if($arr_f8[7] != '') $arr_f8[7] = 'X';
if($arr_f8[8] != '') $arr_f8[8] = 'X';
if($arr_f8[9] != '') $arr_f8[9] = 'X';
if($arr_f8[10] != '') $arr_f8[10] = 'X';

if($arr_f9[1] != '') $arr_f9[1] = 'X';
if($arr_f9[2] != '') $arr_f9[2] = 'X';
if($arr_f9[3] != '') $arr_f9[3] = 'X';
if($arr_f9[4] != '') $arr_f9[4] = 'X';
if($arr_f9[5] != '') $arr_f9[5] = 'X';
if($arr_f9[6] != '') $arr_f9[6] = 'X';
if($arr_f9[7] != '') $arr_f9[7] = 'X';
if($arr_f9[8] != '') $arr_f9[8] = 'X';
if($arr_f9[9] != '') $arr_f9[9] = 'X';
if($arr_f9[10] != '') $arr_f9[10] = 'X';

if($arr_f10[1] != '') $arr_f10[1] = 'X';
if($arr_f10[2] != '') $arr_f10[2] = 'X';
if($arr_f10[3] != '') $arr_f10[3] = 'X';
if($arr_f10[4] != '') $arr_f10[4] = 'X';
if($arr_f10[5] != '') $arr_f10[5] = 'X';
if($arr_f10[6] != '') $arr_f10[6] = 'X';
if($arr_f10[7] != '') $arr_f10[7] = 'X';
if($arr_f10[8] != '') $arr_f10[8] = 'X';
if($arr_f10[9] != '') $arr_f10[9] = 'X';
if($arr_f10[10] != '') $arr_f10[10] = 'X';

if($arr_f11[1] != '') $arr_f11[1] = 'X';
if($arr_f11[2] != '') $arr_f11[2] = 'X';
if($arr_f11[3] != '') $arr_f11[3] = 'X';
if($arr_f11[4] != '') $arr_f11[4] = 'X';
if($arr_f11[5] != '') $arr_f11[5] = 'X';
if($arr_f11[6] != '') $arr_f11[6] = 'X';
if($arr_f11[7] != '') $arr_f11[7] = 'X';
if($arr_f11[8] != '') $arr_f11[8] = 'X';
if($arr_f11[9] != '') $arr_f11[9] = 'X';
if($arr_f11[10] != '') $arr_f11[10] = 'X';

if($arr_f12[1] != '') $arr_f12[1] = 'X';
if($arr_f12[2] != '') $arr_f12[2] = 'X';
if($arr_f12[3] != '') $arr_f12[3] = 'X';
if($arr_f12[4] != '') $arr_f12[4] = 'X';
if($arr_f12[5] != '') $arr_f12[5] = 'X';
if($arr_f12[6] != '') $arr_f12[6] = 'X';
if($arr_f12[7] != '') $arr_f12[7] = 'X';
if($arr_f12[8] != '') $arr_f12[8] = 'X';
if($arr_f12[9] != '') $arr_f12[9] = 'X';
if($arr_f12[10] != '') $arr_f12[10] = 'X';

if($arr_f13[1] != '') $arr_f13[1] = 'X';
if($arr_f13[2] != '') $arr_f13[2] = 'X';
if($arr_f13[3] != '') $arr_f13[3] = 'X';
if($arr_f13[4] != '') $arr_f13[4] = 'X';
if($arr_f13[5] != '') $arr_f13[5] = 'X';
if($arr_f13[6] != '') $arr_f13[6] = 'X';
if($arr_f13[7] != '') $arr_f13[7] = 'X';
if($arr_f13[8] != '') $arr_f13[8] = 'X';
if($arr_f13[9] != '') $arr_f13[9] = 'X';
if($arr_f13[10] != '') $arr_f13[10] = 'X';

if($arr_f14[1] != '') $arr_f14[1] = 'X';
if($arr_f14[2] != '') $arr_f14[2] = 'X';
if($arr_f14[3] != '') $arr_f14[3] = 'X';
if($arr_f14[4] != '') $arr_f14[4] = 'X';
if($arr_f14[5] != '') $arr_f14[5] = 'X';
if($arr_f14[6] != '') $arr_f14[6] = 'X';
if($arr_f14[7] != '') $arr_f14[7] = 'X';
if($arr_f14[8] != '') $arr_f14[8] = 'X';
if($arr_f14[9] != '') $arr_f14[9] = 'X';
if($arr_f14[10] != '') $arr_f14[10] = 'X';

if($arr_f15[1] != '') $arr_f15[1] = 'X';
if($arr_f15[2] != '') $arr_f15[2] = 'X';
if($arr_f15[3] != '') $arr_f15[3] = 'X';
if($arr_f15[4] != '') $arr_f15[4] = 'X';
if($arr_f15[5] != '') $arr_f15[5] = 'X';
if($arr_f15[6] != '') $arr_f15[6] = 'X';
if($arr_f15[7] != '') $arr_f15[7] = 'X';
if($arr_f15[8] != '') $arr_f15[8] = 'X';
if($arr_f15[9] != '') $arr_f15[9] = 'X';
if($arr_f15[10] != '') $arr_f15[10] = 'X';

if($arr_f16[1] != '') $arr_f16[1] = 'X';
if($arr_f16[2] != '') $arr_f16[2] = 'X';
if($arr_f16[3] != '') $arr_f16[3] = 'X';
if($arr_f16[4] != '') $arr_f16[4] = 'X';
if($arr_f16[5] != '') $arr_f16[5] = 'X';
if($arr_f16[6] != '') $arr_f16[6] = 'X';
if($arr_f16[7] != '') $arr_f16[7] = 'X';
if($arr_f16[8] != '') $arr_f16[8] = 'X';
if($arr_f16[9] != '') $arr_f16[9] = 'X';
if($arr_f16[10] != '') $arr_f16[10] = 'X';

$data = array(
	array('c1'=>$arr_f1[0], 'c2'=>$arr_f1[1], 'c3'=>$arr_f1[2], 'c4'=>$arr_f1[3], 'c5'=>$arr_f1[4], 'c6'=>$arr_f1[5], 'c7'=>$arr_f1[6], 'c8'=>$arr_f1[7], 'c9'=>$arr_f1[8], 'c10'=>$arr_f1[9], 'c11'=>$arr_f1[10]),
	array('c1'=>$arr_f2[0], 'c2'=>$arr_f2[1], 'c3'=>$arr_f2[2], 'c4'=>$arr_f2[3], 'c5'=>$arr_f2[4], 'c6'=>$arr_f2[5], 'c7'=>$arr_f2[6], 'c8'=>$arr_f2[7], 'c9'=>$arr_f2[8], 'c10'=>$arr_f2[9], 'c11'=>$arr_f2[10]),
	array('c1'=>$arr_f3[0], 'c2'=>$arr_f3[1], 'c3'=>$arr_f3[2], 'c4'=>$arr_f3[3], 'c5'=>$arr_f3[4], 'c6'=>$arr_f3[5], 'c7'=>$arr_f3[6], 'c8'=>$arr_f3[7], 'c9'=>$arr_f3[8], 'c10'=>$arr_f3[9], 'c11'=>$arr_f3[10]),
	array('c1'=>$arr_f4[0], 'c2'=>$arr_f4[1], 'c3'=>$arr_f4[2], 'c4'=>$arr_f4[3], 'c5'=>$arr_f4[4], 'c6'=>$arr_f4[5], 'c7'=>$arr_f4[6], 'c8'=>$arr_f4[7], 'c9'=>$arr_f4[8], 'c10'=>$arr_f4[9], 'c11'=>$arr_f4[10]),
	array('c1'=>$arr_f5[0], 'c2'=>$arr_f5[1], 'c3'=>$arr_f5[2], 'c4'=>$arr_f5[3], 'c5'=>$arr_f5[4], 'c6'=>$arr_f5[5], 'c7'=>$arr_f5[6], 'c8'=>$arr_f5[7], 'c9'=>$arr_f5[8], 'c10'=>$arr_f5[9], 'c11'=>$arr_f5[10]),
	array('c1'=>$arr_f6[0], 'c2'=>$arr_f6[1], 'c3'=>$arr_f6[2], 'c4'=>$arr_f6[3], 'c5'=>$arr_f6[4], 'c6'=>$arr_f6[5], 'c7'=>$arr_f6[6], 'c8'=>$arr_f6[7], 'c9'=>$arr_f6[8], 'c10'=>$arr_f6[9], 'c11'=>$arr_f6[10]),
	array('c1'=>$arr_f7[0], 'c2'=>$arr_f7[1], 'c3'=>$arr_f7[2], 'c4'=>$arr_f7[3], 'c5'=>$arr_f7[4], 'c6'=>$arr_f7[5], 'c7'=>$arr_f7[6], 'c8'=>$arr_f7[7], 'c9'=>$arr_f7[8], 'c10'=>$arr_f7[9], 'c11'=>$arr_f7[10]),
	array('c1'=>$arr_f8[0], 'c2'=>$arr_f8[1], 'c3'=>$arr_f8[2], 'c4'=>$arr_f8[3], 'c5'=>$arr_f8[4], 'c6'=>$arr_f8[5], 'c7'=>$arr_f8[6], 'c8'=>$arr_f8[7], 'c9'=>$arr_f8[8], 'c10'=>$arr_f8[9], 'c11'=>$arr_f8[10]),
	array('c1'=>$arr_f9[0], 'c2'=>$arr_f9[1], 'c3'=>$arr_f9[2], 'c4'=>$arr_f9[3], 'c5'=>$arr_f9[4], 'c6'=>$arr_f9[5], 'c7'=>$arr_f9[6], 'c8'=>$arr_f9[7], 'c9'=>$arr_f9[8], 'c10'=>$arr_f9[9], 'c11'=>$arr_f9[10]),
	array('c1'=>$arr_f10[0], 'c2'=>$arr_f10[1], 'c3'=>$arr_f10[2], 'c4'=>$arr_f10[3], 'c5'=>$arr_f10[4], 'c6'=>$arr_f10[5], 'c7'=>$arr_f10[6], 'c8'=>$arr_f10[7], 'c9'=>$arr_f10[8], 'c10'=>$arr_f10[9], 'c11'=>$arr_f10[10]),
	array('c1'=>$arr_f11[0], 'c2'=>$arr_f11[1], 'c3'=>$arr_f11[2], 'c4'=>$arr_f11[3], 'c5'=>$arr_f11[4], 'c6'=>$arr_f11[5], 'c7'=>$arr_f11[6], 'c8'=>$arr_f11[7], 'c9'=>$arr_f11[8], 'c10'=>$arr_f11[9], 'c11'=>$arr_f11[10]),
	array('c1'=>$arr_f12[0], 'c2'=>$arr_f12[1], 'c3'=>$arr_f12[2], 'c4'=>$arr_f12[3], 'c5'=>$arr_f12[4], 'c6'=>$arr_f12[5], 'c7'=>$arr_f12[6], 'c8'=>$arr_f12[7], 'c9'=>$arr_f12[8], 'c10'=>$arr_f12[9], 'c11'=>$arr_f12[10]),
	array('c1'=>$arr_f13[0], 'c2'=>$arr_f13[1], 'c3'=>$arr_f13[2], 'c4'=>$arr_f13[3], 'c5'=>$arr_f13[4], 'c6'=>$arr_f13[5], 'c7'=>$arr_f13[6], 'c8'=>$arr_f13[7], 'c9'=>$arr_f13[8], 'c10'=>$arr_f13[9], 'c11'=>$arr_f13[10]),
	array('c1'=>$arr_f14[0], 'c2'=>$arr_f14[1], 'c3'=>$arr_f14[2], 'c4'=>$arr_f14[3], 'c5'=>$arr_f14[4], 'c6'=>$arr_f14[5], 'c7'=>$arr_f14[6], 'c8'=>$arr_f14[7], 'c9'=>$arr_f14[8], 'c10'=>$arr_f14[9], 'c11'=>$arr_f14[10]),
	array('c1'=>$arr_f15[0], 'c2'=>$arr_f15[1], 'c3'=>$arr_f15[2], 'c4'=>$arr_f15[3], 'c5'=>$arr_f15[4], 'c6'=>$arr_f15[5], 'c7'=>$arr_f15[6], 'c8'=>$arr_f15[7], 'c9'=>$arr_f15[8], 'c10'=>$arr_f15[9], 'c11'=>$arr_f15[10]),
	array('c1'=>$arr_f16[0], 'c2'=>$arr_f16[1], 'c3'=>$arr_f16[2], 'c4'=>$arr_f16[3], 'c5'=>$arr_f16[4], 'c6'=>$arr_f16[5], 'c7'=>$arr_f16[6], 'c8'=>$arr_f16[7], 'c9'=>$arr_f16[8], 'c10'=>$arr_f16[9], 'c11'=>$arr_f16[10])
);
$options = array('xPos'=>'left',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>540,
	'colGap' => 5,
	'shaded'=> 1,
	'showLines'=> 1,
	'fontSize' => 6,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'left','width'=>238),
		'c2'=>array('justification'=>'center','width'=>33),
		'c3'=>array('justification'=>'center','width'=>30),
		'c4'=>array('justification'=>'center','width'=>30),
		'c5'=>array('justification'=>'center','width'=>30),
		'c6'=>array('justification'=>'center','width'=>30),
		'c7'=>array('justification'=>'center','width'=>33),
		'c8'=>array('justification'=>'center','width'=>30),
		'c9'=>array('justification'=>'center','width'=>30),
		'c10'=>array('justification'=>'center','width'=>33),
		'c11'=>array('justification'=>'center','width'=>33)
	)
);
$pdf->ezTable($data, '','',$options);
/** -------------------------------------------------------------------- **/
$text_p09 = $data_f['p09'];
$arrays = explode('|', $text_p09);
$arr_f1 = explode(';', $arrays[0]);
$arr_f2 = explode(';', $arrays[1]);
$arr_f3 = explode(';', $arrays[2]);
$arr_f4 = explode(';', $arrays[3]);

if($arr_f1[1] != '') $arr_f1[1] = 'X';
if($arr_f1[2] != '') $arr_f1[2] = 'X';
if($arr_f1[3] != '') $arr_f1[3] = 'X';
if($arr_f1[4] != '') $arr_f1[4] = 'X';
if($arr_f1[5] != '') $arr_f1[5] = 'X';
if($arr_f1[6] != '') $arr_f1[6] = 'X';
if($arr_f1[7] != '') $arr_f1[7] = 'X';
if($arr_f1[8] != '') $arr_f1[8] = 'X';
if($arr_f1[9] != '') $arr_f1[9] = 'X';
if($arr_f1[10] != '') $arr_f1[10] = 'X';

if($arr_f2[1] != '') $arr_f2[1] = 'X';
if($arr_f2[2] != '') $arr_f2[2] = 'X';
if($arr_f2[3] != '') $arr_f2[3] = 'X';
if($arr_f2[4] != '') $arr_f2[4] = 'X';
if($arr_f2[5] != '') $arr_f2[5] = 'X';
if($arr_f2[6] != '') $arr_f2[6] = 'X';
if($arr_f2[7] != '') $arr_f2[7] = 'X';
if($arr_f2[8] != '') $arr_f2[8] = 'X';
if($arr_f2[9] != '') $arr_f2[9] = 'X';
if($arr_f2[10] != '') $arr_f2[10] = 'X';

if($arr_f3[1] != '') $arr_f3[1] = 'X';
if($arr_f3[2] != '') $arr_f3[2] = 'X';
if($arr_f3[3] != '') $arr_f3[3] = 'X';
if($arr_f3[4] != '') $arr_f3[4] = 'X';
if($arr_f3[5] != '') $arr_f3[5] = 'X';
if($arr_f3[6] != '') $arr_f3[6] = 'X';
if($arr_f3[7] != '') $arr_f3[7] = 'X';
if($arr_f3[8] != '') $arr_f3[8] = 'X';
if($arr_f3[9] != '') $arr_f3[9] = 'X';
if($arr_f3[10] != '') $arr_f3[10] = 'X';

if($arr_f4[1] != '') $arr_f4[1] = 'X';
if($arr_f4[2] != '') $arr_f4[2] = 'X';
if($arr_f4[3] != '') $arr_f4[3] = 'X';
if($arr_f4[4] != '') $arr_f4[4] = 'X';
if($arr_f4[5] != '') $arr_f4[5] = 'X';
if($arr_f4[6] != '') $arr_f4[6] = 'X';
if($arr_f4[7] != '') $arr_f4[7] = 'X';
if($arr_f4[8] != '') $arr_f4[8] = 'X';
if($arr_f4[9] != '') $arr_f4[9] = 'X';
if($arr_f4[10] != '') $arr_f4[10] = 'X';

$data = array(
	array('c1'=>$arr_f1[0], 'c2'=>$arr_f1[1], 'c3'=>$arr_f1[2], 'c4'=>$arr_f1[3], 'c5'=>$arr_f1[4], 'c6'=>$arr_f1[5], 'c7'=>$arr_f1[6], 'c8'=>$arr_f1[7], 'c9'=>$arr_f1[8], 'c10'=>$arr_f1[9], 'c11'=>$arr_f1[10]),
	array('c1'=>$arr_f2[0], 'c2'=>$arr_f2[1], 'c3'=>$arr_f2[2], 'c4'=>$arr_f2[3], 'c5'=>$arr_f2[4], 'c6'=>$arr_f2[5], 'c7'=>$arr_f2[6], 'c8'=>$arr_f2[7], 'c9'=>$arr_f2[8], 'c10'=>$arr_f2[9], 'c11'=>$arr_f2[10]),
	array('c1'=>$arr_f3[0], 'c2'=>$arr_f3[1], 'c3'=>$arr_f3[2], 'c4'=>$arr_f3[3], 'c5'=>$arr_f3[4], 'c6'=>$arr_f3[5], 'c7'=>$arr_f3[6], 'c8'=>$arr_f3[7], 'c9'=>$arr_f3[8], 'c10'=>$arr_f3[9], 'c11'=>$arr_f3[10]),
	array('c1'=>$arr_f4[0], 'c2'=>$arr_f4[1], 'c3'=>$arr_f4[2], 'c4'=>$arr_f4[3], 'c5'=>$arr_f4[4], 'c6'=>$arr_f4[5], 'c7'=>$arr_f4[6], 'c8'=>$arr_f4[7], 'c9'=>$arr_f4[8], 'c10'=>$arr_f4[9], 'c11'=>$arr_f4[10])
);
$options = array('xPos'=>'left',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>540,
	'colGap' => 5,
	'shaded'=> 1,
	'showLines'=> 1,
	'fontSize' => 6,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'left','width'=>238),
		'c2'=>array('justification'=>'center','width'=>33),
		'c3'=>array('justification'=>'center','width'=>30),
		'c4'=>array('justification'=>'center','width'=>30),
		'c5'=>array('justification'=>'center','width'=>30),
		'c6'=>array('justification'=>'center','width'=>30),
		'c7'=>array('justification'=>'center','width'=>33),
		'c8'=>array('justification'=>'center','width'=>30),
		'c9'=>array('justification'=>'center','width'=>30),
		'c10'=>array('justification'=>'center','width'=>33),
		'c11'=>array('justification'=>'center','width'=>33)
	)
);
$pdf->ezTable($data, '','',$options);
/** -------------------------------------------------------------------- **/
$text_p10 = $data_f['p10'];
$arrays = explode('|', $text_p10);
$arr_f1 = explode(';', $arrays[0]);
$arr_f2 = explode(';', $arrays[1]);
$arr_f3 = explode(';', $arrays[2]);
$arr_f4 = explode(';', $arrays[3]);
$arr_f5 = explode(';', $arrays[4]);
$arr_f6 = explode(';', $arrays[5]);
$arr_f7 = explode(';', $arrays[6]);
$arr_f8 = explode(';', $arrays[7]);
$arr_f9 = explode(';', $arrays[8]);

if($arr_f1[1] != '') $arr_f1[1] = 'X';
if($arr_f1[2] != '') $arr_f1[2] = 'X';
if($arr_f1[3] != '') $arr_f1[3] = 'X';
if($arr_f1[4] != '') $arr_f1[4] = 'X';
if($arr_f1[5] != '') $arr_f1[5] = 'X';
if($arr_f1[6] != '') $arr_f1[6] = 'X';
if($arr_f1[7] != '') $arr_f1[7] = 'X';
if($arr_f1[8] != '') $arr_f1[8] = 'X';
if($arr_f1[9] != '') $arr_f1[9] = 'X';
if($arr_f1[10] != '') $arr_f1[10] = 'X';

if($arr_f2[1] != '') $arr_f2[1] = 'X';
if($arr_f2[2] != '') $arr_f2[2] = 'X';
if($arr_f2[3] != '') $arr_f2[3] = 'X';
if($arr_f2[4] != '') $arr_f2[4] = 'X';
if($arr_f2[5] != '') $arr_f2[5] = 'X';
if($arr_f2[6] != '') $arr_f2[6] = 'X';
if($arr_f2[7] != '') $arr_f2[7] = 'X';
if($arr_f2[8] != '') $arr_f2[8] = 'X';
if($arr_f2[9] != '') $arr_f2[9] = 'X';
if($arr_f2[10] != '') $arr_f2[10] = 'X';

if($arr_f3[1] != '') $arr_f3[1] = 'X';
if($arr_f3[2] != '') $arr_f3[2] = 'X';
if($arr_f3[3] != '') $arr_f3[3] = 'X';
if($arr_f3[4] != '') $arr_f3[4] = 'X';
if($arr_f3[5] != '') $arr_f3[5] = 'X';
if($arr_f3[6] != '') $arr_f3[6] = 'X';
if($arr_f3[7] != '') $arr_f3[7] = 'X';
if($arr_f3[8] != '') $arr_f3[8] = 'X';
if($arr_f3[9] != '') $arr_f3[9] = 'X';
if($arr_f3[10] != '') $arr_f3[10] = 'X';

if($arr_f4[1] != '') $arr_f4[1] = 'X';
if($arr_f4[2] != '') $arr_f4[2] = 'X';
if($arr_f4[3] != '') $arr_f4[3] = 'X';
if($arr_f4[4] != '') $arr_f4[4] = 'X';
if($arr_f4[5] != '') $arr_f4[5] = 'X';
if($arr_f4[6] != '') $arr_f4[6] = 'X';
if($arr_f4[7] != '') $arr_f4[7] = 'X';
if($arr_f4[8] != '') $arr_f4[8] = 'X';
if($arr_f4[9] != '') $arr_f4[9] = 'X';
if($arr_f4[10] != '') $arr_f4[10] = 'X';

if($arr_f5[1] != '') $arr_f5[1] = 'X';
if($arr_f5[2] != '') $arr_f5[2] = 'X';
if($arr_f5[3] != '') $arr_f5[3] = 'X';
if($arr_f5[4] != '') $arr_f5[4] = 'X';
if($arr_f5[5] != '') $arr_f5[5] = 'X';
if($arr_f5[6] != '') $arr_f5[6] = 'X';
if($arr_f5[7] != '') $arr_f5[7] = 'X';
if($arr_f5[8] != '') $arr_f5[8] = 'X';
if($arr_f5[9] != '') $arr_f5[9] = 'X';
if($arr_f5[10] != '') $arr_f5[10] = 'X';

if($arr_f6[1] != '') $arr_f6[1] = 'X';
if($arr_f6[2] != '') $arr_f6[2] = 'X';
if($arr_f6[3] != '') $arr_f6[3] = 'X';
if($arr_f6[4] != '') $arr_f6[4] = 'X';
if($arr_f6[5] != '') $arr_f6[5] = 'X';
if($arr_f6[6] != '') $arr_f6[6] = 'X';
if($arr_f6[7] != '') $arr_f6[7] = 'X';
if($arr_f6[8] != '') $arr_f6[8] = 'X';
if($arr_f6[9] != '') $arr_f6[9] = 'X';
if($arr_f6[10] != '') $arr_f6[10] = 'X';

if($arr_f7[1] != '') $arr_f7[1] = 'X';
if($arr_f7[2] != '') $arr_f7[2] = 'X';
if($arr_f7[3] != '') $arr_f7[3] = 'X';
if($arr_f7[4] != '') $arr_f7[4] = 'X';
if($arr_f7[5] != '') $arr_f7[5] = 'X';
if($arr_f7[6] != '') $arr_f7[6] = 'X';
if($arr_f7[7] != '') $arr_f7[7] = 'X';
if($arr_f7[8] != '') $arr_f7[8] = 'X';
if($arr_f7[9] != '') $arr_f7[9] = 'X';
if($arr_f7[10] != '') $arr_f7[10] = 'X';

if($arr_f8[1] != '') $arr_f8[1] = 'X';
if($arr_f8[2] != '') $arr_f8[2] = 'X';
if($arr_f8[3] != '') $arr_f8[3] = 'X';
if($arr_f8[4] != '') $arr_f8[4] = 'X';
if($arr_f8[5] != '') $arr_f8[5] = 'X';
if($arr_f8[6] != '') $arr_f8[6] = 'X';
if($arr_f8[7] != '') $arr_f8[7] = 'X';
if($arr_f8[8] != '') $arr_f8[8] = 'X';
if($arr_f8[9] != '') $arr_f8[9] = 'X';
if($arr_f8[10] != '') $arr_f8[10] = 'X';

if($arr_f9[1] != '') $arr_f9[1] = 'X';
if($arr_f9[2] != '') $arr_f9[2] = 'X';
if($arr_f9[3] != '') $arr_f9[3] = 'X';
if($arr_f9[4] != '') $arr_f9[4] = 'X';
if($arr_f9[5] != '') $arr_f9[5] = 'X';
if($arr_f9[6] != '') $arr_f9[6] = 'X';
if($arr_f9[7] != '') $arr_f9[7] = 'X';
if($arr_f9[8] != '') $arr_f9[8] = 'X';
if($arr_f9[9] != '') $arr_f9[9] = 'X';
if($arr_f9[10] != '') $arr_f9[10] = 'X';

$data = array(
	array('c1'=>$arr_f1[0], 'c2'=>$arr_f1[1], 'c3'=>$arr_f1[2], 'c4'=>$arr_f1[3], 'c5'=>$arr_f1[4], 'c6'=>$arr_f1[5], 'c7'=>$arr_f1[6], 'c8'=>$arr_f1[7], 'c9'=>$arr_f1[8], 'c10'=>$arr_f1[9], 'c11'=>$arr_f1[10]),
	array('c1'=>$arr_f2[0], 'c2'=>$arr_f2[1], 'c3'=>$arr_f2[2], 'c4'=>$arr_f2[3], 'c5'=>$arr_f2[4], 'c6'=>$arr_f2[5], 'c7'=>$arr_f2[6], 'c8'=>$arr_f2[7], 'c9'=>$arr_f2[8], 'c10'=>$arr_f2[9], 'c11'=>$arr_f2[10]),
	array('c1'=>$arr_f3[0], 'c2'=>$arr_f3[1], 'c3'=>$arr_f3[2], 'c4'=>$arr_f3[3], 'c5'=>$arr_f3[4], 'c6'=>$arr_f3[5], 'c7'=>$arr_f3[6], 'c8'=>$arr_f3[7], 'c9'=>$arr_f3[8], 'c10'=>$arr_f3[9], 'c11'=>$arr_f3[10]),
	array('c1'=>$arr_f4[0], 'c2'=>$arr_f4[1], 'c3'=>$arr_f4[2], 'c4'=>$arr_f4[3], 'c5'=>$arr_f4[4], 'c6'=>$arr_f4[5], 'c7'=>$arr_f4[6], 'c8'=>$arr_f4[7], 'c9'=>$arr_f4[8], 'c10'=>$arr_f4[9], 'c11'=>$arr_f4[10]),
	array('c1'=>$arr_f5[0], 'c2'=>$arr_f5[1], 'c3'=>$arr_f5[2], 'c4'=>$arr_f5[3], 'c5'=>$arr_f5[4], 'c6'=>$arr_f5[5], 'c7'=>$arr_f5[6], 'c8'=>$arr_f5[7], 'c9'=>$arr_f5[8], 'c10'=>$arr_f5[9], 'c11'=>$arr_f5[10]),
	array('c1'=>$arr_f6[0], 'c2'=>$arr_f6[1], 'c3'=>$arr_f6[2], 'c4'=>$arr_f6[3], 'c5'=>$arr_f6[4], 'c6'=>$arr_f6[5], 'c7'=>$arr_f6[6], 'c8'=>$arr_f6[7], 'c9'=>$arr_f6[8], 'c10'=>$arr_f6[9], 'c11'=>$arr_f6[10]),
	array('c1'=>$arr_f7[0], 'c2'=>$arr_f7[1], 'c3'=>$arr_f7[2], 'c4'=>$arr_f7[3], 'c5'=>$arr_f7[4], 'c6'=>$arr_f7[5], 'c7'=>$arr_f7[6], 'c8'=>$arr_f7[7], 'c9'=>$arr_f7[8], 'c10'=>$arr_f7[9], 'c11'=>$arr_f7[10]),
	array('c1'=>$arr_f8[0], 'c2'=>$arr_f8[1], 'c3'=>$arr_f8[2], 'c4'=>$arr_f8[3], 'c5'=>$arr_f8[4], 'c6'=>$arr_f8[5], 'c7'=>$arr_f8[6], 'c8'=>$arr_f8[7], 'c9'=>$arr_f8[8], 'c10'=>$arr_f8[9], 'c11'=>$arr_f8[10]),
	array('c1'=>$arr_f9[0], 'c2'=>$arr_f9[1], 'c3'=>$arr_f9[2], 'c4'=>$arr_f9[3], 'c5'=>$arr_f9[4], 'c6'=>$arr_f9[5], 'c7'=>$arr_f9[6], 'c8'=>$arr_f9[7], 'c9'=>$arr_f9[8], 'c10'=>$arr_f9[9], 'c11'=>$arr_f9[10])
);
$options = array('xPos'=>'left',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>540,
	'colGap' => 5,
	'shaded'=> 1,
	'showLines'=> 1,
	'fontSize' => 6,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'left','width'=>238),
		'c2'=>array('justification'=>'center','width'=>33),
		'c3'=>array('justification'=>'center','width'=>30),
		'c4'=>array('justification'=>'center','width'=>30),
		'c5'=>array('justification'=>'center','width'=>30),
		'c6'=>array('justification'=>'center','width'=>30),
		'c7'=>array('justification'=>'center','width'=>33),
		'c8'=>array('justification'=>'center','width'=>30),
		'c9'=>array('justification'=>'center','width'=>30),
		'c10'=>array('justification'=>'center','width'=>33),
		'c11'=>array('justification'=>'center','width'=>33)
	)
);
$pdf->ezTable($data, '','',$options);
/** -------------------------------------------------------------------- **/

$pdf->ezStream();
?>