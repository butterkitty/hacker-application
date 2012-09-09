<?php 
	require_once("Connections/mainDB.php");
 ?>
<?PHP
// Start the login session
session_start();

if (!$_SESSION['user'] || !$_SESSION['pass']) {

// What to do if the user hasn't logged in
// We'll just redirect them to the login page.
header('Location: login.php');
die();

} else {


// If the session variables exist, check to see
// if the user has access.

$result = mysql_query("SELECT count(id) FROM NeoStreams WHERE name='$_SESSION[user]' AND admpasswd='$_SESSION[pass]'") or die("Couldn't query the user-database.");
$num = mysql_result($result, 0);


if (!$num) {
// If the credentials didn't match,
// redirect the user to the login screen.
header('Location: login.php');
die();
}
}

//AUTHENTICATED
if ($_POST['On_x']) {
  mysql_query("UPDATE NeoStreams SET status='START' WHERE name='$_SESSION[user]' AND admpasswd='$_SESSION[pass]'") or die("Database Modification Error");
}
else if ($_POST['emailbut_x']) {
  mysql_query("UPDATE NeoStreams SET email='$_POST[email]' WHERE name='$_SESSION[user]' AND admpasswd='$_SESSION[pass]'") or die("Database Modification Error");
}
else if ($_POST['pw_x']) {
  mysql_query("UPDATE NeoStreams SET passwd='$_POST[passwd]' WHERE name='$_SESSION[user]' AND admpasswd='$_SESSION[pass]'") or die("Database Modification Error");
}
if ($_POST['publicon_x']) {
  mysql_query("UPDATE NeoStreams SET public_server='always' WHERE name='$_SESSION[user]' AND admpasswd='$_SESSION[pass]'") or die("Database Modification Error");
}
if ($_POST['publicoff_x']) {
  mysql_query("UPDATE NeoStreams SET public_server='never' WHERE name='$_SESSION[user]' AND admpasswd='$_SESSION[pass]'") or die("Database Modification Error");
}
else if ($_POST['logout_x']) { session_unset(); header('Location: login.php'); } //echo '<META HTTP-EQUIV="refresh" content="0;URL=login.php">'; }

$result = mysql_query("SELECT * FROM NeoStreams WHERE name='$_SESSION[user]' AND admpasswd='$_SESSION[pass]'") or die("Couldn't query the user-database.");
$userinfo = mysql_fetch_array($result);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
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
.twoColFixLt #container {
	width: 780px; /* the auto margins (in conjunction with a width) center the page */
	border: 1px solid #000000;
	text-align: left; /* this overrides the text-align: center on the body element. */
	margin-top: 0;
	margin-right: auto;
	margin-bottom: 0;
	margin-left: auto;
	background-color: #FFFFFF;
}
.twoColFixLt #sidebar1 {
	float: none; /* since this element is floated, a width must be given */
	width: 750px; /* the actual width of this div, in standards-compliant browsers, or standards mode in Internet Explorer will include the padding and border in addition to the width */
	background: #EBEBEB;
	padding-top: 15px;
	padding-right: 10px;
	padding-bottom: 15px;
	padding-left: 20px;
	height: 100px;
}
.twoColFixLt #mainContent {
	margin-top: 0;
	margin-right: 0;
	margin-bottom: 0;
	margin-left: 0px;
	padding-top: 0;
	padding-right: 20px;
	padding-bottom: 20px;
	padding-left: 20px;
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
.style2 {
	font-size: 10pt
}
--> 
</style>
<!--[if IE 5]>
<style type="text/css"> 
/* place css box model fixes for IE 5* in this conditional comment */
.twoColFixLt #sidebar1 { width: 230px; }
</style>
<![endif]--><!--[if IE]>
<style type="text/css"> 
/* place css fixes for all versions of IE in this conditional comment */
.twoColFixLt #sidebar1 { padding-top: 30px; }
.twoColFixLt #mainContent { zoom: 1; }
/* the above proprietary zoom property gives IE the hasLayout it needs to avoid several bugs */
</style>
<![endif]--></head>

<body class="twoColFixLt">

