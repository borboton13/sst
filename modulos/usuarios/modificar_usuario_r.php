<?php
require("../../funciones/funciones.php");
$id = $_POST["id"];
$nombre = $_POST["nombre"];
$ap_pat = $_POST["ap_pat"];
$ap_mat = $_POST["ap_mat"];
$cuenta = $_POST["cuenta"];
$contrasena = $_POST["contrasena"];
$cargo = $_POST["cargo"];
$mail = $_POST["mail"];
$nivel = $_POST["nivel"];
$sucursal = $_POST["sucursal"];
$fecha_nacimiento = convertfecha($_POST['fecha_nacimiento'],"/");
$direccion = $_POST['direccion'];
$mail2 = $_POST['mail2'];
$skype = $_POST['skype'];
$msn = $_POST['msn'];
$telf = $_POST['telf'];
$cel = $_POST['cel'];
$telf_oficina = $_POST['telf_oficina'];
$interno = $_POST['interno'];

$activo = $_POST['activo'];

$consulta="UPDATE usuarios SET 
nombre='".$nombre."',
ap_pat='".$ap_pat."',
ap_mat='".$ap_mat."',
cuenta='".$cuenta."',";

if($contrasena!="") $consulta.="contrasena=md5('".$contrasena."'),";

$consulta.="
cargo='".$cargo."',
mail='".$mail."',
nivel='".$nivel."',
sucursal='".$sucursal."',
fecha_nacimiento='".$fecha_nacimiento."',
direccion='".$direccion."',
mail2='".$mail2."',
skype='".$skype."',
msn='".$msn."',
telf='".$telf."',
cel='".$cel."',
telf_oficina='".$telf_oficina."',
interno='".$interno."',
activo='".$activo."',
id_usuario='".$id_user."',
fecha_modificacion=NOW()
WHERE id='".$id."'
";

$resultado=mysql_query($consulta);

if($resultado) {
	header("Location: ".$link_modulo."?path=ver_usuarios.php");
	}
	else echo "<b>Ocurrio un error, revise bien la información insertada!</b><br>Notrifiue de este error al administrador del Sistema: ".mysql_error()."<br><a href='javascript:history.back(1);'>[RETORNAR]</a>";  		
?>

