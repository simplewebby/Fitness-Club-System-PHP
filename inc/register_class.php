<?php 
$page_title = 'Register for Class';
include ('index.html');

if ($_SERVER['REQUEST_METHOD'] =='POST') {
$errors = array();

if (empty($_POST['class_name'])) {
    $errors[] = 'You forgot to enter your class name.';
    } else {
    $cn = trim($_POST['class_name']);
    }


    if (empty($_POST['instructor_name'])) {
    $errors[] = 'You forgot to enter your istructor name.';
    } else {
    $iname = trim($_POST['instructor_name']);
    }



    if (!empty($_POST['member_reg'])) {
    if ($_POST['member_reg'] != $_POST['member_reg']) {
    $errors[] = 'Your ID did not match name.';
    } else {
    $mg= trim($_POST['member_reg']);
    }


    } else {
    $errors[] = 'You forgot to enter your name.';
    }

    if (empty($errors)) { // If everything's OK.
     // Register the user in the database...
     require ('./mysqli_connect.php'); // Connect to the db. 
     // Make the query:
    $q = "INSERT INTO classes (class_name, instructor_name, member_reg, class_date ) VALUES
    ('$cn','$iname', '$mg', NOW() )";

    $r = @mysqli_query ($dbc, $q); // Run the query.
    if ($r) { // If it ran OK.
      // Print a message:
     echo '

     <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta http-equiv="content-type"content="text/html; charset=utf-8" />
    
    <div class="container">
     <h2>You are registered for class!!!</h2> <br/>
     <h2>Thank You! </h2> <br/>
     <button  class="btn btn-primary"><a class="text-white "href="view_users.php">Go Back</a></button>
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
          <h1 class="text-center mb-3 mt-3">Register For A Class</h1>
          <div class="form-group">
        	 <form action="register_class.php" method="post"  >
        	<label>Class Name: </label>
          <input type="text" name="class_name" class="form-control" value="<?php if
        (isset($_POST['class_name'])) echo $_POST['class_name']; ?>" />

        <label>Instructor Name: </label>
          <input type="instructor_name" name='instructor_name' class="form-control" value="<?php if
        (isset($_POST['instructor_name'])) echo $_POST['instructor_name']; ?>"		/>

        <label>Your Name: </label>
          <input type="member_reg" name='member_reg' class="form-control" value="<?php if
        (isset($_POST['member_reg'])) echo $_POST['member_reg']; ?>"		/>
        	 
        	 	<input type="submit"class="btn btn-primary mt-5" name="submit" value="Register For a Class" />
           </form>
           </div>
           </div>
       	 <?php include ('includes/footer.html'); ?>


