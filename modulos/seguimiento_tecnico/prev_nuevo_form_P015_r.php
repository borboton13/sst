<?php
require("../../funciones/funciones.php");

$idevento     = $_POST["idevento"];
$idformulario = $_POST["idformulario"];
$titulo       = $_POST["titulo"];
$params       = $_POST["params"];

$p01    = $_POST["p01"];

$size2    = $_POST["size2"];
$p02 = "";
for($i=1; $i < $size2; $i++ ){
    $p02 .= $_POST["p02$i"];
    if($i==12||$i==24||$i==36||$i==48||$i==60||$i==72||$i==84||$i==96||$i==108||$i==120||$i==132||$i==144||$i==156||$i==168)
        $p02 .= '|';
    else{
        if($i<$size2-1)
            $p02 .= ';';
    }
}

$size3    = $_POST["size3"];
$p03 = "";
for($i=1; $i < $size3; $i++ ){
    $p03 .= $_POST["p03$i"];
    if($i==2||$i==4||$i==6||$i==8||$i==10)
        $p03 .= '|';
    else{
        if($i<$size3-1)
            $p03 .= ';';
    }
}

$size4    = $_POST["size4"];
$p04 = "";
for($i=1; $i < $size4; $i++ ){
    $p04 .= $_POST["p04$i"];
    if($i==4||$i==8||$i==12)
        $p04 .= '|';
    else{
        if($i<$size4-1)
            $p04 .= ';';
    }
}

$p05    = $_POST["p05"];

/** Nuevo Formulario Mtto. **/
if(!isset($_POST['idformtto'])){

    $id = incrementar_id("formulario_p015", "id");
    $consulta = "INSERT INTO formulario_p015 SET
    id           ='".$id."',
    idevento     ='".$idevento."',
    idformulario ='".$idformulario."',
    titulo ='".$titulo."',
    p01       ='".$p01."',
    p02       ='".$p02."',
    p03       ='".$p03."',
    p04       ='".$p04."',
    p05       ='".$p05."'";

    $resultado = mysql_query($consulta);

    if($resultado) {
        header("Location: ".$link_modulo."?path=prev_estacion.php$params");
    }
    else echo "<b>Ocurrio un error, revise bien la informacion insertada!</b><br>Notrifiue de este error al administrador del Sistema: ".mysql_error()."<br><a href='javascript:history.back(1);'>[RETORNAR]</a>";

/** Editar Formulario Mtto. **/
}else{

    $idformtto = $_POST['idformtto'];
    $consulta =  "UPDATE formulario_p015 SET
                    titulo ='".$titulo."',
                    p01       ='".$p01."',
                    p02       ='".$p02."',
                    p03       ='".$p03."',
                    p04       ='".$p04."',
                    p05       ='".$p05."'
                  WHERE id = ".$idformtto."
                    ";
    $resultado=mysql_query($consulta);
    if($resultado) {
        header("Location: ".$link_modulo."?path=prev_estacion.php$params");
    }
    else echo "<b>Ocurrio un error, revise bien la información insertada!</b><br>Notrifiue de este error al administrador del Sistema: ".mysql_error()."<br><a href='javascript:history.back(1);'>[RETORNAR]</a>";
}

?>
