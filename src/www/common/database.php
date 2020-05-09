<?php

include_once(dirname(__FILE__)."/settings.php");

class Database 
{
	private $connection;
	
	function __construct()
	{
		$url = constant("SQL_SERVER");
		$username = constant("SQL_USERNAME");
		$password = constant("SQL_PASSWORD");
		$database = constant("SQL_DATABASE");
		
		$this->connection = new mysqli($url, $username, $password, $database);
	}
	
	function __destruct()
	{}
	
	function isConnected()
	{
		return ($this->connection->connect_error) ? False : True;
	}
	
	function isTableExist($tablename)
	{
		$sql = "SHOW TABLES LIKE '$tablename'";
		$result = $this->connection->query($sql);
		if($result == False)
		{
			return False;
		}
		
		if($result->num_rows == 1)
		{
			return True;
		}
		
		return False;
	}
	
	function isTableTask()
	{
		return $this->isTableExist("EASYTASKLIST");
	}
	
	function createTableTask()
	{
		$sql = "CREATE TABLE EASYTASKLIST (ID INT(10) UNSIGNED PRIMARY KEY, WHENTODO DATE NOT NULL, TASKNAME VARCHAR(128) NOT NULL, COMPLETED INT(1) DEFAULT 0)";
		$result = $this->connection->query($sql);
		if($result == False)
			return False;
		
		return $this->isTableTask();
	}
	
	function checkInstall()
	{
		if(!$this->isTableTask())
		{
			return $this->createTableTask();
		}
		return True;
	}
	
	function execquery($sql)
	{
		return $this->connection->query($sql);
	}
	
	function setTimeZone()
	{
		date_default_timezone_set("Asia/Kolkata");
	}
	
	function getDate($s)
	{
		$this->setTimeZone();
		return date($s);
	}
	
	function getTaskToday()
	{		
		$dt = $this->getDate("Y-m-d");
		return $this->execquery("SELECT * FROM EASYTASKLIST WHERE WHENTODO='$dt' AND COMPLETED=0 ORDER BY ID ASC");		
	}
	
	function eventDone($id)
	{
		$sql = "UPDATE EASYTASKLIST SET COMPLETED=1 WHERE ID=$id";
		$result = $this->execquery($sql);
		if($result == False)
			return False;
		
		
		return True;
	}
	
	function getID()
	{
		$sql = "SELECT MAX(ID)+1 FROM EASYTASKLIST";
		$result = $this->execquery($sql);
		if($result==false)
			return 0;
		
		$row = $result->fetch_row();
		if($row ==False)
			return 0;
		
		return $row[0];
	}
	
	function saveEvent($id, $tname, $evdateyyyy, $evdatemm, $evdatedd, $completed)
	{
		$this->setTimeZone();
		
		$sql = "";
		$iyear= (int) $evdateyyyy;
		$imonth = (int) $evdatemm;
		$idate = (int) $evdatedd;
		$icompleted= (int) $completed;
		$iid = (int) $id;
		
		if(!checkdate($imonth, $idate, $iyear))
			return False;
		
		if($icompleted!=1 && $icompleted!=0)
			return False;
		
		if($iid<0)
			return False;
		
		$inewid= $this->getID();
		if($inewid==0)
			return False;
		
		if($iid>=$inewid)
			return False;
		
		$dt = date_create("$iyear-$imonth-$idate");
		$sdate= date_format($dt, "Y-m-d");
		
		if($id == 0)
		{
			$sql = "INSERT INTO EASYTASKLIST VALUES($inewid, '$sdate', '$tname', $icompleted)";
			$result = $this->execquery($sql);
			if($result==False)
				return False;
		}
		else if($id>0)
		{
			$sql = "UPDATE EASYTASKLIST SET WHENTODO='$sdate', TASKNAME='$tname', COMPLETED=$icompleted WHERE ID=$id";
			$result = $this->execquery($sql);
			if($result == False)
				return False;
		}
		else
		{
			return False;
		}
		return True;
	}
	
	
	function getRowforID($id)
	{
		$sql = "SELECT * FROM EASYTASKLIST WHERE ID=$id";
		$result = $this->execquery($sql);
		if($result == False)
			return False;
		if($result->num_rows != 1)
			return False;
		
		$row = $result->fetch_row();
		if($row == False)
			return False;
		return $row;
	}
	
	function getTodoDates()
	{
		$sql = "SELECT DISTINCT WHENTODO FROM EASYTASKLIST WHERE COMPLETED=0 order by WHENTODO desc";
		$result = $this->execquery($sql);
		if($result == False)
			return False;
		return $result;
	}
	
	function getTodoOfDate($dt)
	{
		$sql = "SELECT * FROM EASYTASKLIST WHERE COMPLETED=0 AND WHENTODO='$dt'";
		$result = $this->execquery($sql);
		if($result == False)
			return False;
		
		return $result;
	}
	
	function getTaskDoneToday()
	{		
		$dt = $this->getDate("Y-m-d");
		return $this->execquery("SELECT * FROM EASYTASKLIST WHERE WHENTODO='$dt' AND COMPLETED=1 ORDER BY ID ASC");		
	}

	function getDoneDates()
	{
		$sql = "SELECT DISTINCT WHENTODO FROM EASYTASKLIST WHERE COMPLETED=1 order by WHENTODO desc";
		$result = $this->execquery($sql);
		if($result == False)
			return False;
		return $result;
	}
	
	function getDoneOfDate($dt)
	{
		$sql = "SELECT * FROM EASYTASKLIST WHERE COMPLETED=1 AND WHENTODO='$dt'";
		$result = $this->execquery($sql);
		if($result == False)
			return False;
		
		return $result;
	}

	function eventUndone($id)
	{
		$sql = "UPDATE EASYTASKLIST SET COMPLETED=0 WHERE ID=$id";
		$result = $this->execquery($sql);
		if($result == False)
			return False;
		
		
		return True;
	}
	
	function clearDone()
	{
		$sql = "DELETE FROM EASYTASKLIST WHERE COMPLETED=1";
		$result = $this->execquery($sql);
		if($result == False)
			return False;
		
		return True;
	}
	
}

?>