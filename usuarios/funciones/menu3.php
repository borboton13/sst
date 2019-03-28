<?php
$menu="../../paquetes/menu/";
$mclientes="../modulos/clientes.php?path=";
$musuarios="../modulos/usuarios.php?path=";
$mst="../modulos/seguimiento_tecnico.php?path=";
$repo="../modulos/repositorio.php";

if($nively=='1') $admin  = true; else $admin  = false;
if($nively=='2') $tech   = true; else $tech   = false;
if($nively=='3') $client = true; else $client = false;

if($nively=='1') $admin  = true; else $admin  = false;
if($nively=='2') $tech   = true; else $tech   = false;
if($nively=='3') $client = true; else $client = false;

?>

    <link href='http://fonts.googleapis.com/css?family=Oswald:300' rel='stylesheet' type='text/css'>
<div align="center">
    <h1>Sistema de Seguimiento Tecnico</h1>

    <a href="<?=$mst?>ver.php" class="btn">Mtto Correctivo</a>
    <a href="<?=$mst?>cronograma_prev.php" class="btn">Mtto Preventivo</a>
    <a href="<?=$mst?>tickets.php" class="btn">Tickets</a>

    <? if($admin || $client){ ?>
    <a href="<?=$mst?>actas.php" class="btn">Actas</a>
    <? } ?>

    <? if($admin){ ?>
    <a href="<?=$mclientes?>ver_clientes.php" class="btn">Clientes</a>
    <? } else { ?>
    <a href="#" class="btn">Clientes</a>
    <? } ?>
    <? if($admin){ ?>
    <a href="<?=$musuarios?>ver_usuarios.php" class="btn">Usuarios</a>
    <? } else { ?>
    <a href="#" class="btn">Usuarios</a>
    <? } ?>

    <a href="<?=$mst?>estadisticas.php" class="btn">Estadisticas</a>

    <a href="../../salir.php" class="btn">Cerrar sesion</a>
</div>