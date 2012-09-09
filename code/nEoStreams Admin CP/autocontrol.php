<?php require_once("inc/checklogin.php"); ?>
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
if ($perms != 2) { echo "<br />INSUFFICIENT PERMISSIONS TO VIEW"; exit; }
//--------------------------------------------END OF PERMS
?>
<?php require_once("Connections/mainDB.php"); ?>
<?php
	if ($_POST['edited'] == "Submit")
	{
		$db = "UPDATE `NeoStreams` SET `port` = '". $_POST['port'] ."', `name` = '". $_POST['name'] ."', `avkey` = '". $_POST['avkey'] ."', `ip` = '". $_POST['ip'] ."', `passwd` = '". $_POST['passwd'] ."', `admpasswd` = '". $_POST['admpasswd'] ."', `start_date` = '". $_POST['start_date'] ."', `end_date` = '". $_POST['end_date'] ."', `cost` = '". $_POST['cost'] ."', `listeners` = '". $_POST['listeners'] ."', `region` = '". $_POST['region'] ."', `coowner` = '". $_POST['coowner'] ."', `email` = '". $_POST['email'] ."', `notes` = '". $_POST['notes'] ."', `fade` = '". $_POST['fade'] ."', `shuffle` = '". $_POST['shuffle'] ."', `streamname` = '". $_POST['streamname'] ."', `streamurl` = '". $_POST['streamurl'] ."', `autostatus` = '". $_POST['autostatus'] ."', `autoquota` = '". $_POST['autoquota'] ."', `autologin` = '". $_POST['autologin'] ."', `autostream` = '". $_POST['autostream'] ."' WHERE `ip` = '" . $_POST['oldip'] ."' AND `port` ='". $_POST['oldport']."' AND `name` ='".$_POST['oldname']."'";;
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
<title>Editing Auto - <?php echo $row['name']; ?> - <?php echo $row['ip']; ?>:<?php echo $row['port'];?></title>
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
  <form action="<?php echo $PHP_SELF;?>" method="post">
  <input type="hidden" name="oldip" id="oldip" value="<?php echo $row['ip']; ?>"/> 
  <input type="hidden" name="oldport" id="oldport" value="<?php echo $row['port']; ?>"/>   
        <input type="hidden" name="oldname" id="oldname" value="<?php echo $row['name']; ?>"/>
<center> 
  <p>Editing AUTO - <?php echo $row['name']; ?> - <?php echo $row['ip']; ?>:<?php echo $row['port'];?>    </p>
  <p>&nbsp;</p>
</center>
<table width="748" height="421" border="1">
      <tr>
        <td width="130"><div align="center" class="style2">
          <div align="center">Av-Key</div>
        </div></td>
        <td width="188"><div align="center"><input type="text" name="avkey" id="avkey" accesskey="1" tabindex="1" value="<?php echo $row['avkey']; ?>"/></div></td>
        <td width="7"><span class="style2"></span></td>
        <td width="107"><div align="center" class="style2">AutoLogin</div></td>
        <td width="198"><div align="center"><input type="text" name="autologin" id="autologin" accesskey="1" tabindex="1" value="<?php echo $row['autologin']; ?>"/></div></td>
      </tr>
      <tr>
        <td><div align="center" class="style2">Name</div></td>
        <td><div align="center"><input type="text" name="name" id="name" accesskey="3" tabindex="3" value="<?php echo $row['name']; ?>" /></div></td>
        <td><span class="style2"></span></td>
        <td><div align="center" class="style2">Auto Quota</div></td>
        <td><div align="center"><input type="text" name="autoquota" id="autoquota" accesskey="1" tabindex="1" value="<?php echo $row['autoquota']; ?>"/></div></td>
      </tr>
      <tr>
        <td><div align="center" class="style2">Ip-Address</div></td>
        <td><div align="center"><input type="text" name="ip" id="ip" accesskey="5" tabindex="5" value="<?php echo $row['ip']; ?>"/></div></td>
        <td><span class="style2"></span></td>
        <td><div align="center" class="style2">Auto Status</div></td>
        <td><div align="center"><select name="autostatus" id="autostatus" accesskey="14" tabindex="14">
<?php   
echo "<option value=\"".$row['autostatus']."\">".$row['autostatus']."</option>";
echo "<option value=\"Running\">Running</option> <option value=\"Stopped\">Stopped</option> <option value=\"Setup\">Setup</option> <option value=\"Start\">Start</option> <option value=\"Stop\">Stop</option> <option value=\"ReloadPL\">EXPIRED</option> <option value=\"UpdatePL\">UpdatePL</option>";
?>
          </select></div></td>
      </tr>
      <tr>
        <td><div align="center" class="style2">Password</div></td>
        <td><div align="center"><input type="text" name="passwd" id="passwd" accesskey="7" tabindex="7" value="<?php echo $row['passwd']; ?>"/></div></td>
        <td><span class="style2"></span></td>
        <td><div align="center" class="style2">Stream Name</div></td>
        <td><div align="center"><input type="text" name="streamname" id="streamname" accesskey="1" tabindex="1" value="<?php echo $row['streamname']; ?>"/></div></td>
      </tr>
      <tr>
        <td><div align="center" class="style2">Admin Password</div></td>
        <td><div align="center"><input type="text" name="admpasswd" id="admpasswd" accesskey="8" tabindex="8" value="<?php echo $row['admpasswd']; ?>"/></div></td>
        <td><span class="style2"></span></td>
        <td><div align="center" class="style2">Stream URL</div></td>
        <td><div align="center"><input type="text" name="streamurl" id="streamurl" accesskey="8" tabindex="8" value="<?php echo $row['streamurl']; ?>"/></div></td>
      </tr>
      <tr>
        <td><div align="center" class="style2">Cost</div></td>
        <td><div align="center"><input type="text" name="cost" id="cost" accesskey="11" tabindex="11" value="<?php echo $row['cost']; ?>"/></div></td>
        <td><span class="style2"></span></td>
        <td><div align="center" class="style2">Shuffle</div></td>
        <td><div align="center"><select name="shuffle" id="shuffle" accesskey="2" tabindex="2">
<?php            if ($row['shuffle'] == "1") { echo "<option value=\"1\">Y</option> <option value=\"0\">N</option>"; }
  elseif ($row['shuffle'] == "0") { echo "<option value=\"0\">N</option> <option value=\"1\">Y</option>"; }?>
          </select></div></td>
      </tr>
      <tr>
        <td><div align="center" class="style2">Listeners</div></td>
        <td><div align="center"><input type="text" name="listeners" id="listeners" accesskey="12" tabindex="12" value="<?php echo $row['listeners']; ?>"/></div></td>
        <td><span class="style2"></span></td>
        <td><div align="center" class="style2">Fade</div></td>
        <td><div align="center"><select name="fade" id="fade" accesskey="2" tabindex="2">
		<?php
        echo "<option value=\"".$row['fade']."\">".$row['fade']."</option>";
		echo "<option value=\"0\">0</option> <option value=\"1\">1</option> <option value=\"2\">2</option> <option value=\"3\">3</option> <option value=\"4\">4</option> <option value=\"5\">5</option> <option value=\"6\">6</option> <option value=\"7\">7</option> <option value=\"8\">8</option> <option value=\"9\">9</option> <option value=\"10\">10</option>";
  ?>
  </select></div></td>
      </tr>
      <tr>
        <td><div align="center" class="style2">Start-Date</div></td>
        <td><div align="center"><?php echo $row['start_date']; ?>
        <!-- <input type="text" name="start_date" id="start_date" accesskey="9" tabindex="9" value="<?php echo $row['start_date']; ?>"/>--></div></td>
        <td><span class="style2"></span></td>
        <td><div align="center" class="style2">Notes</div></td>
        <td><div align="center"><input type="text" name="notes" id="notes" accesskey="10" tabindex="10" value="<?php echo $row['Notes']; ?>"/></div></td>
      </tr>
      <tr>
        <td><div align="center" class="style2">End-Date</div></td>
        <td><div align="center">
          <input type="text" name="end_date" id="end_date" accesskey="10" tabindex="10" value="<?php echo $row['end_date']; ?>"/>
        </div></td>
        <td><span class="style2"></span></td>
        <td><div align="center" class="style2">Co-Owner</div></td>
        <td><div align="center"><input type="text" name="coowner" id="coowner" accesskey="4" tabindex="4" value="<?php echo $row['coowner']; ?>"/></div></td>
      </tr>
      <tr>
        <td><div align="center" class="style2">Status</div></td>
        <td><div align="center"> <select name="status" id="status" accesskey="14" tabindex="14">
<?php   
echo "<option value=\"".$row['status']."\">".$row['status']."</option>";
echo "<option value=\"RUNNING\">RUNNING</option> <option value=\"STOPPED\">STOPPED</option> <option value=\"FORSALE\">FORSALE</option> <option value=\"START\">START</option> <option value=\"STOP\">STOP</option> <option value=\"EXPIRED\">EXPIRED</option> <option value=\"DELETED\">DELETED</option>";
?></select></div></td>
        <td><span class="style2"></span></td>
        <td><div align="center" class="style2">Region</div></td>
        <td><div align="center">         <select name="region" id="region" accesskey="2" tabindex="2">
<?php            if ($row['region'] == "US") { echo "<option value=\"US\">US</option> <option value=\"EU\">EU</option>"; }
  elseif ($row['region'] == "EU") { echo "<option value=\"EU\">EU</option> <option value=\"US\">US</option>"; }?>
          </select></div></td>
      </tr>
      <tr>
        <td><div align="center" class="style2">Auto-Stream</div></td>
        <td><div align="center"><select name="autostream" id="autostream" accesskey="2" tabindex="2">
<?php            if ($row['autostream'] == "Y") { echo "<option value=\"Y\">Y</option> <option value=\"N\">N</option>"; }
  elseif ($row['autostream'] == "N") { echo "<option value=\"N\">N</option> <option value=\"Y\">Y</option>"; }?>
          </select></div></td>
        <td><span class="style2"></span></td>
        <td><div align="center" class="style2">E-Mail</div></td>
        <td><div align="center"><input type="text" name="email" id="email" accesskey="6" tabindex="6" value="<?php echo $row['email']; ?>"/></div></td>
      </tr>
      <tr>
        <td><div align="center" class="style2">Stream Port</div></td>
        <td><div align="center">
          <div align="center">
            <input type="text" name="port" id="port" accesskey="7" tabindex="7" value="<?php echo $row['port']; ?>"/>
          </div>
        </div></td>
        <td><div align="center"></div></td>
        <td><div align="center" class="style2">
          <div align="center" class="style2">Renewal Date</div>
        </div></td>
        <td><div align="center">
          <div align="center"> <?php echo $row['renew_date']; ?>
              <!--          <input type="text" name="renew)date" id="renew_date" accesskey="8" tabindex="8" value="<?php echo $row['renew_date']; ?>"/> -->
          </div>
        </div></td>
      </tr>
      <tr>
        <td><div align="center" class="style2"></div></td>
        <td><div align="center"></div></td>
        <td><div align="center"></div></td>
        <td><div align="center" class="style2"></div></td>
        <td><div align="center"></div></td>
      </tr>
    </table>
<h1>
<center>
<p>
      <input type="button" name="Refresh" id="Refresh" value="Refresh" accesskey="15" tabindex="15" onclick="window.location.reload()"/>
      <input type="submit" name="edited" id="edited" value="Submit" accesskey="16" tabindex="16" />
</p>
      
</center>
</h1>
  <!-- end #mainContent --></div>
<!-- end #container --></div>
</body>
</html>
