<?php

session_start();

require 'include/beContent.inc.php';
require_once 'include/content.inc.php';
require 'include/auth.inc.php';
require_once(realpath(dirname(__FILE__)).'/include/view/template/InitGraphic.php');

$main = new Skin('system');

InitGraphic::getInstance()->createSystemGraphic($main);

$form = new Form('dataEntry',$categoryEntity);

$form->addSection('Category Management');

$form->addText('name', 'Nome', 60,null,60,true);
$form->addEditor('description', 'Descrizione', 50, 50);

if (!isset($_REQUEST['action'])) {
	$_REQUEST['action'] = 'edit';
}

$main->setContent('body',$form->requestAction());

$main->close();
