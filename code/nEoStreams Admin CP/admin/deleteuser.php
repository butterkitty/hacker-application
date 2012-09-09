<?php
require_once("inc/checkadminlogin.php");
require_once("../settings.php");
require_once("Connections/panelDB.php");

	if ($_POST['sure'] == "Yes")
	{
		$db = "DELETE FROM `cp_login` WHERE login='".$_POST['login']."'";
		if (!mysql_query($db))
		  {
		  die('Error: ' . mysql_error());
		  }
		echo "1 record deleted <br />";
		echo "Redirecting to main admin page.  If this page does not change in 5 seconds, click <a href='http://csrep.neostreams.org/admin'>here</a>.";
		echo "<META HTTP-EQUIV=Refresh CONTENT='5; URL=http://csrep.neostreams.org/admin'>";
		die();
		
	}
	else if ($_POST['sure'] == "No") 
	{
		echo "Redirecting to main admin page.  If this page does not change in 5 seconds, click <a href='http://csrep.neostreams.org/admin'>here</a>.";
		echo "<META HTTP-EQUIV=Refresh CONTENT='5; URL=http://csrep.neostreams.org/admin'>";
		die(); 
	}
	echo "Are you sure you wish to delete ". $_POST['login'] ." out of the login table?";
	echo "<br />Remember that this is PERMANENT!!!"
?>

<center>
  <form id="deleteuser" name="deleteuser" method="post" action="deleteuser.php">
  <input name="login" type="hidden" value="<?php echo $_POST['login'];?>" />
<input type="submit" name="sure" id="sure" value="No" accesskey="1" tabindex="1" />
<input type="submit" name="sure" id="sure" value="Yes" accesskey="2" tabindex="2" />
  </form>
</center>