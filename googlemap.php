<?php
header("Access-Control-Allow-Origin: *");
$url = "water_coordinate.json";
$data = file_get_contents($url);
print $data;
?>