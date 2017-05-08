<?php
//require("../funciones/motor.php");
//$nro = base64_decode($_GET["nro"]);

$idcentro    = $_POST["idcentro"];
$codigoForm  = $_POST["codigoForm"];
$fechainicio = $_POST["fechainicio"];
$fechafin    = $_POST["fechafin"];

switch ($codigoForm){
    case 'P001':
        include 'report/report_P001.php';
        break;
    case 'P002':
        include 'report/report_P002.php';
        break;
    case 'P003':
        include 'report/report_P003.php';
        break;
    case 'P004':
        include 'report/report_P004.php';
        break;
    case 'P005':
        include 'report/report_P005.php';
        break;
    case 'P006':
        include 'report/report_P006.php';
        break;
    case 'P007':
        include 'report/report_P007.php';
        break;
    case 'P008':
        include 'report/report_P008.php';
        break;
    case 'P009':
        include 'report/report_P009.php';
        break;
    case 'P010':
        include 'report/report_P010.php';
        break;
    case 'P011':
        include 'report/report_P011.php';
        break;
}

?>