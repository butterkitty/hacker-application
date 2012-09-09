<?php
require_once("settings.php");
//-------------------------------------------BEGINNING OF PERMS
session_start();
require_once("Connections/panelDB.php");
$perms = getpageperms($_SERVER['PHP_SELF']);


if ($debug == 1)
{
	echo "<br />User: ". $_SESSION['user'];
	echo "<br />User Group: ". $_SESSION['group'];
	echo "<br />User Perms: ". $_SESSION['perms'];
	echo "<br />Current Allowed Perms: ".$perms;
}
if ($perms == 0) { echo "<br />INSUFFICIENT PERMISSIONS TO VIEW"; exit; }
//--------------------------------------------END OF PERMS
require_once("Connections/mainDB.php");

$name = $_GET['name'];
$key = $_GET['key'];
$type = $_GET['type'];
$ip = $_GET['ip'];
$port = $_GET['port'];
$region = $_GET['region'];
$coowner = $_GET['coowner'];
$email = $_GET['email'];
$db="SELECT * FROM `NeoStreams` WHERE ";
/*if($name != "")
{*/
	$db = $db."`name` LIKE '%".$name."%'";
//}
if($key != "")
{
	$db = $db." AND `avkey` LIKE '%".$key."%'";
}
if($type != "" && $type != "ANY")
{
	$db = $db." AND `type` = '".$type."'";
}
if($ip != "")
{
	$db = $db." AND `ip` LIKE '%".$ip."%'";
}
if($port != "")
{
	$db = $db." AND `port` LIKE '%".$port."%'";
}
if($region != "" && $region != "ANY")
{
	$db = $db." AND `region` = '".$region."'";
}
if($coowner != "")
{
	$db = $db." AND `coowner` LIKE '%".$coowner."%'";
}
if($email != "")
{
	$db = $db." AND `email` LIKE '%".$email."%'";
}
//$db = $db." AND `autostream` = 'Y'";
$result = mysql_query($db);

echo "<table border='1'>
<tr>
<th>EDIT</th>
<th>Name</th>
<th>AvKey</th>
<th>Type</th>
<th>Region</th>
<th>Stream IP</th>
<th>Port</th>
<th>Stream Pass</th>
<th>Admin Pass</th>
<th>Purchase Date</th>
<th>Expire Date</th>
<th>Cost</th>
<th>Listeners</th>
<th>Days</th>
<th>Status</th>
<th>Co-Owner</th>
<th>Email</th>
</tr>";
while($row = mysql_fetch_array($result))
 {
 echo "<tr>";
 echo "<td>";
 if ($perms == 2) 
 {
	 echo "<form action=\"";
	 if ($row['type'] == "AUTO") { echo "autocontrol.php\""; }
	 else { echo "streamcontrol.php\""; }
	 echo " method=\"post\"> <input type=\"hidden\" name=\"ip\" value=\"". $row['ip'] ."\"/> <input type=\"hidden\" name=\"port\" value=\"". $row['port'] ."\"/><input type=\"hidden\" name=\"name\" value=\"". $row['name'] ."\"/><input type=\"submit\" name=\"EDIT\" value=\"EDIT\" /></form>";
 }
  else { echo "INSUF PERMS"; }
 echo "</td>";
 echo "<td>" . $row['name'] . "</td>";
 echo "<td>" . $row['avkey'] . "</td>";
 echo "<td>" . $row['type'] . "</td>";
 echo "<td>" . $row['region'] . "</td>";
 echo "<td>" . $row['ip'] . "</td>";
 echo "<td>" . $row['port'] . "</td>";
 echo "<td>" . $row['passwd'] . "</td>";
 echo "<td>" . $row['admpasswd'] . "</td>";
 echo "<td>" . $row['start_date'] . "</td>";
 echo "<td>" . $row['end_date'] . "</td>";
 echo "<td>" . $row['cost'] . "</td>";
 echo "<td>" . $row['listeners'] . "</td>";
 echo "<td>" . $row['days'] . "</td>";
 echo "<td>" . $row['status'] . "</td>";
 echo "<td>" . $row['coowner'] . "</td>";
if ($row['email'] != "") { echo "<td>" . $row['email'] . "</td>"; }
else { echo "<td> None </td>";}
 echo "</tr>";
 }
echo "</table>";

mysql_close($db);
?>
