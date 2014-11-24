<?php

require_once "include/skin.inc.php";
require_once 'include/skinlet.inc.php';
require_once "include/beContent.inc.php";
require_once "include/entities.inc.php";
require_once "include/content.inc.php";

require_once(realpath(dirname(__FILE__)).'/include/view/template/InitGraphic.php');

$main = new Skin();

InitGraphic::getInstance()->createGraphic($main,false,false);

// @Luca
$events = new Content($eventsEntity, $imageEntity, $eventsEntity, $commentsEntity, $eventsEntity, $categoryEntity);
// @Daniele
//$events = new Content($eventsEntity, $categoryEntity, $eventsEntity, $imageEntity, $eventsEntity, $commentsEntity);
    
if(!empty($_GET['title'])){
    $events->setFilter("title", "LIKE %".$_GET['title']."%");
}
elseif(!empty($_GET['category'])){
    $events->setFilter("categoria", $_GET['category']);
}
elseif(!empty($_GET['date'])){
    $dateArr = explode("/", $_GET['date']);
    $dateArr = array_reverse($dateArr);
    $date = implode($dateArr, "-");
    $events->setFilter("date", "LIKE ".$date."%");
}


$main->setContent("body", $events->get());
$main->close();

?>