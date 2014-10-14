<?php

session_start();
require_once "include/beContent.inc.php";
require_once(realpath(dirname(__FILE__)).'/include/view/template/InitGraphic.php');

$main = new Skin();
InitGraphic::getInstance()->createGraphic($main);

$home = new Skinlet("home");

$eventi = new Skinlet("widget/eventi.html");

$last_events = new Content($eventsEntity, $usersEntity);

$last_events->apply($eventi);

$home->setContent("last_events", $eventi->get());

$main->setContent('body', $home->get());

$main->close();
