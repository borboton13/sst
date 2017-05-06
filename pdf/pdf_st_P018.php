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
$data = array(
	array('c1'=>'<b>FECHA:</b>',			'c2'=>date_format(date_create($data_f['inicio']), 'd/m/Y'),	'c3'=>'<b>CM/SCM:</b>',			'c4'=>$data_f['nom_centro']),
	array('c1'=>'<b>NODO:</b>',				'c2'=>$data_f['nom_estacion'], 								'c3'=>'<b>Hora Inicio:</b>',	'c4'=>$data_f['p01']),
	array('c1'=>'<b>PERSONAL DE MTTO.:</b>','c2'=>$data_g['user1'].' , '.$data_g['user2'],				'c3'=>'<b>Hora de conclusion:</b>','c4'=>$data_f['p02'])
);
$options = array('xPos'=>'left',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>480,
	'colGap' => 5,
	'shaded'=> 0,
	'showLines'=> 1,
	'fontSize' => 9,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'right','width'=>110),
		'c2'=>array('justification'=>'left','width'=>230),
		'c3'=>array('justification'=>'right','width'=>100),
		'c4'=>array('justification'=>'left','width'=>110)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/
$data=array(array('h01'=>'<b>LIMPIEZA, INSPECCION DE LA INFRAESTRUCTURA EXTERNA:</b>', 'h02'=>'S=SI   N=NO   N/A=NO APLICA'));
$pdf->ezTable($data,'','',
	array('xPos'=>'left',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>206,
		'colGap' => 5,
		'shaded'=> 1,
		'showLines'=> 0,
		'fontSize' => 8,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'h01'=>array('justification'=>'left','width'=>275),
			'h02'=>array('justification'=>'left','width'=>275)
		)));
$pdf->ezText("\n",2);
/** -------------------------------------------------------------------- **/
$data=array(array('h01'=>'N.ITEM', 'h02'=>'DESCRIPCION DEL ITEM', 'h03'=>'ESTADO DE CONSERVACION', 'h04'=>'DESPUES DE LA INTERVENCION', 'h05'=>'OBSERVACIONES'));
$pdf->ezTable($data,'','',
	array('xPos'=>'left',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>206,
		'colGap' => 5,
		'shaded'=> 1,
		'showLines'=> 1,
		'fontSize' => 6,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'h01'=>array('justification'=>'center','width'=>31),
			'h02'=>array('justification'=>'center','width'=>200),
			'h03'=>array('justification'=>'center','width'=>60),
			'h04'=>array('justification'=>'center','width'=>60),
			'h05'=>array('justification'=>'center','width'=>200)
		)
	));
/** -------------------------------------------------------------------- **/
$text_p03 = $data_f['p03'];
$arrays = explode('|', $text_p03);
$arr_f1 = explode(';', $arrays[0]);
$arr_f2 = explode(';', $arrays[1]);

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
	'fontSize' => 7,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'center','width'=>31),
		'c2'=>array('justification'=>'left','width'=>200),
		'c3'=>array('justification'=>'center','width'=>60),
		'c4'=>array('justification'=>'center','width'=>60),
		'c5'=>array('justification'=>'left','width'=>200)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/
$data=array(array('h01'=>'<b>INSPECCION DE LA INFRAESTRUCTURA INTERNA:</b>', 'h02'=>'B=BUENO   D=DEGRADADO   M=MALO   N/A=NO APLICA'));
$pdf->ezTable($data,'','',
	array('xPos'=>'left',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>206,
		'colGap' => 5,
		'shaded'=> 1,
		'showLines'=> 0,
		'fontSize' => 8,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'h01'=>array('justification'=>'left','width'=>275),
			'h02'=>array('justification'=>'left','width'=>275)
		)));
