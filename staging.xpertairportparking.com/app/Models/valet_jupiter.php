<?php

$servername = "your_server_name";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SHOW TABLES");
$tables = array();
while ($row = $result->fetch_row()) {
    $tables[] = $row[0];
}

echo  $tables;
// Loop through the tables and delete them
// foreach ($tables as $table) {
//     $sql = "DROP TABLE $table";
    
//     if ($conn->query($sql) === TRUE) {
//         echo "Table $table deleted successfully<br>";
//     } else {
//         echo "Error deleting table $table: " . $conn->error . "<br>";
//     }
// }


$conn->close();
?>
