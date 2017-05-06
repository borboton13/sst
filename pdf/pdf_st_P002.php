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
array('c1'=>'<b>CM/SCM:</b>',					'c2'=>$data_f['nom_centro'], 					'c3'=>'',				'c4'=>''),
array('c1'=>'<b>Nomb. Responsables:</b>',		'c2'=>$data_g['user1'].' , '.$data_g['user2'],	'c3'=>'<b>Fecha Mtto:</b>', 	'c4'=>date_format(date_create($data_f['inicio']), 'd/m/Y')),
array('c1'=>'<b>Departamento:</b>',			'c2'=>$data_f['depto'],							'c3'=>'', 				'c4'=>''),
array('c1'=>'<b>Nombre estación:</b>',		'c2'=>$data_f['nom_estacion'], 					'c3'=>'<b>ID estación:</b> ', 	'c4'=> $data_f['codigo'])
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
$pdf->ezText("\n",10);
/** -------------------------------------------------------------------- **/
$pdf->ezText("<b>1. Relevamiento</b>",10);
$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/
$pdf->ezText("<b>     Estructura 1</b>",10);
$data = array(
	array('c1'=>'Estado:',						'c2'=>$data_f['p01']),
	array('c1'=>'Tipo de estructura:',			'c2'=>$data_f['p02']),
	array('c1'=>'Altura de la estructura (m):',	'c2'=>$data_f['p03'])
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
$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/
$pdf->ezText("<b>     Estructura 2</b>",10);
$data = array(
	array('c1'=>'Estado:',						'c2'=>$data_f['p04']),
	array('c1'=>'Tipo de estructura:',			'c2'=>$data_f['p05']),
	array('c1'=>'Altura de la estructura (m):',	'c2'=>$data_f['p06'])
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
$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/
$pdf->ezText("\n",5);
$pdf->ezText("<b>2. Mantenimiento Preventivo</b>",10);
$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/
$data=array(array(	'h01'=>'No Existe',	'h02'=>'Malo',		'h03'=>'Bajo',		'h04'=>'Medio',		'h05'=>'Alto',
					'h06'=>'Bueno',		'h07'=>'Reparado',	'h08'=>'Ajustado',	'h09'=>'Cambiado',	'h10'=>'Pendiente'));
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
	'fontSize' => 7,
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

/** -------------------------------------------------------------------- **/

/** -------------------------------------------------------------------- **/

/** -------------------------------------------------------------------- **/

$pdf->ezStream();
?>