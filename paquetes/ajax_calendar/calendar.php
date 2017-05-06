<? 

$output = '';
$month = $_GET['month'];
$year = $_GET['year'];
	
if($month == '' && $year == '') { 
	$time = time();
	$month = date('n',$time);
    $year = date('Y',$time);
}

$date = getdate(mktime(0,0,0,$month,1,$year));
$today = getdate();
$hours = $today['hours'];
$mins = $today['minutes'];
$secs = $today['seconds'];

if(strlen($hours)<2) $hours="0".$hours;
if(strlen($mins)<2) $mins="0".$mins;
if(strlen($secs)<2) $secs="0".$secs;

$days=date("t",mktime(0,0,0,$month,1,$year));
$start = $date['wday']+1;
//$name = $date['month'];
	//en vez de $name
		switch($month)
	  {
	  case 1: $name="Enero";break;
	  case 2: $name="Febrero";break;
	  case 3: $name="Marzo";break;
	  case 4: $name="Abril";break;
	  case 5: $name="Mayo";break;
	  case 6: $name="Junio";break;
	  case 7: $name="Julio";break;
	  case 8: $name="Agosto";break;
	  case 9: $name="Septiembre";break;
	  case 10: $name="Octubre";break;
	  case 11: $name="Noviembre";break;
	  case 12: $name="Diciembre";break;		  	  
	  }

$year2 = $date['year'];
$offset = $days + $start - 1;
 
if($month==12) { 
	$next=1; 
	$nexty=$year + 1; 
} else { 
	$next=$month + 1; 
	$nexty=$year; 
}

if($month==1) { 
	$prev=12; 
	$prevy=$year - 1; 
} else { 
	$prev=$month - 1; 
	$prevy=$year; 
}

if($offset <= 28) $weeks=28; 
elseif($offset > 35) $weeks = 42; 
else $weeks = 35; 

$output .= "
<table class='cal' cellspacing='1'>
<tr>
	<td colspan='7'>
		<table class='calhead' cellspacing='0' border='0'>
		<tr>
			<td >&nbsp;<a href='javascript:navigate($prev,$prevy)'><img src='../../paquetes/ajax_calendar/calLeft.gif'></a> <a href='javascript:navigate(\"\",\"\")'><img src='../../paquetes/ajax_calendar/calCenter.gif'></a> <a href='javascript:navigate($next,$nexty)'><img src='../../paquetes/ajax_calendar/calRight.gif'></a>
			</td>
			<td align='right'>
				<div>$name $year2</div>
			</td>
		</tr>
		</table>
	</td>
</tr>
<tr class='dayhead'>
	<td>Dom</td>
	<td>Lun</td>
	<td>Mar</td>
	<td>Mie</td>
	<td>Jue</td>
	<td>Vie</td>
	<td>Sab</td>
</tr>";

$col=1;
$cur=1;
$next=0;

for($i=1;$i<=$weeks;$i++) { 
	if($next==3) $next=0;
	if($col==1) $output.="<tr class='dayrow'>"; 
  	
	$output.="<td valign='top'>";

	if($i <= ($days+($start-1)) && $i >= $start) {
		$output.="<div class='day'><b";

		if(($cur==date('d')) && ($month==date('m'))) $output.=" style='padding:2px; font-size: 14px; background-color:#FFCC00;'";

		$output.=">$cur</b></div></td>";

		$cur++; 
		$col++; 
		
	} else { 
		$output.="&nbsp;</td>"; 
		$col++; 
	}  
	    
    if($col==8) { 
	    $output.="</tr>"; 
	    $col=1; 
    }
}

$output.="</table>";
  
echo $output;

?>
