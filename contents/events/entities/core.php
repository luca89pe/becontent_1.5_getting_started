<?php

// require in ordine!!!!!!

require_once realpath(dirname(__FILE__)) .'/entityCategory.php';
require_once realpath(dirname(__FILE__)) .'/entityEvents.php';
require_once realpath(dirname(__FILE__)) .'/entityComments.php';



$categoryEntity->connect();
$eventsEntity->connect();
$commentsEntity->connect();