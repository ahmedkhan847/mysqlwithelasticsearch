<?php
namespace ElasticSearchClient;

use ElasticSearchClient\ElasticSearchClient;

/**
 * Class to create Maps on Elasticsearch
 */
class Mapping
{
    private $client = null;

    /**
     * Create mapping for Elasticsearch.
     *
     * @void \ElasticSearchClient\ElasticSearchClient
     */
    function __construct() {
        $this->client = new ElasticSearchClient;
    }
    /**
     * Create mapping for Elasticsearch.
     *
     * @param  array  $map
     * @return \ElasticSearchClient\ElasticSearchClient
     */
    public function createMapping(array $map)
    {
        try {
            $elasticclient = $this->client->getClient();
            return  $elasticclient->indices()->create($map);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Delete the previous mapping by passing its name
     *
     * @param  $index
     * @return \ElasticSearchClient\ElasticSearchClient
     */
    public function deleteMapping($index)
    {
        try {
            $elasticclient = $this->client->getClient();
            $map = ['index' => $index];
            return $this->client->indices()->delete($map);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
