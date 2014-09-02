<?php

require_once realpath(dirname(__FILE__)) . '/core.php';

function init($usersEntity) {

    $config = Config::getInstance()->getConfigurations();
    if (!$usersEntity->retrieveAndLink() && Settings::getModMode()) {
        $values_conditions = array();

        $GLOBALS['servicesEntity']->insertItem(array(
            "id" => "15",
            "name" => "Events",
            "script" => "user-events-manager.php",
            "entry" => "Events",
            "servicecategory" => "2",
            "visible" => "*",
            "des" => "",
            "id_entities" => "",
            "position" => "9")
        );

        $GLOBALS['servicesGroupsRelation']->insertItem(null, "15", "1");
    }
}

init($usersEntity);