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
    private $selectQuery = null;
    private $idColumn = 'id';
    private $con = null;
    
    /**
     * Constructor
     * @void
     */
    function __construct() {
        $this->con = new PDOConnection();
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
     * Create mapping for Elasticsearch.
     *
     * @return index
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * Create mapping for Elasticsearch.
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
     * Sync All data of MySQL in Elasticsearch.
     *
     * @param  array  $allData
     * @return \ElasticSearchClient\ElasticSearchClient
     */
    public function insertAllData(array $allData)
    {
        $this->validate($allData);
        $client = ElasticSearchClient::getClient();
        /* Change the query with your own query to fetch data from database*/
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
        $responses = $client->bulk($params);
        return $responses;
    }

    /**
     * Insert single data in Elasticsearch.
     *
     * @param  array  $data
     * @return \ElasticSearchClient\ElasticSearchClient
     */
    public function insertNode(array $data)
    {
        $this->validate($data);
        $client = ElasticSearchClient::getClient();
        $params = [
            'index' => $this->index,
            'type'  => $this->type,
            'id'    => $data[$this->idColumn],
            'body'  => $data
        ];
        $responses = $client->index($params);
        return $responses;
    }

    /**
     * Update single data in Elasticsearch.
     *
     * @param  array  $data
     * @return \ElasticSearchClient\ElasticSearchClient
     */
    public function updateNode(array $data)
    {
        $this->validate($data);
        $client = ElasticSearchClient::getClient();
        /* Change the query with your own query to fetch data from database*/
        $params = [
            'index' => $this->index,
            'type'  => $this->type,
            'id'    => $data[$this->idColumn],
            'body'  => ['doc' => $data]
        ];
        $responses = $client->update($params);
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
        $client = ElasticSearchClient::getClient();
        $params = [
            'index' => $this->index,
            'type'  => $this->type,
            'id'    => $id,
        ];
        $responses = $client->delete($params);
        return $responses;
    }

    /**
     * Validation of $data.
     *
     * @param  array  $data
     * @return \ElasticSearchClient\ElasticSearchClient
     */
    protected function validate($data = null)
    {
        if ($this->getIndex() == null) {
            throw new SyncMySqlExceptions("Index cannot be null");
        }
        if ($this->getType() == null) {
            throw new SyncMySqlExceptions("Type cannot be null");
        }
        if ($data != null) {
            if (count($data) == 0) {
                throw new SyncMySqlExceptions("$data can't be null");
            }
        }
    }
}
