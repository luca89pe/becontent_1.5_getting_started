<?php

/**
 * @author dipompeodaniele@gmail.com, n.sacco.dev@gmail.com
 */

session_start();

require "include/beContent.inc.php";
require "include/auth.inc.php";
require_once 'include/content.inc.php';
require_once(realpath(dirname(__FILE__)).'/include/view/template/InitGraphic.php');

$main = new Skin("system");
InitGraphic::getInstance()->createSystemGraphic($main);

$form = new Form("dataEntry",$eventsEntity);

$form->addSection("Events Management");
$form->addText("title", "Titolo", 80, MANDATORY);
$form->addLongDate("date", "Data", MANDATORY);

$form->addEditor("body", "Testo", 20, 50);
$form->addCheck("popular", "Popular");

$form->addSelectFromReference($categoryEntity, "categoria", "Category");

$imageForm=new ImageForm('imageEntry',$pageEntity);
$imageForm->addImage('foto','Foto');
$form->triggers($imageForm);

if (!isset($_REQUEST['action'])) {
	$_REQUEST['action'] = 'edit';
}

$main->setContent("body", $form->requestAction());

$main->close();
