<?php
require "vendor/autoload.php";

use SearchElastic\SyncMySQL;
use SearchElastic\MySQLiConnection;
// $elastic = new SearchElastic($config);
// $con = new mysqli("localhost","root","","cms");
// $result = $elastic->insertAllData($con);

// echo '<pre>';
// print_r(ElasticSearchClient::getClient());
// echo '</pre>';
$con = new mysqli('localhost','homestead','homestead','test');
$query = "SELECT * FROM users WHERE id = 1";
$data = [[
    "id" => 1,
    "name0" => "abc",
    "design" => "pattern"
],[
    "id" => 3,
    "name0" => "abc",
    "design" => "pattern"
],[
    "id" => 4,
    "name0" => "abc",
    "design" => "pattern"
],[
    "id" => 5,
    "name0" => "abc",
    "design" => "pattern"
]
];
$mysqls = new MySQLiConnection();
$sync = new SyncMySQL();
 $sync->setIndex("abc");
$sync->setType("asd");
// echo $sync->insertAllData($data);
// echo $sync->insertNode([
//     "id" => 5,
//     "name0" => "abc",
//     "design" => "pattern"
// ]);
$sync->setConnection($mysqls);   
echo print_r($sync->insertAllData($con,"users"));