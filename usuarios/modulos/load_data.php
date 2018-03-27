<?php
require("../../funciones/motor.php");

$output = '';
session_start();

if( !isset($_SESSION['estaciones'])){
    $_SESSION['estaciones'] = array();
}


if (isset($_GET["estacionId"])){

    $estacionId = $_GET["estacionId"];

    if ($estacionId > 0){
        $_SESSION['estaciones'][] = $estacionId;
    }else{
        $_SESSION['estaciones'] = array();
    }

}

for($i=0;$i<count($_SESSION['estaciones']);$i++){
    $id = $_SESSION['estaciones'][$i];
    $result = mysql_query("select codigo, nombre, provicia FROM estacion where idestacion = " . $id);
    $row    = mysql_fetch_array($result);
    $output .= '<div>'.$row['codigo'].' - '.$row['nombre'].' - '.$row['provicia']. ' - '. count($_SESSION["estaciones"]).'</div>';
}

echo $output;
?>