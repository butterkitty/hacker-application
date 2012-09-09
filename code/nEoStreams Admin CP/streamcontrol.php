<?php 
require_once("settings.php");
require_once("inc/checklogin.php");
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
if ($perms == 1) { echo "<br />INSUFFICIENT PERMISSIONS TO VIEW"; exit; }
//--------------------------------------------END OF PERMS
?>
<?php require_once("Connections/mainDB.php"); ?>
<?php
	if ($_POST['edited'] == "Submit")
	{// `start_date` = '". $_POST['start_date'] ."', 
		$db = "UPDATE `NeoStreams` SET `type` = '". $_POST['type'] ."', `config` = '". $_POST['config'] ."', `Notes` = '". $_POST['Notes'] ."', `renew_date` = '". $_POST['renew_date'] ."', `port` = '". $_POST['port'] ."', `name` = '". $_POST['name'] ."', `avkey` = '". $_POST['avkey'] ."', `ip` = '". $_POST['ip'] ."', `passwd` = '". $_POST['passwd'] ."', `admpasswd` = '". $_POST['admpasswd'] ."',`end_date` = '". $_POST['end_date'] ."', `cost` = '". $_POST['cost'] ."', `listeners` = '". $_POST['listeners'] ."', `days` = '". $_POST['days'] ."', `status` = '". $_POST['status'] ."', `region` = '". $_POST['region'] ."', `coowner` = '". $_POST['coowner'] ."', `email` = '". $_POST['email'] ."' WHERE `ip` = '" . $_POST['oldip'] ."' AND `port` ='". $_POST['oldport']."' AND `name` ='".$_POST['oldname']."'";
		$result = mysql_query($db);
		mysql_close($db);
	} 
	else if (!isset($_POST['ip'])) { header( 'Location: http://csrep.neostreams.org/find_user.php' ); }	
	$ip = $_POST['ip'];
	$port = $_POST['port'];
	$name = $_POST['name'];
	$db = "SELECT * FROM `NeoStreams` WHERE ";
	$db = $db."`ip` LIKE '%".$ip."%'";
	$db = $db." AND `port` LIKE '%".$port."%'";
	$db = $db." AND `name` LIKE '%".$name."%'";
	$result = mysql_query($db);
	$row = mysql_fetch_array($result)
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Editing SC/ICE - <?php echo $row['name']; ?> - <?php echo $row['ip']; ?>:<?php echo $row['port'];?></title>
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
.style1 {font-size: 10pt}
-->
</style></head>

<body class="oneColFixCtr">

<div id="container">
  <div id="mainContent">
  <form action="<?php echo $PHP_SELF;?>" method="post">
    <p>
      <input type="hidden" name="oldip" id="oldip" value="<?php echo $row['ip']; ?>"/> 
      <input type="hidden" name="oldport" id="oldport" value="<?php echo $row['port']; ?>"/>
      <input type="hidden" name="oldname" id="oldname" value="<?php echo $row['name']; ?>"/>
<center> Editing SC/ICE - <?php echo $row['name']; ?> - <?php echo $row['ip']; ?>:<?php echo $row['port'];?>    </center>
    </p>
    <p>&nbsp;</p>
    <table width="745" height="531" border="1" align="center">
      <tr>
        <td width="179"><div align="center" class="style1">Av-Key</div></td>
        <td width="170"><div align="center">
          <input type="text" name="avkey" id="avkey" accesskey="1" tabindex="1" value="<?php echo $row['avkey']; ?>"/>
        </div></td>
        <td width="47">&nbsp;</td>
        <td width="128"><div align="center" class="style1">Region</div></td>
        <td width="187"><div align="center">
          <select name="region" id="region" accesskey="2" tabindex="2">
<?php            if ($row['region'] == "US") { echo "<option value=\"US\">US</option> <option value=\"EU\">EU</option>"; }
  elseif ($row['region'] == "EU") { echo "<option value=\"EU\">EU</option> <option value=\"US\">US</option>"; }?>
          </select>
          </div></td>
      </tr>
      <tr>
        <td width="179"><div align="center"><span class="style1">Customer Name</span></div></td>
        <td width="170"><div align="center">
          <input type="text" name="name" id="name" accesskey="3" tabindex="3" value="<?php echo $row['name']; ?>" />
        </div></td>
        <td>&nbsp;</td>
        <td><div align="center" class="style1">Co-Owner</div></td>
        <td><div align="center">
          <input type="text" name="coowner" id="coowner" accesskey="4" tabindex="4" value="<?php echo $row['coowner']; ?>"/>
        </div></td>
      </tr>
      <tr>
        <td><div align="center"><span class="style1">Stream IP</span></div></td>
        <td><div align="center">
            <label></label>
            <input type="text" name="ip" id="ip" accesskey="5" tabindex="5" value="<?php echo $row['ip']; ?>"/>
        </div>
            <label></label></td>
        <td>&nbsp;</td>
        <td><div align="center" class="style1">E-Mail</div></td>
        <td><div align="center">
          <input type="text" name="email" id="email" accesskey="6" tabindex="6" value="<?php echo $row['email']; ?>"/>
        </div></td>
      </tr>
      <tr>
        <td><div align="center" class="style1">Stream Password</div></td>
        <td><div align="center">
            <label></label>
            <input type="text" name="passwd" id="passwd" accesskey="7" tabindex="7" value="<?php echo $row['passwd']; ?>"/>
        </div></td>
        <td>&nbsp;</td>
        <td><div align="center" class="style1">Stream Port</div></td>
        <td><div align="center">
          <input type="text" name="port" id="port" accesskey="7" tabindex="7" value="<?php echo $row['port']; ?>"/>
        </div></td>
      </tr>
      <tr>
        <td><div align="center"><span class="style1">Admin Password</span></div></td>
        <td><div align="center">
            <label></label>
            <input type="text" name="admpasswd" id="admpasswd" accesskey="8" tabindex="8" value="<?php echo $row['admpasswd']; ?>"/>
        </div></td>
        <td>&nbsp;</td>
        <td><div align="center" class="style1">Renewal Date</div></td>
        <td><div align="center">
        <?php echo $row['renew_date']; ?>
