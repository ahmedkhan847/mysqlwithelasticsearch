<?php
namespace SearchElastic;


class SearchElastic
{
    private $elasticclient = null;
    // private $conn = null;
    private $rowid = "id";
    private $config = null;
    public function __construct($config)
    {
        $this->config = $config;
        $this->elasticclient = \Elasticsearch\ClientBuilder::create()->build();
        
    }

    public function deleteMapping($index)
    {
        try{
            $map = ['index' => $index];
            $this->elasticclient->indices()->delete($map);
        }
        catch(\Exception $ex){
            return $ex->getMessage();
        }

    }
    public function createMapping(){
        try{
            /* Change it according to your needs*/
                $map = ['index' => $this->config['index'],
                        'body' => [
                            'mappings' => $this->config['mappings']
                        ]
                    ];
            
            $response =  $this->elasticclient->indices()->create($map);
            return $response;
        }
        catch(\Exception $ex){
            return $ex->getMessage();
        }
       
    }
    public function insertAllData($conn)
    {
        try{
            $this->checkRowId();
            $con    = $conn;
            $client = $this->elasticclient;
            /* Change the query with your own query to fetch data from database*/
            $stmt   = $this->config['sqlalldata'];
            $result = $con->query($stmt);
            $params = null;
            /*Change the row column names with your own column names*/   
            while ($row = $result->fetch_assoc()) {
                $params['body'][] = array(
                    'index' => array(
                        '_index' => $this->config['index'],
                        '_type'  => $this->config['type'],
                        '_id'    => $row[$this->rowid],
                    ),
                );

                $params['body'][] = $row;
            }
            
            $responses = $client->bulk($params);
            
            return $responses;
        }
        catch(\Exception $ex){
            return $ex->getMessage();
        }

    }

    public function insertNode($id = null, $con)
    {
       try{
            $this->checkRowId();
            $conn   = $con;
            $client = $this->elasticclient;
            /* Change the query with your own query to fetch data from database*/
            $stmt   =  $this->config['sqlsingledata'] . $id;
            $result = $con->query($stmt);
            $params = null;
            /*Change the row column names with your own column names*/
            while ($row = $result->fetch_assoc()) {
                $params = [
                    'index' => $this->config['index'],
                    'type'  => $this->config['type'],
                    'id'    => $row[$this->rowid],
                    'body'  => $row
                    ];
            }
            $responses = $client->index($params);
            return $responses;
       }
        catch(\Exception $ex){
            return $ex->getMessage();
        }

        

    }

    public function updateNode($id = null, $con)
    {
        try{
            $conn   = $con;
            $client = $this->elasticclient;
            /* Change the query with your own query to fetch data from database*/
            $stmt   = $this->config['sqlsingledata'] . $id;
            $result = $con->query($stmt);
            $params = null;
            /*Change the row column names with your own column names*/
            while ($row = $result->fetch_assoc()) {
                $params = [
                    'index' => $this->config['index'],
                    'type'  => $this->config['type'],
                    'id'    => $row[$this->rowid],
                    'body'  => $row
                    ];
            }
            $responses = $client->update($params);

            return $responses;
        }
        catch(\Exception $ex){
            return $ex->getMessage();
        }

    }

    public function deleteNode($id)
    {
        try{
            $client = $this->elasticclient;
            $params = [
                'index' => $this->config['index'],
                'type'  => $this->config['type'],
                'id'    => $id,
            ];
            $responses = $client->delete($params);
            return $responses;

        }
        catch(\Exception $ex){
            return $ex->getMessage();
        }
        

    }

    public function search($query)
    {
        try{
            $client = $this->elasticclient;
            $result = array();
            /* Change the match column name with the column name you want to search in it.*/
            $i = 0;

            $params = [
                'index' => $this->config['index'],
                'type'  => $this->config['type'],
                'body'  => [
                    'query' => [
                        'match' => [ $this->config['search']['match'] => $query],
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
        catch(\Exception $ex){
            return $ex->getMessage();
        }
        
    }

    private function checkRowId()
    {
        if(isset($this->config['rowid'])){
            $this->rowid = $this->config['rowid'];
        }
    }
}
