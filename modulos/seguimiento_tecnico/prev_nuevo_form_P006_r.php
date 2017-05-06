<?php
require("../../funciones/funciones.php");

$idevento     = $_POST["idevento"];
$idformulario = $_POST["idformulario"];
$titulo       = $_POST["titulo"];
$params       = $_POST["params"];

$p01    = $_POST["p01"];
$p02    = $_POST["p02"];

$size3    = $_POST["size3"];
$p03 = "";
for($i=1; $i < $size3; $i++ ){
    $p03 .= $_POST["p03$i"];
    if($i<$size3-1)
        $p03 .= ';';
}

$size4    = $_POST["size4"];
$p04 = "";
for($i=1; $i < $size4; $i++ ){
    $p04 .= $_POST["p04$i"];
    if($i==4||$i==8||$i==12||$i==16)
        $p04 .= '|';
    else{
        if($i<$size4-1)
            $p04 .= ';';
    }
}

$size5    = $_POST["size5"];
$p05 = "";
for($i=1; $i < $size5; $i++ ){
    $p05 .= $_POST["p05$i"];
    if($i==8)
        $p05 .= '|';
    else{
        if($i<$size5-1)
            $p05 .= ';';
    }
}

$size6    = $_POST["size6"];
$p06 = "";
for($i=1; $i < $size6; $i++ ){
    $p06 .= $_POST["p06$i"];
    if($i==7||$i==14||$i==21||$i==28)
        $p06 .= '|';
    else{
        if($i<$size6-1)
            $p06 .= ';';
    }
}

$p06_1    = $_POST["p06_1"];

$size7    = $_POST["size7"];
$p07 = "";
for($i=1; $i < $size7; $i++ ){
    $p07 .= $_POST["p07$i"];
    if($i==5||$i==10||$i==15||$i==20||$i==25||$i==30||$i==35||$i==40||$i==45||$i==50||$i==55||$i==60||$i==65||$i==70||$i==75||$i==80||$i==85||$i==90||$i==95||$i==100||$i==105)
        $p07 .= '|';
    else{
        if($i<$size7-1)
            $p07 .= ';';
    }
}

$size8    = $_POST["size8"];
$p08 = "";
for($i=1; $i < $size8; $i++ ){
    $p08 .= $_POST["p08$i"];
    if($i==12||$i==24||$i==36||$i==48||$i==60||$i==72||$i==84)
        $p08 .= '|';
    else{
        if($i<$size8-1)
            $p08 .= ';';
    }
}

$size9    = $_POST["size9"];
$p09 = "";
for($i=1; $i < $size9; $i++ ){
    $p09 .= $_POST["p09$i"];
    if($i==12||$i==24||$i==36)
        $p09 .= '|';
    else{
        if($i<$size9-1)
            $p09 .= ';';
    }
}

$size10    = $_POST["size10"];
$p10 = "";
for($i=1; $i < $size10; $i++ ){
    $p10 .= $_POST["p10$i"];
    if($i==12||$i==24||$i==36||$i==48)
        $p10 .= '|';
    else{
        if($i<$size10-1)
            $p10 .= ';';
    }
}

$size11    = $_POST["size11"];
$p11 = "";
for($i=1; $i < $size11; $i++ ){
    $p11 .= $_POST["p11$i"];
    if($i==4)
        $p11 .= '|';
    else{
        if($i<$size11-1)
            $p11 .= ';';
    }
}

$p12    = $_POST["p12"];
$p13    = $_POST["p13"];

$size14    = $_POST["size14"];
$p14 = "";
for($i=1; $i < $size14; $i++ ){
    $p14 .= $_POST["p14$i"];
    if($i==13||$i==26)
        $p14 .= '|';
    else{
        if($i<$size14-1)
            $p14 .= ';';
    }
}

$size15    = $_POST["size15"];
$p15 = "";
for($i=1; $i < $size15; $i++ ){
    $p15 .= $_POST["p15$i"];
    if($i==2||$i==4)
        $p15 .= '|';
    else{
        if($i<$size15-1)
            $p15 .= ';';
    }
}

/** Nuevo Formulario Mtto. **/
if(!isset($_POST['idformtto'])){

    $id = incrementar_id("formulario_p006", "id");
    $consulta = "INSERT INTO formulario_p006 SET
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
    p06_1       ='".$p06_1."',
    p07       ='".$p07."',
    p08       ='".$p08."',
    p09       ='".$p09."',
    p10       ='".$p10."',
    p11       ='".$p11."',
    p12       ='".$p12."',
    p13       ='".$p13."',
    p14       ='".$p14."',
    p15       ='".$p15."'";

    $resultado = mysql_query($consulta);

    if($resultado) {
        header("Location: ".$link_modulo."?path=prev_estacion.php$params");
    }
    else echo "<b>Ocurrio un error, revise bien la informacion insertada!</b><br>Notrifiue de este error al administrador del Sistema: ".mysql_error()."<br><a href='javascript:history.back(1);'>[RETORNAR]</a>";

/** Editar Formulario Mtto. **/
}else{

    $idformtto = $_POST['idformtto'];
    $consulta =  "UPDATE formulario_p006 SET
                    titulo ='".$titulo."',
                    p01       ='".$p01."',
                    p02       ='".$p02."',
                    p03       ='".$p03."',
                    p04       ='".$p04."',
                    p05       ='".$p05."',
                    p06       ='".$p06."',
                    p06_1     ='".$p06_1."',
                    p07       ='".$p07."',
                    p08       ='".$p08."',
                    p09       ='".$p09."',
                    p10       ='".$p10."',
                    p11       ='".$p11."',
                    p12       ='".$p12."',
                    p13       ='".$p13."',
                    p14       ='".$p14."',
                    p15       ='".$p15."'
                  WHERE id = ".$idformtto."
                    ";
    $resultado=mysql_query($consulta);
    if($resultado) {
        header("Location: ".$link_modulo."?path=prev_estacion.php$params");
    }
    else echo "<b>Ocurrio un error, revise bien la información insertada!</b><br>Notrifiue de este error al administrador del Sistema: ".mysql_error()."<br><a href='javascript:history.back(1);'>[RETORNAR]</a>";
}

?>
