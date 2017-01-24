# Connect MySQL With Elasticsearch

A small library to connect MySQL with Elasticsearch. Use it to sync data and do full text search. Working example can be found on my article [How To Setup Elasticsearch With MySQL](https://www.cloudways.com/blog/setup-elasticsearch-with-mysql/)


Clone the library

`git clone https://github.com/ahmedkhan847/mysqlwithelasticsearch`

Now, run `composer install` to install the required dependencies. 

Or use composer to install complete package.

`composer require ahmedkhan847/mysqlwithelasticsearch:dev-release1`

Once the package is install copy the **sample-config.php** file from the vendor folder and rename it to **config.php**.

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
