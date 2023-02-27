<?php
if (($open = fopen("dataoperator.csv", "r")) !== FALSE) {

    while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
        $array[] = $data;
    }

    fclose($open);
}
echo "<pre>";
//To display array data
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
        // $conn->query("update sls set NomorBatch=? where KdKec=? and KdDesa=? and KdSls=?",[]);
    }
} else {
    echo "0 results";
}
print_r($array[0]);

foreach ($array as $arr) {
    print_r($arr);
    $conn->query("update sls set Operator=".$arr[3]." where KdKec=".$arr[0]." and KdDesa=".$arr[1]." and KdSls=".$arr[2]." and Operator=''");
    # code...
}
$conn->close();
