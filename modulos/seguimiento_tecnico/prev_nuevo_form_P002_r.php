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
$p06    = $_POST["p06"];

$size7    = $_POST["size7"];
$p07 = "";
for($i=1; $i < $size7; $i++ ){
    $p07 .= $_POST["p07$i"];
    if($i==11 || $i==22 || $i==33)
        $p07 .= '|';
    else{
        if($i<$size7-1)
            $p07 .= ';';
    }
}

/** Nuevo Formulario Mtto. **/
if(!isset($_POST['idformtto'])){

    $id = incrementar_id("formulario_p002", "id");
    $consulta = "INSERT INTO formulario_p002 SET
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
    p07       ='".$p07."'";

    $resultado = mysql_query($consulta);

    if($resultado) {
        header("Location: ".$link_modulo."?path=prev_estacion.php$params");
    }
    else echo "<b>Ocurrio un error, revise bien la informacion insertada!</b><br>Notrifiue de este error al administrador del Sistema: ".mysql_error()."<br><a href='javascript:history.back(1);'>[RETORNAR]</a>";

/** Editar Formulario Mtto. **/
}else{

    $idformtto = $_POST['idformtto'];
    $consulta =  "UPDATE formulario_p002 SET
                    titulo ='".$titulo."',
                    p01    ='".$p01."',
                    p02    ='".$p02."',
                    p03    ='".$p03."',
                    p04    ='".$p04."',
                    p05    ='".$p05."',
                    p06    ='".$p06."',
                    p07    ='".$p07."'
                  WHERE id = ".$idformtto."
                    ";
    $resultado=mysql_query($consulta);
    if($resultado) {
        header("Location: ".$link_modulo."?path=prev_estacion.php$params");
    }
    else echo "<b>Ocurrio un error, revise bien la información insertada!</b><br>Notrifiue de este error al administrador del Sistema: ".mysql_error()."<br><a href='javascript:history.back(1);'>[RETORNAR]</a>";
}

?>
