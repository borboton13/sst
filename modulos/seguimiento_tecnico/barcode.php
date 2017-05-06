<?php
// ==============================================
// Output Image using Code 39 using only default values
// ==============================================
$cod=$_GET['cod'];
require_once ('../../paquetes/jpgraph/jpgraph.php');
require_once ('../../paquetes/jpgraph/jpgraph_canvas.php');
require_once ('../../paquetes/jpgraph/jpgraph_barcode.php');

$encoder = BarcodeFactory::Create(ENCODING_CODE39);
$e = BackendFactory::Create(BACKEND_IMAGE,$encoder);
$e ->HideText(true);
$e -> SetHeight(56);
$e->Stroke($cod);

?>