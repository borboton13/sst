<?php
require("../../funciones/motor.php");

$output = '';
session_start();

if( !isset($_SESSION['tickets'])){
    $_SESSION['tickets'] = array();
}


if (isset($_GET["id_st_ticket"]) && isset($_GET["id_f001"])){

    $id_st_ticket = $_GET["id_st_ticket"];
    $id_f001 = $_GET["id_f001"];

    if ($id_st_ticket > 0){
        $_SESSION['tickets'][] = $id_st_ticket;
        $res = mysql_query("insert into st_ticket_f001 (id_st_ticket, id_f001) values (".$id_st_ticket.",".$id_f001.")");
    }else{
        $_SESSION['tickets'] = array();
        $res = mysql_query("delete from st_ticket_f001 where id_f001 = ".$id_f001);
    }

}

for($i=0;$i<count($_SESSION['tickets']);$i++){
    $id = $_SESSION['tickets'][$i];
    $result = mysql_query("select id_st_ticket, ticket, estacion, fecha_inicio_rif FROM st_ticket where id_st_ticket = " . $id);
    $row    = mysql_fetch_array($result);
    $output .= '<p>'.$row['fecha_inicio_rif'].' - '.$row['ticket'].' - '.$row['estacion'].'</p>';
}


echo $output;

?>