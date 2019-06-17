<?php
if($nively=='1'){ $adm=1;}
include("../../funciones/class.paginado.php");
if (isset($_GET['pagina'])){
$pagina = $_GET['pagina'];
}
?>
<? if($admin){ ?>
<div align="center"><span class="title">ESTADISTICAS DE MANTENIMIENTO</span></div>
<? } ?>

<?php
        $rs = new paginado($conexion);
        $rs->pagina($pagina);
        $rs->propagar("path");
        $rs->porPagina(12);
        if(!$rs->query("SELECT COD,inicio,fin,DESCRIPCION from estadisticas order by inicio desc"))
        {    die( $rs->error() ); }
        
?>
<table width="100%" class="table4">
<tr>
    <td colspan="3" class="paginado">
        <div align="left">
        </div>
    </td>
    <td colspan="5" class="paginado">
        <div align="right">
            
            <? if($admin || $tech){?>
                    <input class="btn_dark" name="nuevoE" type="button" value="Nuevo" onClick="location.href='<?=$link_modulo?>?path=nueva_estadistica.php'" />
                <?php } ?>
        </div>
    </td>
</tr>			        
	<tr>
	<th width="6%" height="20"><div align="center">COD</div></th>
	<th  width="6%"><div align="center">INICIO </div></th>
	<th  width="6%"><div align="center">FIN</div></th>
	<th  width="40%"><div align="center">DESCRIPCION</div></th>
	<th  width="4%"><div align="center"></div></th>
	</tr>
<?php
  $i=0; 
  while($dato = $rs->obtenerArray())
 {?>
    <tr height="25" bgcolor="" >
        <td><DIV ALIGN='CENTER'>
        <?php 
            if($nively == 1){
                $ticket_html = "$link_modulo?path=eliminar_estadistica.php&codigo=".$dato[0];
            }else{
                $ticket_html = $dato[0];        
            }               
            
        ?>
        <a href="<?php echo($ticket_html); ?>"> <?php echo($dato[0]); ?></a>
        </DIV></td>
        <td><DIV ALIGN='CENTER'><?php echo(date("d/m/Y", strtotime($dato[1]))); ?></DIV></td>
        <td><DIV ALIGN='CENTER'><?php echo(date("d/m/Y", strtotime($dato[2])));?></DIV></td>
        <td align='justify'><span class='small'><?php echo($dato[3]);  ?></span></td>
        <td valign='top'>
            <div align='center'>
                <a title='Ver estadisticas' href='<?=$link_modulo?>?path=est_detalle1.php&fini=<?php echo($dato[1]);  ?>&ffin=<?php echo($dato[2]);  ?>&est=<?php echo($dato[3]);  ?>'><img src='../../img/ver01.png' alt='Editar Form' vspace='0' border='0' align='absbottom'></a>
            </div>
        </td>
    </tr>

 <? } ?>   

<tfoot>
<tr> 
<td colspan="8" class="paginado">
</td>
</tr>	
</tfoot>
</table>
