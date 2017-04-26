# Connect MySQL With Elasticsearch using PHP

A small library to connect MySQL with Elasticsearch. Use it to sync data and do full text search. Working example for release1 can be found on my article [How To Setup Elasticsearch With MySQL](https://www.cloudways.com/blog/setup-elasticsearch-with-mysql/)

Click here to find the [API documentation for v2](https://ahmedkhan847.github.io/mysqlwithelasticsearch)
# Downloading the latest release

Clone the library

`git clone -b release2 https://github.com/ahmedkhan847/mysqlwithelasticsearch`

Now, run `composer install` to install the required dependencies. 

Or use composer to install complete package.

`composer require ahmedkhan847/mysqlwithelasticsearch:2.*`

## What's in release2?

In release2 package if fully redesign. Now you don't need to pass $config file to constructor. You can set index, type, sql query, sql connection dyamically. Even now you can create your own function for searching in Elasticsearch. Let's see how you can achieve the following:

* [Mapping in Elasticsearch](https://github.com/ahmedkhan847/mysqlwithelasticsearch/tree/master#mapping-in-elasticsearch)
* [Indexing All MySQL data in Elasticsearch](https://github.com/ahmedkhan847/mysqlwithelasticsearch/tree/master#indexing-all-mysql-data-in-elasticsearch)
* [Indexing All MySQL data in Elasticsearch using MySqli Connection](https://github.com/ahmedkhan847/mysqlwithelasticsearch/tree/master#indexing-all-mysql-data-in-elasticsearch-using-mysqli-connection)
* [Indexing Single Data in Elasticsearch](https://github.com/ahmedkhan847/mysqlwithelasticsearch/tree/master#indexing-single-data-in-elasticsearch)
* [Updating in Elasticsearch](https://github.com/ahmedkhan847/mysqlwithelasticsearch/tree/master#updating-in-elasticsearch)
* [Deleting in Elasticsearch](https://github.com/ahmedkhan847/mysqlwithelasticsearch/tree/master#deleting-data-from-elasticsearch)
* [Searching in Elasticsearch](https://github.com/ahmedkhan847/mysqlwithelasticsearch/tree/master#searching-in-elasticsearch)
* [Creating your own search class for Elasticsearch](https://github.com/ahmedkhan847/mysqlwithelasticsearch/tree/master#creating-your-own-search-class-for-elasticsearch)

## Mapping in Elasticsearch

```php
<?php
require "vendor/autoload.php";
use ElasticSearchClient\Mapping;

$mapping = new Mapping();
$map = ['index' => 'blog',
        'body' => [
            'mappings' => [
                'article' => [
                    'properties' => [
                        'id' => [
                            'type' => 'integer'
                        ],
                        'article_name' => [
                            'type' => 'string'
                        ],
                        'article_content' => [
                            'type' => 'string'
                        ],
                        'article_url' => [
                            'type' => 'string'
                        ],
                        'category_name' => [
                            'type' => 'string'
                        ],
                        'username' => [
                            'type' => 'string'
                        ],
                        'date' => [
                            'type' => 'date',
                            'format' => 'dd-MM-yyyy'
                        ],
                        'article_img' => [
                            'type' => 'string'
                        ],
                    ]
                ]
            ]
        ]
       ];
$mapping->createMapping($map);
``` 

## Indexing All MySQL data in Elasticsearch
```php
<?php
require "vendor/autoload.php";
include "config.php";
use SyncMySql\SyncMySql;
$elastic = new SyncMySql();
$connection = new \PDO('mysql:host=localhost;dbname=laravel;', 'root', '');
$sync->setIndex("blog");
$sync->setType("users");
//Where 1st param is the database connection and 2nd param is tableName
$sync->insertAllData($connection, "users");
echo '<pre>';
print_r($result);
echo '</pre>';
```
By default it is using **"SELECT * FROM tablename"**, use **'id'** as a default id column for table and elasticsearch. It is using PDO connection to fetch the data by default. If you want elasticsearch to fetch data using mysqli connection you can also use that you just need to set the connection to `SyncMySql\Connection\MySQLiConnection` or write your own by implementing `SyncMySql\Connection`. Also you can change the select query but don't forget to define an id column in it. Let's see how you can do it.

## Indexing All MySQL data in Elasticsearch using MySqli Connection

```php
<?php
require "vendor/autoload.php";

use SyncMySql\SyncMySql;
use SyncMySql\Connection\MySQLiConnection;
$sync = new SyncMySql();
$connection = new \mysqli('localhost', 'root', '', 'laravel');
$sync->setIndex("blog");
$sync->setType("article");
$sync->setConnection(new MySQLiConnection());
$sync->setSqlQuery("SELECT id,title,body FROM posts");
//Now you don't need to pass the tablename'
$sync->insertAllData($connection);
echo '<pre>';
print_r($result);
echo '</pre>';
```
## Indexing Single Data in Elasticsearch
```php
<?php
require "vendor/autoload.php";

use SyncMySql\SyncMySql;
use SyncMySql\Connection\MySQLiConnection;
$sync = new SyncMySql();
$connection = new \mysqli('localhost', 'root', '', 'laravel');
$sync->setIndex("blog");
$sync->setType("article");
$sync->setConnection(new MySQLiConnection());
$result = $sync->insertNode($connection,21,"users");
echo '<pre>';
print_r($result);
echo '</pre>';
```
If you have want to define you own query then:

```php
<?php
require "vendor/autoload.php";

use SyncMySql\SyncMySql;

$sync = new SyncMySql();
$connection = new \PDO('mysql:host=localhost;dbname=laravel;', 'root', '');
$sync->setIndex("blog");
$sync->setType("article");
$sync->setSqlQuery("SELECT id,title,body FROM posts");
//Now you don't need to pass the tablename'
$result = $sync->insertNode($connection,21);
echo '<pre>';
print_r($result);
echo '</pre>';
```
## Updating in Elasticsearch
```php
<?php
require "vendor/autoload.php";

use SyncMySql\SyncMySql;

$sync = new SyncMySql();
$connection = new \PDO('mysql:host=localhost;dbname=laravel;', 'root', '');
$sync->setIndex("blog");
$sync->setType("article");
$result = $sync->updateNode($connection,21,"users");
echo '<pre>';
print_r($result);
echo '</pre>';
```
Using same technique as we do for insert you can add your own select query using `setSqlQuery()`.

## Deleting data from Elasticsearch
```php
<?php
require "vendor/autoload.php";

use SyncMySql\SyncMySql;

$sync = new SyncMySql();
$sync->setIndex("blog");
$sync->setType("article");
$result = $sync->deleteNode(21);
echo '<pre>';
print_r($result);
echo '</pre>';
```

## Searching in Elasticsearch
```php
<?php
require "vendor/autoload.php";

use SearchElastic\Search;

$search = new Search();
$search->setIndex("blog");
$search->setType("user");
$search->setSearchColumn("name");
$result = $search->search("ahmed khan");
echo '<pre>';
print_r($result);
echo '</pre>';
```
## Creating your own search class for Elasticsearch

In order to write your own search you should extends it from `SearchAbstract` class and complete the `public function search($query)` in it. 
```php
<?php
namespace SearchElastic;

//Extends your class from SearchAbstract
use SearchElastic\SearchAbstract\SearchAbstract;

class CustomPostSearch extends SearchAbstract
{
    /**
     * Write your own search method
     *
     * @param  string  $query
     * @return Result from elasticsearch
     */
    public function search($query)
    {
        $this->validate($query);
        //get the elasticsearch client from the base class
        $client = $this->client->getClient();
        $result = array();
        /* Write your own query*/
        $params = [
            //you can add your index directly here or use this function if you are planning to set it on runtime $search->setIndex("blog") and then use $this->client->getIndex() to get index
                'index' => "blog",
            //you can add your type directly here or use this function if you are planning to set it on runtime using $search->setType("post") and then use $this->client->getIndex()    
                'type'  => "post", 
                'body'  => [
                    'query' => [
                        'match' => [ "post" => $query],
                    ],
                ],
            ];
        $query  = $client->search($params);
        // you can use the base method to extract result from the search or return the result directly    
        return  $this->extractResult($query); 
    }
}
```
If you want contribute, fork **master** branch.
