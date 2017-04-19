<?php
namespace ElasticSearchClient;

use Elasticsearch\ClientBuilder;

/**
 * 
 */
class ElasticSearchClient
{
    /**
     * Create mapping for Elasticsearch.
     *
     * @return ClientBuilder
     */
    public static function getClient()
    {
        return ClientBuilder::create()->build();
    }
}
