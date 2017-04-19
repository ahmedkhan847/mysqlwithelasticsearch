<?php
require "vendor/autoload.php";

use SearchElastic\Search;

// $elastic = new SearchElastic($config);
// $con = new mysqli("localhost","root","","cms");
// $result = $elastic->insertAllData($con);

// echo '<pre>';
// print_r(ElasticSearchClient::getClient());
// echo '</pre>';

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
$sync = new Search();
$sync->setIndex("abc");
$sync->setType("asd");
// echo $sync->insertAllData($data);
// echo $sync->insertNode([
//     "id" => 5,
//     "name0" => "abc",
//     "design" => "pattern"
// ]);
echo $sync->search("asd");