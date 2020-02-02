<?php 
// This page processes the login form submission.
// Upon successful login, the user is redirected.
// Two included files are necessary.
// Send NOTHING to the Web browser prior to the setcookie( ) lines!

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//include ('header.html');
// For processing the login:
require ('./login_functions.inc.php');
 // Need the database connection:
 require ('./mysqli_connect.php');
 // Check the login:
list ($check, $data) = check_login($dbc,$_POST['email'], $_POST['member_id']);
 if ($check) { // OK!
 
 
// Set the session:
session_start();
$_SESSION['member_id'] =$data['member_id'];
$_SESSION['first_name'] =$data['first_name'];

// Store the HTTP_USER_AGENT:
 $_SESSION['agent'] = md5($_SERVER['HTTP_USER_AGENT']);

// Redirect:
//redirect_user('loggedin.php');
redirect_user('view_users.php');
 	 	
 } else { // Unsuccessful!
	
// Assign $data to $errors for error reporting
// in the login_page.inc.php file.
// Assign $data to $errors for login_page.inc.php:
 $errors = $data;

 }
	 	
mysqli_close($dbc); // Close the database connection.
 } // End of the main submit conditional.

// Create the page:
 include ('./login_page.inc.php');
 ?>