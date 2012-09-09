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
if ($perms == 0) { echo "<br />INSUFFICIENT PERMISSIONS TO VIEW"; exit; }
//--------------------------------------------END OF PERMS
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>nEoStreams Admin Control Panel</title>
<style type="text/css"> 
<!-- 
body  {
	font: 100% Verdana, Arial, Helvetica, sans-serif;
	background: #666666;
	margin: 0; /* it's good practice to zero the margin and padding of the body element to account for differing browser defaults */
	padding: 0;
	text-align: center; /* this centers the container in IE 5* browsers. The text is then set to the left aligned default in the #container selector */
	color: #000000;
}
.twoColFixLtHdr #container {
	width: 950px;  /* using 20px less than a full 800px width allows for browser chrome and avoids a horizontal scroll bar */
	background: #FFFFFF; /* the auto margins (in conjunction with a width) center the page */
	border: 1px solid #000000;
	text-align: left; /* this overrides the text-align: center on the body element. */
	margin-top: 0;
	margin-right: auto;
	margin-bottom: 0;
	margin-left: auto;
} 
.twoColFixLtHdr #header { 
	background: #DDDDDD; 
	padding: 0 10px 0 20px;  /* this padding matches the left alignment of the elements in the divs that appear beneath it. If an image is used in the #header instead of text, you may want to remove the padding. */
} 
.twoColFixLtHdr #header h1 {
	margin: 0; /* zeroing the margin of the last element in the #header div will avoid margin collapse - an unexplainable space between divs. If the div has a border around it, this is not necessary as that also avoids the margin collapse */
	padding: 10px 0; /* using padding instead of margin will allow you to keep the element away from the edges of the div */
}
.twoColFixLtHdr #sidebar1 {
	float: left; /* since this element is floated, a width must be given */
	width: 150px; /* the actual width of this div, in standards-compliant browsers, or standards mode in Internet Explorer will include the padding and border in addition to the width */
	background: #EBEBEB;
	padding-top: 15px;
	padding-right: 10px;
	padding-bottom: 15px;
	padding-left: 20px;
}
.twoColFixLtHdr #mainContent {
	margin-top: 0;
	margin-right: 0;
	margin-bottom: 0;
	margin-left: 165px;
	padding-top: 0;
	padding-right: 20px;
	padding-bottom: 0;
	padding-left: 20px;
} 
.twoColFixLtHdr #footer { 
	padding: 0 10px 0 20px; /* this padding matches the left alignment of the elements in the divs that appear above it. */
	background:#DDDDDD; 
} 
.twoColFixLtHdr #footer p {
	margin: 0; /* zeroing the margins of the first element in the footer will avoid the possibility of margin collapse - a space between divs */
	padding: 10px 0; /* padding on this element will create space, just as the the margin would have, without the margin collapse issue */
}
.fltrt { /* this class can be used to float an element right in your page. The floated element must precede the element it should be next to on the page. */
	float: right;
	margin-left: 8px;
}
.fltlft { /* this class can be used to float an element left in your page */
	float: left;
	margin-right: 8px;
}
.clearfloat { /* this class should be placed on a div or break element and should be the final element before the close of a container that should fully contain a float */
	clear:both;
    height:0;
    font-size: 1px;
    line-height: 0px;
}
.style1 {font-size: 10pt}
--> 
</style>
<!--[if IE 5]>
<style type="text/css"> 
/* place css box model fixes for IE 5* in this conditional comment */
.twoColFixLtHdr #sidebar1 { width: 230px; }
</style>
<![endif]--><!--[if IE]>
<style type="text/css"> 
/* place css fixes for all versions of IE in this conditional comment */
.twoColFixLtHdr #sidebar1 { padding-top: 30px; }
.twoColFixLtHdr #mainContent { zoom: 1; }
/* the above proprietary zoom property gives IE the hasLayout it needs to avoid several bugs */
</style>
<![endif]--></head>

<body class="twoColFixLtHdr">

<div id="container">
  <div id="header">
    <h1 align="center"><img src="images/bannercontrolpanel.jpg" width="741" height="74" /></h1>
  <!-- end #header --></div>
  <div id="sidebar1">
    <table width="155" height="278" border="0">
      <tr>
        <td height="67"><div align="center">
          <p class="style1"><a href="find_user.php" target="whatever"><img src="images/shoutice.png" width="141" height="47" border="0"/></a></p>
        </div></td>
      </tr>
      <tr>
        <td height="72"><div align="center" class="style1"><a href="find_user.php" target="whatever"><img src="images/automated.png" width="141" height="47" border="0"/></a></div></td>
      </tr>
      <tr>
        <td height="76"><div align="center" class="style1"><img src="images/video.png" width="141" height="47" /></div></td>
      </tr>
      <tr>
        <td height="27"><div align="center" class="style1"><img src="images/serverstatus.png" width="141" height="47" /></div></td>
      </tr>
    </table>
    <h3>&nbsp;</h3>
  <!-- end #sidebar1 --></div>
  <div id="mainContent">
    <iframe src="start.php" width="780" height="460" name="whatever" frameborder="0" bgcolor="#FFFFFF"> </iframe>
    <!-- end #mainContent --></div>
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
  <div id="footer">
    <p align="center"><span class="style1">Copyright&copy; nEo Stream Services 2006 - 2010</span></p>
  <!-- end #footer --></div>
<!-- end #container --></div>
</body>
</html>
