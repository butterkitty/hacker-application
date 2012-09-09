<?php
if ($_POST['user']) {
	require_once("Connections/panelDB.php");
	$result = mysql_query("SELECT count(id) FROM cp_login WHERE login='".$_POST[user]."' AND passwd='".$_POST[pass]."'") or die("Couldn't query the user-database.");
	$num = mysql_num_rows($result);
}
if (!$num) {

// When the query didn't return anything,
// display the login form.
echo "<title>Neo Stream Services - Automation Control Panel Login</title>";
echo "<h3>&nbsp;</h3>
<table width='271' border='2' align='center'>
  <tr>
    <td width='259'><h3 align='center'>NeoStream Control Panel Login</h3>
      <form action='$_SERVER[PHP_SELF]' method='post'>
        <div align='center'>Username:
          <input type='text' name='user' />
          <br />
        Password:
        <input type='password' name='pass' />
        <br />
        <br />
        <input type='submit' value='Login' />
        </div>
      </form>
     </td>
  </tr>
</table>";

} else {
require_once("Connections/panelDB.php");
$paneldb = "SELECT * FROM `cp_login` WHERE login = '".$_POST['user']."' AND passwd = '".$_POST['pass']."'";
$result = mysql_query($paneldb);
$panelsql = mysql_fetch_array($result);

// Start the login session
session_start();
echo "<title>Neo Stream Services - Automation Control Panel Login</title>";

$_SESSION['user'] = $_POST['user'];
$_SESSION['pass'] = $_POST['pass'];
$_SESSION['perms'] = $panelsql['perms'];
$_SESSION['group'] = $panelsql['group'];


// All output text below this line will be displayed
// to the users that are authenticated. Since no text
// has been output yet, you could also use redirect
// the user to the next page using the header() function.
echo "Redirecting.  If this page does not change in 5 seconds, click <a href='http://csrep.neostreams.org/'>here</a>.";
echo "<META HTTP-EQUIV=Refresh CONTENT='0; URL=http://csrep.neostreams.org/'>";
//http://csrep.neostreams.org/
}

?><style type="text/css">
<!--
body {
	background-color: #FFFFFF;
	}
-->
</style>
