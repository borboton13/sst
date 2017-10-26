<?php
require("../../funciones/funciones.php");

$idevento     = $_POST["idevento"];
$idformulario = $_POST["idformulario"];
$titulo       = $_POST["titulo"];
$params       = $_POST["params"];

$p01 = $_POST["p01"];
$p02 = $_POST["p02"];
$p03 = $_POST["p03"];
$p04 = $_POST["p04"];
$p05 = $_POST["p05"];
$p06 = $_POST["p06"];
$p07 = $_POST["p07"];
$p08 = $_POST["p08"];
$p09 = $_POST["p09"];
$p10 = $_POST["p10"];
$p11 = $_POST["p11"];
$p12 = $_POST["p12"];

$p13 = "";
$size13    = $_POST["size13"];
for($i=1; $i < $size13; $i++ ){
    $p13 .= $_POST["p13$i"];
    if($i==3 || $i==6 || $i==9 || $i==12)
        $p13 .= '|';
    else{
        if($i<$size13-1)
            $p13 .= ';';
    }
}

$p14 = "";
$size14    = $_POST["size14"];
for($i=1; $i < $size14; $i++ ){
    $p14 .= $_POST["p14$i"];
    if($i==4||$i==8||$i==12||$i==16)
        $p14 .= '|';
    else{
        if($i<$size14-1)
            $p14 .= ';';
    }
}

$p15 = "";
$size15    = $_POST["size15"];
for($i=1; $i < $size15; $i++ ){
    $p15 .= $_POST["p15$i"];
    if($i==3||$i==6||$i==9||$i==12||$i==15||$i==18||$i==21||$i==24||$i==27||$i==30||$i==33)
        $p15 .= '|';
    else{
        if($i<$size15-1)
            $p15 .= ';';
    }
}

$p16 = "";
$size16    = $_POST["size16"];
for($i=1; $i < $size16; $i++ ){
    $p16 .= $_POST["p16$i"];
    if($i==6||$i==12||$i==18||$i==24)
        $p16 .= '|';
    else{
        if($i<$size16-1)
            $p16 .= ';';
    }
}

$p17 = "";
$size17    = $_POST["size17"];
for($i=1; $i < $size17; $i++ ){
    $p17 .= $_POST["p17$i"];
    if($i==14||$i==28||$i==42||$i==56||$i==70||$i==84||$i==98||$i==112||$i==126||$i==140||$i==154||$i==168||$i==182||$i==196)
        $p17 .= '|';
    else{
        if($i<$size17-1)
            $p17 .= ';';
    }
}

$p18 = "";
$size18    = $_POST["size18"];
for($i=1; $i < $size18; $i++ ){
    $p18 .= $_POST["p18$i"];
    if($i==3||$i==6||$i==9||$i==12||$i==15||$i==18)
        $p18 .= '|';
    else{
        if($i<$size18-1)
            $p18 .= ';';
    }
}

/** Nuevo Formulario Mtto. **/
if(!isset($_POST['idformtto'])){

    $id = incrementar_id("formulario_p013", "id");
    $consulta = "INSERT INTO formulario_p013 SET
    id           ='".$id."',
    idevento     ='".$idevento."',
    idformulario ='".$idformulario."',
    titulo ='".$titulo."',
    p01       ='".$p01."',
    p02       ='".$p02."',
    p03       ='".$p03."',
    p04       ='".$p04."',
    p05       ='".$p05."',
    p06       ='".$p06."',
    p07       ='".$p07."',
    p08       ='".$p08."',
    p09       ='".$p09."',
    p10       ='".$p10."',
    p11       ='".$p11."',
    p12       ='".$p12."',
    p13       ='".$p13."',
    p14       ='".$p14."',
    p15       ='".$p15."',
    p16       ='".$p16."',
    p17       ='".$p17."',
    p18       ='".$p18."'";

    $resultado = mysql_query($consulta);

    if($resultado) {
        header("Location: ".$link_modulo."?path=prev_estacion.php$params");
    }
    else echo "<b>Ocurrio un error, revise bien la informacion insertada!</b><br>Notrifiue de este error al administrador del Sistema: ".mysql_error()."<br><a href='javascript:history.back(1);'>[RETORNAR]</a>";

/** Editar Formulario Mtto. **/
}else{

    $idformtto = $_POST['idformtto'];
    $consulta =  "UPDATE formulario_p013 SET
                    titulo ='".$titulo."',
                    p01       ='".$p01."',
                    p02       ='".$p02."',
                    p03       ='".$p03."',
                    p04       ='".$p04."',
                    p05       ='".$p05."',
                    p06       ='".$p06."',
                    p07       ='".$p07."',
                    p08       ='".$p08."',
                    p09       ='".$p09."',
                    p10       ='".$p10."',
                    p11       ='".$p11."',
                    p12       ='".$p12."',
                    p13       ='".$p13."',
                    p14       ='".$p14."',
                    p15       ='".$p15."',
                    p16       ='".$p16."',
                    p17       ='".$p17."',
                    p18       ='".$p18."'
                  WHERE id = ".$idformtto."
                    ";
    $resultado=mysql_query($consulta);
    if($resultado) {
        header("Location: ".$link_modulo."?path=prev_estacion.php$params");
    }
    else echo "<b>Ocurrio un error, revise bien la información insertada!</b><br>Notrifiue de este error al administrador del Sistema: ".mysql_error()."<br><a href='javascript:history.back(1);'>[RETORNAR]</a>";
}

?>