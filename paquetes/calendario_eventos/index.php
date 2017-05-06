<?php
	include("../../funciones/motor.php");
	include('settings.php');
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>MySQL Calendar System - Easily using PHP &amp; Script.aculo.us</title>

<script src="js/lib/prototype.js" type="text/javascript"></script>
<script src="js/src/scriptaculous.js" type="text/javascript"></script>

<style>
BODY {
	PADDING-RIGHT: 0px; PADDING-LEFT: 0px; FONT-SIZE: 11px; PADDING-BOTTOM: 0px; MARGIN: 0px; PADDING-TOP: 0px; FONT-FAMILY: Verdana, sans-serif
}
.azul {
	FONT-WEIGHT: 700; COLOR: #006699; FONT-SIZE: 10px; LINE-HEIGHT: 14px
}
	.calendarBox {
		position: relative;
		margin: 0 auto;
		padding: 5px;
		width: 254px;
		border: 1px solid #000;
	}

	.calendarFloat {
		float: left;
		width: 31px;
		height: 20px;
		margin: 1px 0px 0px 1px;
		padding: 1px;
		border: 1px solid #000;
	}
</style>

<script type="text/javascript">

	
	function startCalendar(month, year) {
		new Ajax.Updater('calendarInternal', 'rpc.php', {method: 'post', postBody: 'action=startCalendar&month='+month+'&year='+year+''});
	}
	function displayEvents(day, month, year) {
		new Ajax.Updater('eventList', 'rpc.php', {method: 'post', postBody: 'action=listEvents&&d='+day+'&m='+month+'&y='+year+''});
		if(Element.visible('eventList')) {
			// do nothing, its already visble.
		} else {
			setTimeout("Element.show('eventList')", 300);
		}
	}
			
</script>


</head>
<body>
<div align="center" class="azul">CALENDARIO DE ACTIVIDADES</div>
<div id="calendar" class="calendarBox">
		<div id="calendarInternal">
			&nbsp;
		</div>
		<br style="clear: both;">
		<div id="eventList" style="display: none;"></div>
</div> <!-- FINAL DIV DO NOT REMOVE -->
	
	<script type="text/javascript">
		startCalendar(0,0);
	</script>
</body>
</html>