<?php 
	//require_once("Connections/mainDB.php");
 ?>
<?php
if ($_POST['user']) {
	require_once("Connections/mainDB.php");
	$result = mysql_query("SELECT id FROM NeoStreams WHERE name='$_POST[user]' AND admpasswd='$_POST[pass]'");// or die("Couldn't query the user-database.");
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

// Start the login session
session_start();
echo "<title>Neo Stream Services - Automation Control Panel Login</title>";
// We've already added slashes and MD5'd the password
$_SESSION['user'] = $_POST['user'];
$_SESSION['pass'] = $_POST['pass'];

// All output text below this line will be displayed
// to the users that are authenticated. Since no text
// has been output yet, you could also use redirect
// the user to the next page using the header() function.
echo "Redirecting.  If this page does not change in 5 seconds, click <a 
href='http://shoutcp.neostreams.info/index.php'>here</a>.";
echo "<META HTTP-EQUIV=Refresh CONTENT='0; URL=http://shoutcp.neostreams.info/index.php'>";
//header ("Location: http://testing.rescuityonline.com/");
}

?><style type="text/css">
<!--
body {
	background-color: #FFFFFF;
	}
-->
</style>
