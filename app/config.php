<?php
$DBservername = "localhost";
$DBname = "hotel";
$DBusername = "root";
$DBpassword = "";

// Create connection
$conn = new mysqli($DBservername, $DBusername, $DBpassword, $DBname);
// Check connection
$conn->set_charset("utf8");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//$sql = "SELECT id, firstname, lastname FROM MyGuests";
//$result = $conn->query($sql);
//
//if ($result->num_rows > 0) {
//    // output data of each row
//    while($row = $result->fetch_assoc()) {
//        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
//    }
//} else {
//    echo "0 results";
//}
?>