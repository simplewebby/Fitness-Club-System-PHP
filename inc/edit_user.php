<?php
// This page is for editing a user record.
// This page is accessed through view_users.php.
	
	 $page_title = 'Edit a User';
	 //include ('header.html');
	 echo '<h1 class="text-center">Edit a User</h1>';
	
	 // Check for a valid user ID, through GET or POST:
	 if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From view_users.php
	 	 $id = $_GET['id'];
	 } elseif ( (isset($_POST['id'])) &&
(is_numeric($_POST['id'])) ) { // Form submission.
	 	 $id = $_POST['id'];
	 } else { // No valid ID, kill the script.
	 	 echo '<p class="error">This page has been accessed in error.</p>';
	 	 include ('inc/footer.html');
	 	 exit();
	 }
	
	 require_once ('./mysqli_connect.php');
	
	 // Check if the form has been submitted:
	 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
          $errors = array();
 
          	 	 // Check for a first name:
          	 	 if (empty($_POST['first_name'])) {
          	 	 	 $errors[] = 'You forgot to enter your first name.';
          	 	 } else {
          	 	 	 $fn = mysqli_real_escape_string($dbc,
          trim($_POST['first_name']));
          	 	 }
          	 	
          	 	 // Check for a last name:
          	 	 if (empty($_POST['last_name'])) {
          	 	 	 $errors[] = 'You forgot to enter
          your last name.';
          	 	 } else {
          	 	 	 $ln = mysqli_real_escape_string($dbc,
          trim($_POST['last_name']));
          	 	 }
          	
          	 	 // Check for an email address:
          	 	 if (empty($_POST['email'])) {
          	 	 	 $errors[] = 'You forgot to enter your email address.';
          	 	 } else {
          	 	 	 $e = mysqli_real_escape_string($dbc, trim($_POST['email']));
          	 	 }
          	 	
          	 	 if (empty($errors)) { // If everything's OK.
          	 	
          	 	 	 //		Test for unique email address:
          	 	 	 $q = "SELECT member_id FROM members WHERE email='$e' AND member_id != $id";
          	 	 	 $r = @mysqli_query($dbc, $q);
          	 	 	 if (mysqli_num_rows($r) == 0) {
          	
          	 	 	 	 // Make the query:
          	 	 	 	 $q = "UPDATE members SET first_name='$fn', last_name='$ln',email='$e' WHERE member_id=$id LIMIT 1";
          	 	 	 	 $r = @mysqli_query ($dbc, $q);
          	 	 	 	 if (mysqli_affected_rows($dbc)== 1) { // If it ran OK.
          	
          	 	 	 	 	 // Print a message:
								   echo '
								   <div class="container">
								   <p>The member has been edited.</p>
								   <button  class="btn btn-outline-info .mr-3"><a href="view_users.php">View Members</a></button>
								   <button class="btn btn-outline-info .mr-5" ><a href="../index.html">Home</a></button>         
                                   </div>';
                                } else { // If it did not run OK.
                                    
                                echo '<p class="error">The member
                                    could not be edited due to a
                                    system error. We apologize for
                                    any inconvenience.</p>';
                                    // Public message.
                                	 echo '<p>' . mysqli_error($dbc). '<br />Query: ' . $q . '</p>'; // Debugging message.
                                    	 	 	 	 }
                                    	 	 	 	 	
                                    	 	 	 } else { // Already registered.
                                    	 	 	 	 echo '<p class="error">The
                                    email address has already been
                                    registered.</p>';
                                    	 	 	 }
                                    	 	 	
                                    	 	 } else { // Report the errors.
                                    	
                                    	 	 	 echo '<p class="error">The
                                    following error(s) occurred:<br />';
                                    	 	 	 foreach ($errors as $msg) {
                                    // Print each error.
                                    	 	 	 	 echo " - $msg<br />\n";
                                    	 	 	 }
                                    	 	 	 echo '</p><p>Please try again.</p>';
                                    	 	
                                    	 	 } // End of if (empty($errors)) IF.
                                    	
                                    	 } // End of submit conditional.
                                	
                                    	 // Always show the form...
                                    	
                                    	 // Retrieve the user's information:
                                    	 $q = "SELECT first_name, last_name,email FROM members WHERE member_id=$id";
                                    	 $r = @mysqli_query ($dbc, $q);
                                    	
                                    	 if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.
                                    	
                                    	 	 // Get the user's information:
                                    	 	 $row = mysqli_fetch_array ($r,MYSQLI_NUM);
                                    	 	
                                    	 	 // Create the form:
											  echo '
											  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
											<meta http-equiv="content-type"content="text/html; charset=utf-8" />
									<div class="container">		 
									<form action="edit_user.php" method="post">
										<div class="form-group">
											  <label>First Name</label>
											  <input type="text" name="first_name" class="form-control" value="' . $row[0] . '" /> 
										</div>
										<div class="form-group">
											  <label>Last Name</label>
											  <input type="text" name="last_name" class="form-control" value="' . $row[1] . '" /> 
										</div>	
										<div class="form-group">
											  <label>Email</label>
											  <input type="text"  name="email" class="form-control" value="' . $row[2] . '"	/> 
										</div>	
                                    	<input type="submit" name="submit"class="btn btn-outline-primary" value="Submit" />
                                        <input type="hidden" name="id" value="' .$id . '" />
                                        </form>
                                        </div>'; 	
                                         	 } else { // Not a valid user ID.
                                         	 	 echo '<p class="error">This page has been accessed in error.</p>';
                                         	 }
                                         	
                                         	 mysqli_close($dbc);
                                         	 	 	
                                         	 include ('inc/footer.html');
                                         	 ?>