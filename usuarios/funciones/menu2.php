<?php
$menu="../../paquetes/menu/";
$mclientes="../modulos/clientes.php?path=";
$musuarios="../modulos/usuarios.php?path=";
$mst="../modulos/seguimiento_tecnico.php?path=";
$repo="../modulos/repositorio.php";
if($nively=='1') $admin  = true; else $admin  = false;
if($nively=='2') $tech   = true; else $tech   = false;
if($nively=='3') $client = true; else $client = false;

?>
<link href="../../css/base.css" rel="stylesheet" type="text/css">
<link href="../../css/style.css" rel="stylesheet" type="text/css">
<script src="../../js/jquery-1.9.1.min.js" type=text/javascript></script>
<script>
    $(document).ready(function() {
        $( '.dropdown' ).hover(
            function(){
                $(this).children('.sub-menu').slideDown(200);
            },
            function(){
                $(this).children('.sub-menu').slideUp(200);
            }
        );
    }); // end ready
</script>
<div>
    <nav>
        <ul class="content clearfix">
            <li class="dropdown">
                <a href="<?=$mst?>ver.php">MTTO Correctivo</a>
                <ul class="sub-menu">
                    <? if($admin){?><li><a href="<?=$mst?>nuevo.php">Crear Nuevo</a></li><? } ?>
                    <li><a href="<?=$mst?>ver.php">Ver Listado por mes</a></li>
                    <li><a href="<?=$repo?>">Repositorio archivos</a></li>
                </ul>
            </li>


            <li class="dropdown">
                <a href="<?=$mst?>cronograma_prev.php">MTTO Preventivo</a>
                <ul class="sub-menu">
                    <li><a href="<?=$mst?>cronograma_prev.php">Cronograma</a></li>
                    <? if($admin || $tech){?><li><a href="<?=$mst?>nuevo_evento.php">Nuevo evento</a></li><?php } ?>
                    <li class="dropdown">
                        <a href="#">Reportes</a>
                        <ul class="sub-menu">
                            <li><a href="<?=$mst?>reporte_mtto_prev.php">Reporte de Mtto x Formulario</a></li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li><a href="<?=$mst?>tickets.php">Tickets</a></li>

            <? if($admin){?><li class="spaced_li"><a href="<?=$mst?>veedor_ver.php">Acceso</a></li>
            <? } else { ?>  <li class="spaced_li"><a>Acceso</a></li><? } ?>

            <li class="dropdown">
                <a href="#">Clientes</a>
                <ul class="sub-menu">
                    <li><a href="<?=$mclientes?>nuevo_cliente.php">Nuevo Cliente y Contacto</a></li>
                    <li><a href="<?=$mclientes?>ver_clientes.php">Ver Clientes</a></li>
                    <li><a href="<?=$mclientes?>contacto_nuevo.php">Nuevo Contacto</a></li>
                    <li><a href="<?=$mclientes?>ver_contactos.php">Ver Contactos</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="">Usuarios</a>
                <ul class="sub-menu">
                    <li><a href="<?=$musuarios?>nuevo_usuario.php">Nuevo Usuario</a></li>
                    <li><a href="<?=$musuarios?>ver_usuarios.php">Ver Usuarios</a></li>
                </ul>
            </li>
            <li><a href="../../salir.php">Cerrar sesion</a></li>

        </ul>
    </nav>
</div>

