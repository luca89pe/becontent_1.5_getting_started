<?php

/**
 * @author luca@ciprietti.net
 */

session_start();

require "include/beContent.inc.php";
require "include/auth.inc.php";
require_once 'include/content.inc.php';
require_once(realpath(dirname(__FILE__)).'/include/view/template/InitGraphic.php');

$main = new Skin("system");
InitGraphic::getInstance()->createSystemGraphic($main);

$form = new Form("dataEntry",$commentsEntity);

$form->addSection("Comments Management");
$form->addText("name", "Name", 68, MANDATORY);
$form->addText("email", "Email", 68, MANDATORY);
$form->addText("subject", "Subject", 255, MANDATORY);
$form->addEditor("body", "Text", 20, 50);

$form->addSelectFromReference($eventsEntity, "id_user_events", "Event");

if (!isset($_REQUEST['action'])) {
	$_REQUEST['action'] = 'edit';
}

$main->setContent("body", $form->requestAction());

$main->close();
