<?php
include_once(dirname(__FILE__)."/common/database.php");

$db = new Database();
if(!$db->isConnected())
{
	die("ERROR: Cannot connect to the MYSQL database");
}

if(!$db->checkInstall())
{
	die("ERROR: Failed to install this appication");
}

if(isset($_GET["id"]))
{
	$id = $_GET["id"];
	if(!$db->eventUndone($id))
	{
		die("ERROR: Cannot mark the Event #$id as undo"); 
	}
}

header("location: index.php");
?>
