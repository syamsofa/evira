<?php



$url = "https://docs.google.com/spreadsheets/d/19STw8fAHIq6aR7wcefXQAdAqSk93BZXzu2bJf1WNIas/gviz/tq?tqx=out:csv&sheet=PENERIMAAN%20DOK%20REGSOSEK";

$data = file_get_contents($url);
file_put_contents('./jos.csv', $data);
$rows = explode("\n",$data);
$array = array();
foreach($rows as $row) {
    $array[] = str_getcsv($row);
}

// print_r($array[12]);

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


foreach ($array as $arr) {
    print_r($arr);
    $conn->query("update sls set NomorBatch=".$arr[14]." ,Vk1=".$arr[15].",Vk2=".$arr[16].",K=".$arr[17].",Xk=".$arr[18].",Psls=".$arr[19].",PetaWs=".$arr[20].",Banr=".$arr[21].",HasilVerifikasi=".$arr[22]."  where KdKec=".$arr[5]." and KdDesa=".$arr[6]." and KdSls=".$arr[9]."");
    # code...
}
$conn->close();
