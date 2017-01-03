<?php
require "vendor/autoload.php";
use SearchElastic\SearchElastic;

$elastic = new SearchElastic();
$con = new mysqli("localhost","root","","cms");
$result = $elastic->insertAllData($con);

