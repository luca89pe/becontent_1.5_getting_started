<?php

session_start();
require_once "include/beContent.inc.php";
require_once(realpath(dirname(__FILE__)).'/include/view/template/InitGraphic.php');

$main = new Skin();
InitGraphic::getInstance()->createGraphic($main);

$home = new Skinlet("home");

$events = new Content($eventsEntity, $imageEntity, $eventsEntity, $commentsEntity);         // Load the content of the Events entity

$last_events_skin = new Skinlet("widget/last_events.html"); // Load a new Skinlet, used for the last events widget
$last_events = clone $events;
$last_events->setOrderFields("creation DESC");              // Order by creation date
$last_events->setLimit(8);                                  // Limit to 8 results (last 8 events)
$last_events->apply($last_events_skin);                     // Apply the content of the entity to the skinlet
$home->setContent("last_events", $last_events_skin->get()); // Fill the "last_events" placeholder with content

$popular_events_skin = new Skinlet("widget/popular_events.html");
$popular_events = clone $events;
$popular_events->setFilter("popular", "*");
$popular_events->setLimit(8);
$popular_events->apply($popular_events_skin);
$home->setContent("popular_events", $popular_events_skin->get());

$next_event_skin = new Skinlet("widget/next_event.html");
$next_event = clone $events;
$next_event->setOrderFields("date");
$next_event->setFilter("date", "> ".date("Y-m-d H:i:s"));
$next_event->setLimit(1);
$next_event->apply($next_event_skin);
$home->setContent("next_event", $next_event_skin->get());

$search_form_skin = new Skinlet("widget/search_form.html");
$categories = new Content($categoryEntity);
$categories->setOrderFields("name");
$categories->apply($search_form_skin);
$home->setContent("search_form", $search_form_skin->get());

$main->setContent('body', $home->get());

$main->close();