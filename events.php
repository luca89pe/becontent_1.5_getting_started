<?php

require_once "include/skin.inc.php";
require_once 'include/skinlet.inc.php';
require_once "include/beContent.inc.php";
require_once "include/entities.inc.php";
require_once "include/content.inc.php";

require_once(realpath(dirname(__FILE__)).'/include/view/template/InitGraphic.php');

$main = new Skin();

InitGraphic::getInstance()->createGraphic($main,false,false);

$events = new Content($eventsEntity, $categoryEntity, $eventsEntity, $imageEntity, $eventsEntity, $commentsEntity);

$form = new Form("dataEntry", $commentsEntity);
$form->addHidden("id_user_events", $_REQUEST['user_events_id'], false);
$form->addText("name", "Name", 68, MANDATORY);
$form->addText("subject", "Subject", 255, MANDATORY);
$form->addEditor("body", "Text", 20, 50);

if(isset($_REQUEST['action']) == false || $_REQUEST['action'] == 'report')
    $_REQUEST['action'] = 'emit';

$events->setContent("comment_form", $form->requestAction());

$main->setContent("body", $events->get());
$main->close();
?>