$pdf->ezText("\n",2);
/** -------------------------------------------------------------------- **/
$data=array(array('h01'=>'N.ITEM', 'h02'=>'DESCRIPCION DEL ITEM', 'h03'=>'ESTADO DE CONSERVACION', 'h04'=>'DESPUES DE LA INTERVENCION', 'h05'=>'OBSERVACIONES'));
$pdf->ezTable($data,'','',
	array('xPos'=>'left',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>206,
		'colGap' => 5,
		'shaded'=> 1,
		'showLines'=> 1,
		'fontSize' => 6,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'h01'=>array('justification'=>'center','width'=>31),
			'h02'=>array('justification'=>'center','width'=>201),
			'h03'=>array('justification'=>'center','width'=>60),
			'h04'=>array('justification'=>'center','width'=>60),
			'h05'=>array('justification'=>'center','width'=>200)
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
$arr_f6 = explode(';', $arrays[5]);
$arr_f7 = explode(';', $arrays[6]);

$data = array(
	array('c1'=>$arr_f1[0], 'c2'=>$arr_f1[1], 'c3'=>$arr_f1[2], 'c4'=>$arr_f1[3], 'c5'=>$arr_f1[4]),
	array('c1'=>$arr_f2[0], 'c2'=>$arr_f2[1], 'c3'=>$arr_f2[2], 'c4'=>$arr_f2[3], 'c5'=>$arr_f2[4]),
	array('c1'=>$arr_f3[0], 'c2'=>$arr_f3[1], 'c3'=>$arr_f3[2], 'c4'=>$arr_f3[3], 'c5'=>$arr_f3[4]),
	array('c1'=>$arr_f4[0], 'c2'=>$arr_f4[1], 'c3'=>$arr_f4[2], 'c4'=>$arr_f4[3], 'c5'=>$arr_f4[4]),
	array('c1'=>$arr_f5[0], 'c2'=>$arr_f5[1], 'c3'=>$arr_f5[2], 'c4'=>$arr_f5[3], 'c5'=>$arr_f5[4]),
	array('c1'=>$arr_f6[0], 'c2'=>$arr_f6[1], 'c3'=>$arr_f6[2], 'c4'=>$arr_f6[3], 'c5'=>$arr_f6[4]),
	array('c1'=>$arr_f7[0], 'c2'=>$arr_f7[1], 'c3'=>$arr_f7[2], 'c4'=>$arr_f7[3], 'c5'=>$arr_f7[4])
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
		'c1'=>array('justification'=>'center','width'=>31),
		'c2'=>array('justification'=>'left','width'=>201),
		'c3'=>array('justification'=>'center','width'=>60),
		'c4'=>array('justification'=>'center','width'=>60),
		'c5'=>array('justification'=>'left','width'=>200)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/
/** -------------------------------------------------------------------- **/
$data=array(array('h01'=>'', 'h02'=>'S=SI   N=NO   N/A=NO APLICA'));
$pdf->ezTable($data,'','',
	array('xPos'=>'left',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>206,
		'colGap' => 5,
		'shaded'=> 1,
		'showLines'=> 0,
		'fontSize' => 8,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'h01'=>array('justification'=>'left','width'=>275),
			'h02'=>array('justification'=>'left','width'=>275)
		)));
$pdf->ezText("\n",2);
/** -------------------------------------------------------------------- **/
$data=array(array('h01'=>'N.ITEM', 'h02'=>'DESCRIPCION DEL ITEM', 'h03'=>'ANTES DE LA INTERVENCION', 'h04'=>'DESPUES DE LA INTERVENCION', 'h05'=>'OBSERVACIONES'));
$pdf->ezTable($data,'','',
	array('xPos'=>'left',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>206,
		'colGap' => 5,
		'shaded'=> 1,
		'showLines'=> 1,
		'fontSize' => 6,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'h01'=>array('justification'=>'center','width'=>31),
			'h02'=>array('justification'=>'center','width'=>200),
			'h03'=>array('justification'=>'center','width'=>60),
			'h04'=>array('justification'=>'center','width'=>60),
			'h05'=>array('justification'=>'center','width'=>200)
		)
	));
/** -------------------------------------------------------------------- **/
$text_p05 = $data_f['p05'];
$arrays = explode('|', $text_p05);
$arr_f1 = explode(';', $arrays[0]);
$arr_f2 = explode(';', $arrays[1]);
$arr_f3 = explode(';', $arrays[2]);
$arr_f4 = explode(';', $arrays[3]);
$arr_f5 = explode(';', $arrays[4]);
$arr_f6 = explode(';', $arrays[5]);

$data = array(
	array('c1'=>$arr_f1[0], 'c2'=>$arr_f1[1], 'c3'=>$arr_f1[2], 'c4'=>$arr_f1[3], 'c5'=>$arr_f1[4]),
	array('c1'=>$arr_f2[0], 'c2'=>$arr_f2[1], 'c3'=>$arr_f2[2], 'c4'=>$arr_f2[3], 'c5'=>$arr_f2[4]),
	array('c1'=>$arr_f3[0], 'c2'=>$arr_f3[1], 'c3'=>$arr_f3[2], 'c4'=>$arr_f3[3], 'c5'=>$arr_f3[4]),
	array('c1'=>$arr_f4[0], 'c2'=>$arr_f4[1], 'c3'=>$arr_f4[2], 'c4'=>$arr_f4[3], 'c5'=>$arr_f4[4]),
	array('c1'=>$arr_f5[0], 'c2'=>$arr_f5[1], 'c3'=>$arr_f5[2], 'c4'=>$arr_f5[3], 'c5'=>$arr_f5[4]),
	array('c1'=>$arr_f6[0], 'c2'=>$arr_f6[1], 'c3'=>$arr_f6[2], 'c4'=>$arr_f6[3], 'c5'=>$arr_f6[4])
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
		'c1'=>array('justification'=>'center','width'=>31),
		'c2'=>array('justification'=>'left','width'=>200),
		'c3'=>array('justification'=>'center','width'=>60),
		'c4'=>array('justification'=>'center','width'=>60),
		'c5'=>array('justification'=>'left','width'=>200)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",10);
/** -------------------------------------------------------------------- **/
$pdf->ezText("<b>MEDICION DE PARAMETROS:</b>",9);
$pdf->ezText("\n",3);
$pdf->ezText("<b>TARJETAS,EQUIPOS Y MODULOS INSTALADOS:</b>",8);
$pdf->ezText("\n",2);
/** -------------------------------------------------------------------- **/
$data=array(array('h01'=>'N.ITEM', 'h02'=>'DESCRIPCION', 'h03'=>'OBSERVACIONES'));
$pdf->ezTable($data,'','',
	array('xPos'=>'left',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>206,
		'colGap' => 5,
		'shaded'=> 1,
		'showLines'=> 1,
		'fontSize' => 6,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'h01'=>array('justification'=>'center','width'=>31),
			'h02'=>array('justification'=>'center','width'=>200),
			'h03'=>array('justification'=>'center','width'=>320)
		)
	));
/** -------------------------------------------------------------------- **/
$text_p06 = $data_f['p06'];
$arrays = explode('|', $text_p06);
$arr_f1 = explode(';', $arrays[0]);
$arr_f2 = explode(';', $arrays[1]);
$arr_f3 = explode(';', $arrays[2]);
$arr_f4 = explode(';', $arrays[3]);

$data = array(
	array('c1'=>$arr_f1[0], 'c2'=>$arr_f1[1], 'c3'=>$arr_f1[2]),
	array('c1'=>$arr_f2[0], 'c2'=>$arr_f2[1], 'c3'=>$arr_f2[2]),
	array('c1'=>$arr_f3[0], 'c2'=>$arr_f3[1], 'c3'=>$arr_f3[2]),
	array('c1'=>$arr_f4[0], 'c2'=>$arr_f4[1], 'c3'=>$arr_f4[2]),
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
		'c1'=>array('justification'=>'left','width'=>31),
		'c2'=>array('justification'=>'left','width'=>200),
		'c3'=>array('justification'=>'left','width'=>320)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/


$pdf->ezText("<b>REQUERIMIENTOS PENDIENTES:</b>",8);
$pdf->ezText("\n",2);
/** -------------------------------------------------------------------- **/
$data=array(array('h01'=>'N.ITEM', 'h02'=>'DESCRIPCION', 'h03'=>'OBSERVACIONES'));
$pdf->ezTable($data,'','',
	array('xPos'=>'left',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>206,
		'colGap' => 5,
		'shaded'=> 1,
		'showLines'=> 1,
		'fontSize' => 6,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'h01'=>array('justification'=>'center','width'=>31),
			'h02'=>array('justification'=>'center','width'=>200),
			'h03'=>array('justification'=>'center','width'=>320)
		)
	));
/** -------------------------------------------------------------------- **/
$text_p07 = $data_f['p07'];
$arrays = explode('|', $text_p07);
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
	'fontSize' => 7,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'left','width'=>31),
		'c2'=>array('justification'=>'left','width'=>200),
		'c3'=>array('justification'=>'left','width'=>320)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/
$pdf->ezText("<b>NOTA:</b> A LA CONCLUSION DEL TRABAJO, EL PERSONAL DE MANTENIMIENTO DEBE CONTACTARSE CON EL CENTRO DE GESTION, PARA VERIFICAR EL CORRECTO FUNCIONAMIENTO DEL NODO",7);
$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/
$data = array(
	array('c1'=>'<b>CRITICIDADES:</b>',			'c2'=>$data_f['p08']),
	array('c1'=>'<b>TRABAJOS PENDIENTES:</b>',	'c2'=>$data_f['p09'])
);
$options = array('xPos'=>'left',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>480,
	'colGap' => 5,
	'shaded'=> 1,
	'showLines'=> 1,
	'fontSize' => 7,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'right','width'=>100),
		'c2'=>array('justification'=>'left','width'=>450)
	)
);
$pdf->ezTable($data, '','',$options);
/** -------------------------------------------------------------------- **/
$pdf->ezStream();
?>