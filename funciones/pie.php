<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr><td colspan="2" background="../../img/menu_fill_up.jpg" height="30"></td></tr>
    <tr>
          <TD width="50%" class="pie">&nbsp;<? echo"$cargo"; ?>: <strong class="pie_txt"><? echo"$nombrec"; ?></strong> Ingresos: <strong class="pie_txt"><? echo"$nro_ing"; ?></strong> </TD>
          <TD width="50%" class="pie">
		    <div align="right">
		    <? 
		  $dias=date("w");
	switch($dias)
	  {
	  case 1: echo"<b>LUN</b>";break;
	  case 2: echo"<b>MAR</b>";break;
	  case 3: echo"<b>MIE</b>";break;
	  case 4: echo"<b>JUE</b>";break;
	  case 5: echo"<b>VIE</b>";break;
	  case 6: echo"<b>SAB</b>";break;
	  case 0: echo"<b>DOM</b>";break;		  	  
	  }	  
		  $dia=date("d");
		  $mes=date("m");
		  echo", $dia de ";
	switch($mes)
	  {
	  case 1: echo"ENE";break;
	  case 2: echo"FEB";break;
	  case 3: echo"MAR";break;
	  case 4: echo"ABR";break;
	  case 5: echo"MAY";break;
	  case 6: echo"JUN";break;
	  case 7: echo"JUL";break;
	  case 8: echo"AGO";break;
	  case 9: echo"SEP";break;
	  case 10: echo"OCT";break;
	  case 11: echo"NOV";break;
	  case 12: echo"DIC";break;		  	  
	  }
		  ?>
		  <a href="../../salir.php" class="enlace_blanco">[Cerrar Sesion]</a></div></TD>
  </tr>
    <tr><td class="pie" colspan="2"><br />
        <div align="center">
            <span class="pie_txt"><b>SANTA CRUZ</b> OFICINA CENTRAL: Direcci&oacute;n Barrio Dr. Melchor Pinto Parada UV 71A, Manzano 3 # 1035<br />
            <b>LA PAZ</b> El Alto, Zona Villa Dolores Calle Cap. Issac Arias esq Av. Arica # 2555
            </span><br />
            <span class="pie_txt">Sistema de Seguimiento Técnico</span><br />&copy; <?=date("Y")?> Todos los derechos reservados
        </div><br />
        </td>
    </tr>
</table>