<?php
/**
 * @author luca@ciprietti.net
 */

require_once realpath(dirname(__FILE__)) .'/core.php';
class EntityEvents extends Entity
{
	public function __construct($database,$name, $owner = "")
	{
		parent::__construct($database,$name,$owner);
		$this->setPresentation("title", "active");
		
		$this->addField("title", VARCHAR, 68, MANDATORY);       // The title of the event
		$this->addField("lastmod", LONGDATE, MANDATORY);        // Last modification date (automatic)
		$this->addField("creation", LONGDATE, MANDATORY);       // Creation date (automatic)
		$this->addField("date", LONGDATE, MANDATORY);           // Date field (date selected by user)
		$this->addField("active", VARCHAR, 1);                  // A flag
		$this->addField("body", TEXT);                          // The content of the event (text field, inserted by a WYSIWYG editor)
        
                // Fields used by the beContent search engine (beta!!!)
		$this->setTextSearchFields("title", "body");
		$this->setTextSearchScript("events.php?user_events_id=");
		$this->setSearchPresentationHead("title");
		$this->setSearchPresentationBody("body");
	}
	
	public function save($query_conditions)
	{
		$query_conditions["creation"]=date("d/m/y");
		$query_conditions["creation_time"]=date("H:i:s");
		$query_conditions["owner"]=$_SESSION["user"]["username"];
		return parent::save($query_conditions);
	}
	
	public function update($where_conditions, $set_parameters)
	{
		$set_parameters["lastmod"]=date("d/m/y");
		$set_parameters["lastmod_time"]=date("H:i:s");
		return parent::update($where_conditions, $set_parameters);
	}
}
$eventsEntity = new EntityEvents($database, "user_events", WITH_OWNER);