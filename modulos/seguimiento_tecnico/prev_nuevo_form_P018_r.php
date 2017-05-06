<?php
require("../../funciones/funciones.php");

$idevento     = $_POST["idevento"];
$idformulario = $_POST["idformulario"];
$titulo       = $_POST["titulo"];
$params       = $_POST["params"];

$p01 = $_POST["p01"];
$p02 = $_POST["p02"];

$p03 = "";
$size3    = $_POST["size3"];
for($i=1; $i < $size3; $i++ ){
    $p03 .= $_POST["p03$i"];
    if($i==5)
        $p03 .= '|';
    else{
        if($i<$size3-1)
            $p03 .= ';';
    }
}

$p04 = "";
$size4    = $_POST["size4"];
for($i=1; $i < $size4; $i++ ){
    $p04 .= $_POST["p04$i"];
    if($i==5 || $i==10 || $i==15 || $i==20 || $i==25 || $i==30)
        $p04 .= '|';
    else{
        if($i<$size4-1)
            $p04 .= ';';
    }
}


$p05 = "";
$size5    = $_POST["size5"];
for($i=1; $i < $size5; $i++ ){
    $p05 .= $_POST["p05$i"];
    if($i==5 || $i==10 || $i==15 || $i==20 || $i==25)
        $p05 .= '|';
    else{
        if($i<$size5-1)
            $p05 .= ';';
    }
}

$p06 = "";
$size6    = $_POST["size6"];
for($i=1; $i < $size6; $i++ ){
    $p06 .= $_POST["p06$i"];
    if($i==3 || $i==6 || $i==9)
        $p06 .= '|';
    else{
        if($i<$size6-1)
            $p06 .= ';';
    }
}

$p07 = "";
$size7    = $_POST["size7"];
for($i=1; $i < $size7; $i++ ){
    $p07 .= $_POST["p07$i"];
    if($i==3 || $i==6)
        $p07 .= '|';
    else{
        if($i<$size7-1)
            $p07 .= ';';
    }
}

$p08 = $_POST["p08"];
$p09 = $_POST["p09"];

/** Nuevo Formulario Mtto. **/
if(!isset($_POST['idformtto'])){

    $id = incrementar_id("formulario_p018", "id");
    $consulta = "INSERT INTO formulario_p018 SET
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
    p09       ='".$p09."'";

    $resultado = mysql_query($consulta);

    if($resultado) {
        header("Location: ".$link_modulo."?path=prev_estacion.php$params");
    }
    else echo "<b>Ocurrio un error, revise bien la informacion insertada!</b><br>Notrifiue de este error al administrador del Sistema: ".mysql_error()."<br><a href='javascript:history.back(1);'>[RETORNAR]</a>";

/** Editar Formulario Mtto. **/
}else{

    $idformtto = $_POST['idformtto'];
    $consulta =  "UPDATE formulario_p018 SET
                    titulo ='".$titulo."',
                    p01       ='".$p01."',
                    p02       ='".$p02."',
                    p03       ='".$p03."',
                    p04       ='".$p04."',
                    p05       ='".$p05."',
                    p06       ='".$p06."',
                    p07       ='".$p07."',
                    p08       ='".$p08."',
                    p09       ='".$p09."'
                  WHERE id = ".$idformtto."
                    ";
    $resultado=mysql_query($consulta);
    if($resultado) {
        header("Location: ".$link_modulo."?path=prev_estacion.php$params");
    }
    else echo "<b>Ocurrio un error, revise bien la información insertada!</b><br>Notrifiue de este error al administrador del Sistema: ".mysql_error()."<br><a href='javascript:history.back(1);'>[RETORNAR]</a>";
}
?>