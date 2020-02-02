<?php # Script 12.11 - logout.php #2
 // This page lets the user logout.
// This version uses sessions.
	
session_start(); // Access the existing session.

// If no session variable exists,redirect the user:
 if (!isset($_SESSION['member_id'])) {
	
 // Need the functions:
require ('login_functions.inc.php');
redirect_user();	
 	
} else { // Cancel the session:
	
$_SESSION = array(); // Clear thevariables.
session_destroy(); // Destroy the session itself.
setcookie ('PHPSESSID', '', time()-3600,'/', '', 0, 0); // Destroy the cookie.
 }
	
// Set the page title and include theHTML header:
$page_title = 'Logged Out!';
 include ('./header.html');

// Print a customized message:
echo "<h1>Logged Out!</h1>
<p>You are now logged out!</p>";

include ('includes/footer.html');
?>