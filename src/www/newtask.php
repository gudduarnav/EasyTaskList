<html>
<head>
	<title>Easy Task List</title>
	<link rel="stylesheet" href="theme.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="./common/newtask.js"></script>
</head>
<body>

<div id="titlebar">
	<h1>Easy Task List</h1>
</div>

<div class="holder">	
	<div class="mainpage">
		<div class="contentheadline">New Task</h2>
		<form class="taskform" method="post" action="saveevent.php">
			<input type="hidden" id="id" name="id" value="0">
			<input type="hidden" id="completed" name="completed" value="0">
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
						<input class="inputtext" type="text" size="50" maxlength="128" id="taskname" name="taskname">
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
						<input class="inputtext" type="text" size="4" maxlength="4" id="taskyyyy" name="taskyyyy">
						<label class="label">-</label>
						<input class="inputtext" type="text" size="2" maxlength="2" id="taskmm" name="taskmm">
						<label class="label">-</label>
						<input class="inputtext" type="text" size="2" maxlength="2" id="taskdd" name="taskdd">
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