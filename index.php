<?php
require "vendor/autoload.php";

use SyncMySql\SyncMySQL;
use SyncMySql\Connection\MySQLiConnection;
use SearchElastic\Search;
use ElasticSearchClient\Mapping;

// $con = new mysqli('localhost','root','','laravel');

// $mysqls = new MySQLiConnection();
$connection = new \PDO('mysql:host=localhost;dbname=laravel;','root', '');
$sync = new Search();
$sync->setIndex("blog");
$sync->setType("user");
$sync->setSearchColumn("name");
// $sync->setConnection($mysqls);
echo print_r($sync->search("ahmed khan"));
// echo print_r($sync->updateNode($con,'users',21));
// echo $sync->insertNode([
//     "id" => 5,
//     "name0" => "abc",
//     "design" => "pattern"
// ]);
   
// $search = new Search();
// $search->setIndex("abc");
// $search->setType("asd");
// $search->setSearchColumn("name");
// echo print_r($search->search("ahmed"));

// $client = new Mapping();
// // $map=;
// $mapping = ['index' => 'abc3',
//             'body' => [
//             'mappings' => [
//                             'article' => [
//                                 'properties' => [
//                                     'id' => [
//                                         'type' => 'integer'
//                                     ],
//                                     'article_name' => [
//                                         'type' => 'string'
//                                     ],
//                                     'article_content' => [
//                                         'type' => 'string'
//                                     ],
//                                     'article_url' => [
//                                         'type' => 'string'
//                                     ],
//                                     'category_name' => [
//                                         'type' => 'string'
//                                     ],
//                                     'username' => [
//                                         'type' => 'string'
//                                     ],
//                                     'date' => [
//                                         'type' => 'date',
//                                         'format' => 'dd-MM-yyyy'
//                                     ],
//                                     'article_img' => [
//                                         'type' => 'string'
//                                     ],
//                                 ]
//                             ]
//                         ]
//                     ]
//             ];
// echo print_r($client->deleteMapping("abc"));

$connection = new PDO('mysql:host=localhost;dbname=laravel;','root', '');

print_r($connection);