<?php

session_start();
require_once "include/beContent.inc.php";
require_once(realpath(dirname(__FILE__)).'/include/view/template/InitGraphic.php');

$main = new Skin();
InitGraphic::getInstance()->createGraphic($main);

$home = new Skinlet("home");

$last_events = new Content($eventsEntity, $usersEntity);

$last_events->setOrderFields("date DESC");
        
var_dump($last_events->getValue("title"));

$home->setContent("last_events", $last_events->get());

$main->setContent('body', $home->get());

$main->close();
