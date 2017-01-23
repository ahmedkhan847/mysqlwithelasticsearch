<?php
require "vendor/autoload.php";
include "config.php";
use SearchElastic\SearchElastic;

$elastic = new SearchElastic($config);
$con = new mysqli("localhost","root","","cms");
$result = $elastic->insertAllData($con);

echo '<pre>';
print_r($result);
echo '</pre>';