<?php 
 function redirect_user ($page = 'index.php') {
	
// Start defining the URL...
 // URL is http:// plus the host nameplus the current directory:
$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
	
// Remove any trailing slashes:
 $url = rtrim($url, '/\\');

// Add the page:
$url .= '/' . $page;

// Redirect the user:
header("Location: $url");
exit(); // Quit the script.

} 
 function check_login($dbc, $email = '',
$member_id = '') {
	
 $errors = array( ); // Initialize error array.
 // Validate the email address:
 if (empty($email)) {
  $errors[] = 'You forgot to enter your email address.';
  } else {
 $e = mysqli_real_escape_string($dbc, trim($email));
}
  
 // Validate the password:
 if (empty($member_id)) {
 $errors[] = 'You forgot to enter your password.';
 } else {
 $id = mysqli_real_escape_string($dbc, trim($member_id));
  }
  	
if (empty($errors)) { // If everything's OK.
 // Retrieve the user_id and first_name for that email/password combination:
$q = "SELECT member_id, first_name FROM members WHERE email='$e' AND member_id='$id'";		
 $r = @mysqli_query ($dbc, $q);
    // Run the query.
 	
 // Check the result:
 if (mysqli_num_rows($r) == 1) {
  // Fetch the record:
   $row = mysqli_fetch_array ($r,MYSQLI_ASSOC);

// Return true and the record:
   return array(true, $row);
  	
 	 } else { // Not a match!
    $errors[] = 'The email address and password entered do not match those on file.';
    }
 	 	
    } // End of empty($errors) IF.
    	
   	 // Return false and the errors:
   	 	 return array(false, $errors);
  
   } // End of check_login( ) function.