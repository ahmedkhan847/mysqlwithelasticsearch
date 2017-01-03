<?php
namespace SearchElastic;


class SearchElastic
{
    private $elasticclient = null;
    // private $conn = null;

    public function __construct()
    {

        $this->elasticclient = \Elasticsearch\ClientBuilder::create()->build();
        
    }

    public function mapping($params = []){
        $params = ['index' => 'blog'];
        if(empty($params)){
            throw new \Exception("Parameters can't be empty");
            
        }
        $response = $this->elasticclient->indices()->delete($params);
        
       $this->elasticclient->indices()->create($params);
       
    }
    public function insertData($conn,$sql)
    {
        $con    = $conn;
        $client = $this->elasticclient;
        $stmt   = "SELECT articles.article_id,articles.article_name,articles.article_content,articles.img,articles.url,categories.category_name,CONCAT(users.u_fname,' ',users.u_lname) AS username,DATE_FORMAT(articles.date,'%d-%m-%Y') AS dates FROM article INNER JOIN users ON users.user_id = article.user_Id INNER JOIN articles ON articles.article_id = article.article_id INNER JOIN categories ON categories.category_id = articles.category_id ";
        $result = $con->query($stmt);
        $params = null;

        while ($row = $result->fetch_assoc()) {
            $params['body'][] = array(
                'index' => array(
                    '_index' => 'blog',
                    '_type'  => 'article',
                    '_id'    => $row['article_id'],
                ),
            );

            $params['body'][] = [
                'article_name'    => $row['article_name'],
                'article_content' => $row['article_content'],
                'article_url'     => $row['url'],
                'category_name'   => $row['category_name'],
                'username'        => $row['username'],
                'date'            => $row['dates'],
                'article_img'     => $row['img'],
            ];
        }
        $responses = $client->bulk($params);
        
        return true;

    }

    public function insertNode($articleid, $con)
    {
        $conn   = $con;
        $client = $this->elasticclient;
        $stmt   = "SELECT articles.article_id,articles.article_name,articles.article_content,articles.img,articles.url,categories.category_name,CONCAT(users.u_fname,' ',users.u_lname) AS username,DATE_FORMAT(articles.date,'%d-%m-%Y') AS dates FROM article INNER JOIN users ON users.user_id = article.user_Id INNER JOIN articles ON articles.article_id = article.article_id INNER JOIN categories ON categories.category_id = articles.category_id WHERE articles.article_id = $articleid";
        $result = $con->query($stmt);
        $params = null;

        while ($row = $result->fetch_assoc()) {
            $params = [
                'index' => 'blog',
                'type'  => 'article',
                'id'    => $row['article_id'],
                'body'  => [
                    'article_name'    => $row['article_name'],
                    'article_content' => $row['article_content'],
                    'article_url'     => $row['url'],
                    'category_name'   => $row['category_name'],
                    'username'        => $row['username'],
                    'date'            => $row['dates'],
                    'article_img'     => $row['img'],
                ]];
        }
        $responses = $client->index($params);

        return true;

    }

    public function updateNode($articleid, $con)
    {
        $conn   = $con;
        $client = $this->elasticclient;
        $stmt   = "SELECT articles.article_id,articles.article_name,articles.article_content,articles.img,articles.url,categories.category_name,CONCAT(users.u_fname,' ',users.u_lname) AS username,DATE_FORMAT(articles.date,'%d-%m-%Y') AS dates FROM article INNER JOIN users ON users.user_id = article.user_Id INNER JOIN articles ON articles.article_id = article.article_id INNER JOIN categories ON categories.category_id = articles.category_id WHERE articles.article_id = $articleid";
        $result = $con->query($stmt);
        $params = null;

        while ($row = $result->fetch_assoc()) {
            $params = [
                'index' => 'blog',
                'type'  => 'article',
                'id'    => $row['article_id'],
                'body'  => [
                    'article_name'    => $row['article_name'],
                    'article_content' => $row['article_content'],
                    'article_url'     => $row['article_id'],
                    'category_name'   => $row['category_name'],
                    'username'        => $row['username'],
                    'date'            => $row['dates'],
                    'article_img'     => $row['img'],
                ]];
        }
        $responses = $client->update($params);

        return true;

    }

    public function deleteNode($id)
    {
        $client = $this->elasticclient;
        $params = [
            'index' => 'blog',
            'type'  => 'article',
            'id'    => $id,
        ];

        $responses = $client->delete($params);

        return true;

    }

    public function search($query)
    {
        $client = $this->elasticclient;
        $result = array();

        $i = 0;

        $params = [
            'index' => 'blog',
            'type'  => 'article',
            'body'  => [
                'query' => [
                    'match' => ['article_content' => $query],
                ],
            ],
        ];
        $query                 = $client->search($params);
        $hits                  = sizeof($query['hits']['hits']);
        $hit                   = $query['hits']['hits'];
        $result['searchfound'] = $hits;
        while ($i < $hits) {

            $result['result'][$i] = $query['hits']['hits'][$i]['_source'];

            $i++;
        }

        return  $result;
    }

}
