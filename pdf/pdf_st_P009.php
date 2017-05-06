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
$data = array(
	array('c1'=>'Tiene Rectificador:',	'c2'=>$data_f['p01']),
	array('c1'=>'Estado:',				'c2'=>$data_f['p02']),
	array('c1'=>'Marca:',				'c2'=>$data_f['p03']),
	array('c1'=>'Modelo:',				'c2'=>$data_f['p04']),
	array('c1'=>'Serie:',				'c2'=>$data_f['p05']),
	array('c1'=>'Voltaje (V):',			'c2'=>$data_f['p06']),
	array('c1'=>'Capacidad (KVA):',		'c2'=>$data_f['p07']),
	array('c1'=>'Cantidad de módulos:',	'c2'=>$data_f['p08'])
);
$options = array('xPos'=>'left',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>0,
	'colGap' => 5,
	'shaded'=> 0,
	'showLines'=> 0,
	'fontSize' => 10,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'right','width'=>200),
		'c2'=>array('justification'=>'left','width'=>350)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",10);
/** -------------------------------------------------------------------- **/
$pdf->ezText("<b>2. Mantenimiento Preventivo</b>",10);
$pdf->ezText("\n",10);
/** -------------------------------------------------------------------- **/
$data=array(array('izq'=>'ANTES MTTO.', 'der'=>'DESPUES MTTO.'));
$pdf->ezTable($data,'','',
	array('xPos'=>'242',
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
			'izq'=>array('justification'=>'center','width'=>151),
			'der'=>array('justification'=>'center','width'=>150),
		)
	));
/** -------------------------------------------------------------------- **/
$text_p09 = $data_f['p09'];
$arrays = explode('|', $text_p09);
$arr_f01 = explode(';', $arrays[0]);
$arr_f02 = explode(';', $arrays[1]);
$arr_f03 = explode(';', $arrays[2]);
$arr_f04 = explode(';', $arrays[3]);

$data = array(
	array('c1'=>'', 'c2'=>'Fase 1', 'c3'=>'Fase 2', 'c4'=>'Fase 3', 'c5'=>'Fase 1', 'c6'=>'Fase 2', 'c7'=>'Fase 3'),
	array('c1'=>$arr_f01[0], 'c2'=>$arr_f01[1], 'c3'=>$arr_f01[2], 'c4'=>$arr_f01[3], 'c5'=>$arr_f01[4], 'c6'=>$arr_f01[3], 'c7'=>$arr_f01[4]),
	array('c1'=>$arr_f02[0], 'c2'=>$arr_f02[1], 'c3'=>$arr_f02[2], 'c4'=>$arr_f02[3], 'c5'=>$arr_f02[4], 'c6'=>$arr_f02[3], 'c7'=>$arr_f02[4]),
	array('c1'=>$arr_f03[0], 'c2'=>$arr_f03[1], 'c3'=>$arr_f03[2], 'c4'=>$arr_f03[3], 'c5'=>$arr_f03[4], 'c6'=>$arr_f03[3], 'c7'=>$arr_f03[4]),
	array('c1'=>$arr_f04[0], 'c2'=>$arr_f04[1], 'c3'=>$arr_f04[2], 'c4'=>$arr_f04[3], 'c5'=>$arr_f04[4], 'c7'=>$arr_f04[3], 'c7'=>$arr_f04[4])
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
		'c1'=>array('justification'=>'center','width'=>200),
		'c2'=>array('justification'=>'center','width'=>50),
		'c3'=>array('justification'=>'center','width'=>50),
		'c4'=>array('justification'=>'center','width'=>50),
		'c5'=>array('justification'=>'center','width'=>50),
		'c6'=>array('justification'=>'center','width'=>50),
		'c7'=>array('justification'=>'center','width'=>50)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",10);
/** -------------------------------------------------------------------- **/
$data = array(
	array('c1'=>'Corriente DC hacia la carga técnica de la estación [A]:',			'c2'=>$data_f['p10']),
	array('c1'=>'Corriente DC hacia el banco de baterías de la estación [A]:',		'c2'=>$data_f['p11']),
	array('c1'=>'Configuración de Parametros:',										'c2'=>$data_f['p12']),
	array('c1'=>'Verificar y controlar la distribución de AC/DC en tableros:',		'c2'=>$data_f['p13']),
	array('c1'=>'Revisión de sobrecalentamiento del cableado en AC/DC:',			'c2'=>$data_f['p14']),
	array('c1'=>'Alarmas Activas:',													'c2'=>$data_f['p15'])
);
$options = array('xPos'=>'left',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>0,
	'colGap' => 5,
	'shaded'=> 0,
	'showLines'=> 0,
	'fontSize' => 10,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'right','width'=>300),
		'c2'=>array('justification'=>'left','width'=>250)
	)
);
$pdf->ezTable($data, '','',$options);
/** -------------------------------------------------------------------- **/

/** -------------------------------------------------------------------- **/

/** -------------------------------------------------------------------- **/

/** -------------------------------------------------------------------- **/

$pdf->ezStream();
?>