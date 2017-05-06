<?php
require("../../funciones/funciones.php");

$idevento     = $_POST["idevento"];
$idformulario = $_POST["idformulario"];
$titulo       = $_POST["titulo"];
$params       = $_POST["params"];
$p01    = $_POST["p01"];
$p02    = $_POST["p02"];
$p03    = $_POST["p03"];
$p04    = $_POST["p04"];
$p05    = $_POST["p05"];

$size6    = $_POST["size6"];
$p06 = "";
for($i=1; $i < $size6; $i++ ){
    $p06 .= $_POST["p06$i"];
    if($i==6 || $i==12 || $i==18 || $i==24)
        $p06 .= '|';
    else{
        if($i<$size6-1)
            $p06 .= ';';
    }
}

$size7    = $_POST["size7"];
$p07 = "";
for($i=1; $i < $size7; $i++ ){
    $p07 .= $_POST["p07$i"];
    if($i==11)
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
    if($i==11 || $i==22 || $i==33  || $i==44  || $i==55  || $i==66  || $i==77  || $i==88
              || $i==99 || $i==110 || $i==121 || $i==132 || $i==143 || $i==154 || $i==165 )
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
    if($i==11 || $i==22 || $i==33)
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
    if($i==11 || $i==22 || $i==33  || $i==44  || $i==55  || $i==66  || $i==77  || $i==88)
        $p10 .= '|';
    else{
        if($i<$size10-1)
            $p10 .= ';';
    }
}

/** Nuevo Formulario Mtto. **/
if(!isset($_POST['idformtto'])){

    $id = incrementar_id("formulario_p001", "id");
    $consulta = "INSERT INTO formulario_p001 SET
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
    p10       ='".$p10."'";

    $resultado = mysql_query($consulta);

    if($resultado) {
        header("Location: ".$link_modulo."?path=prev_estacion.php$params");
    }
    else echo "<b>Ocurrio un error, revise bien la informacion insertada!</b><br>Notrifiue de este error al administrador del Sistema: ".mysql_error()."<br><a href='javascript:history.back(1);'>[RETORNAR]</a>";

/** Editar Formulario Mtto. **/
}else{
    //print("Post editar: " . $_POST['idformtto']);
    $idformtto = $_POST['idformtto'];
    $consulta =  "UPDATE formulario_p001 SET
                    titulo ='".$titulo."',
                    p01    ='".$p01."',
                    p02    ='".$p02."',
                    p03    ='".$p03."',
                    p04    ='".$p04."',
                    p05    ='".$p05."',
                    p06    ='".$p06."',
                    p07    ='".$p07."',
                    p08    ='".$p08."',
                    p09    ='".$p09."',
                    p10    ='".$p10."'
                  WHERE id = ".$idformtto."
                    ";
    $resultado=mysql_query($consulta);
    if($resultado) {
        header("Location: ".$link_modulo."?path=prev_estacion.php$params");
    }
    else echo "<b>Ocurrio un error, revise bien la información insertada!</b><br>Notrifiue de este error al administrador del Sistema: ".mysql_error()."<br><a href='javascript:history.back(1);'>[RETORNAR]</a>";

}
?>
