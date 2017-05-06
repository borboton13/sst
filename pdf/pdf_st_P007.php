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
/*$data = array(
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
				'fontSize' => 10,
				'lineCol' => array(0.48,0.48,0.48),
				'cols'=>array(
				'c1'=>array('justification'=>'right','width'=>120),
				'c2'=>array('justification'=>'left','width'=>250),
				'c3'=>array('justification'=>'right','width'=>70),
				'c4'=>array('justification'=>'left','width'=>100)
				)
            );
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",10);*/
/** -------------------------------------------------------------------- **/
$pdf->ezText("<b>1. Relevamiento</b>",10);
$pdf->ezText("\n",1);
/** -------------------------------------------------------------------- **/
$data = array(
	array('c1'=>'Tiene Banco de Baterias:',	'c2'=>$data_f['p01']),
	array('c1'=>'Estado:',					'c2'=>$data_f['p02']),
	array('c1'=>'Marca:',					'c2'=>$data_f['p03']),
	array('c1'=>'Modelo:',					'c2'=>$data_f['p04']),
	array('c1'=>'Voltaje (V):',				'c2'=>$data_f['p05']),
	array('c1'=>'Capacidad (Ah):',			'c2'=>$data_f['p06']),
	array('c1'=>'Cantidad:',				'c2'=>$data_f['p07']),
	array('c1'=>'Autonomia Real:',			'c2'=>$data_f['p08']),
	array('c1'=>'Tiene gabinete propio:',	'c2'=>$data_f['p09'])
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
$pdf->ezText("<b>2. Mantenimiento Preventivo</b>",10);
$pdf->ezText("\n",3);
/** -------------------------------------------------------------------- **/
$text_p10 = $data_f['p10'];
$arrays = explode('|', $text_p10);
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
$arr_f23 = explode(';', $arrays[22]);
$arr_f24 = explode(';', $arrays[23]);
$arr_f25 = explode(';', $arrays[24]);
$arr_f26 = explode(';', $arrays[25]);
$arr_f27 = explode(';', $arrays[26]);
$arr_f28 = explode(';', $arrays[27]);
$arr_f29 = explode(';', $arrays[28]);
$arr_f30 = explode(';', $arrays[29]);
$arr_f31 = explode(';', $arrays[30]);


$data = array(
	array('c1'=>'No. Celda', 'c2'=>'Voltaje Descarga[V]', 'c3'=>'Temperatura[°C]', 'c4'=>'Densidad [Baumes]', 'c5'=>'Tiempo de descarga y/o observaciones'),
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
	array('c1'=>$arr_f12[0], 'c2'=>$arr_f12[1], 'c3'=>$arr_f12[2], 'c4'=>$arr_f12[3], 'c5'=>$arr_f12[4]),
	array('c1'=>$arr_f13[0], 'c2'=>$arr_f13[1], 'c3'=>$arr_f13[2], 'c4'=>$arr_f13[3], 'c5'=>$arr_f13[4]),
	array('c1'=>$arr_f14[0], 'c2'=>$arr_f14[1], 'c3'=>$arr_f14[2], 'c4'=>$arr_f14[3], 'c5'=>$arr_f14[4]),
	array('c1'=>$arr_f15[0], 'c2'=>$arr_f15[1], 'c3'=>$arr_f15[2], 'c4'=>$arr_f15[3], 'c5'=>$arr_f15[4]),
	array('c1'=>$arr_f16[0], 'c2'=>$arr_f16[1], 'c3'=>$arr_f16[2], 'c4'=>$arr_f16[3], 'c5'=>$arr_f16[4]),
	array('c1'=>$arr_f17[0], 'c2'=>$arr_f17[1], 'c3'=>$arr_f17[2], 'c4'=>$arr_f17[3], 'c5'=>$arr_f17[4]),
	array('c1'=>$arr_f18[0], 'c2'=>$arr_f18[1], 'c3'=>$arr_f18[2], 'c4'=>$arr_f18[3], 'c5'=>$arr_f18[4]),
	array('c1'=>$arr_f19[0], 'c2'=>$arr_f19[1], 'c3'=>$arr_f19[2], 'c4'=>$arr_f19[3], 'c5'=>$arr_f19[4]),
	array('c1'=>$arr_f20[0], 'c2'=>$arr_f20[1], 'c3'=>$arr_f20[2], 'c4'=>$arr_f20[3], 'c5'=>$arr_f20[4]),
	array('c1'=>$arr_f21[0], 'c2'=>$arr_f21[1], 'c3'=>$arr_f21[2], 'c4'=>$arr_f21[3], 'c5'=>$arr_f21[4]),
	array('c1'=>$arr_f22[0], 'c2'=>$arr_f22[1], 'c3'=>$arr_f22[2], 'c4'=>$arr_f22[3], 'c5'=>$arr_f22[4]),
	array('c1'=>$arr_f23[0], 'c2'=>$arr_f23[1], 'c3'=>$arr_f23[2], 'c4'=>$arr_f23[3], 'c5'=>$arr_f23[4]),
	array('c1'=>$arr_f24[0], 'c2'=>$arr_f24[1], 'c3'=>$arr_f24[2], 'c4'=>$arr_f24[3], 'c5'=>$arr_f24[4]),
	array('c1'=>$arr_f25[0], 'c2'=>$arr_f25[1], 'c3'=>$arr_f25[2], 'c4'=>$arr_f25[3], 'c5'=>$arr_f25[4]),
	array('c1'=>$arr_f26[0], 'c2'=>$arr_f26[1], 'c3'=>$arr_f26[2], 'c4'=>$arr_f26[3], 'c5'=>$arr_f26[4]),
	array('c1'=>$arr_f27[0], 'c2'=>$arr_f27[1], 'c3'=>$arr_f27[2], 'c4'=>$arr_f27[3], 'c5'=>$arr_f27[4]),
	array('c1'=>$arr_f28[0], 'c2'=>$arr_f28[1], 'c3'=>$arr_f28[2], 'c4'=>$arr_f28[3], 'c5'=>$arr_f28[4]),
	array('c1'=>$arr_f29[0], 'c2'=>$arr_f29[1], 'c3'=>$arr_f29[2], 'c4'=>$arr_f29[3], 'c5'=>$arr_f29[4]),
	array('c1'=>$arr_f30[0], 'c2'=>$arr_f30[1], 'c3'=>$arr_f30[2], 'c4'=>$arr_f30[3], 'c5'=>$arr_f30[4]),
	array('c1'=>$arr_f31[0], 'c2'=>$arr_f31[1], 'c3'=>$arr_f31[2], 'c4'=>$arr_f31[3], 'c5'=>$arr_f31[4])
);
$options = array('xPos'=>'left',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>550,
	'colGap' => 5,
	'shaded'=> 1,
	'showLines'=> 1,
	'fontSize' => 8,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'center','width'=>50),
		'c2'=>array('justification'=>'center','width'=>100),
		'c3'=>array('justification'=>'center','width'=>100),
		'c4'=>array('justification'=>'center','width'=>100),
		'c5'=>array('justification'=>'center','width'=>200)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/
$data = array(
	array('c1'=>'Verificar conexiones en bornes (ajustados):',				'c2'=>$data_f['p11']),
	array('c1'=>'Verificar limpieza de los Bornes:',						'c2'=>$data_f['p12']),
	array('c1'=>'Verificar nivel de Agua Destilada:',						'c2'=>$data_f['p13']),
	array('c1'=>'Porcentaje de carga  Banco de Baterias en Servicio (%):',	'c2'=>$data_f['p14'])
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
		'c1'=>array('justification'=>'right','width'=>240),
		'c2'=>array('justification'=>'left','width'=>310)
	)
);
$pdf->ezTable($data, '','',$options);
/** -------------------------------------------------------------------- **/

/** -------------------------------------------------------------------- **/

/** -------------------------------------------------------------------- **/

/** -------------------------------------------------------------------- **/

$pdf->ezStream();
?>