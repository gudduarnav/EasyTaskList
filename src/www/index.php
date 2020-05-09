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


?>

<html>
<head>
	<title>Easy Task List</title>
	<link rel="stylesheet" href="theme.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="./common/this.js"></script>
</head>
<body>

<div id="titlebar">
	<h1>Easy Task List</h1>
</div>

<div class="holder">
	<div class="sidebar">
		<ul class="menuitem">
			<li id="todo">Today's Tasks TODO</li>
			<li id="todoall">Show All Tasks</li>
			<li id="done">Today's Completed Tasks</li>
			<li id="doneall">Show All Completed Tasks</li>
			<li id="deletedone">Clear all completed Tasks</li>
			<li id="addtask">New Task</li>
		<ul>
	</div>
	
	<div class="mainpage">
		<div id="tasklist">
		</div>
	</div>


</div>

<div class="footer">
	<table align="center">
		<tr>
			<td align="left">Application uses <b><i>PHP, MySQL/InnoDB database (mysqli), JQuery, AJAX, HTML, CSS</b></i></td>
			<td align="right">Developer (Copyright) <b>Arnav Mukhopadhyay (<i>2020</i>)</b></td>
		</tr>
	</table>
</div>


</body>
</html>