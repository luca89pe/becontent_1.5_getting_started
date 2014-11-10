<?php

require_once "include/skin.inc.php";
require_once 'include/skinlet.inc.php';
require_once "include/beContent.inc.php";
require_once "include/entities.inc.php";
require_once "include/content.inc.php";

require_once(realpath(dirname(__FILE__)).'/include/view/template/InitGraphic.php');

Settings::setModMode(true);

$main = new Skin();

InitGraphic::getInstance()->createGraphic($main,false,false);

//$events = new Content($eventsEntity, $usersEntity, $eventsEntity, $categoryEntity, $eventsEntity, $commentsEntity);
$events = new Content($eventsEntity, $imageEntity, $eventsEntity);

$events->setFilter("title", "boh");


$main->setContent("body", $events->get());
$main->close();
?>