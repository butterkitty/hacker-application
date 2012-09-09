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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
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
.style2 {font-size: 10; }
.style3 {font-size: 10px; }
-->
</style></head>

<body class="oneColFixCtr">

<div id="container">
  <div id="mainContent">
    <table width="745" height="353" border="1">
      <tr>
        <td width="119"><div align="center" class="style1">VZID</div></td>
        <td width="174"><div align="center" class="style1">++++</div></td>
        <td width="58"><div align="center"><span class="style1"><span class="style2"><span class="style3"><span class="style1"></span></span></span></span></div></td>
        <td width="137"><div align="center" class="style1">Bitrate</div></td>
        <td width="223"><div align="center" class="style1">*******</div></td>
      </tr>
      <tr>
        <td><div align="center" class="style1">Av-Key</div></td>
        <td><div align="center" class="style1">***</div></td>
        <td><div align="center"><span class="style1"><span class="style2"><span class="style3"><span class="style1"></span></span></span></span></div></td>
        <td><div align="center" class="style1">BW-Allowance</div></td>
        <td><div align="center" class="style1">*********</div></td>
      </tr>
      <tr>
        <td><div align="center" class="style1">Name</div></td>
        <td><div align="center" class="style1">*****</div></td>
        <td><div align="center"><span class="style1"><span class="style2"><span class="style3"><span class="style1"></span></span></span></span></div></td>
        <td><div align="center" class="style1">Days</div></td>
        <td><div align="center" class="style1">*******</div></td>
      </tr>
      <tr>
        <td><div align="center" class="style1">IP ADDY</div></td>
        <td><div align="center" class="style1">dropdown</div></td>
        <td><div align="center"><span class="style1"><span class="style2"><span class="style3"><span class="style1"></span></span></span></span></div></td>
        <td><div align="center" class="style1">Start-Date</div></td>
        <td><div align="center" class="style1">+++++</div></td>
      </tr>
      <tr>
        <td><div align="center" class="style1">PASS</div></td>
        <td><div align="center" class="style1">*****</div></td>
        <td><div align="center"><span class="style1"><span class="style2"><span class="style3"><span class="style1"></span></span></span></span></div></td>
        <td><div align="center" class="style1">End-Date</div></td>
        <td><div align="center" class="style1">*****</div></td>
      </tr>
      <tr>
        <td><div align="center" class="style1">FTPUSER</div></td>
        <td><div align="center" class="style1">*****</div></td>
        <td><div align="center"><span class="style1"><span class="style2"><span class="style3"><span class="style1"></span></span></span></span></div></td>
        <td><div align="center" class="style1">Vz-Status</div></td>
        <td><div align="center" class="style1">dropdown</div></td>
      </tr>
      <tr>
        <td><div align="center" class="style1">FTPpass</div></td>
        <td><div align="center" class="style1">******</div></td>
        <td><div align="center"><span class="style1"><span class="style2"><span class="style3"><span class="style1"></span></span></span></span></div></td>
        <td><div align="center" class="style1">Region</div></td>
        <td><div align="center" class="style1">dropdown</div></td>
      </tr>
      <tr>
        <td><div align="center" class="style1">COST</div></td>
        <td><div align="center" class="style1">******</div></td>
        <td><div align="center"><span class="style1"><span class="style2"><span class="style3"><span class="style1"></span></span></span></span></div></td>
        <td><div align="center" class="style1">Co-owner</div></td>
        <td><div align="center" class="style1">******</div></td>
      </tr>
      <tr>
        <td><div align="center" class="style1">LISTENERS</div></td>
        <td><div align="center" class="style1">*****</div></td>
        <td><div align="center"><span class="style1"><span class="style2"><span class="style3"><span class="style1"></span></span></span></span></div></td>
        <td><div align="center" class="style1">E-Mail</div></td>
        <td><div align="center" class="style1">******</div></td>
      </tr>
      <tr>
        <td><div align="center" class="style1">HDQUOTA</div></td>
        <td><div align="center" class="style1">*****</div></td>
        <td><div align="center"><span class="style1"><span class="style2"><span class="style3"><span class="style1"></span></span></span></span></div></td>
        <td><div align="center" class="style1">Notes</div></td>
        <td><div align="center" class="style1">******</div></td>
      </tr>
    </table>
    <blockquote>&nbsp;</blockquote>
    <h1>&nbsp;</h1>
  <!-- end #mainContent --></div>
<!-- end #container --></div>
</body>
</html>
