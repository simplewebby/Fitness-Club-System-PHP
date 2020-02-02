<?php 
$page_title = 'Register';
include ('index.html');

if ($_SERVER['REQUEST_METHOD'] =='POST') {
$errors = array();

if (empty($_POST['first_name'])) {
    $errors[] = 'You forgot to enter your first name.';
    } else {
    $fn = trim($_POST['first_name']);
    }


    if (empty($_POST['last_name'])) {
    $errors[] = 'You forgot to enter your last name.';
    } else {
    $ln = trim($_POST['last_name']);
    }



    if (empty($_POST['email'])) {
    $errors[] = 'You forgot to enter your email address.';
    } else {
    $e = trim($_POST['email']);
    }



    if (!empty($_POST['member_id'])) {
    if ($_POST['member_id'] != $_POST['member_id']) {
    $errors[] = 'Your ID did not match the confirmed password.';
    } else {
    $p = trim($_POST['member_id']);
    }


    } else {
    $errors[] = 'You forgot to enter your ID.';
    }

    if (empty($errors)) { // If everything's OK.
     // Register the user in the database...
     require ('./mysqli_connect.php'); // Connect to the db. 
     // Make the query:
    $q = "INSERT INTO members (member_id, first_name, last_name, email ) VALUES
    ('$p','$fn', '$ln', '$e' )";

    $r = @mysqli_query ($dbc, $q); // Run the query.
    if ($r) { // If it ran OK.
      // Print a message:
     echo '

     <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta http-equiv="content-type"content="text/html; charset=utf-8" />
    
    <div class="container">
     <h2>You are registered!!!</h2> <br/>
     <h2>Please log in</h2> <br/>
     <button  class="btn btn-primary"><a class="text-white "href="login.php">LogIn</a></button>
      </div>';
    } else { // If it did not run OK.
       	
     // Public message:
                  echo ' <h1>System Error</h1>
        	 	 	 <p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>';
       	
      	 	 	 	 // Debugging message:
      	 	 	 	 echo '<p>' . mysqli_error($dbc) . '<br/><br />Query: ' . $q . '</p>';
       	 	 	 	 	
        	 	 	 } // End of if ($r) IF.
       	 	 	
        	 	 	 mysqli_close($dbc); // Close the database connection.
       	 	 	
        	 	 	 // Include the footer and quit the script:
        	 	 	 include ('includes/footer.html');
        	 	 	 exit();
      	 	 	
        	 	 } else { // Report the errors.
        	 	
        	 	 	 echo '<h1>Error!</h1>
        	 	 	 <p class="error">The following error(s) occurred:<br />';
        	 	 	 foreach ($errors as $msg) { // Print each error.
        	 	 	 	 echo " - $msg<br />\n";
        	 	 	 }
       	 	 	 echo '</p><p>Please try again.</p><p><br /></p>';
        	 	 	
        	 	 } // End of if (empty($errors)) IF.
       	
        	 } // End of the main Submit conditional.
        	 ?>
          
          <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
          <meta http-equiv="content-type"content="text/html; charset=utf-8" />
          
          <div class="container">
          <h1>Register</h1>
          <div class="form-group">
        	 <form action="register.php" method="post"  >
        	<label>First Name: </label>
          <input type="text" name="first_name" class="form-control" value="<?php if
        (isset($_POST['first_name'])) echo $_POST['first_name']; ?>" />

       	 	 <label>Last Name: </label>
          <input type="text" name="last_name" class="form-control" value="<?php if
        (isset($_POST['last_name'])) echo $_POST['last_name']; ?>" />


        	 	 <label>Email Address: </label>
            <input type="text" name="email" class="form-control" value="<?php if
        (isset($_POST['email'])) echo $_POST['email']; ?>"		/> 

        <label>Member Id: </label>
          <input type="member_id" name='member_id' class="form-control" value="<?php if
        (isset($_POST['member_id'])) echo $_POST['member_id']; ?>"		/>
        <div class="form-group form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck1">
      <label class="form-check-label" for="exampleCheck1">Confirmation Needed</label>
      </div>	 	 
        	 	<input type="submit"class="btn btn-primary" name="submit" value="Register" />
           </form>
           </div>
           </div>
       	 <?php include ('includes/footer.html'); ?>


