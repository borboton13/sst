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
<link rel="stylesheet" href="<?=$menu?>cbcscbmenu.css" type="text/css" />

<div>
    <nav>
        <ul class="content clearfix">
            <li><a href="#">Nav 1</a></li>
            <li><a href="#">Nav 2</a></li>
            <li class="dropdown">
                <a href="#">Nav 3</a>
                <ul class="sub-menu">
                    <li><a href="#">Nav 3.1</a></li>
                    <li><a href="#">Nav 3.2</a></li>
                    <li><a href="#">Nav 3.3</a></li>
                    <li class="dropdown">
                        <a href="#">Nav 3.4</a>
                        <ul class="sub-menu">
                            <li><a href="#">Nav 3.4.1</a></li>
                            <li class="dropdown">
                                <a href="#">Nav 3.4.2</a>
                                <ul class="sub-menu">
                                    <li><a href="#">Nav 3.4.2.1</a></li>
                                    <li><a href="#">Nav 3.4.2.2</a></li>
                                    <li><a href="#">Nav 3.4.2.3</a></li>
                                    <li><a href="#">Nav 3.4.2.4</a></li>
                                    <li><a href="#">Nav 3.4.2.5</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Nav 3.4.3</a></li>
                            <li><a href="#">Nav 3.4.4</a></li>
                            <li><a href="#">Nav 3.4.5</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Nav 3.5</a></li>
                </ul>
            </li>
            <li><a href="#">Nav 4</a></li>
            <li><a href="#">Nav 5</a></li>
        </ul>
    </nav>
</div>

<script type="text/javascript" src="<?=$menu?>cbjscbmenu.js"></script>
