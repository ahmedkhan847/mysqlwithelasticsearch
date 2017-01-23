<?php
$config['index'] = "blog";
$config['type'] ="article";
/*Fields for Elasticsearch Same as you are using in your mysql table*/
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
/*Replace your table row id here if needed*/

$config['rowid'] = "article_id";


/*Where to search*/
$config['search']['match'] = "article_content";
// echo '<pre>';
// print_r($config);
// echo '</pre>';
