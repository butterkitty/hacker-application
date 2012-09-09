<?php 
require_once("inc/checkadminlogin.php");
require_once("../settings.php");
require_once("Connections/panelDB.php");

	if ($_POST['edited'] == "Submit")
	{
		$db = "UPDATE `cp_login` SET `login` = '". $_POST['login'] ."', `passwd` = '". $_POST['passwd'] ."', `perms` = '". $_POST['perms'] ."', `group` = '". $_POST['group'] ."' WHERE `login` = '" . $_POST['oldlogin'] ."'";
		$result = mysql_query($db);
	} 
	else if (!isset($_POST['login'])) { header( 'Location: http://csrep.neostreams.org/admin/editadminusers.php' ); }	
	$login = $_POST['login'];
	$db = "SELECT * FROM `cp_login` WHERE ";
	$db = $db."`login` LIKE '%".$login."%'";
	$result = mysql_query($db);
	$row = mysql_fetch_array($result)
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Editing CP User- <?php echo $row['login']; ?></title>
<style type="text/css">
<!--
body {
	font: 100% Verdana, Arial, Helvetica, sans-serif;
	background: #666666;
	margin: 0; /* it's good practice to zero the margin and padding of the body element to account for differing browser defaults */
	padding: 0;
	text-align: center; /* this centers the container in IE 5* browsers. The text is then set to the left aligned default in the #container selector */
	color: #000000;
}
.oneColFixCtr #container {
	width: 780px;  /* using 20px less than a full 800px width allows for browser chrome and avoids a horizontal scroll bar */
	background: #FFFFFF;
	margin: 0 auto; /* the auto margins (in conjunction with a width) center the page */
	border: 1px solid #000000;
	text-align: left; /* this overrides the text-align: center on the body element. */
}
.oneColFixCtr #mainContent {
	padding: 0 20px; /* remember that padding is the space inside the div box and margin is the space outside the div box */
}
.style1 {font-size: 10}
.style2 {font-size: 10pt}
-->
</style></head>

<body class="oneColFixCtr">

<div id="container">
  <div id="mainContent">
  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
  <input type="hidden" name="oldlogin" id="oldlogin" value="<?php echo $row['login']; ?>"/> 
    <table width="748" height="75" border="1">
      <tr>
        <td width="130" height="35"><div align="center" class="style2">
          <div align="center">Login</div>
        </div></td>
        <td width="188"><div align="center"><input type="text" name="login" id="login" accesskey="1" tabindex="1" value="<?php echo $row['login']; ?>"/></div></td>
        <td width="7"><span class="style2"></span></td>
        <td width="107"><div align="center" class="style2">Password</div></td>
        <td width="198"><div align="center"><input type="text" name="passwd" id="passwd" accesskey="2" tabindex="2" value="<?php echo $row['passwd']; ?>"/></div></td>
      </tr>
      <tr>
        <td height="32"><div align="center" class="style2">Perms</div></td>
        <td><div align="center">
          <select name="perms" id="perms" accesskey="3" tabindex="3">
            <?php
			$perms = "";   
			if ($row['perms'] == 100)
			{
				$perms = "Admin";
			}
			else if ($row['perms'] == 75)
			{
				$perms = "Full";
			}
			else if ($row['perms'] == 50)
			{
				$perms = "Read";
			}
			else if ($row['perms'] == 0)
			{
				$perms = "None";
			}
			
echo "<option value=\"".$row['perms']."\">". $perms ."</option>";
echo "<option value=\"100\">Admin</option> <option value=\"75\">Full</option> <option value=\"50\">Read</option> <option value=\"0\">None</option>";
?>
          </select></div>
        <td><span class="style2"></span></td>
        <td><div align="center" class="style2">Group</div></td>
        <td><div align="center">
          <select name="group" id="group" accesskey="4" tabindex="4">
            <?php   
echo "<option value=\"".$row['group']."\">".$row['group']."</option>";
echo "<option value=\"Administrators\">Administrators</option> <option value=\"Managers\">Managers</option> <option value=\"Trainees\">Trainees</option>";
?>
          </select></div></td>
      </tr>
    </table>
    <h1>
<center>
<p>
      <input type="button" name="Refresh" id="Refresh" value="Refresh" accesskey="5" tabindex="5" onclick="window.location.reload()"/>
      <input type="submit" name="edited" id="edited" value="Submit" accesskey="6" tabindex="6" />
</p>
<?php include("footer.php"); ?>
</center>
</h1>
</body>
</html>
