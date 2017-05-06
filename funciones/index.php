<?php
require_once("path.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-language" content="es" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="description" content="The Official Dimesat Site to research" />
<meta name="keywords" content="Dimesat, project, projects, Santa Cruz, data, satelite, transceivers, epp, comunication, telecomunication, bolivia, vsat, gilat, wimax, idirect, gsm, technology, cellphone, conexion, comunicaciones" />
<meta name="author" content="DIMESAT" />
<title>DIMESAT S.R.L.</title>
<link href="<?php print("$URL2/style.css"); ?>" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="<?php print("$URL2/images/favico.ico"); ?>" />
</head>

<body id="TotalBodyId" style="margin-top:0px;background-position:0 0px;">
<!--Inline css is needed for the top banner/ad, top-margin should be same as the ad-block height-->

<!-- Top Bg Panel start -->
<?php require_once("$PATH/system/presentation/general/header.php"); ?>
<!-- Top Bg Panel End -->

<!--Body Panel Start -->
<div class="bodyBg">
	<div id="bodypan">
		
		<!-- Left Panel Start -->
		<?php require_once("$PATH/system/presentation/general/leftPan.php"); ?>
		<!-- Left Panel End -->
		
		<!-- Right Panel start -->
		<?php require_once("$PATH/system/presentation/general/rightPanel.php"); ?>
		<!--Right Panel end -->
	</div>
</div>
<!--Body Panel End -->
<div class="spacer" />

<!--footer start -->
<?php require_once("$PATH/system/presentation/general/footer.php"); ?>
<!--footer End -->
</body>
</html>