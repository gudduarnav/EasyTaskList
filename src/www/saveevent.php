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

if(isset($_POST["id"]) && 
   isset($_POST["taskname"]) &&
   isset($_POST["taskyyyy"]) &&
   isset($_POST["taskmm"]) &&
   isset($_POST["taskdd"]) &&
   isset($_POST["completed"]))
   {
	  if(!$db->saveEvent($_POST["id"], 
						 $_POST["taskname"],
						 $_POST["taskyyyy"],
						 $_POST["taskmm"],
						 $_POST["taskdd"],
						 $_POST["completed"]))
						 {
							 die("ERROR: Cannot save event");
						 }
   }
else
{
	die("ERROR: Wrong format");
}

header("location: index.php");
?>

