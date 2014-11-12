<?php
ini_set('xdebug.var_display_max_depth', -1);
ini_set('xdebug.var_display_max_children', -1);
ini_set('xdebug.var_display_max_data', -1);

require_once "include/skin.inc.php";
require_once 'include/skinlet.inc.php';
require_once "include/beContent.inc.php";
require_once "include/entities.inc.php";
require_once "include/content.inc.php";
require_once "include/control/search/searchEngine.php";

require_once(realpath(dirname(__FILE__)).'/include/view/template/InitGraphic.php');


$main = new Skin();
$search = new Skinlet("search.html");

InitGraphic::getInstance()->createGraphic($main,false,false);

$events = new Content($eventsEntity, $usersEntity, $eventsEntity, $categoryEntity);

if(isset($_GET['category'])){
    $events->setFilter("categoria", $_GET['category']);
}

$search->setContent("results", $events->get());

$main->setContent("body", $search->get());
$main->close();
?>