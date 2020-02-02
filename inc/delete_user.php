<?php # Script 10.2 - delete_user.php	 
// This page is for deleting a user record.
	// This page is accessed through view_users.php.
	
	 $page_title = 'Delete a User';
	
	 echo '<h1 class="text-center m-5" >Delete a User</h1>';
	
	 // Check for a valid user ID, through GET or POST:
	 if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From view_users.php
	 	 $member_id = $_GET['id'];
	 } elseif ( (isset($_POST['id'])) &&(is_numeric($_POST['id'])) ) { // Form submission.
	 	 $member_id = $_POST['id'];
	 } else { // No valid ID, kill the script.
	 	 echo '<p class="error">This page has been accessed in error.</p>';
	 	 include ('inc/footer.html');
	 	 exit();
	 }
	
	 require_once ('./mysqli_connect.php');
	
	 // Check if the form has been submitted:
	 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	 	 if ($_POST['sure'] == 'Yes') {
	 	 // Delete the record.
	
	 	 	 // Make the query:
	 	 	 $q = "DELETE FROM members WHERE member_id=$member_id LIMIT 1";
	 	 	 $r = @mysqli_query ($dbc, $q);
	 	 	 if (mysqli_affected_rows($dbc) ==1) { // If it ran OK.
	
	 	 	 	 // Print a message:
					echo '
					<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
					<meta http-equiv="content-type"content="text/html; charset=utf-8" />
					<div class="container text-center">
					<p>The member has been deleted.</p>
					<button  class="btn btn-primary"><a class="text-white "href="view_users.php">Go Back</a></button></div>
					';	
	
	 	 	 } else { // If the query did not run OK.
                    echo '<p class="error">The member could not be deleted due to a system error.</p>'; // Public message.
                    
                    echo '<p>' . mysqli_error($dbc)
                    . '<br />Query: ' . $q . '</p>';
                    // Debugging message.
                    	 	 	 }
                    	 	
                    	 	 } else { // No confirmation of deletion.
                    	 	 	 echo '<p>The member has NOT been deleted.</p>';	
                    	 	 }
                    	
                    	 } else { // Show the form.
                    	
                    	 	 // Retrieve the user's information:
                    	 	 $q = "SELECT CONCAT(last_name, first_name) as name, email FROM members WHERE member_id=$member_id";
                    	 	 $r = @mysqli_query ($dbc, $q);
                    	
                    	 	 if (mysqli_num_rows($r) == 1) {// Valid user ID, show the form.
                    	
                    	 	 	 // Get the user's information:
                    	 	 	 $row = mysqli_fetch_array ($r,MYSQLI_NUM);
                    	 	 	
                    	 	 	 // Display the record being deleted:
								   echo '
								   <div class="text-center mb-5">
								   <h3 text-center mb-5>Name:'. $row[0].'</h3>Are you sure you want to delete this member? </div>';
                    	 	 	
                    	 	 	 // Create the form:
								   echo '
								   <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
								<meta http-equiv="content-type"content="text/html; charset=utf-8" />
							<div class="container text-center">
							<form action="delete_user.php" method="post">
                    	 	 <input type="radio" name="sure" value="Yes" /> Yes
                    	 	 <input type="radio" name="sure" value="No" checked="checked" /> No <br/>
                    	 	 <input type="submit"  class="btn btn-danger mt-5"  name="submit" value="Submit" />
                    	 	 <input type="hidden" name="id" value="' . $member_id . '" />
							  </form>
							  </div>
							  ';
                    	 	
                    	 	 } else { // Not a valid user ID.
                    	 	 	 echo '<p class="error">This page has been accessed in error.</p>';
                    	 	 }
                    	
                    	 } // End of the main submission conditional.
                    	
                    	 mysqli_close($dbc);
                    	 	 	
                    	 include ('inc/footer.html');
                    	 ?>