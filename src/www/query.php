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

$q = 0;
if(isset($_GET["q"]))
	$q=$_GET["q"];

$db->setTimeZone();
if($q == 0)
{
	$result = $db->getTaskToday();
	$todate = $db->getDate("Y-M-d (D)");
	echo "<h2 class='contentheadline'>$todate</h2>";

	if($result == False)
	{
		echo "<div class='eventcounter'>You have no tasks todo today</div>";
	}
	else if($result->num_rows <= 0)
	{
		echo "<div class='eventcounter'>You have no tasks todo today</div>";
	}
	else
	{
		$n = $result->num_rows;
		echo "<div class='eventcounter'>You have $n tasks todo today</div>";
		
		$counter=0;
		echo "<table class='eventtable'>";
		while($row = $result->fetch_row())
		{
			$counter ++;
			$id = $row[0];
			$name = $row[2];
			echo "<tr>";
			echo "<td class='eventtablerow0'>$counter.</td>";
			echo "<td class='eventtablerow1'>$name</td>";
			echo "<td class='eventtablerow2'><a class='button' href='done.php?id=$id'>Done</a></td>";
			echo "<td class='eventtablerow2'><a class='button' href='edit.php?id=$id'>Edit</a></td>";
			echo "</tr>";
		}
		echo "</table>";
	}
}
else if($q == 1)
{
	$result_dates = $db->getTodoDates();
	if($result_dates == False)
	{
		echo "<div class='eventcounter'>You have no tasks todo</div>";
	}
	else if($result_dates->num_rows<=0)
	{
		echo "<div class='eventcounter'>You have no tasks todo</div>";
	}
	else
	{
		while($row_date = $result_dates->fetch_row())
		{
			$todate = $row_date[0];
			$sdate = strtotime($todate);
			$string_date = date("Y-M-d", $sdate);
			echo "<p>";
			echo "<h2 class='contentheadline'>$string_date</h2>";
			
			$result = $db->getTodoOfDate($todate);
			if($result==False)
			{
				echo "<div class='eventcounter'>You have no tasks todo</div>";
			}
			else
			{
				$n = $result->num_rows;
				echo "<div class='eventcounter'>You have $n tasks todo</div>";

				$counter=0;
				echo "<table class='eventtable'>";
				while($row = $result->fetch_row())
				{
					$counter ++;
					$id = $row[0];
					$name = $row[2];
					echo "<tr>";
					echo "<td class='eventtablerow0'>$counter.</td>";
					echo "<td class='eventtablerow1'>$name</td>";
					echo "<td class='eventtablerow2'><a class='button' href='done.php?id=$id'>Done</a></td>";
					echo "<td class='eventtablerow2'><a class='button' href='edit.php?id=$id'>Edit</a></td>";
					echo "</tr>";
				}
				echo "</table>";
				
			}
			echo "</p>";
		}
	}

}
else if($q == 2)
{
	$result = $db->getTaskDoneToday();
	$todate = $db->getDate("Y-M-d (D)");
	echo "<h2 class='contentheadline'>$todate</h2>";

	if($result == False)
	{
		echo "<div class='eventcounter'>You have no tasks done today</div>";
	}
	else if($result->num_rows <= 0)
	{
		echo "<div class='eventcounter'>You have no tasks done today</div>";
	}
	else
	{
		$n = $result->num_rows;
		echo "<div class='eventcounter'>You have $n tasks done today</div>";
		
		$counter=0;
		echo "<table class='eventtable'>";
		while($row = $result->fetch_row())
		{
			$counter ++;
			$id = $row[0];
			$name = $row[2];
			echo "<tr>";
			echo "<td class='eventtablerow0'>$counter.</td>";
			echo "<td class='eventtablerow1'>$name</td>";
			echo "<td class='eventtablerow2'><a class='button' href='undone.php?id=$id'>Undo</a></td>";
			echo "<td class='eventtablerow2'><a class='button' href='edit.php?id=$id'>Edit</a></td>";
			echo "</tr>";
		}
		echo "</table>";
	}
}
else if($q == 3)
{
	$result_dates = $db->getDoneDates();
	if($result_dates == False)
	{
		echo "<div class='eventcounter'>You have no tasks done</div>";
	}
	else if($result_dates->num_rows<=0)
	{
		echo "<div class='eventcounter'>You have no tasks done</div>";
	}
	else
	{
		while($row_date = $result_dates->fetch_row())
		{
			$todate = $row_date[0];
			$sdate = strtotime($todate);
			$string_date = date("Y-M-d", $sdate);
			echo "<p>";
			echo "<h2 class='contentheadline'>$string_date</h2>";
			
			$result = $db->getDoneOfDate($todate);
			if($result==False)
			{
				echo "<div class='eventcounter'>You have no tasks done</div>";
			}
			else
			{
				$n = $result->num_rows;
				echo "<div class='eventcounter'>You have $n tasks done</div>";

				$counter=0;
				echo "<table class='eventtable'>";
				while($row = $result->fetch_row())
				{
					$counter ++;
					$id = $row[0];
					$name = $row[2];
					echo "<tr>";
					echo "<td class='eventtablerow0'>$counter.</td>";
					echo "<td class='eventtablerow1'>$name</td>";
					echo "<td class='eventtablerow2'><a class='button' href='undone.php?id=$id'>Undo</a></td>";
					echo "<td class='eventtablerow2'><a class='button' href='edit.php?id=$id'>Edit</a></td>";
					echo "</tr>";
				}
				echo "</table>";
				
			}
			echo "</p>";
		}
	}

}
else if($q == 4)
{
	if($db->clearDone())
	{
			echo "<h3 class='contentheadline'>All completed tasks are removed from the list.</h2>";
	}
	else
	{
			echo "<h3 class='contentheadline'>ERROR: Cannot clear completed tasks.</h2>";
	}
}


?>
