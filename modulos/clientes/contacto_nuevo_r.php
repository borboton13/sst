<?php
//datos cliente
$cliente = $_POST["cliente"];
//datos contacto
$cnombre = $_POST["cnombre"];
$ccargo = $_POST["ccargo"];
$cdpto = $_POST["cdpto"];
$ctelf = $_POST["ctelf"];
$ccel = $_POST["cel"];
$cmail = $_POST["cmail"];
$cfax = $_POST["cfax"];
$cobs = $_POST['cobs'];

$consulta="SELECT id FROM clientes WHERE razon_social='$cliente';";
$resultado=mysql_query($consulta);
$filas=mysql_num_rows($resultado);
if($filas!=0){
$dato=mysql_fetch_array($resultado);
$id_cliente=$dato[0];	
	
		$resultado=mysql_query("SELECT nombre,email FROM contactos WHERE nombre like '%$cnombre%' OR email='$cmail'");
		$filas=mysql_num_rows($resultado);
		if($filas!=0){
		
				echo "<center>Ya existe el contacto <B>$cnombre</B> o correo: <B>$cmail:</B><hr>";
		while($dato=mysql_fetch_array($resultado))
		 { 
				echo "<BR>NOMBRE: ".$dato['nombre']." CORREO: ".$dato['email'];
		 }
		echo "<hr><a href='javascript:history.back(1)'>Insertar Contacto Nuevamente</a></center>"; 
	}
	else {
	//inseeta contacto
	
	$consulta="INSERT INTO contactos (id, id_cliente, nombre, cargo, dpto, telf, celular, email, fax, obs, id_user, fecha_registro) VALUES ('', '$id_cliente', '$cnombre', '$ccargo', '$cdpto', '$ctelf', '$ccel', '$cmail', '$cfax', '$cobs', '$id_user', NOW())";
	$resultado=mysql_query($consulta);
	
	header("Location: clientes.php?path=cliente_detalles.php&nro=".base64_encode($id_cliente));
	}
}
else
{ echo "<center>El Cliente <B>$cliente</B> no exite!<hr> <a href='javascript:history.back(1);'>Haga Click Aqui para RETORNAR</a></center>"; 
}

?>

