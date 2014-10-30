<?php
require_once realpath(dirname(__FILE__)) .'/core.php';

class EntityCategory extends Entity
{
	public function __construct($database,$name, $owner = "")
	{
		parent::__construct($database,$name,$owner);
		$this->setPresentation("(%name)");
		$this->addField("name", VARCHAR, 100);
		$this->addField("description", TEXT);
	}
        
        
	public function save($query_conditions)
	{
		$query_conditions["owner"]=$_SESSION["user"]["username"];
		return parent::save($query_conditions);
	}
}
$categoryEntity = new EntityCategory($database, "user_event_categories", WITH_OWNER);