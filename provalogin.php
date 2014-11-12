<?php
session_start();
session_destroy();
session_start();
require_once "include/beContent.inc.php";
require_once "include/content.inc.php";
require_once "include/auth.inc.php";
require_once "include/view/template/InitGraphic.php";
$main = new Skin('theme');
InitGraphic::getInstance()->createGraphic($main);
header("Location: index.php");
die();
$main->close();  
?>