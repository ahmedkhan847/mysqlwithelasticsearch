<?php
namespace SyncMySql;

use ElasticSearchClient\ElasticSearchClient;
use MySQLWithElasticsearchExceptions\SyncMySqlExceptions;
use SyncMySql\Connection\PDOConnection;
use SyncMySql\Connection\Connection;

/**
* Class to Sync MySQL Database
*/
class SyncMySql
{
    /** @var string Default search query */
    protected $selectQuery = "SELECT * FROM ";
    /** @var string Default id columnn for a database table */
    protected $idColumn = 'id';
    /** @var string|null Should contain the instance of Connection class */
    protected $con = null;
    /** @var string|null Should contain the instance of ElasticsearchClient */
    protected $client = null;
    /** @var bool Set true when you use your custom query  */
    protected $queryChanged = false;
    
    /**
     * Constructor
     * @return void
     */
    public function __construct()
    {
        $this->con = new PDOConnection();
        $this->client = new ElasticSearchClient();
    }

    /**
     * Set Database Connection.
     *
     * @param  SyncMySql\Connection\Connection  $con
     * @return void
     */
    public function setConnection(Connection $con)
    {
        $this->con = $con;
    }
    /**
     * Set Index to Use in Elasticsearch.
     *
     * @param  string  $index
     * @return void
     */
    public function setIndex($index)
    {
        $this->client->setIndex($index);
    }

    /**
     * Set Type to use in Elasticsearch
     *
     * @param  string  $type
     * @return void
     */
    public function setType($type)
    {
        $this->client->setType($type);
    }

    /**
     * Set Id column which will be set as ID in Elasticsearch index
     *
     * @param  string  $column
     * @return void
     */
    public function setIdColumn($column)
    {
        $this->idColumn = $column;
    }

    /**
     * Set sqlQuery to get data from database
     *
     * @param  string  $sqlQuery Select query for database
     * @return void
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
        try {
            $this->validate(['con' => $con, 'tableName' => $tableName]);
            $query = null;
            
            if ($this->queryChanged) {
                $query = $this->selectQuery;
            } else {
                $query = $this->selectQuery.$tableName;
            }

            $allData = $this->con->getData($con, $query);
            $params = null;
            foreach ($allData as $key => $data) {
                $params['body'][] = array(
                    'index' => array(
                        '_index' => $this->client->getIndex(),
                        '_type'  => $this->client->getType(),
                        '_id'    => $data[$this->idColumn],
                    ),
                );
                $params['body'][] = $data;
            }
            $responses = $this->client->getClient()->bulk($params);
            return $responses;
        } catch (\Elasticsearch\Common\Exceptions\NoNodesAvailableException $ex) {
            throw new SyncMySqlExceptions("Check your elasticsearch connetion");
        }
    }

    /**
     * Insert single data in Elasticsearch.
     *
     * @param  $con,$tablename
     * @return \ElasticSearchClient\ElasticSearchClient
     */
    public function insertNode($con, $insertId, $tableName = null)
    {
        $this->validate(['con' => $con, 'tableName' => $tableName, 'insertId' => $insertId]);
        if ($this->queryChanged) {
            $query = $this->selectQuery." WHERE ".$this->idColumn." = ". $insertId;
        } else {
            $query = $this->selectQuery.$tableName." WHERE ".$this->idColumn." = ". $insertId;
        }
        $data = $this->con->getData($con, $query);
        $client = ElasticSearchClient::getClient();
        $params = [
            'index' => $this->client->getIndex(),
            'type'  => $this->client->getType(),
            'id'    => $data[0][$this->idColumn],
            'body'  => $data[0]
        ];
        $responses = $this->client->getClient()->index($params);
        return $responses['result'];
    }

    /**
     * Update single data in Elasticsearch.
     *
     * @param  array  $data
     * @return \ElasticSearchClient\ElasticSearchClient
     */
    public function updateNode($con, $insertId, $tableName = null)
    {
        $this->validate(['con' => $con, 'tableName' => $tableName, 'insertId' => $insertId]);
        
        if ($this->queryChanged) {
            $query = $this->selectQuery." WHERE ".$this->idColumn." = ". $insertId;
        } else {
            $query = $this->selectQuery.$tableName." WHERE ".$this->idColumn." = ". $insertId;
        }
        
        $data = $this->con->getData($con, $query);
        
        $params = [
            'index' => $this->client->getIndex(),
            'type'  => $this->client->getType(),
            'id'    => $data[0][$this->idColumn],
            'body'  => ['doc' => $data[0]]
        ];
        
        $responses = $this->client->getClient()->update($params);
        return $responses['result'];
    }

    /**
     * Delete single data from Elasticsearch.
     *
     * @param  int  $id
     * @return \ElasticSearchClient\ElasticSearchClient
     */
    public function deleteNode($id)
    {
        $this->validate();
        
        $params = [
            'index' => $this->client->getIndex(),
            'type'  => $this->client->getType(),
            'id'    => $id,
        ];
        $responses = $this->client->getClient()->delete($params);
        return $responses['result'];
    }

    /**
     * Validation of $data.
     *
     * @param  array  $data
     * @return \ElasticSearchClient\ElasticSearchClient
     */
    protected function validate(array $data = null)
    {
        if ($this->client->getIndex() == null) {
            throw new SyncMySqlExceptions("Index cannot be null");
        }
        if ($this->client->getType() == null) {
            throw new SyncMySqlExceptions("Type cannot be null");
        }
        if ($data != null) {
            if ($data['con'] == null) {
                throw new SyncMySqlExceptions("Please provide a valid database connection string");
            }
            if ($this->queryChanged == false) {
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
}
