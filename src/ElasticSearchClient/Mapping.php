<?php
namespace ElasticSearchClient;

use ElasticSearchClient\ElasticSearchClient;

/**
 * Class to create Maps on Elasticsearch
 */
class Mapping
{
    /**
     * Create mapping for Elasticsearch.
     *
     * @param  array  $map
     * @return \ElasticSearchClient\ElasticSearchClient
     */
    public function createMapping(array $map)
    {
        try {
            $elasticclient = ElasticSearchClient::getClient();
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
            $elasticclient = ElasticSearchClient::getClient();
            $map = ['index' => $index];
            return $elasticclient->indices()->delete($map);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
