<?php
require("../../funciones/funciones.php");

$idevento     = $_POST["idevento"];
$idformulario = $_POST["idformulario"];
$titulo       = $_POST["titulo"];
$params       = $_POST["params"];

$size1    = $_POST["size1"];
$p01 = "";
for($i=1; $i < $size1; $i++ ){
    $p01 .= $_POST["p01$i"];
    if($i==3 || $i==6 || $i==9 || $i==12 || $i==15 || $i==18 || $i==21)
        $p01 .= '|';
    else{
        if($i<$size1-1)
            $p01 .= ';';
    }
}

$size2    = $_POST["size2"];
$p02 = "";
for($i=1; $i < $size2; $i++ ){
    $p02 .= $_POST["p02$i"];
    if($i==9 || $i==18 || $i==27 || $i==36 || $i==45 || $i==54)
        $p02 .= '|';
    else{
        if($i<$size2-1)
            $p02 .= ';';
    }
}

/** Nuevo Formulario Mtto. **/
if(!isset($_POST['idformtto'])){

    $id = incrementar_id("formulario_p010", "id");
    $consulta = "INSERT INTO formulario_p010 SET
    id           ='".$id."',
    idevento     ='".$idevento."',
    idformulario ='".$idformulario."',
    titulo ='".$titulo."',
    p01       ='".$p01."',
    p02       ='".$p02."'";

    $resultado = mysql_query($consulta);

    if($resultado) {
        header("Location: ".$link_modulo."?path=prev_estacion.php$params");
    }
    else echo "<b>Ocurrio un error, revise bien la informacion insertada!</b><br>Notrifiue de este error al administrador del Sistema: ".mysql_error()."<br><a href='javascript:history.back(1);'>[RETORNAR]</a>";

/** Editar Formulario Mtto. **/
}else{

    $idformtto = $_POST['idformtto'];
    $consulta =  "UPDATE formulario_p010 SET
                    titulo ='".$titulo."',
                    p01    ='".$p01."',
                    p02    ='".$p02."'
                  WHERE id = ".$idformtto."
                    ";
    $resultado=mysql_query($consulta);
    if($resultado) {
        header("Location: ".$link_modulo."?path=prev_estacion.php$params");
    }
    else echo "<b>Ocurrio un error, revise bien la información insertada!</b><br>Notrifiue de este error al administrador del Sistema: ".mysql_error()."<br><a href='javascript:history.back(1);'>[RETORNAR]</a>";
}

?>
