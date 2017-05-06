<?php
$dir="../".$_GET['directorio']."/";

if (isset($_GET['download']))
downloadfile($_GET['download'],$dir);

function downloadfile($file,$dir){
	$file = $dir.basename($file);
	if (!is_file($file)) { return; }
	header("Content-Type: application/octet-stream");
	header("Content-Size: ".filesize($file));
	header("Content-Disposition: attachment; filename=\"".basename($file)."\"\n");
	header("Content-Length: ".filesize($file));
	header("Content-transfer-encoding: binary");
	@readfile($file);
	exit(0);
}
?>

