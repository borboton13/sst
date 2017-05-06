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
$p07    = $_POST["p07"];
$p08    = $_POST["p08"];
$p09    = $_POST["p09"];

/** Nuevo Formulario Mtto. **/
if(!isset($_POST['idformtto'])){

    $id = incrementar_id("formulario_p005", "id");
    $consulta = "INSERT INTO formulario_p005 SET
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
    $consulta =  "UPDATE formulario_p005 SET
                    titulo ='".$titulo."',
                    p01    ='".$p01."',
                    p02    ='".$p02."',
                    p03    ='".$p03."',
                    p04    ='".$p04."',
                    p05    ='".$p05."',
                    p06    ='".$p06."',
                    p07    ='".$p07."',
                    p08    ='".$p08."',
                    p09    ='".$p09."'
                  WHERE id = ".$idformtto;

    $resultado=mysql_query($consulta);
    if($resultado) {
        header("Location: ".$link_modulo."?path=prev_estacion.php$params");
    }
    else echo "<b>Ocurrio un error, revise bien la información insertada!</b><br>Notrifiue de este error al administrador del Sistema: ".mysql_error()."<br><a href='javascript:history.back(1);'>[RETORNAR]</a>";
}

?>