<!--          <input type="text" name="renew)date" id="renew_date" accesskey="8" tabindex="8" value="<?php echo $row['renew_date']; ?>"/> -->
        </div></td>
      </tr>
      <tr>
        <td><div align="center"><span class="style1">Purchase Date</span></div></td>
        <td><div align="center">
        <?php echo $row['start_date']; ?>
<!--          <input type="text" name="start_date" id="start_date" accesskey="9" tabindex="9" value="<?php echo $row['start_date']; ?>"/>-->
        </div></td>
        <td>&nbsp;</td>
        <td><div align="center" class="style1">Config Filename</div></td>
        <td><div align="center">
          <input type="text" name="config" id="config" accesskey="8" tabindex="8" value="<?php echo $row['config']; ?>"/>
        </div></td>
      </tr>
      <tr>
        <td><div align="center" class="style1">Expire Date</div></td>
        <td><div align="center">
          <input type="text" name="end_date" id="end_date" accesskey="10" tabindex="10" value="<?php echo $row['end_date']; ?>"/>
        </div></td>
        <td>&nbsp;</td>
        <td><div align="center" class="style1">Stream Type</div></td>
        <td><div align="center">
          <select name="type" id="type" accesskey="10" tabindex="10">
            <?php            if ($row['type'] == "SC") { echo "<option value=\"SC\">SC</option> <option value=\"ICE\">ICE</option> <option value=\"AUTO\">AUTO</option>"; }
  elseif ($row['type'] == "ICE") { echo "<option value=\"ICE\">ICE</option> <option value=\"SC\">SC</option> <option value=\"AUTO\">AUTO</option>"; }
  elseif ($row['type'] == "AUTO") { echo "<option value=\"AUTO\">AUTO</option> <option value=\"SC\">SC</option> <option value=\"ICE\">ICE</option>"; }?>
          </select>
        </div></td>
      </tr>
      <tr>
        <td><div align="center"><span class="style1">Cost</span></div></td>
        <td><div align="center">
          <input type="text" name="cost" id="cost" accesskey="11" tabindex="11" value="<?php echo $row['cost']; ?>"/>
        </div></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><div align="center"><span class="style1">Listeners</span></div></td>
        <td><div align="center">
          <input type="text" name="listeners" id="listeners" accesskey="12" tabindex="12" value="<?php echo $row['listeners']; ?>"/>
        </div></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><div align="center"><span class="style1">Days</span></div></td>
        <td><div align="center">
          <input type="text" name="days" id="days" accesskey="13" tabindex="13" value="<?php echo $row['days']; ?>"/>
        </div></td>
        <td>&nbsp;</td>
        <td><div align="center" class="style1">Notes</div></td>
        <td><div align="center">
          <input type="text" name="Notes" id="Notes" accesskey="8" tabindex="8" value="<?php echo $row['Notes']; ?>"/>
        </div></td>
      </tr>
      <tr>
        <td><div align="center" class="style1">Status</div></td>
        <td><div align="center">
          <select name="status" id="status" accesskey="14" tabindex="14">
<?php   
echo "<option value=\"".$row['status']."\">".$row['status']."</option>";
echo "<option value=\"RUNNING\">RUNNING</option> <option value=\"STOPPED\">STOPPED</option> <option value=\"FORSALE\">FORSALE</option> <option value=\"START\">START</option> <option value=\"STOP\">STOP</option> <option value=\"EXPIRED\">EXPIRED</option> <option value=\"DELETED\">DELETED</option>";
?>
          </div></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
    
<center>    
  <p>
    <input type="button" name="Refresh" id="Refresh" value="Refresh" accesskey="15" tabindex="15" onClick="window.location.reload()"/>
    <input type="submit" name="edited" id="edited" value="Submit" accesskey="16" tabindex="16" />
    
  </p>
</center>
  </form>

    <h1>&nbsp;</h1>
  <!-- end #mainContent --></div>
<!-- end #container --></div>
<?php mysql_close($db); ?>
</body>
</html>
