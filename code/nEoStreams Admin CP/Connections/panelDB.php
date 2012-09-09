<?php 
	$db = mysql_connect('xxx.xxx.xxx.xxx', 'CPuser', 'xxxxxxxxx') or die("Couldn't connect to the database.");
	mysql_select_db('admincontrolpanel') or die("Couldn't select the database");
	function getpageperms($page)
	{
		session_start();
		$paneldb = "SELECT * FROM `cp_pages` WHERE page = '".$page."'";
		$result = mysql_query($paneldb) or die(mysql_error());
		$panelsql = mysql_fetch_array($result);
		$perms = 0;
		
		if ($_SESSION['group'] == "Administrators") { $perms = 2; }
		else if ($_SESSION['group'] == $panelsql['group']) { $perms = 2; }
		else if ($_SESSION['perms'] >= $panelsql['fullperms']) { $perms = 2; }
		else if ($_SESSION['perms'] >= $panelsql['viewperms']) { $perms = 1; }	
		return $perms;
	}
?>