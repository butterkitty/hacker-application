<?php
	session_start();
	if ($debug == 1)
	{
		echo "<br />User: ". $_SESSION['user'];
		echo "<br />User Group: ". $_SESSION['group'];
		echo "<br />User Perms: ". $_SESSION['perms'];
		echo "<br />";
	}
	if ($_SESSION['group'] != "Administrators")
	{
		echo "NO ACCESS ALLOWED";
		echo "Redirecting to login page.  If this page does not change in 10 seconds, click <a href='http://csrep.neostreams.org/login.php'>here</a>.";
		echo "<META HTTP-EQUIV=Refresh CONTENT='10; URL=http://csrep.neostreams.org/login.php'>";
		die();
	}
?>