<?php
	require_once("../settings.php");
	require_once("inc/checkadminlogin.php");


require_once("Connections/panelDB.php");

$login = $_GET['login'];
$passwd = $_GET['passwd'];
$perms = $_GET['perms'];
$group = $_GET['group'];

$db="SELECT * FROM `cp_login` WHERE ";
	$db = $db."`login` LIKE '%".$login."%'";

if($passwd != "")
{
	$db = $db." AND `passwd` LIKE '%".$passwd."%'";
}
if ($perms != -1) { 
	if($perms != "")
	{
		$db = $db." AND `perms` = '".$perms."'";
	}
}
if ($group != -1)
{
	if($group != "")
	{
		$db = $db." AND `group` LIKE '%".$group."%'";
	}
}
$result = mysql_query($db);

echo "<table border='1'>
<tr>
<th>EDIT</th>
<th>Login</th>
<th>Password</th>
<th>Perms</th>
<th>Group</th>
<th>DELETE</th>
</tr>";
while($row = mysql_fetch_array($result))
 {
 echo "<tr>";
 echo "<td>";
 echo "<div align=\"center\"><form action=\"edituser.php\" method=\"post\"> <input type=\"hidden\" name=\"login\" value=\"". $row['login'] ."\"/><input type=\"submit\" name=\"EDIT\" value=\"EDIT\"/></form></div>";
 echo "</td>";
 echo "<td>" . $row['login'] . "</td>";
 echo "<td>" . $row['passwd'] . "</td>";
 echo "<td>" . $row['perms'] . "</td>";
 echo "<td>" . $row['group'] . "</td>";
 echo "<td>";
 echo "<div align=\"center\"><form action=\"deleteuser.php\" method=\"post\"> <input type=\"hidden\" name=\"login\" value=\"". $row['login'] ."\"/><input type=\"submit\" name=\"DELETE\" value=\"DELETE\"/></form></div>";
 echo "</td>";
 echo "</tr>";
 }
echo "</table>";
?>
