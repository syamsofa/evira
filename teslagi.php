<?php



$url = "https://docs.google.com/spreadsheets/d/19STw8fAHIq6aR7wcefXQAdAqSk93BZXzu2bJf1WNIas/gviz/tq?tqx=out:csv&sheet=PENERIMAAN%20DOK%20REGSOSEK";

$data = file_get_contents($url);
$rows = explode("\n",$data);
$s = array();
foreach($rows as $row) {
    $s[] = str_getcsv($row);
}

print_r($s);