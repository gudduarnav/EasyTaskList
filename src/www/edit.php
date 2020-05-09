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

if(!isset($_GET["id"]))
{
	header("location: index.php");
}

$result = $db->getRowforID((int) $_GET["id"]);
if($result==False)
	die("ERROR: Wrong ID");

$db->setTimeZone();
$sdate = strtotime($result[1]);
$syyyy = date("Y", $sdate);
$smm = date("m", $sdate);
$sdd = date("d", $sdate);

?>

<html>
<head>
	<title>Easy Task List</title>
	<link rel="stylesheet" href="theme.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="./common/edittask.js"></script>
</head>
<body>

<div id="titlebar">
	<h1>Easy Task List</h1>
</div>

<div class="holder">	
	<div class="mainpage">
		<div class="contentheadline">Edit Task</h2>
		<form class="taskform" method="post" action="saveevent.php">
			<input type="hidden" id="id" name="id" value="<?php echo $result[0]; ?>">
			<input type="hidden" id="completed" name="completed" value="<?php echo $result[3]; ?>">
			<table align="center">
				<tr>
					<td>
						<br>
					</td>
					<td>
					</td>
				</tr>
				<tr>
					<td>
						<label class="label"> Task Name:</label>
					</td>
					<td>
						<input class="inputtext" type="text" size="50" maxlength="128" id="taskname" name="taskname" value="<?php echo $result[2]; ?>">
					</td>
				</tr>
				<tr>
					<td>
						<br>
					</td>
					<td>
					</td>
				</tr>
				<tr>
					<td>
						<label class="label">Date:</label>
					</td>
					<td>
						<input class="inputtext" type="text" size="4" maxlength="4" id="taskyyyy" name="taskyyyy" value="<?php echo $syyyy; ?>">
						<label class="label">-</label>
						<input class="inputtext" type="text" size="2" maxlength="2" id="taskmm" name="taskmm" value="<?php echo $smm; ?>">
						<label class="label">-</label>
						<input class="inputtext" type="text" size="2" maxlength="2" id="taskdd" name="taskdd" value="<?php echo $sdd; ?>">
					</td>
				</tr>
				<tr>
					<td>
						<br>
					</td>
					<td>
					</td>
				</tr>
				<tr>
					<td align="center">
						<input class="buttondisabled" type="submit" id="save" name="save" value="Save" disabled>
					</td>
					<td align="center">
						<input class="button" type="button" id="cancel" value="Cancel">
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>

<div class="footer1">
	<table align="center">
		<tr>
			<td align="left">Application uses <b><i>PHP, MySQL/InnoDB database (mysqli), JQuery, AJAX, HTML, CSS</b></i></td>
			<td align="right">Developer (Copyright) <b>Arnav Mukhopadhyay (<i>2020</i>)</b></td>
		</tr>
	</table>
</div>


</body>
</html>