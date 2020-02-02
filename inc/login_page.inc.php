<?php # Script 12.1 - login_page.inc.php
// This page prints any errors associated with logging in
// and it creates the entire login page,including the form.
	
// Include the header:
$page_title = 'Login';

	
// Print any error messages, if they exist:
if (isset($errors) && !empty($errors)) {
echo '<h1>Error!</h1>
<p class="error">The followingerror(s) occurred:<br />';
foreach ($errors as $msg) {
echo " - $msg<br />\n";
 }
echo '</p><p>Please try again.</p>';
}

 // Display the form:
?>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<meta http-equiv="content-type"content="text/html; charset=utf-8" />
<div class="container">
<h1>Please Login </h1>
 <form action="login.php" method="post">
 <div class="form-group">    
  <label>Email Address: </label>
  <input type="text"name="email" class="form-control"  />
 </div>
 <div class="form-group">    
  <label>Member Id: </label>
  <input type="password"name="member_id" class="form-control" />
 </div>
<input type="submit" name="submit"value="Login" class="btn btn-primary" />
</form>
</div>


<?php include ('includes/footer.html');
?>