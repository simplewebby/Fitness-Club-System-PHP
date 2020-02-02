<?php 
# Script 9.4 - view_users.php
	 // This script retrieves all the records from the users table.
	
	 $page_title = 'View the Current Users';
	 //include ('header.html');
	
	 // Page header:
	 echo '<h1 class="text-center">Registered Members</h1>';
	
	 require_once ('./mysqli_connect.php'); // Connect to the db.
	 // Number of records to show per page:
     $display = 10;	 
     
  // Determine how many pages there are...
    if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
	$pages = $_GET['p'];
	} else { // Need to determine.

// Count the number of records:
 $q = "SELECT COUNT(member_id) FROM members";
 $r = @mysqli_query ($dbc, $q);
 $row = @mysqli_fetch_array ($r,MYSQLI_NUM);
 $records = $row[0];
	
 // Calculate the number of pages...
 if ($records > $display) { // More than 1 page.
$pages = ceil ($records/$display);
 } else {
 $pages = 1;
 }
	 	
 } // End of p IF.

// Determine the sort...
// Default is by registration date.
$sort = (isset($_GET['sort'])) ?
$_GET['sort'] : 'rd';
	
// Determine the sorting order:
switch ($sort) {
case 'ln':
$order_by = 'last_name ASC';
break;
case 'fn':
$order_by = 'first_name ASC';
break;
case 'email':
$order_by = 'email ASC';
break;
default:
$order_by = 'member_id ASC';
$sort = 'member_id';
break;
 }

// Determine where in the database to start returning results...
if (isset($_GET['s']) && is_numeric($_GET['s'])) {
$start = $_GET['s'];
 } else {
 $start = 0;
 }
// Make the query:
	 $q = "SELECT member_id as member_id,last_name as last_name, first_name as first_name, email as email FROM members ORDER BY member_id ASC LIMIT $start, $display";	 	
	 $r = @mysqli_query ($dbc, $q); // Run the query.
	


// Table header:
echo '
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<meta http-equiv="content-type"content="text/html; charset=utf-8" />
<div class="container">
<table class="table">
 <tr>
 <td align="left"><b>Edit</b></td>
 <td align="left"><b>Delete</b></td>
 <td align="left"><b>Member Id</b></td>
 <td align="left"><b>Last Name</b></td>
 <td align="left"><b>First Name</b></td>
 <td align="left"><b>Email</b></td>
 </tr> </div>';
	 	
// Fetch and print all the records:
$bg = '#eeeeee'; // Set the initial background color.
	
while ($row = mysqli_fetch_array($r,MYSQLI_ASSOC)) {
	
$bg = ($bg=='#eeeeee' ? '#ffffff' :'#eeeeee'); // Switch the background color.
 	
echo '<tr bgcolor="' . $bg . '">
<td align="left"><a href="edit_user.php?id=' . $row['member_id'] .'">Edit</a></td>
<td align="left"><a href="delete_user.php?id=' . $row['member_id'] .'">Delete</a></td>
<td align="left">' . $row['member_id'] . '</td>
<td align="left">' . $row['last_name'] . '</td>
<td align="left">' . $row['first_name'] . '</td>
<td align="left">' . $row['email'] .'</td>
</tr>
';
} // End of WHILE loop.
echo '<button type="button" class="btn btn-outline-warning"><a  href="logout.php">Logout</a></button><br/><br/>
<button type="button" class="btn btn-outline-warning"><a  href="register_class.php">Register For a Class</a></button><br/><br/>

';	
echo '</table>';
mysqli_free_result ($r);
mysqli_close($dbc);
	
// Make the links to other pages, if necessary.
if ($pages > 1) {
	 	
// Add some spacing and start aparagraph:
echo '<br /><p>';
 	
// Determine what page the script is on:	
$current_page = ($start/$display)+ 1;
	 	
// If it's not the first page, make a Previous link:
if ($current_page != 1) {
    echo '<a href="view_users.php?s=' . ($start - $display) .'&p=' . $pages . '&sort=' .$sort . '">Previous</a> ';
}
 
// Make all the numbered pages:
 for ($i = 1; $i <= $pages; $i++) {
  if ($i != $current_page) {
    echo '<a href="view_users.php?s=' . (($display * ($i -1))) . '&p=' . $pages .'&sort=' . $sort . '">' .$i . '</a> ';
   } else {
   echo $i . ' ';
  }
} // End of FOR loop. 	
// If it's not the last page, make aNext button:
if ($current_page != $pages) {
echo '<a href="view_users.php?s=' . ($start + $display) .'&p=' . $pages . '&sort=' .$sort . '">Next</a>';
}
echo '</p>'; // Close the paragraph.
	
} // End of links section
include ('includes/footer.html');
?>