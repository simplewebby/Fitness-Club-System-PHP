<?php
$con = new mysqli('127.0.0.1', 'root', 'root', 'club');

if($con->connect_errno) {
    // error reporting here
}

$result = $con->query("SHOW TABLES");

if($result->num_rows > 0) {
    echo '<select>';
    while($row = $result->fetch_array(MYSQLI_NUM)) {
        echo '<option>' . $row[0] . '</option>';
    }
    echo '</select>';
}
// Free memory by clearing result
$result->free();

// close connection 
$mysqli->close();