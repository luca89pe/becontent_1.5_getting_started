<?php
/**
 * @author luca@ciprietti.net
 */

require_once realpath(dirname(__FILE__)) .'/core.php';
class EntityComments extends Entity
{
	public function __construct($database,$name)
	{
		parent::__construct($database,$name);
		$this->setPresentation("name", "subject");
		
		$this->addField("name", VARCHAR, 68, MANDATORY);       // The title of the event
		$this->addField("email", VARCHAR, 68, MANDATORY);        // Last modification date (automatic)
		$this->addField("creation", LONGDATE, MANDATORY);       // Creation date (automatic)
		$this->addField("subject", VARCHAR, 255, MANDATORY);                 // A flag
		$this->addField("body", TEXT);                          // The content of the event (text field, inserted by a WYSIWYG editor)
        
	}
	
	public function save($query_conditions)
	{
		$query_conditions["creation"]=date("d/m/y");
		$query_conditions["creation_time"]=date("H:i:s");
		return parent::save($query_conditions);
	}
	
	public function update($where_conditions, $set_parameters)
	{
		$set_parameters["lastmod"]=date("d/m/y");
		$set_parameters["lastmod_time"]=date("H:i:s");
		return parent::update($where_conditions, $set_parameters);
	}
}
$commentsEntity = new EntityComments($database, "user_comments");
$commentsEntity->addReference($eventsEntity);