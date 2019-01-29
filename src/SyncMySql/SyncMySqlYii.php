<?php
namespace SyncMySql;

use ElasticSearchClient\ElasticSearchClient;
use MySQLWithElasticsearchExceptions\SyncMySqlExceptions;
use SyncMySql\Connection\YiiConnection;
use SyncMySql\SyncMySql;

class SyncMySqlYii extends SyncMySql
{
    /**
     * Constructor
     * @return void
     */
    public function __construct()
    {
        $this->con = new YiiConnection();
        $this->client = new ElasticSearchClient();
    }

    /**
     * Sync All data of MySQL in Elasticsearch.
     *
     * @param  $con, $tablename
     * @return \ElasticSearchClient\ElasticSearchClient
     */
    public function insertAllData($model)
    {
        try {
            $this->validate(['model' => $model]);
            $query = null;

            $allData = $this->con->getAllData($model, $query);
            $params = null;
            foreach ($allData as $key => $data) {
                $params['body'][] = array(
                    'index' => array(
                        '_index' => $this->client->getIndex(),
                        '_type'  => $model->tableName(),
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
    public function insertNode($model)
    {
        $this->validate(['model' => $model]);
        $query = null;

        $data = $this->con->getData($model, $query);
        
        $params = [
            'index' => $this->client->getIndex(),
            'type'  => $model->tableName(),
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
    public function updateNode($model)
    {
        $this->validate(['model' => $model]);
        
        $query = null;
        
        $data = $this->con->getData($con, $query);
        
        $params = [
            'index' => $this->client->getIndex(),
            'type'  => $model->tableName(),
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
    public function deleteNode($model,$id)
    {
        $this->validate();
        
        $params = [
            'index' => $this->client->getIndex(),
            'type'  => $model->tableName(),
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
            if ($data['model'] == null) {
                throw new SyncMySqlExceptions("Please provide a valid model");
            }
        }
    }
}
