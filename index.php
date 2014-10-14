<?php

session_start();
require_once "include/beContent.inc.php";
require_once(realpath(dirname(__FILE__)).'/include/view/template/InitGraphic.php');

$main = new Skin();
InitGraphic::getInstance()->createGraphic($main);

$home = new Skinlet("home");

$last_events_skin = new Skinlet("widget/last_events.html");   // Load a new Skinlet, used for the last events widget
$last_events = new Content($eventsEntity, $usersEntity);    // Load the content of the Events entity
$last_events->setLimit(8);      // Limit to 8 results (last 8 events)
$last_events->apply($last_events_skin);   // Apply the content of the entity to the skinlet
$home->setContent("last_events", $last_events_skin->get());

$popular_events_skin = new Skinlet("widget/popular_events.html");
$popular_events = new Content($eventsEntity, $usersEntity);
$popular_events->setFilter("popular", "*");
$popular_events->setLimit(8);
$popular_events->apply($popular_events_skin);
$home->setContent("popular_events", $popular_events_skin->get());

$main->setContent('body', $home->get());

$main->close();
