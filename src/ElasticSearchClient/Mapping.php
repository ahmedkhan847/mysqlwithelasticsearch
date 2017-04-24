<?php
namespace ElasticSearchClient;

use ElasticSearchClient\ElasticSearchClient;

/**
 * Class to create Maps on Elasticsearch
 */
class Mapping
{
    /** @var string|null Should contain the client of Elasticsearch from ElasticsearchClient class */
    private $client = null;

    /**
     * Creating $client for Elasticsearch.
     *
     * @return void
     */
    public function __construct()
    {
        $this->client = new ElasticSearchClient;
    }
    /**
     * Create mapping for Elasticsearch.
     *
     * @param  array  $map An array of elasticsearch mapping
     * @return \ElasticSearchClient\ElasticSearchClient
     */
    public function createMapping(array $map)
    {
        try {
            $elasticclient = $this->client->getClient();
            $response = $elasticclient->indices()->create($map);
            return  $response['acknowledged'];
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Delete the previous mapping by passing its name
     *
     * @param  $index Name of an exisiting index to delete
     * @return \ElasticSearchClient\ElasticSearchClient
     */
    public function deleteMapping($index)
    {
        try {
            $elasticclient = $this->client->getClient();
            $map = ['index' => $index];
            $response = $elasticclient->indices()->delete($map);
            return $response['acknowledged'];
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
