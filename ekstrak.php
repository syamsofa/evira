<?php
if (($open = fopen("data.csv", "r")) !== FALSE) {

    while (($data = fgetcsv($open, 1000, ";")) !== FALSE) {
        $array[] = $data;
    }

    fclose($open);
}
echo "<pre>";
//To display array data
print_r($array[1]);
echo "</pre>";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rembangk_evira";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM sls";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        // echo $row["Id"]."\n";
    }
} else {
    echo "0 results";
}
$conn->close();
