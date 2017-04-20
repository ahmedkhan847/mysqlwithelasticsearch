<?php
namespace SearchElastic;

use ElasticSearchClient\ElasticSearchClient;
use SearchElastic\Exceptions\SyncMySqlExceptions;
use SearchElastic\PDOConnection;
use SearchElastic\Connection\Connection;

/**
* Class to Sync MySQL Database
*/
class SyncMySql
{
    private $index = null;
    private $type = null;
    private $selectQuery = "SELECT * FROM ";
    private $idColumn = 'id';
    private $con = null;
    private $client = null;
    private $queryChanged = false;
    /**
     * Constructor
     * @void
     */
    function __construct() {
        $this->con = new PDOConnection();
        $this->client = ElasticSearchClient::getClient();
    }

    /**
     * Set Database Connection.
     *
     * @param  SearchElastic\Connection\Connection  $con
     * @void
     */
    public function setConnection(Connection $con)
     {
         $this->con = $con;
     }
    /**
     * Set Index to Use in Elasticsearch.
     *
     * @param  string  $index
     * @void
     */
    public function setIndex($index)
    {
        $this->index = $index;
    }

    /**
     * Set Type to use in Elasticsearch
     *
     * @param  string  $type
     * @void
     */
    public function setType($type)
    {
        $this->index = $type;
    }

    /**
     * Get Index to use in Elasticsearch.
     *
     * @return index
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * Get Type to use in Elasticsearch.
     *
     * @return type
     */
    public function getType()
    {
        return $this->index;
    }

    /**
     * Set Id column which will be set as ID in Elasticsearch index
     *
     * @param  string  $column
     * @void
     */
    public function setIdColumn($column)
    {
        $this->idColumn = $column;
    }

    /**
     * Set sqlQuery column which will be set as ID in Elasticsearch index
     *
     * @param  string  $column
     * @void
     */
    public function setSqlQuery($sqlQuery)
    {
        $this->queryChanged = true;
        $this->selectQuery = $sqlQuery;
    }

    /**
     * Sync All data of MySQL in Elasticsearch.
     *
     * @param  $con, $tablename
     * @return \ElasticSearchClient\ElasticSearchClient
     */
    public function insertAllData($con, $tableName = null)
    {
        try{
            $this->validate(['con' => $con, 'tableName' => $tableName]);
            $query = null;
            
            if($this->queryChanged){
                $query = $this->selectQuery;
            }else{
                $query = $this->selectQuery.$tableName;
            }

            $allData = $this->con->getData($con,$query);
            
            $params = null;
            foreach ($allData as $key => $data) {
                $params['body'][] = array(
                    'index' => array(
                        '_index' => $this->index,
                        '_type'  => $this->type,
                        '_id'    => $data[$this->idColumn],
                    ),
                );
                $params['body'][] = $data;
            }
            $responses = $this->client->bulk($params);
            return $responses;

        } catch (\Elasticsearch\Common\Exceptions\NoNodesAvailableException $ex){
            throw new SyncMySqlExceptions("Check your elasticsearch connetion"); 
        }       
    }

    /**
     * Insert single data in Elasticsearch.
     *
     * @param  $con,$tablename
     * @return \ElasticSearchClient\ElasticSearchClient
     */
    public function insertNode($con,$tableName = null,$insertId)
    {
        $this->validate(['con' => $con, 'tableName' => $tableName, 'insertId' => $insertId]);
        if($this->queryChanged){
            $query = $this->selectQuery." WHERE ".$this->idColumn." = ". $insertId;
        }else{
            $query = $this->selectQuery.$tableName." WHERE ".$this->idColumn." = ". $insertId;
        }
        $data = $this->con->getData($con,$query);
        $client = ElasticSearchClient::getClient();
        $params = [
            'index' => $this->index,
            'type'  => $this->type,
            'id'    => $data[$this->idColumn],
            'body'  => $data
        ];
        $responses = $this->client->index($params);
        return $responses;
    }

    /**
     * Update single data in Elasticsearch.
     *
     * @param  array  $data
     * @return \ElasticSearchClient\ElasticSearchClient
     */
    public function updateNode($con,$tableName = null,$insertId)
    {
        $this->validate(['con' => $con, 'tableName' => $tableName, 'insertId' => $insertId]);
        if($this->queryChanged){
            $query = $this->selectQuery." WHERE ".$this->idColumn." = ". $insertId;
        }else{
            $query = $this->selectQuery.$tableName." WHERE ".$this->idColumn." = ". $insertId;
        }
        $data = $this->con->getData($con,$query);
        $client = ElasticSearchClient::getClient();
        /* Change the query with your own query to fetch data from database*/
        $params = [
            'index' => $this->index,
            'type'  => $this->type,
            'id'    => $data[$this->idColumn],
            'body'  => ['doc' => $data]
        ];
        $responses = $this->client->update($params);
        return $responses;
    }

    /**
     * Insert single data in Elasticsearch.
     *
     * @param  int  $id
     * @return \ElasticSearchClient\ElasticSearchClient
     */
    public function deleteNode($id)
    {
        $this->validate();
        $client = ElasticSearchClient::getClient();
        $params = [
            'index' => $this->index,
            'type'  => $this->type,
            'id'    => $id,
        ];
        $responses = $this->client->delete($params);
        return $responses;
    }

    /**
     * Validation of $data.
     *
     * @param  array  $data
     * @return \ElasticSearchClient\ElasticSearchClient
     */
    protected function validate(array $data = null)
    {
        if($this->client == null){
            throw new SyncMySqlExceptions("Check if elasticsearch is running on your machine or not");
        }
        if ($this->getIndex() == null) {
            throw new SyncMySqlExceptions("Index cannot be null");
        }
        if ($this->getType() == null) {
            throw new SyncMySqlExceptions("Type cannot be null");
        }
        if ($data['con'] == null) {
            throw new SyncMySqlExceptions("Please provide a valid database connection string");
        }
        if($this->queryChanged == false){
            if (empty($data['tableName'])) {
                throw new SyncMySqlExceptions("Please provide a tablename for SELECT query");
            }
        }
        if (isset($data['insertId'])) {
            if (empty($data['insertId'])) {
                throw new SyncMySqlExceptions("Please provide the last inserted Id");
            }            
        }                            
    }
}
