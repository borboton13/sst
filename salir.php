<?php
session_start(); 
$_SESSION["santox"] = NULL;
$_SESSION["senax"] = NULL;
$_SESSION["sesionx"] = NULL;
$_SESSION["nivelx"] = NULL;
session_destroy();
header("Location: index.php");
?>