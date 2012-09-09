<?php
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

require_once("Connections/panelDB.php");
$result = mysql_query("SELECT count(id) FROM cp_login WHERE login='$_SESSION[user]' AND passwd='$_SESSION[pass]'") or die("Couldn't query the user-database.");
$num = mysql_result($result, 0);


if (!$num) {
// If the credentials didn't match,
// redirect the user to the login screen.
header('Location: login.php');
die();
}
}
?>

