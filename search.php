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

$events = new Content($eventsEntity, $usersEntity);

//var_dump(DB::getInstance()->getEntityByName($eventsEntity->name));

if(isset($_GET['title'])){
    $events->setFilter("title", $_GET['title']);
}
if(isset($_GET['date'])){
    $events->setFilter("date", "LIKE %".$_GET['date'] . "%");
}
if(isset($_GET['owner'])){
    $events->setFilter("owner", $_GET['owner']);
}

$search->setContent("results", $events->get());

$main->setContent("body", $search->get());
$main->close();
?>