<div id="container">
  <div id="sidebar1">
    <h3 align="center">
      <!-- end #sidebar1 -->
      <img src="images/bannercontrolpanel.jpg" width="718" height="82" /></h3>
    </div>
    <form id="stream" name="stream" method="post" action="<?php echo $PHP_SELF; ?>">
	<center>
	  Choose Stream: 
	  <select name="selstream">
		<?php      
		while($row = mysql_fetch_array($result))
 		{
	    echo "<option value=\""$userinfo['ip'].":".$userinfo['port']."\">".$userinfo['port']."</option>";
        }
        ?>
	  </select>
    </center>
    </form>
  <div id="mainContent">
    <form id="form1" name="form1" method="post" action="./index.php">
    <table width="759" height="414" border="1">
      <tr>
        <td width="163" height="73"><div align="center">
            <label>
              <input name="emailbut" type="image" id="emailbut" src="images/emailreminders.png" alt="email" />
              </label>
          </div></td>
        <td width="174"><div align="center">
            <label>
              <input name="email" type="text" id="email" value="<?php //echo $userinfo['email']; ?>" size="25"/>
              </label>
          </div></td>
        <td width="233"><div align="center" class="style2">You can signup for email reminders by entering your email in the text box and clicking the Email Reminders button!</div></td>
        <td width="161" Colspan="2"><div class="style13" align="center"><?php echo $userinfo[email]; ?></div></td>
      </tr>
      <tr>
        <td height="66"><div align="center">
            <label>
              <input type="image" name="pw" id="pw" src="images/changestreampassword.png" alt="passwd"/>
              </label>
          </div></td>
        <td><div align="center">
            <label>
              <input name="passwd" type="text" id="passwd" value="<?php //echo $userinfo['passwd']; ?>" size="25"/>
              </label>
          </div></td>
        <td><div align="center"><span class="style2">To change your stream password, enter the new password in the box and click the Change Stream Password Box.</span></div></td>
        <td Colspan="2"><div class="style13" align="center"><?php echo $userinfo[passwd]; ?></div></td>
      </tr>
      <tr>
        <td height="69"><div align="center">
            <label>
              <input type="image" name="imageField6" id="imageField6" src="images/adminpw.png" />
              </label>
          </div></td>
        <td><div align="center">
            <label>
              <input name="admpasswd" type="text" id="admpasswd" value="<?php //echo $userinfo['admpasswd']; ?>" size="25"/>
              </label>
        </div></td>
        <td><div align="center"><span class="style2">To change your Streams Admin password enter the new password in the box and click the change admin password box.</span></div></td>
        <td Colspan="2"><div class="style13" align="center"><?php echo $userinfo[admpasswd]; ?></div></td>
      </tr>
      <tr>
        <td height="71"><div align="center">
            <label>
              <input name="On" type="image" id="On" src="images/restartstream.png" alt="START" />
              </label>
          </div></td>
        <td><div align="center"></div></td>
        <td><div align="center"><span class="style2">To restart your stream, simply click the restart stream button and wait for the status indicator to turn solid green.</span></div></td>
        <td><div class="style13" align="center"><img width="45" height ="45" img src="<?php
      if ($userinfo[status] == "START") { echo 'images/start.gif'; }
      else if ($userinfo[status] == "STOP") { echo 'images/stop.gif'; }
      else if ($userinfo[status] == "RUNNING") { echo 'images/on.JPG'; }
      else { echo 'images/off.JPG'; }
      ?>"></div></td>
      </tr>
      <tr>
        <td height="57"><div align="center">
            <label>
              <input name="publicoff" type="image" id="public_server" src="images/setstreamprivate.png" alt="never" />
              </label>
          </div></td>
        <td><div align="center">
            <label>
              <input name="publicon" type="image" value="public_server" src="images/setstreampublic.png" alt="always" />
              </label>
          </div></td>
        <td><div align="center">
          <p class="style2">Setting your stream Public will list your stream on shoutcast.com as a radio station!</p>
          </div></td>
        <td><div class="style13" align="center"><img width="140" height ="45" img src="<?php
      if ($userinfo[public_server] == "never") { echo 'images/private.png'; }
      else if ($userinfo[public_server] == "always") { echo 'images/public.png'; }
      else { echo 'images/private.png'; }
      ?>"></div></td>
      </tr>
      <tr>
        <td><div align="center">
            <label>
              <input type="image" name="imageField7" id="imageField7" src="images/expiredate.png" />
              </label>
        </div></td>
        <td Colspan="2"><div class="style13" align="center"><?php echo date("F j, Y", strtotime($userinfo[end_date])); ?></div></td>
        <td><div align="center"><span class="style2">This is the date your stream expires.</span></div></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td Colspan="2"><div align="center">
          <label>
          <input name="logout" type="image" id="logout" src="images/logout.png" alt="LOGOUT" />
          </label>
        </div></td>
        <td>&nbsp;</td>
      </tr>
    </table>
    </form>
	<br />
	<table width="200" border="1" align="center">
      <tr>
        <td><div align="center">
        <script type="text/javascript"><!--
google_ad_client = "pub-9874767300154518";
/* 468x60, created 10/24/08 */
google_ad_slot = "8619702711";
google_ad_width = 468;
google_ad_height = 60;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
        </div></td>
      </tr>
    </table>
	</div>
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
<!-- end #container --></div>
</body>
</html>
