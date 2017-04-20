# Connect MySQL With Elasticsearch
A small library to connect MySQL with Elasticsearch. Use it to sync data and do full text search. Working example can be found on my article [How To Setup Elasticsearch With MySQL](https://www.cloudways.com/blog/setup-elasticsearch-with-mysql/)

Clone the library

`git clone -b release1 https://github.com/ahmedkhan847/mysqlwithelasticsearch`

Now, run `composer install` to install the required dependencies. 

Or use composer to install complete package.

`composer require ahmedkhan847/mysqlwithelasticsearch:1.* s`

Once the package is install copy the **sample-config.php** file from the vendor folder and rename it to **config.php**.

##Creating config.php file

```php
<?php
$config['index'] = "blog";
$config['type'] ="article";
/*Fields for Elasticsearch same as you are using in your mysql table*/
$config['mappings'] = [
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
];
/* SQL query to insert all the data useful when you are using insertAllData($conn) function */
$config['sqlalldata'] = "SELECT articles.article_id,articles.article_name,articles.article_content,articles.img,articles.url,categories.category_name,CONCAT(users.u_fname,' ',users.u_lname) AS username,DATE_FORMAT(articles.date,'%d-%m-%Y') AS dates FROM article INNER JOIN users ON users.user_id = article.user_Id INNER JOIN articles ON articles.article_id = article.article_id INNER JOIN categories ON categories.category_id = articles.category_id ";
/* SQL query to insert or update single data for insertNode($id = null, $con) where id will concated on runtime passed in parameter*/
$config['sqlsingledata'] = "SELECT articles.article_id,articles.article_name,articles.article_content,articles.img,articles.url,categories.category_name,CONCAT(users.u_fname,' ',users.u_lname) AS username,DATE_FORMAT(articles.date,'%d-%m-%Y') AS dates FROM article INNER JOIN users ON users.user_id = article.user_Id INNER JOIN articles ON articles.article_id = article.article_id INNER JOIN categories ON categories.category_id = articles.category_id WHERE articles.article_id =";

/*Replace your table row id field name here*/
//$config['rowid'] = "article_id";

/*Where to search*/
$config['search']['match'] = "article_content";
```

##Indexing All MySQL data in Elasticsearch
```php
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
```

##Searching in Elasticsearch
```php
<?php
require "vendor/autoload.php";
include "config.php";
use SearchElastic\SearchElastic;

$elastic = new SearchElastic($config);
$result = $elastic->search("node js");
echo "<pre>";
print_r($result);
echo "</pre>";
```
You can find the working example for this repository in these files:

https://github.com/ahmedkhan847/customcms/blob/master/search.php 
https://github.com/ahmedkhan847/customcms/blob/master/class/articles.php

If you want contribute, fork **master** branch.